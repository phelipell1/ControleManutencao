<?php
session_start();
require_once('../Connections/Conexao.php');
$user_id = $_SESSION['userId'];
$ObjDB = new DB();
$link = $ObjDB -> connecta_mysql();

$rem_Remetente = filter_input(INPUT_POST, 'rem_Remetente', FILTER_SANITIZE_STRING);
$rem_Destinatario = filter_input(INPUT_POST, 'rem_Destinatario', FILTER_SANITIZE_STRING);
$est_Codigo = filter_input(INPUT_POST, 'est_Codigo', FILTER_SANITIZE_STRING);
$cid_Codigo = filter_input(INPUT_POST, 'cid_Codigo', FILTER_SANITIZE_STRING);
$temp_Empresa = filter_input(INPUT_POST, 'temp_Empresa', FILTER_SANITIZE_STRING);
$rms_Descricao = filter_input(INPUT_POST, 'rms_Descricao', FILTER_SANITIZE_STRING);

$query_insert = "INSERT INTO Remessas (rms_Descricao, rem_Remetente, des_Destinatario, cid_Coodigo, est_Codigo, temp_Empresa, rms_Rastreio, rms_DataCriacao) 
VALUES
('$rms_Descricao', '$rem_Remetente', '$rem_Destinatario', '$cid_Codigo', '$est_Codigo','$temp_Empresa', 'NULL', NOW())";   

if($rem_Remetente == "Selecione"){
    echo'Atenção ! E necessário adicionar Remetente para continuar';
    die();
}elseif($rem_Destinatario == 'Selecione'){
    echo'Atenção ! E necessário adicionar Destinatário para continuar';
    die();
}elseif($est_Codigo == "Selecione"){
    echo'Atenção ! E necessário adicionar Estado para continuar';
    die();
}elseif($cid_Codigo == "Selecione"){
    echo'Atenção ! E necessário adicionar Cidade para continuar';
    die();
}elseif($temp_Empresa == "Selecione"){
    echo'Atenção ! E necessário adicionar Envio para continuar';
    die();
}

$result_insert = mysqli_query($link, $query_insert);

if($result_insert == true){
    echo 'Remetente cadastrado com sucesso !';
}else{
    echo 'Atenção ! existe um erro ao tentar executar script'.'<br>'.mysqli_error($link);
}
?>