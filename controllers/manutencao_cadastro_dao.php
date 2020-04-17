<?php
session_start();
require_once('../Connections/Conexao.php');
$user_id = $_SESSION['userId'];
$ObjDB = new DB();
$link = $ObjDB -> connecta_mysql();

$txtCodEquipamento = filter_input(INPUT_POST, 'txtCodEquipamento', FILTER_SANITIZE_STRING);
$txtCodMDE = filter_input(INPUT_POST, 'txtCodMDE', FILTER_SANITIZE_STRING);
$textIMEI = filter_input(INPUT_POST, 'textIMEI', FILTER_SANITIZE_STRING);
$textcodigoSut = filter_input(INPUT_POST, 'textcodigoSut', FILTER_SANITIZE_STRING);
$textpatrimonio = filter_input(INPUT_POST, 'textpatrimonio', FILTER_SANITIZE_STRING);
$textdescricaoDefeito = filter_input(INPUT_POST, 'textdescricaoDefeito', FILTER_SANITIZE_STRING);
$txtcodUF = filter_input(INPUT_POST, 'txtcodUF', FILTER_SANITIZE_STRING);
$txtcodCidade = filter_input(INPUT_POST, 'txtcodCidade', FILTER_SANITIZE_STRING);
$txtcodDepartamento = filter_input(INPUT_POST, 'txtcodDepartamento', FILTER_SANITIZE_STRING);
$txtcodStatus = filter_input(INPUT_POST, 'txtcodStatus', FILTER_SANITIZE_STRING);
$txtcodRemessa = filter_input(INPUT_POST, 'txtcodRemessa', FILTER_SANITIZE_STRING);
$sut;
if($textcodigoSut == ""){
    $sut = 'default';
}else{
    $sut = $textcodigoSut;
}

$query_insert = "INSERT INTO EntradaManutencao
(codEquipamento, codMDE, IMEI, codigoSut, patrimonio, descricaoDefeito, dateEntrada, codCidade, codUf, codDepartamento, codStatus, codUser, rms_Codigo) 
VALUES
('$txtCodEquipamento','$txtCodMDE', '$textIMEI', $sut, '$textpatrimonio', '$textdescricaoDefeito', NOW(), '$txtcodCidade', '$txtcodUF', '$txtcodDepartamento',
'$txtcodStatus', '$user_id', '$txtcodRemessa')";   

$result_insert = mysqli_query($link, $query_insert);

if($result_insert == true){
    echo 'Equipamento inserido a lista com sucesso !';
}else{
    echo 'Atenção ! existe um erro ao tentar executar script'.'<br>'.mysqli_error($link);
}
?>