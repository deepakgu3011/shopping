<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Blog Update Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #555;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        .unsubscribe {
            margin-top: 20px;
            font-size: 0.9em;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Blog Update!</h1>
        <p>Hello,</p>
        <p>We are excited to inform you that a new blog has been updated on our website. You can visit the link below to read the latest post:</p>
        <p>
            <a href="{{ url('blog') }}">Click to read</a>
        </p>
        <p>Thank you for being a part of our community!</p>
        <div class="unsubscribe">
            <p>If you no longer wish to receive updates about our blogs, you can unsubscribe using the link below:</p>
            <a href="{{ url('unsubscribe') }}">Unsubscribe</a>
        </div>
    </div>
</body>
</html>
