<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta Eliminada</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --text-color: #2b2d42;
            --light-gray: #f8f9fa;
            --white: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        body {
            background-color: var(--light-gray);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .message-container {
            background-color: var(--white);
            border-radius: 15px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 500px;
            padding: 40px;
            text-align: center;
        }
        
        .message-icon {
            font-size: 60px;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .message-title {
            font-size: 24px;
            color: var(--text-color);
            margin-bottom: 15px;
        }
        
        .message-text {
            margin-bottom: 30px;
            color: #555;
        }
        
        .btn-home {
            display: inline-block;
            padding: 12px 25px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .btn-home:hover {
            background-color: #3a56d4;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <div class="message-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1 class="message-title">Cuenta Eliminada Exitosamente</h1>
        <p class="message-text">
            Tu cuenta y todos los datos asociados han sido eliminados permanentemente.
            Lamentamos que hayas decidido irte. Si cambias de opinión, puedes registrarte nuevamente en cualquier momento.
        </p>
        <a href="index.php" class="btn-home">
            <i class="fas fa-home"></i> Volver al Inicio
        </a>
    </div>
</body>
</html>