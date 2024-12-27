<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        /* Same styling as login page */
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, rgba(224 152 207), rgb(144 100 157));
            overflow: hidden;
        }
        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 1rem;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #218838;
        }
        .form-container .login-link {
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<div class="heading">
<h2>Online Quiz - Signup</h2>
</div>
    <div class="form-container">
        <h2>Create an account</h2>
        <form method="POST" action="{{ route('signup') }}">
            @csrf
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="New Password" required>
            <input type="password" name="password_confirmation" placeholder="New Password (repate)" required>
            <button type="submit">Create an account</button>
        </form>
        <div class="login-link">
            <p><a href="{{ route('login') }}">Cancel</a></p>
        </div>
    </div>
</body>
</html>
