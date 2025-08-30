<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to TrueFrame</title>
    <style>
        body { font-family: sans-serif; text-align: center; margin-top: 50px; }
        h1 { color: #333; }
        p { color: #666; }
    </style>
</head>
<body>
    <h1>Welcome to the TrueFrame Framework, <?= htmlspecialchars($name ?? 'Guest') ?>!</h1>
    <p>You've successfully set up your new project.</p>
    <p>Start building something amazing!</p>
    <br>
    <a href="/about">About Us</a>
</body>
</html>