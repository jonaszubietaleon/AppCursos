<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
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
        
        .password-container {
            background-color: var(--white);
            border-radius: 15px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            text-align: center;
        }
        
        .password-logo {
            margin-bottom: 30px;
        }
        
        .password-logo i {
            font-size: 50px;
            color: var(--primary-color);
        }
        
        .password-title {
            font-size: 24px;
            color: var(--text-color);
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .password-subtitle {
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
        
        .btn-change {
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
        
        .btn-change:hover {
            background-color: var(--secondary-color);
        }
        
        .password-footer {
            margin-top: 25px;
            font-size: 13px;
            color: #6c757d;
        }
        
        .password-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .password-footer a:hover {
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
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
        
        .input-wrapper {
            position: relative;
        }
    </style>
</head>
<body>
    <div class="password-container">
        <div class="password-logo">
            <i class="fas fa-key"></i>
        </div>
        <h1 class="password-title">Cambiar Contraseña</h1>
        <p class="password-subtitle">Ingresa tu nueva contraseña segura</p>
        
        <?php if (isset($success)): ?>
            <div class="success-message">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="current_password">Contraseña Actual</label>
                <div class="input-wrapper">
                    <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Ingresa tu contraseña actual" required>
                    <i class="fas fa-eye password-toggle" id="toggleCurrentPassword"></i>
                </div>
                <?php if (isset($errors['current_password'])): ?>
                    <p class="error-message"><?php echo $errors['current_password']; ?></p>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="new_password">Nueva Contraseña</label>
                <div class="input-wrapper">
                    <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Mínimo 8 caracteres" required>
                    <i class="fas fa-eye password-toggle" id="toggleNewPassword"></i>
                </div>
                <div class="password-strength">
                    <div class="strength-meter" id="strength-meter"></div>
                </div>
                <?php if (isset($errors['new_password'])): ?>
                    <p class="error-message"><?php echo $errors['new_password']; ?></p>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirmar Nueva Contraseña</label>
                <div class="input-wrapper">
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Repite tu nueva contraseña" required>
                    <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
                </div>
                <?php if (isset($errors['confirm_password'])): ?>
                    <p class="error-message"><?php echo $errors['confirm_password']; ?></p>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="btn-change"><i class="fas fa-sync-alt"></i> Actualizar Contraseña</button>
        </form>
        
        <div class="password-footer">
            <a href="index.php?action=courses"><i class="fas fa-arrow-left"></i> Volver al panel</a>
        </div>
    </div>

    <script>
        // Mostrar/ocultar contraseña
        document.getElementById('toggleCurrentPassword').addEventListener('click', function() {
            const input = document.getElementById('current_password');
            this.classList.toggle('fa-eye-slash');
            input.type = input.type === 'password' ? 'text' : 'password';
        });
        
        document.getElementById('toggleNewPassword').addEventListener('click', function() {
            const input = document.getElementById('new_password');
            this.classList.toggle('fa-eye-slash');
            input.type = input.type === 'password' ? 'text' : 'password';
        });
        
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const input = document.getElementById('confirm_password');
            this.classList.toggle('fa-eye-slash');
            input.type = input.type === 'password' ? 'text' : 'password';
        });
        
        // Validación de fortaleza de contraseña en tiempo real
        document.getElementById('new_password').addEventListener('input', function(e) {
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
            const password = document.getElementById('new_password').value;
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