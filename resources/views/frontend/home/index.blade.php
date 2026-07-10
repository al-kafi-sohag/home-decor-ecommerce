<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HB Gallery - Under Construction</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            text-align: center;
            background: white;
            padding: 60px 40px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
        }

        .logo {
            font-size: 48px;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
            font-size: 42px;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .status {
            color: #667eea;
            font-size: 28px;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .message {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .construction-icon {
            font-size: 80px;
            margin: 30px 0;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .whatsapp-section {
            background: #f0f0f0;
            padding: 30px;
            border-radius: 8px;
            margin-top: 30px;
        }

        .whatsapp-label {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .whatsapp-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #25D366;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            transition: background 0.3s ease;
            margin-top: 10px;
        }

        .whatsapp-link:hover {
            background: #20ba5a;
        }

        .whatsapp-icon {
            font-size: 20px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 40px 25px;
            }

            h1 {
                font-size: 32px;
            }

            .status {
                font-size: 22px;
            }

            .construction-icon {
                font-size: 60px;
            }

            .message {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">🎨</div>
        <h1>HB Gallery</h1>
        <div class="status">Under Construction</div>

        <div class="construction-icon">🏗️</div>

        <p class="message">
            We're currently working on creating something amazing for you. Our website will be live very soon. Thank you
            for your patience!
        </p>

        <div class="whatsapp-section">
            <div class="whatsapp-label">Stay Connected</div>
            <a href="https://wa.me/8801343591032" class="whatsapp-link" target="_blank">
                <span class="whatsapp-icon">💬</span>
                WhatsApp: +8801343591032
            </a>
        </div>
    </div>
</body>

</html>
