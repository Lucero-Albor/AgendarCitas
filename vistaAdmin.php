<?php
  include 'conexiones/sesion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleVistaAdmin.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="manifest" href="./manifest.json">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <title>Vista Administrador</title>
    <style>
        .table-container {
            display: none; /* Ocultamos las tablas por defecto */
        }
    </style>
</head>
<body>
    <nav style="background-color: #5A1746;" class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <img src="images/logo.png" width="40px">&nbsp;&nbsp;
            <a class="navbar-brand" style="color: white; font-size: 28px;" href="index.html">MiCita</a>
            <div class="collapse navbar-collapse"></div>
            <span style="color: white;" id="user"><?php echo $n_completo;?></span>&nbsp;&nbsp;
            <a style="color: white; margin-right: 10px;" href="conexiones/cerrar_conexion.php">Cerrar sesión</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="header-container position-relative">
            <img src="images/logo.png" class="logo">
            <h1 class="title">Vista administrador</h1>
        </div>

        <!-- Botones para cambiar entre tablas -->
        <div class="d-flex justify-content-center my-3">
            <button class="btn btn-outline-secondary mx-2" onclick="showTable('usuarios')">Usuarios</button>
            <button class="btn btn-outline-secondary mx-2" onclick="showTable('tramites')">Trámites</button>
            <button class="btn btn-outline-secondary mx-2" onclick="showTable('lugar')">Lugar</button>
            <button class="btn btn-outline-secondary mx-2" onclick="showTable('usuarioTramite')">Usuario-Trámite</button>
        </div>
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-warning mx-2" onclick="window.location.href='registroAdministrador.php'">Registrar Usuario</button>
        </div>

        <!-- Tabla de Usuarios -->
        <div class="table-container" id="usuarios">
            <table class="table table-bordered text-center">
                <thead style="background-color: #EAA724; color: white;">
                    <tr>
                        <th>ID usuario</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Contraseña</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'conexiones/conexion.php';

                    $sql = "SELECT id_usuario, nombre, apellidos, correo, pass, rol FROM usuarios";
                    $result = $conexion->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id_usuario']}</td>
                                    <td>{$row['nombre']}</td>
                                    <td>{$row['apellidos']}</td>
                                    <td>{$row['correo']}</td>
                                    <td>{$row['pass']}</td>
                                    <td>{$row['rol']}</td>
                                    <td>
                                        <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' onclick='editUsuario({$row['id_usuario']}, \"{$row['nombre']}\", \"{$row['apellidos']}\", \"{$row['correo']}\", \"{$row['pass']}\", \"{$row['rol']}\")'>Editar</button>
                                        <button class='btn btn-danger btn-sm' onclick='deleteUsuario({$row['id_usuario']})'>Eliminar</button>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No se encontraron registros</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Modal de edición para Usuarios -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" action="editarUsuario.php" method="POST">
                            <input type="hidden" id="usuarioId" name="usuarioId">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>
                            <div class="mb-3">
                                <label for="pass" class="form-label">Contraseña</label>
                                <input type="text" class="form-control" id="pass" name="pass" required>
                            </div>
                            <div class="mb-3">
                               <label for="rol" class="form-label">Rol</label>
                               <select class="form-select" id="rol" name="rol" required>
                                   <option value="Usuario">Usuario</option>
                                   <option value="Administrador">Administrador</option>
                               </select>
                           </div>

                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tabla de Trámites -->
                <div class="table-container" id="tramites">
                    <table class="table table-bordered text-center">
                        <thead style="background-color: #EAA724; color: white;">
                            <tr>
                                <th>ID</th>
                                <th>Trámite</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT num_tramite, nombre, descripcion FROM tramites";
                            $result = $conexion->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr id='tramite-{$row['num_tramite']}'>
                                            <td>{$row['num_tramite']}</td>
                                            <td>{$row['nombre']}</td>
                                            <td>{$row['descripcion']}</td>
                                            <td>
                                                <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editTramiteModal'
                                                    onclick='editTramite({$row['num_tramite']}, \"{$row['nombre']}\", \"{$row['descripcion']}\")'>Editar</button>
                                                <button class='btn btn-danger btn-sm' onclick='deleteTramite({$row['num_tramite']})'>Eliminar</button>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No se encontraron registros</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            <!-- Modal de edición para Trámites -->
            <div class="modal fade" id="editTramiteModal" tabindex="-1" aria-labelledby="editTramiteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTramiteModalLabel">Editar Trámite</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editTramiteForm" action="editarTramite.php" method="POST">
                                <input type="hidden" id="tramiteId" name="tramiteId">
                                <div class="mb-3">
                                    <label for="nombreTramite" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombreTramite" name="nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


                <!-- Tabla de Lugar -->
                <div class="table-container" id="lugar">
                    <table class="table table-bordered text-center">
                        <thead style="background-color: #EAA724; color: white;">
                            <tr>
                                <th>ID</th>
                                <th>Lugar</th>
                                <th>Domicilio</th>
                                <th>Departamento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT n_lugar, nombre, domicilio, departamento FROM lugar";
                            $result = $conexion->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr id='lugar-{$row['n_lugar']}'>
                                            <td>{$row['n_lugar']}</td>
                                            <td>{$row['nombre']}</td>
                                            <td>{$row['domicilio']}</td>
                                            <td>{$row['departamento']}</td>
                                            <td>
                                                <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editLugarModal'
                                                    onclick='editLugar({$row['n_lugar']}, \"{$row['nombre']}\", \"{$row['domicilio']}\", \"{$row['departamento']}\")'>Editar</button>
                                                <button class='btn btn-danger btn-sm' onclick='deleteLugar({$row['n_lugar']})'>Eliminar</button>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No se encontraron registros</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            <div class="modal fade" id="editLugarModal" tabindex="-1" aria-labelledby="editLugarModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editLugarModalLabel">Editar Lugar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editLugarForm" action="editarLugar.php" method="POST">
                                <input type="hidden" id="n_lugar" name="n_lugar">
                                <div class="mb-3">
                                    <label for="nombreLugar" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombreLugar" name="nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="domicilio" class="form-label">Domicilio</label>
                                    <input type="text" class="form-control" id="domicilio" name="domicilio" required>
                                </div>
                                <div class="mb-3">
                                    <label for="departamento" class="form-label">Departamento</label>
                                    <input type="text" class="form-control" id="departamento" name="departamento" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Tabla de Usuario-Trámite -->
                <div class="table-container" id="usuarioTramite">
                    <table class="table table-bordered text-center">
                        <thead style="background-color: #EAA724; color: white;">
                            <tr>
                                <th>ID</th>
                                <th>ID Usuario</th>
                                <th>ID Lugar</th>
                                <th>ID Trámite</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT id_ut, id_usuarios, n_lugar, num_tramite, fecha, hora FROM usuario_tramite";
                            $result = $conexion->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr id='ut-{$row['id_ut']}'>
                                            <td>{$row['id_ut']}</td>
                                            <td>{$row['id_usuarios']}</td>
                                            <td>{$row['n_lugar']}</td>
                                            <td>{$row['num_tramite']}</td>
                                            <td>{$row['fecha']}</td>
                                            <td>{$row['hora']}</td>
                                            <td>
                                                <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editUsuarioTramiteModal'
                                                    onclick='editUsuarioTramite({$row['id_ut']}, \"{$row['id_usuarios']}\", \"{$row['n_lugar']}\", \"{$row['num_tramite']}\", \"{$row['fecha']}\", \"{$row['hora']}\")'>Editar</button>
                                                <button class='btn btn-danger btn-sm' onclick='deleteUsuarioTramite({$row['id_ut']})'>Eliminar</button>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No se encontraron registros</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
    <!-- Modal de edición para Usuario-Trámite -->
    <div class="modal fade" id="editUsuarioTramiteModal" tabindex="-1" aria-labelledby="editUsuarioTramiteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUsuarioTramiteModalLabel">Editar Usuario-Trámite</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUsuarioTramiteForm" action="editarUsuarioTramite.php" method="POST">
                        <input type="hidden" id="usuarioTramiteId" name="usuarioTramiteId">
                        <div class="mb-3">
                            <label for="idUsuario" class="form-label">ID Usuario</label>
                            <input type="text" class="form-control" id="idUsuario" name="idUsuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="idLugar" class="form-label">ID Lugar</label>
                            <input type="text" class="form-control" id="idLugar" name="idLugar" required>
                        </div>
                        <div class="mb-3">
                            <label for="idTramite" class="form-label">ID Trámite</label>
                            <input type="text" class="form-control" id="idTramite" name="idTramite" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                        <div class="mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Función para mostrar la tabla correspondiente
        function showTable(tableId) {
            const tables = document.querySelectorAll('.table-container');
            tables.forEach(table => table.style.display = 'none');
            document.getElementById(tableId).style.display = 'block';
        }

        // Mostrar la tabla de Usuarios por defecto al cargar la página
        showTable('usuarios');

        function editTramite(id, nombre, descripcion) {
                document.getElementById('tramiteId').value = id;
                document.getElementById('nombreTramite').value = nombre;
                document.getElementById('descripcion').value = descripcion;
            }

            function editLugar(id, nombre, domicilio, departamento) {
                document.getElementById('n_lugar').value = id;
                document.getElementById('nombreLugar').value = nombre;
                document.getElementById('domicilio').value = domicilio;
                document.getElementById('departamento').value = departamento;
            }

            function editUsuarioTramite(id, idUsuario, idLugar, idTramite, fecha, hora) {
                document.getElementById('usuarioTramiteId').value = id;
                document.getElementById('idUsuario').value = idUsuario;
                document.getElementById('idLugar').value = idLugar;
                document.getElementById('idTramite').value = idTramite;
                document.getElementById('fecha').value = fecha;
                document.getElementById('hora').value = hora;
            }

        // Función para eliminar un usuario
        function deleteUsuario(id) {
            if (confirm('¿Estás seguro de eliminar este usuario?')) {
                window.location.href = 'eliminarUsuario.php?id=' + id;
            }
        }

        // Función para llenar el modal con los datos del trámite a editar
        function editTramite(id, nombre, descripcion) {
            document.getElementById('tramiteId').value = id;
            document.getElementById('nombreTramite').value = nombre;
            document.getElementById('descripcion').value = descripcion;
        }

        function deleteTramite(id) {
            if (confirm("¿Estás seguro de que deseas eliminar este trámite?")) {
                window.location.href = `eliminarTramite.php?id=${id}`;
            }
        }

        function deleteLugar(id) {
            if (confirm("¿Estás seguro de que deseas eliminar este lugar?")) {
                window.location.href = `eliminarLugar.php?id=${id}`;
            }
        }

        function deleteUsuarioTramite(id) {
            if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
                window.location.href = `eliminarUsuarioTramite.php?id=${id}`;
            }
        }
    </script>

</body>
</html>
