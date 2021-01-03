<?php
require '../functions/database.php';

$assunto = filter_input(INPUT_GET, 'term', FILTER_SANITIZE_STRING);

//SQL para selecionar os registros
$result_msg_cont = "SELECT fornecedor FROM fornecedor WHERE fornecedor LIKE '%".$assunto."%' LIMIT 7";

//Seleciona os registros
$resultado_msg_cont = $conn->prepare($result_msg_cont);
$resultado_msg_cont->execute();

while($row_msg_cont = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC)){
    $fornecedor[] = $row_msg_cont['fornecedor'];
}

echo json_encode($fornecedor);
