require 'conexion.php';
$query = "SELECT * FROM agenda";
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_array($result)){
    $output[] = array (
        'id' => $row['id'],
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido'],
        'sector' => $row['sector'],
        'telefono' => $row['telefono'],
        'email' => $row['email']
    );
}
echo json_encode($output);