<?php
session_start();
require_once('../Connections/Conexao.php');
$user_id = $_SESSION['userId'];
$ObjDB = new DB();
$link = $ObjDB -> connecta_mysql();
$user_id = $_SESSION['id'];

$msg = null;

$txt_id = filter_input(INPUT_POST, 'txtId', FILTER_SANITIZE_STRING);
$txt_descricao = filter_input(INPUT_POST, 'txt_descricao', FILTER_SANITIZE_STRING);
$cbmStatus = filter_input(INPUT_POST, 'cbmStatus', FILTER_SANITIZE_STRING);

$query_insert = "INSERT INTO histManutencao (cod_entrada, hist_Resolucao, hist_DataServico, cod_User)
values
('$txt_id', '$txt_descricao', now(), '$user_id')";

$result_insert = mysqli_query($link, $query_insert);

if($result_insert == true){
    $msg = 1;
    if($msg == 1){
        $query_update = "UPDATE EntradaManutencao set codStatus = '$cbmStatus' where codEntrada = $txt_id";
        $result_update = mysqli_query($link, $query_update);
        echo "Dados atualizados com Sucesso !";
    }elseif($msg == 2){
        echo"ERROR = 1";
    }
}else{
    echo 'Atenção ! existe um erro ao tentar executar script'.'</br>'.mysqli_error($link);
}
?>