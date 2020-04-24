<?php
session_start();
require_once('../Connections/Conexao.php');
$user_id = $_SESSION['userId'];
$ObjDB = new DB();
$link = $ObjDB -> connecta_mysql();

$txt_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$txtDtPostagem = filter_input(INPUT_POST, 'txtDtPostagem', FILTER_SANITIZE_STRING);
$txtcod_Empresa = filter_input(INPUT_POST, 'txtcod_Empresa', FILTER_SANITIZE_STRING);
$txtcod_Remetente = filter_input(INPUT_POST, 'txtcod_Remetente', FILTER_SANITIZE_STRING);
$txtcod_Cidade = filter_input(INPUT_POST, 'txtcod_Cidade', FILTER_SANITIZE_STRING);
$txtcod_Estado = filter_input(INPUT_POST, 'txtcod_Estado', FILTER_SANITIZE_STRING);
$txtcod_Destinatário = filter_input(INPUT_POST, 'txtcod_Destinatário', FILTER_SANITIZE_STRING);
$txtcodUF = filter_input(INPUT_POST, 'txtcodUF', FILTER_SANITIZE_STRING);
$txtcodCidade = filter_input(INPUT_POST, 'txtcodCidade', FILTER_SANITIZE_STRING);
$txt_cod_rastreio = filter_input(INPUT_POST, 'txt_cod_rastreio', FILTER_SANITIZE_STRING);
$txt_Valor = filter_input(INPUT_POST, 'txt_Valor', FILTER_SANITIZE_STRING);
$txtcod_Pago = filter_input(INPUT_POST, 'txtcod_Pago', FILTER_SANITIZE_STRING);
$cmb_Extraviado = filter_input(INPUT_POST, 'cmb_Extraviado', FILTER_SANITIZE_STRING);
$sut;

$query_insert = "UPDATE regSedex SET sed_DataPostagem = '$txtDtPostagem', sed_Cod_rastreio = '$txt_cod_rastreio', sed_Valor = '$txt_Valor'
, sed_Pago = '$txtcod_Pago', sed_Extraviado = '$cmb_Extraviado', sed_Operador = '$user_id', sed_DataAlteracao = now()
where sed_Codigo = $txt_id";

//if($txtCodEquipamento == "-Selecione-" || $txtCodMDE == "-Selecione-" || $textIMEI == "" || $textpatrimonio == "" || $textdescricaoDefeito == ""
//|| $txtcodUF == "-Selecione-" || $txtcodCidade == "-Selecione-" || $txtcodDepartamento == "-Selecione-" || $txtcodStatus == "-Selecione-"){
   //echo 'Atenção ! Todos os campos são obrigatórios';
//}

$result_insert = mysqli_query($link, $query_insert);

if($result_insert == true){
    echo 'Dados atualizados com sucesso !';
}else{
    echo 'Atenção ! existe um erro ao tentar executar script'.'<br>'.mysqli_error($link);
}
?>