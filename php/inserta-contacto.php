<?php

require_once '../conexion/Conexion.php';

$nombre_contacto = $_POST['nombre_contacto'] ?? '';
$numero = $_POST['numero'] ?? '';
$nombres = $_POST['nombres'] ?? [];

$conexion = new Conexion();
$db = $conexion->conectar();

$stmt = $db->prepare('INSERT INTO contacto_general(coal_nombre_contacto,coal_numero) VALUES (?,?)');
$stmt->bind_param('ss',$nombre_contacto,$numero);
$stmt->execute();
$id_contacto = $db->insert_id;

function insertaNombre($nombre,$id_contacto,$db){
    $stmt = $db->prepare('INSERT INTO contacto_nombre(coes_nombre,coes_id_contacto_general) VALUES (?,?)');
    $stmt->bind_param('si',$nombre,$id_contacto);
    return $stmt->execute();
}
$errores = [];

if (!empty($nombres)) {
    foreach ($nombres as $key => $nombre){
        if (!insertaNombre($nombre,$id_contacto,$db)) {
        	$errores[] = $key;
        }
    }
}

if (empty($errores)) {
	echo json_encode(['respuesta' => true,'mensaje' =>'Se insertaron los datos correctamente']);
}else{
    echo json_encode(['respuesta' => false,'mensaje' =>'Hubo un problema al insertar los datos, intente más tarde']);
}