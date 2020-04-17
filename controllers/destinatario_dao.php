<?php
session_start();
require_once('../Connections/Conexao.php');
$user_id = $_SESSION['userId'];
$ObjDB = new DB();
$link = $ObjDB -> connecta_mysql();

$id = filter_input(INPUT_GET, 'uf', FILTER_SANITIZE_NUMBER_INT);
$txtdesc_destinatario = filter_input(INPUT_POST, 'txtdesc_destinatario', FILTER_SANITIZE_STRING);
$txtdesc_AC = filter_input(INPUT_POST, 'txtdesc_AC', FILTER_SANITIZE_STRING);
$txtdesc_AcAbreviado = filter_input(INPUT_POST, 'txtdesc_AcAbreviado', FILTER_SANITIZE_STRING);
$txtdesc_CPF = filter_input(INPUT_POST, 'txtdesc_CPF', FILTER_SANITIZE_STRING);
$txtdesc_Logradouro = filter_input(INPUT_POST, 'txtdesc_Logradouro', FILTER_SANITIZE_STRING);
$txtdesc_Numero = filter_input(INPUT_POST, 'txtdesc_Numero', FILTER_SANITIZE_STRING);
$txtdesc_Complemento = filter_input(INPUT_POST, 'txtdesc_Complemento', FILTER_SANITIZE_STRING);
$txtdesc_Bairro = filter_input(INPUT_POST, 'txtdesc_Bairro', FILTER_SANITIZE_STRING);
$txtcodUF = filter_input(INPUT_POST, 'txtcodUF', FILTER_SANITIZE_STRING);
$txtcodCidade = filter_input(INPUT_POST, 'txtcodCidade', FILTER_SANITIZE_STRING);
$txtdesc_CEP = filter_input(INPUT_POST, 'txtdesc_CEP', FILTER_SANITIZE_STRING);
$txtdesc_Fixo = filter_input(INPUT_POST, 'txtdesc_Fixo', FILTER_SANITIZE_STRING);
$txtdesc_Movel = filter_input(INPUT_POST, 'txtdesc_Movel', FILTER_SANITIZE_STRING);
$txt_Transporte = filter_input(INPUT_POST, 'txt_Transporte', FILTER_SANITIZE_STRING);
$txtdesc_Ativo = filter_input(INPUT_POST, 'txtdesc_Ativo', FILTER_SANITIZE_STRING);
$txtdesc_Latitude = filter_input(INPUT_POST, 'txtdesc_Latitude', FILTER_SANITIZE_STRING);
$txtdesc_Longitude = filter_input(INPUT_POST, 'txtdesc_Longitude', FILTER_SANITIZE_STRING);

$query_insert = "INSERT INTO Destinatario (desc_Destinatario, desc_AC, desc_AcAbreviado, desc_CPF, desc_Logradouro,
desc_Numero, desc_Complemento, desc_Bairro, cid_Codigo, cod_Uf, desc_CEP, desc_Fixo, desc_Movel, desc_Transportadora, 
desc_Ativo, desc_Operador, desc_DataAlteracao, desc_Latitude, desc_Longitude) values ('$txtdesc_destinatario', '$txtdesc_AC',
'$txtdesc_AcAbreviado', '$txtdesc_CPF', '$txtdesc_Logradouro', '$txtdesc_Numero', '$txtdesc_Complemento', '$txtdesc_Bairro',
'$txtcodCidade', '$txtcodUF', '$txtdesc_CEP', '$txtdesc_Fixo', '$txtdesc_Movel', '$txt_Transporte', '$txtdesc_Ativo',
'$user_id',now(),'$txtdesc_Latitude', '$txtdesc_Longitude')";

$result_insert = mysqli_query($link, $query_insert);

if($result_insert == true){
    echo 'Destinatário inserido com sucesso !';
}else{
    echo 'Atenção ! existe um erro ao tentar executar script'.'<br>'.mysqli_error($link);
}
?>