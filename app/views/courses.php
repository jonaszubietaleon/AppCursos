<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Cursos</title>
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
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: var(--white);
            border-radius: 15px;
            box-shadow: var(--shadow);
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header h1 {
            font-size: 28px;
            color: var(--text-color);
        }

        .user-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-danger {
            background-color: var(--error-color);
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .course-form {
            background-color: var(--light-gray);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 40px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }

        textarea.form-control {
            min-height: 100px;
        }

        .icon-preview {
            width: 50px;
            height: 50px;
            object-fit: contain;
            margin-top: 10px;
            border-radius: 8px;
            display: none;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: var(--light-gray);
        }

        .course-icon {
            width: 40px;
            height: 40px;
            object-fit: contain;
            border-radius: 6px;
        }

        .status-active {
            color: green;
        }

        .status-inactive {
            color: red;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 30px;
        }

        .pagination a {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            text-decoration: none;
        }

        .pagination a.active {
            background-color: var(--primary-color);
            color: white;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-book-open"></i> Gestión de Cursos</h1>
            <div class="user-actions">
                <a href="index.php?action=logout" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Cerrar
                    Sesión</a>
                <a href="index.php?action=change-password" class="btn btn-secondary"><i class="fas fa-key"></i> Cambiar
                    Contraseña</a>
                <a href="index.php?action=delete-account" class="btn btn-danger" style="margin-left: 10px;">
                    <i class="fas fa-user-times"></i> Eliminar Cuenta
                </a>
            </div>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <section class="course-form">
            <h2><i class="fas fa-plus-circle"></i>
                <?php echo isset($editCourse) ? 'Editar Curso' : 'Crear Nuevo Curso'; ?></h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="<?php echo isset($editCourse) ? 'update' : 'create'; ?>">
                <?php if (isset($editCourse)): ?>
                    <input type="hidden" name="id" value="<?php echo $editCourse['id']; ?>">
                <?php endif; ?>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre">Nombre del Curso</label>
                        <input type="text" id="nombre" name="nombre" class="form-control"
                            value="<?php echo isset($editCourse) ? htmlspecialchars($editCourse['nombre']) : ''; ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="abreviacion">Código/Abreviación</label>
                        <input type="text" id="abreviacion" name="abreviacion" class="form-control"
                            value="<?php echo isset($editCourse) ? htmlspecialchars($editCourse['abreviacion']) : ''; ?>"
                            required maxlength="10">
                    </div>

                    <div class="form-group">
                        <label for="aula">Aula</label>
                        <input type="text" id="aula" name="aula" class="form-control"
                            value="<?php echo isset($editCourse) ? htmlspecialchars($editCourse['aula']) : ''; ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select id="estado" name="estado" class="form-control" required>
                            <option value="1" <?php echo (isset($editCourse) && $editCourse['estado']) ? 'selected' : ''; ?>>Activo</option>
                            <option value="0" <?php echo (isset($editCourse) && !$editCourse['estado']) ? 'selected' : ''; ?>>Inactivo</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion"
                        class="form-control"><?php echo isset($editCourse) ? htmlspecialchars($editCourse['descripcion']) : ''; ?></textarea>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="icono">Ícono del Curso</label>
                        <input type="file" id="icono" name="icono" class="form-control">
                        <?php if (isset($editCourse) && !empty($editCourse['icono'])): ?>
                            <p>Ícono actual:</p>
                            <img src="public/uploads/icons/<?php echo $editCourse['icono']; ?>" class="course-icon"
                                alt="Ícono actual">
                        <?php endif; ?>
                        <img id="icono-preview" class="icon-preview" src="#" alt="Vista previa">
                    </div>

                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio</label>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control"
                            value="<?php echo isset($editCourse) ? $editCourse['fecha_inicio'] : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_fin">Fecha de Finalización (Opcional)</label>
                        <input type="date" id="fecha_fin" name="fecha_fin" class="form-control"
                            value="<?php echo isset($editCourse) ? $editCourse['fecha_fin'] : ''; ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> <?php echo isset($editCourse) ? 'Actualizar Curso' : 'Crear Curso'; ?>
                </button>

                <?php if (isset($editCourse)): ?>
                    <a href="index.php?action=courses" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                <?php endif; ?>
            </form>
        </section>

        <section class="course-list">
            <h2><i class="fas fa-list"></i> Listado de Cursos</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Ícono</th>
                            <th>Nombre</th>
                            <th>Código</th>
                            <th>Aula</th>
                            <th>Estado</th>
                            <th>Fechas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($course['icono'])): ?>
                                        <img src="public/uploads/icons/<?php echo $course['icono']; ?>" class="course-icon"
                                            alt="Ícono del curso">
                                    <?php else: ?>
                                        <i class="fas fa-book" style="font-size: 20px;"></i>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($course['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($course['abreviacion']); ?></td>
                                <td><?php echo htmlspecialchars($course['aula']); ?></td>
                                <td class="<?php echo $course['estado'] ? 'status-active' : 'status-inactive'; ?>">
                                    <?php echo $course['estado'] ? 'Activo' : 'Inactivo'; ?>
                                </td>
                                <td>
                                    <?php echo date('d/m/Y', strtotime($course['fecha_inicio'])); ?>
                                    <?php if (!empty($course['fecha_fin'])): ?>
                                        <br>- <?php echo date('d/m/Y', strtotime($course['fecha_fin'])); ?>
                                    <?php endif; ?>
                                </td>
                                <td class="actions">
                                    <a href="index.php?action=courses&edit=<?php echo $course['id']; ?>"
                                        class="btn btn-secondary">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $course['id']; ?>">
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('¿Estás seguro de eliminar este curso?')">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="index.php?action=courses&page=<?php echo $i; ?>"
                            class="<?php echo ($i == ($_GET['page'] ?? 1)) ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>

    <script>
        // Vista previa del ícono
        document.getElementById('icono').addEventListener('change', function (e) {
            const preview = document.getElementById('icono-preview');
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>