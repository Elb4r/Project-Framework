<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #3f3f40, #2575fc);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            background-size: cover;
            animation: gradientBackground 5s ease infinite;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .login-container h1 {
            margin-bottom: 30px;
            color: #333333;
            font-size: 2.5em;
            font-weight: 600;
        }

        .login-container form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555555;
            text-align: left;
        }

        .login-container form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #cccccc;
            border-radius: 8px;
            font-size: 16px;
            color: #333333;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .login-container form input:focus {
            border-color: #2575fc;
            box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
            outline: none;
        }

        .login-container form button {
            width: 100%;
            padding: 12px;
            background-color: #2575fc;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .login-container form button:hover {
            background-color: #6a11cb;
            transform: translateY(-2px);
        }

        .error-messages {
            background-color: #ffe0e0;
            color: #d9534f;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: left;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .error-messages p {
            margin: 0;
        }

        /* Responsive design for smaller screens */
        @media (max-width: 480px) {
            .login-container {
                padding: 20px;
                max-width: 100%;
            }

            .login-container h1 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>

        <!-- Display error messages -->
        @if ($errors->any())
            <div class="error-messages">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
