<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --text-color: #2b2d42;
            --light-gray: #f8f9fa;
            --white: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light-gray);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        
        .login-container {
            background-color: var(--white);
            border-radius: 15px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            text-align: center;
        }
        
        .login-logo {
            margin-bottom: 30px;
        }
        
        .login-logo i {
            font-size: 50px;
            color: var(--primary-color);
        }
        
        .login-title {
            font-size: 24px;
            color: var(--text-color);
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .login-subtitle {
            color: #6c757d;
            margin-bottom: 30px;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-color);
            font-size: 14px;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        
        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 13px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-me input {
            margin-right: 5px;
        }
        
        .forgot-password a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
        
        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn-login:hover {
            background-color: var(--secondary-color);
        }
        
        .login-footer {
            margin-top: 25px;
            font-size: 13px;
            color: #6c757d;
        }
        
        .login-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-footer a:hover {
            text-decoration: underline;
        }
        
        .error-message {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-logo">
            <i class="fas fa-user-circle"></i>
        </div>
        <h1 class="login-title">Inicia sesión</h1>
        <p class="login-subtitle">Ingresa tus credenciales para acceder</p>
        
        <form action="index.php?action=login" method="POST">
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Ingresa tu usuario" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required>
                <?php if (isset($error)): ?>
                    <p class="error-message"><?php echo $error; ?></p>
                <?php endif; ?>
            </div>
            
            <div class="options">
                <div class="remember-me">
                  
                </div>
                <div class="forgot-password">
                    <a href="forgot-password.php"> </a>
                </div>
            </div>
            
            <button type="submit" class="btn-login">LOGIN</button>
        </form>
        
        <div class="login-footer">
            ¿No tienes una cuenta? <a href="index.php?action=register">Regístrate</a>
        </div>
    </div>
</body>
</html>