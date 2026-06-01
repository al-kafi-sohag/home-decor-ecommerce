import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';

/*
|--------------------------------------------------------------------------
| Reusable AJAX image uploader (Cropper.js)
|--------------------------------------------------------------------------
|
| Drop a <x-backend.image-uploader> component anywhere and this module wires
| it up automatically:
|
|   pick file  ->  crop in a modal  ->  POST the cropped blob to the generic
|   media endpoint  ->  store the returned token in a hidden input  ->  the
|   parent form attaches that token to its record on save.
|
| Nothing here is module-specific, so the same component/JS powers avatars,
| product images, banners, etc.
|
*/

let modal = null;
let modalImage = null;
let confirmBtn = null;
let cropper = null;
let active = null; // the uploader currently being edited

function csrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';
}

function buildModal() {
    if (modal) {
        return;
    }

    modal = document.createElement('div');
    modal.className = 'uploader-modal hidden';
    modal.innerHTML = `
        <div class="uploader-modal__backdrop" data-cropper-cancel></div>
        <div class="uploader-modal__panel">
            <div class="uploader-modal__head">
                <h3>Crop image</h3>
                <button type="button" data-cropper-cancel aria-label="Close">&times;</button>
            </div>
            <div class="uploader-modal__body"><img alt="Crop preview"></div>
            <div class="uploader-modal__foot">
                <button type="button" class="btn-ghost" data-cropper-cancel>Cancel</button>
                <button type="button" class="btn-primary" data-cropper-confirm>Crop &amp; upload</button>
            </div>
        </div>`;

    document.body.appendChild(modal);
    modalImage = modal.querySelector('img');
    confirmBtn = modal.querySelector('[data-cropper-confirm]');

    modal.querySelectorAll('[data-cropper-cancel]').forEach((el) => {
        el.addEventListener('click', closeModal);
    });
    confirmBtn.addEventListener('click', confirmCrop);
}

function openModal() {
    buildModal();
    modal.classList.remove('hidden');
}

function closeModal() {
    if (cropper) {
        cropper.destroy();
        cropper = null;
    }
    if (modal) {
        modal.classList.add('hidden');
    }
    setConfirmLoading(false);
    active = null;
}

function setConfirmLoading(loading) {
    if (!confirmBtn) {
        return;
    }
    confirmBtn.disabled = loading;
    confirmBtn.textContent = loading ? 'Uploading…' : 'Crop & upload';
}

function setStatus(uploader, message, type) {
    const el = uploader.status;
    if (!message) {
        el.classList.add('hidden');
        el.textContent = '';
        return;
    }
    el.textContent = message;
    el.style.color = type === 'error' ? 'var(--admin-danger)' : 'var(--admin-success)';
    el.classList.remove('hidden');
}

function setPreviewLoading(uploader, loading) {
    if (loading) {
        uploader.loading.classList.remove('hidden');
        uploader.loading.style.display = 'flex';
    } else {
        uploader.loading.style.display = '';
        uploader.loading.classList.add('hidden');
    }
}

function openCropper(uploader, file) {
    active = uploader;
    openModal();

    modal.classList.toggle('is-circle', uploader.el.dataset.circle === '1');

    const url = URL.createObjectURL(file);

    if (cropper) {
        cropper.destroy();
        cropper = null;
    }

    modalImage.src = url;
    modalImage.onload = () => {
        const aspect = parseFloat(uploader.el.dataset.aspect);
        cropper = new Cropper(modalImage, {
            aspectRatio: aspect && aspect > 0 ? aspect : NaN,
            viewMode: 1,
            autoCropArea: 1,
            background: false,
            responsive: true,
            movable: true,
            zoomable: true,
        });
    };
}

function confirmCrop() {
    if (!cropper || !active) {
        return;
    }

    const uploader = active;
    const canvas = cropper.getCroppedCanvas({
        width: 800,
        height: 800,
        imageSmoothingEnabled: true,
        imageSmoothingQuality: 'high',
    });

    if (!canvas) {
        return;
    }

    setConfirmLoading(true);

    canvas.toBlob((blob) => {
        if (!blob) {
            setConfirmLoading(false);
            return;
        }
        uploadBlob(uploader, blob);
    }, 'image/png', 0.92);
}

function uploadBlob(uploader, blob) {
    const data = new FormData();
    data.append('file', blob, 'upload.png');

    setPreviewLoading(uploader, true);

    fetch(uploader.el.dataset.uploadUrl, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken(), Accept: 'application/json' },
        body: data,
    })
        .then((response) => response.json().then((json) => ({ ok: response.ok, json })))
        .then(({ ok, json }) => {
            if (!ok || !json.success) {
                const message = json?.errors?.file?.[0] || json?.message || 'Upload failed.';
                setStatus(uploader, message, 'error');
                return;
            }

            const payload = json.data;
            uploader.image.src = payload.url;
            uploader.image.classList.remove('hidden');
            uploader.empty.classList.add('hidden');
            uploader.token.value = payload.token;
            uploader.remove.value = '0';
            uploader.removeBtn.classList.remove('hidden');
            if (uploader.pickLabel) {
                uploader.pickLabel.textContent = 'Change image';
            }
            setStatus(uploader, 'Uploaded — save the form to apply changes.', 'ok');
            closeModal();
        })
        .catch(() => setStatus(uploader, 'Upload failed. Please try again.', 'error'))
        .finally(() => {
            setPreviewLoading(uploader, false);
            setConfirmLoading(false);
        });
}

function removeImage(uploader) {
    const token = uploader.token.value;

    // Discard the pending temp upload server-side, if any.
    if (token) {
        fetch(`${uploader.el.dataset.uploadUrl}/${token}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrfToken(), Accept: 'application/json' },
        }).catch(() => {});
    }

    uploader.token.value = '';
    // Flag the already-saved image for deletion when the form is submitted.
    uploader.remove.value = uploader.el.dataset.hasExisting === '1' ? '1' : '0';

    uploader.image.src = '';
    uploader.image.classList.add('hidden');
    uploader.empty.classList.remove('hidden');
    uploader.removeBtn.classList.add('hidden');
    if (uploader.pickLabel) {
        uploader.pickLabel.textContent = 'Upload image';
    }
    setStatus(uploader, '', null);
}

export function initImageUploaders() {
    document.querySelectorAll('[data-image-uploader]').forEach((el) => {
        if (el.dataset.bound === '1') {
            return;
        }
        el.dataset.bound = '1';

        const uploader = {
            el,
            file: el.querySelector('[data-uploader-file]'),
            image: el.querySelector('[data-uploader-image]'),
            empty: el.querySelector('[data-uploader-empty]'),
            loading: el.querySelector('[data-uploader-loading]'),
            token: el.querySelector('[data-uploader-token]'),
            remove: el.querySelector('[data-uploader-remove]'),
            removeBtn: el.querySelector('[data-uploader-remove-btn]'),
            pickBtn: el.querySelector('[data-uploader-pick]'),
            pickLabel: el.querySelector('[data-uploader-pick-label]'),
            status: el.querySelector('[data-uploader-status]'),
        };

        uploader.pickBtn.addEventListener('click', () => uploader.file.click());
        uploader.file.addEventListener('change', () => {
            const file = uploader.file.files && uploader.file.files[0];
            uploader.file.value = ''; // allow picking the same file again
            if (file) {
                openCropper(uploader, file);
            }
        });
        uploader.removeBtn.addEventListener('click', () => removeImage(uploader));
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
}
