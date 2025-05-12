<?php 
    include 'conexion.php'; 
    $isEdit = false; //opcion dentro del modal por default es agregar un contacto
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
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
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
                            <?php echo $isEdit ? 'Editar Contacto' : 'Agregar Contacto'; ?>
                        </h5>
                              
                
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                        <button type="button" class="btn btn-primary">Guardar Cambios</button>
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
                            <tr>
                                <td>  Diego  </td>
                                <td>  Sanchez </td>
                                <td>  Sistemas  </td>
                                <td>  diego.sanchez@  </td>
                                <td>  1035 </td>
                                <td>  2302333333  </td>
                                <td>
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <i class="fa-solid fa-trash-can"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </body>
</html>