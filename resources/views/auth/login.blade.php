<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - Broblems</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #ffffff; /* خلفية بيضاء */
            font-family: 'Tajawal', sans-serif;
            color: #343a40;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-container {
            max-width: 450px;
            width: 100%;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .login-container h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #2575fc;
            text-align: center;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container h1 i {
            margin-left: 10px;
            font-size: 1.5rem;
        }

        .form-label {
            font-weight: bold;
            color: #343a40;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-left: 8px;
            font-size: 1rem;
            color: #2575fc;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            font-size: 0.9rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 8px rgba(37, 117, 252, 0.3);
        }

        .btn-primary {
            background-color: #6a11cb; /* لون جديد للزر */
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            width: 100%;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #4a0d9b; /* لون أغمق عند التحويم */
            transform: translateY(-2px);
        }

        .text-danger {
            font-size: 0.8rem;
            margin-top: 5px;
            color: #dc3545;
        }

        .toggle-link {
            color: #2575fc;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .toggle-link:hover {
            color: #1a5bbf;
            text-decoration: underline;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-check {
            margin-bottom: 15px;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #343a40;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1><i class="fas fa-sign-in-alt"></i> تسجيل الدخول</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- البريد الإلكتروني -->
            <div class="form-group">
                <label for="email" class="form-label"><i class="fas fa-envelope"></i> البريد الإلكتروني</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <!-- كلمة المرور -->
            <div class="form-group">
                <label for="password" class="form-label"><i class="fas fa-lock"></i> كلمة المرور</label>
                <input id="password" class="form-control" type="password" name="password" required>
                @if ($errors->has('password'))
                    <div class="text-danger">{{ $errors->first('password') }}</div>
                @endif
            </div>

        
            <!-- زر تسجيل الدخول -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">تسجيل الدخول</button>
            </div>

            <!-- رابط نسيت كلمة السر -->
            <div class="text-center">
                <a href="{{ route('password.request') }}" class="toggle-link">نسيت كلمة السر؟</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
