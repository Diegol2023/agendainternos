<?php 
   // session_start();
    include 'conexion.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       //obtenemos los datos del formulario verificar la variable del sector con sector del form mas adelante en el codigo
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $sector = $_POST['sector'];
        $email = $_POST['email'];
        $telefono_interno = $_POST['telefono_interno'];
        $telefono_corporativo = $_POST['telefono_corporativo'];
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            //actualizamos el contacto recorriendo el array de empleados
            foreach ($empleados_list as $key => $empleado)  {
                if ($empleado['id'] == $id) {
                    $empleados_list[$key]['id'] = $id;
                    $empleados_list[$key]['nombre'] = $nombre;
                    $empleados_list[$key]['apellido'] = $apellido;
                    $empleados_list[$key]['sector'] = $sector;
                    $empleados_list[$key]['email'] = $email;
                    $empleados_list[$key]['telefono_interno'] = $telefono_interno;
                    $empleados_list[$key]['telefono_corporativo'] = $telefono_corporativo;
                    break;
                }
            }
        } else {
            $empleados_list[] = [
                'id' => $id,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'sector' => $sector,
                'email' => $email,
                'telefono_interno' => $telefono_interno,
                'telefono_corporativo' => $telefono_corporativo
            ];
        }
        $_SESSION['empleados_list'] = $empleados_list;
    }   
    
    if (isset($_SESSION['empleados_list'])) {
         $_SESSION['empleados_list'] = []; //sino hay enpleados en la sesion lo creamos vacio
        
    }
    //cargamos el array de empleados en la sesion de forma manual
    $empleados_list = [
        [
            'id' => 1,
            'nombre' => 'Diego',    
            'apellido' => 'Sanchez',
            'sector' => 'Sistemas',
            'email' => 'diego.sanchez@',
            'telefono_interno' => '1035',
            'telefono_corporativo' => '2302-666633'
        ],
        [
            'id' => 2,
            'nombre' => 'Andres',    
            'apellido' => 'Sanchez',
            'sector' => 'Sistemas',
            'email' => 'andres.sanchez@',
            'telefono_interno' => '1035',
            'telefono_corporativo' => '2302-666666'
        ]

    ];

    $isedit = false; //opcion dentro del modal por default es agregar un contacto

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
                <h1>AGENDA</h1>
                <h2>INTERNOS</h2>
            </div>
            <nav class="navbar navbar-light bg-light" >
                <div class="container-fluid" >
                    <a class="navbar-brand"></a>
                    <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Ingrese Busqueda" aria-label="Search">
                    <br>
                    <button class="btn btn-outline-dark" type="submit">Buscar</button>
                    </form>
                </div>
            </nav>
            <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-outline-dark" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar Contacto</button>
                
            </div>
            <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <?php echo $isedit ? 'Editar Contacto' : 'Agregar Contacto'; ?>
                        </h5>
                              
                
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $isedit ? $empleado['id'] : ''; ?>">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Apellido:</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="mb-3">
                                <label for="sector" class="col-form-label">Sector:</label>
                                <select name="sector" id="sector" class="form-select">
                                    <?php echo $isedit ? $empleado['sector'] : 'Seleccionar Sector'; ?>
                                    <option value="0">Sistemas</option>
                                    <option value="1">Recursos Humanos</option>
                                    <option value="2">Contabilidad</option>
                                    <option value="3">Comercial ATP</option>
                                    <option value="4">Administracion</option>
                                    <option value="5">Facturacion</option>
                                    <option value="6">Personal</option>
                                    <option value="7">Ciat</option>
                                </select>
                             </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Email:</label>
                                <input type="email" class="form-control" id="recipient-name">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Telefono Interno:</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Telefono Corporativo:</label>
                                <input type="text" class="form-control" id="recipient-name">
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
                            <?php foreach ($empleados_list as $empleado)
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
</html>