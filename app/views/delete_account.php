<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cuenta</title>
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
            --warning-color: #ffc107;
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
        
        .delete-container {
            background-color: var(--white);
            border-radius: 15px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 500px;
            padding: 40px;
            text-align: center;
        }
        
        .delete-icon {
            margin-bottom: 30px;
        }
        
        .delete-icon i {
            font-size: 50px;
            color: var(--error-color);
        }
        
        .delete-title {
            font-size: 24px;
            color: var(--text-color);
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .delete-warning {
            background-color: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            text-align: left;
        }
        
        .delete-warning i {
            margin-right: 10px;
            color: var(--warning-color);
        }
        
        .delete-details {
            text-align: left;
            margin-bottom: 25px;
            padding: 15px;
            background-color: var(--light-gray);
            border-radius: 8px;
        }
        
        .delete-details p {
            margin-bottom: 10px;
        }
        
        .delete-details strong {
            color: var(--error-color);
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
        
        .btn-delete {
            width: 100%;
            padding: 12px;
            background-color: var(--error-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        
        .btn-delete:hover {
            background-color: #c82333;
        }
        
        .btn-cancel {
            width: 100%;
            padding: 12px;
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 15px;
            text-decoration: none;
            display: block;
        }
        
        .btn-cancel:hover {
            background-color: #5a6268;
        }
        
        .error-message {
            color: var(--error-color);
            font-size: 13px;
            margin-top: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="delete-container">
        <div class="delete-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h1 class="delete-title">Eliminar Cuenta Permanentemente</h1>
        
        <div class="delete-warning">
            <p><i class="fas fa-exclamation-circle"></i> <strong>Advertencia:</strong> Esta acción no se puede deshacer. Todos tus datos serán eliminados permanentemente.</p>
        </div>
        
        <div class="delete-details">
            <p><strong>Se eliminarán los siguientes datos:</strong></p>
            <p>- Tu cuenta de usuario (<strong><?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?></strong>)</p>
            <p>- Todos tus cursos creados (<strong><?php echo $totalCursos; ?> cursos</strong>)</p>
            <p>- Toda la información asociada a tu cuenta</p>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="error-message" style="text-align: center; margin-bottom: 20px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="password">Ingresa tu contraseña para confirmar:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Tu contraseña actual" required>
                <?php if (isset($errors['password'])): ?>
                    <p class="error-message"><?php echo $errors['password']; ?></p>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="btn-delete">
                <i class="fas fa-trash-alt"></i> Eliminar Cuenta Permanentemente
            </button>
            <a href="index.php?action=courses" class="btn-cancel">
                <i class="fas fa-times"></i> Cancelar y Volver al Panel
            </a>
        </form>
    </div>
</body>
</html>