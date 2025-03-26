<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --text-color: #2b2d42;
            --light-gray: #f8f9fa;
            --white: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --error-color: #dc3545;
            --success-color: #28a745;
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
        
        .register-container {
            background-color: var(--white);
            border-radius: 15px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            text-align: center;
        }
        
        .register-logo {
            margin-bottom: 30px;
        }
        
        .register-logo i {
            font-size: 50px;
            color: var(--primary-color);
        }
        
        .register-title {
            font-size: 24px;
            color: var(--text-color);
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .register-subtitle {
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
        
        .password-strength {
            height: 4px;
            background-color: #e9ecef;
            margin-top: 8px;
            border-radius: 2px;
            overflow: hidden;
        }
        
        .strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.3s, background-color 0.3s;
        }
        
        .btn-register {
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
            margin-top: 10px;
        }
        
        .btn-register:hover {
            background-color: var(--secondary-color);
        }
        
        .register-footer {
            margin-top: 25px;
            font-size: 13px;
            color: #6c757d;
        }
        
        .register-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .register-footer a:hover {
            text-decoration: underline;
        }
        
        .error-message {
            color: var(--error-color);
            font-size: 13px;
            margin-top: 5px;
            text-align: left;
        }
        
        .success-message {
            color: var(--success-color);
            font-size: 14px;
            margin-bottom: 20px;
        }
        
        .terms {
            font-size: 13px;
            color: #6c757d;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-logo">
            <i class="fas fa-user-plus"></i>
        </div>
        <h1 class="register-title">Crea tu cuenta</h1>
        <p class="register-subtitle">Completa el formulario para registrarte</p>
        
        <?php if (isset($success)): ?>
            <div class="success-message">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        
        <form action="index.php?action=register" method="POST">
            <div class="form-group">
                <label for="username">Nombre de usuario</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Ej: usuario123" required>
                <?php if (isset($errors['username'])): ?>
                    <p class="error-message"><?php echo $errors['username']; ?></p>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="tucorreo@ejemplo.com" required>
                <?php if (isset($errors['email'])): ?>
                    <p class="error-message"><?php echo $errors['email']; ?></p>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Mínimo 8 caracteres" required>
                <div class="password-strength">
                    <div class="strength-meter" id="strength-meter"></div>
                </div>
                <?php if (isset($errors['password'])): ?>
                    <p class="error-message"><?php echo $errors['password']; ?></p>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirmar contraseña</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Repite tu contraseña" required>
                <?php if (isset($errors['confirm_password'])): ?>
                    <p class="error-message"><?php echo $errors['confirm_password']; ?></p>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="btn-register">REGISTRARSE</button>
            
            
        </form>
        
        <div class="register-footer">
            ¿Ya tienes una cuenta? <a href="index.php?action=login">Inicia sesión</a>
        </div>
    </div>

    <script>
        // Validación de fortaleza de contraseña en tiempo real
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const strengthMeter = document.getElementById('strength-meter');
            let strength = 0;
            
            // Validaciones de fortaleza
            if (password.length >= 8) strength += 1;
            if (password.match(/[a-z]/)) strength += 1;
            if (password.match(/[A-Z]/)) strength += 1;
            if (password.match(/[0-9]/)) strength += 1;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 1;
            
            // Actualizar la barra de fortaleza
            switch(strength) {
                case 0:
                case 1:
                    strengthMeter.style.width = '20%';
                    strengthMeter.style.backgroundColor = '#dc3545';
                    break;
                case 2:
                    strengthMeter.style.width = '40%';
                    strengthMeter.style.backgroundColor = '#fd7e14';
                    break;
                case 3:
                    strengthMeter.style.width = '60%';
                    strengthMeter.style.backgroundColor = '#ffc107';
                    break;
                case 4:
                    strengthMeter.style.width = '80%';
                    strengthMeter.style.backgroundColor = '#28a745';
                    break;
                case 5:
                    strengthMeter.style.width = '100%';
                    strengthMeter.style.backgroundColor = '#20c997';
                    break;
            }
        });
        
        // Confirmación de contraseña en tiempo real
        document.getElementById('confirm_password').addEventListener('input', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = e.target.value;
            
            if (password !== confirmPassword && confirmPassword.length > 0) {
                e.target.style.borderColor = 'var(--error-color)';
            } else {
                e.target.style.borderColor = '#ced4da';
            }
        });
    </script>
</body>
</html>