{{--
    Renders validation errors for a single field.

    Usage:
        @include('backend.includes.form-feedback', ['field' => 'email'])

    Handles both flat messages and the occasional nested array of messages
    (e.g. array inputs like items.0.qty) without any per-call branching.
--}}
@if ($errors->has($field))
    @foreach ($errors->get($field) as $error)
        @if (is_array($error))
            @foreach ($error as $er)
                <p class="mt-1.5 text-sm text-rose-600" role="alert">{{ $er }}</p>
            @endforeach
        @else
            <p class="mt-1.5 text-sm text-rose-600" role="alert">{{ $error }}</p>
        @endif
    @endforeach
@endif
