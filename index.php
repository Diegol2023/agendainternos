<?php 
    session_start();
    //include 'conexion.php';
    //inicializamos el array de empleados
    if (!isset($_SESSION['empleados_list'])) {
        $_SESSION['empleados_list'] = [];
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        echo 'entro al post';
        //obtenemos los datos del formulario verificar la variable del sector con sector del form mas adelante en el codigo
        $id =  $_POST['id'] ? $_POST['id'] : '';
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $sector = $_POST['sector'];
        $email = $_POST['email'];
        $telefono_interno = $_POST['telefono_interno'];
        $telefono_corporativo = $_POST['telefono_corporativo'];
        
        //si se envia el id es porque se esta editando un contacto
        if (!empty($id )) {
            
            //actualizamos el contacto recorriendo el array de empleados
            foreach ($_SESSION['empleados_list'] as $key => $empleado) {
                if ($empleado['id'] == $id) {
                    $_SESSION['empleados_list'][$key] = [
                        'id' => $empleado['id'],
                        'nombre' => $empleado['nombre'],
                        'apellido' => $empleado['apellido'],    
                        'sector' => $empleado['sector'],
                        'email' => $empleado['email'],
                        'telefono_interno' => $empleado['telefono_interno'],
                        'telefono_corporativo' => $empleado['telefono_corporativo'] 
                    ];
                    
                    break;
                }
            }
        } else {//si no se envia el id es porque se esta agregando un contacto nuevo
                
            $_SESSION['empleados_list'][] = [
                'id' => count($_SESSION['empleados_list']) + 1,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'sector' => $sector,
                'email' => $email,
                'telefono_interno' => $telefono_interno,
                'telefono_corporativo' => $telefono_corporativo 
            ];
           echo 'entro al else';

        }
        // Redirigir para evitar reenvío del formulario
        header('Location: index.php');  
        exit;
    }   
    if (isset($_GET['delete'])) {
        $deleteid = $_GET['delete'];
        foreach ($_SESSION['empleados_list'] as $key => $empleado) {
            if ($empleado['id'] == $deleteid) {
                unset($_SESSION['empleados_list'][$key]);
                $_SESSION['empleados_list'] = array_values(array: $_SESSION['empleados_list']);
                header(header: 'Location: index.php');
                exit;
            }
        }
        var_dump(value:$_SESSION['empleados_list']);//muestra el contenido del array
        
    }
    
    //cargamos el array de empleados en la sesion de forma manual
   //empleados_list = [
   //   [
   //       'id' => 1,
   //       'nombre' => 'Diego',    
   //       'apellido' => 'Sanchez',
   //       'sector' => 'Sistemas',
    //      'email' => 'diego.sanchez@',
   //       'telefono_interno' => '1035',
   //       'telefono_corporativo' => '2302-666633'
   //   ],
   //   [
   //       'id' => 2,
   //       'nombre' => 'Andres',    
   //       'apellido' => 'Sanchez',
   //       'sector' => 'Sistemas',
   //       'email' => 'andres.sanchez@',
   //       'telefono_interno' => '1035',
    //      'telefono_corporativo' => '2302-666666'
    //  ]
//
   //;
$is_edit = false; //opcion dentro del modal por default es agregar un contacto
    $empleado_to_edit = [
        'nombre' => '',
        'apellido' => '',
        'sector' => '',
        'email' => '',
        'telefono_interno' => '',
        'telefono_corporativo' => ''
    ]; //array para almacenar el contacto a editar

?>
<!DOCTYPE html>
<html lang="es">    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AGENDA - INTERNOS</title>
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body class="container">
        <div class="container">
            <div class="header">
                <h1>AGENDA EMPLEADOS</h1>
                <h2>INTERNOS</h2>
            </div>
            <nav class="navbar navbar-light bg-light" >
                <div class="container-fluid" >
                    <a class="navbar-brand"></a>
                    <form class="d-flex" name="buscar">
                    <input class="form-control me-2" type="search" placeholder="Ingrese Busqueda" aria-label="Search" name="inputbusqueda">
                    <br>
                    <button class="btn btn-outline-dark" type="submit">Buscar</button>
                    </form>
                </div>
            </nav>
            <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-outline-dark" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" 
                    onclick="history.replaceState(null, null, window.location.pathname); ClearForm();">                      
                    Agregar Contacto</button>
                
            </div>
            <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><!-- si edita es empleado -->
                            <?php echo $is_edit ? 'Editar Contacto' : 'Agregar Contacto'; ?> 
                        </h5> 
                            
                
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post" id = "form" name="form_metodo">
                            <input type="hidden" name="id" value="<?php echo $is_edit ? $is_edit : ''; ?>">
                            <div class="mb-3">
                                <label for="nombre" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre"
                                    value="<?php echo htmlspecialchars($empleado_to_edit['nombre']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="apellido" class="col-form-label">Apellido:</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingrese Apellido"
                                    value="<?php echo htmlspecialchars($empleado_to_edit['apellido']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="sector" class="col-form-label">Sector:</label>
                                <select name="sector" id="sector" class="form-select">
                                    <?php echo $is_edit ? $empleado_to_edit['sector'] : 'Seleccionar Sector'; ?>
                                    <option value="Sistemas">Sistemas</option>
                                    <option value="Recursos Humanos">Recursos Humanos</option>
                                    <option value="Contabilidad">Contabilidad</option>
                                    <option value="Comercial ATP">Comercial ATP</option>
                                    <option value="Administracion">Administracion</option>
                                    <option value="Facturacion">Facturacion</option>
                                    <option value="Personal">Personal</option>
                                    <option value="Ciat">Ciat</option>
                                </select>
                             </div>
                            <div class="mb-3">
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese Email"
                                    value="<?php echo htmlspecialchars($empleado_to_edit['email'])  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="telefono_interno" class="col-form-label">Telefono Interno:</label>
                                <input type="text" class="form-control" id="telefono_interno" name="telefono_interno" placeholder="Ingrese Telefono Interno"
                                    value="<?php echo htmlspecialchars($empleado_to_edit['telefono_interno']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="telefono_corporativo" class="col-form-label">Telefono Corporativo:</label>
                                <input type="text" class="form-control" id="telefono_corporativo" name="telefono_corporativo" placeholder="Ingrese Telefono Corporativo"
                                    value="<?php echo htmlspecialchars($empleado_to_edit['telefono_corporativo'])  ?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                    
                    </div>
                </div>
                </div>  
            <div class="content">
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Sector</th>
                                <th>Email</th>
                                <th>Telefono Interno</th>
                                <th>Telefono Corporativo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION ['empleados_list']  as $empleado)
                                echo '<tr>
                                    <td>  ' . $empleado['nombre'] . '  </td>
                                    <td>  ' . $empleado['apellido'] . '  </td>
                                    <td>  ' . $empleado['sector'] . '  </td>
                                    <td>  ' . $empleado['email'] . '  </td>
                                    <td>  ' . $empleado['telefono_interno'] . '  </td>
                                    <td>  ' . $empleado['telefono_corporativo'] . '  </td>
                                    <td>
                                        <!-- Boton Editar -->
                                        <a href="edit.php?id=' . $empleado['id'] . '" class="btn btn-primary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <!-- Boton Eliminar -->
                                        <a href="delete.php?id=' . $empleado['id'] . '" class="btn btn-danger"
                                            onclick="return confirm(\'¿Desea eliminar el contacto?\')">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>

                                        
                                </tr>';

                                ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </body>
    <script>
        function ClearForm() {
            let form = document.getElementById('form').reset(); // Obtener el formulario
            if (form) {
                form.reset();
                form.querySelector('input[name="id"]').value = '';
                form.querySelector('input[name="nombre"]').value = '';
                form.querySelector('input[name="apellido"]').value = '';
                form.querySelector('input[name="sector"]').value = '';
                form.querySelector('input[name="email"]').value = '';
                form.querySelector('input[name="telefono_interno"]').value = '';
                form.querySelector('input[name="telefono_corporativo"]').value = '';
            }
        }
    </script>
</html>