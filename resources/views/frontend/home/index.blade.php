<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>এইচবি গ্যালারি - নির্মাণাধীন</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Noto Sans Bengali', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        h1 {
            color: #333;
            font-size: 40px;
            margin-bottom: 15px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .status {
            color: #667eea;
            font-size: 24px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .divider {
            width: 60px;
            height: 3px;
            background: #667eea;
            margin: 20px auto 30px;
            border-radius: 2px;
        }

        .message {
            color: #666;
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 40px;
        }

        .whatsapp-section {
            background: #f7f7f9;
            padding: 30px;
            border-radius: 8px;
            margin-top: 30px;
            border: 1px solid #eaeaea;
        }

        .whatsapp-label {
            color: #666;
            font-size: 13px;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .whatsapp-link {
            display: inline-block;
            background: #25D366;
            color: white;
            padding: 15px 35px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            transition: background 0.3s ease;
            margin-top: 10px;
        }

        .whatsapp-link:hover {
            background: #20ba5a;
        }

        @media (max-width: 600px) {
            .container {
                padding: 40px 25px;
            }

            h1 {
                font-size: 30px;
            }

            .status {
                font-size: 20px;
            }

            .message {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>এইচবি গ্যালারি</h1>
        <div class="status">নির্মাণাধীন</div>
        <div class="divider"></div>
        <p class="message">
            আমরা বর্তমানে আপনার জন্য একটি চমৎকার ওয়েবসাইট তৈরি করছি। আমাদের ওয়েবসাইট শীঘ্রই চালু হবে। ধৈর্য ধরার জন্য
            আপনাকে ধন্যবাদ।
        </p>
        <div class="whatsapp-section">
            <div class="whatsapp-label">যোগাযোগ করুন</div>
            <a href="https://wa.me/8801343591032" class="whatsapp-link" target="_blank">
                হোয়াটসঅ্যাপ: +৮৮০১৩৪৩৫৯১০৩২
            </a>
        </div>
    </div>
</body>

</html>
