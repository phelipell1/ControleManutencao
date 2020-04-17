<?php
session_start();
require_once('../Connections/Conexao.php');
$user_id = $_SESSION['userId'];
$ObjDB = new DB();
$link = $ObjDB -> connecta_mysql();

$textrem_Remetente = filter_input(INPUT_POST, 'textrem_Remetente', FILTER_SANITIZE_STRING);
$textrem_Abreviado = filter_input(INPUT_POST, 'textrem_Abreviado', FILTER_SANITIZE_STRING);
$textrem_Fixo = filter_input(INPUT_POST, 'textrem_Fixo', FILTER_SANITIZE_STRING);
$textrem_Movel = filter_input(INPUT_POST, 'textrem_Movel', FILTER_SANITIZE_STRING);
$txtemp_Codigo = filter_input(INPUT_POST, 'txtemp_Codigo', FILTER_SANITIZE_STRING);
$txtrem_Ativo = filter_input(INPUT_POST, 'txtrem_Ativo', FILTER_SANITIZE_STRING);

$query_insert = "INSERT INTO Remetente (rem_Remetente, rem_Abreviado, rem_Fixo, rem_Movel, emp_Codigo, rem_Ativo) 
VALUES
('$textrem_Remetente', '$textrem_Abreviado', '$textrem_Fixo', '$textrem_Movel', '$txtemp_Codigo', '$txtrem_Ativo')";   

$result_insert = mysqli_query($link, $query_insert);

if($result_insert == true){
    echo 'Remetente cadastrado com sucesso !';
}else{
    echo 'Atenção ! existe um erro ao tentar executar script'.'<br>'.mysqli_error($link);
}
?>