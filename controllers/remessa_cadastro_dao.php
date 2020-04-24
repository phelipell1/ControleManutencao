<?php
session_start();
require_once('../Connections/Conexao.php');
$ObjDB = new DB();
$link = $ObjDB -> connecta_mysql();

$empresa = filter_input(INPUT_POST, 'cbmEmpresa', FILTER_SANITIZE_STRING);
$expeditor = filter_input(INPUT_POST, 'cmbExpeditor', FILTER_SANITIZE_STRING);
$uf = filter_input(INPUT_POST, 'est_Codigo', FILTER_SANITIZE_STRING);
$cidade = filter_input(INPUT_POST, 'cid_Codigo', FILTER_SANITIZE_STRING);
$acDestinatario = filter_input(INPUT_POST, 'cbmAcDestinatario', FILTER_SANITIZE_STRING);
$user_id = $_SESSION['userId'];
$data_system = date('Y-m-d');


$query_insert = "INSERT INTO regSedex (sed_Data, sed_DataPostagem, emp_Codigo, rem_Codigo, cid_Codigo, est_Codigo, des_Codigo, sed_Cod_rastreio, sed_Valor, sed_Pago, sed_Extraviado, sed_Operador, sed_DataAlteracao) 
VALUES
('$data_system', default, '$empresa', '$expeditor', '$cidade', '$uf', '$acDestinatario', default, default, 0, default, default, default)";   

if($empresa == "" || $expeditor == "" || $cidade == "" || $uf == "" || $acDestinatario == ""){
    echo 'Preencha os campos para continuar.';
}

$result_insert = mysqli_query($link, $query_insert);

if($result_insert == true){
    echo 'Remessa cadastrada com sucesso !';
}else{
    echo 'Atenção ! existe um erro ao tentar executar script'.'<br>'.mysqli_error($link);
}
?>