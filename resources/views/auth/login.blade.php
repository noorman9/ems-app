<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - EMS</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #1f2937;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login-card {
            background: white;
            padding: 30px;
            border-radius: 10px;

            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        .login-header {
            margin-bottom: 25px;
            text-align: center;
        }

        .login-header h1 {
            margin: 0 0 8px;
            font-size: 24px;
        }

        .login-header p {
            margin: 0;
            color: #6b7280;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;

            font-size: 14px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;

            padding: 10px 11px;

            border: 1px solid #d1d5db;
            border-radius: 6px;

            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #2563eb;
        }

        .btn-login {
            width: 100%;

            padding: 10px;

            border: none;
            border-radius: 6px;

            background: #2563eb;
            color: white;

            font-size: 14px;
            font-weight: bold;

            cursor: pointer;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

        .error {
            margin-bottom: 18px;
            padding: 12px 14px;

            border-radius: 6px;

            background: #fee2e2;
            color: #991b1b;

            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="login-card">

            <div class="login-header">
                <h1>Equipment Maintenance System</h1>

                <p>
                    Silakan login untuk melanjutkan.
                </p>
            </div>

            @error('email')
            <div class="error">
                {{ $message }}
            </div>
            @enderror

            <form method="POST" action="{{ url('/login') }}">

                @csrf

                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus>

                </div>

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        required>

                </div>

                <button
                    type="submit"
                    class="btn-login">

                    Login

                </button>

            </form>

        </div>

    </div>

</body>

</html>