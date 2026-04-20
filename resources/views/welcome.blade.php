<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMONTEA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /*CSS Murni sesuai spesifikasi UI/UX sistem*/
        :root {
            --bg-gradient: linear-gradient(135deg, #e8f0fe, #e0ecf8);
            --primary-text: #1e293b;
            --secondary-text: #64748b;
            --accent-gradient: linear-gradient(135deg, #1e3a5f, #2d5a8e);
            --border-color: #e2e8f0;
            --white: #ffffff;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden; /*mencegah scroll akibat animasi background */
            position: relative;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.12;
            z-index: 0;
            animation: float 10s infinite ease-in-out;
        }
        .shape-1 {width: 400px; height: 400px;background: #1e3a5f;top: -100px;left: -100px;}
        .shape-2 {width: 300px;height: 300px;background: #0891b2;}

        @keyframes float{
            0%, 100% {transform: translateY(0) scale(1);}
            50% {transform:translateY(-30px)scale(1.05);}
        }

        /*---desain kartu login---*/
        .login-card{
            background: var(--white);
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(red, green, blue, alpha);
            width: 100%;
            max-width: 400px;
            z-index: 1;
            position: relative;
        }

        /*---animasi logo (pulse)---*/
        .logo-container {text-align: center;margin-bottom: 30px;}
        .logo-icon{
            display: inline-flex;
            justify-content:center;
            align-items: center;
            width: 60px;
            height: 60px;
            background: var(--accent-gradient);
            color: white;
            font-size: 24px;
            font-weight: 800;
            border-radius: 16px;
            margin-bottom: 15px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse{
            0%{box-shadow: 0 0 0 0 rgba(red, green, blue, alpha);}
            70%{box-shadow: 0 0 0 0 rgba(red, green, blue, alpha);}
            100%{box-shadow: 0 0 0 0 rgba(red, green, blue, alpha)}
        }

        h2 {margin: 0; color: var(--primary-text); font-size: 24px; font-weight: 700;}
        p.subtitle{color: var(--secondary-text);margin-top: 5px;font-size: 14px;}

        /*---form input---*/
        .form-group{margin-bottom: 20px;position: relative;}
        label{display: block;margin-bottom: 8px;color: var(--primary-text);font-size:14px; font-weight: 500;}
        input[type="email"], input[type="password"]{
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            box-si
        }
    </style>
</head>
<body>
    
</body>
</html>