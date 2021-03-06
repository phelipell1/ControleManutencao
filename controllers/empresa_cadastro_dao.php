<?php
session_start();
require_once('../Connections/Conexao.php');
$user_id = $_SESSION['userId'];
$ObjDB = new DB();
$link = $ObjDB -> connecta_mysql();

$txtemp_CNPJ = filter_input(INPUT_POST, 'txtemp_CNPJ', FILTER_SANITIZE_STRING);
$txtemp_RasaoSocial = filter_input(INPUT_POST, 'txtemp_RasaoSocial', FILTER_SANITIZE_STRING);
$txtemp_TipoEmpresa = filter_input(INPUT_POST, 'txtemp_TipoEmpresa', FILTER_SANITIZE_STRING);
$txtemp_Descricao = filter_input(INPUT_POST, 'txtemp_Descricao', FILTER_SANITIZE_STRING);
$txtemp_Logradouro = filter_input(INPUT_POST, 'txtemp_Logradouro', FILTER_SANITIZE_STRING);
$txtemp_Numero = filter_input(INPUT_POST, 'txtemp_Numero', FILTER_SANITIZE_STRING);
$txtemp_Complemento = filter_input(INPUT_POST, 'txtemp_Complemento', FILTER_SANITIZE_STRING);
$txtemp_Bairro = filter_input(INPUT_POST, 'txtemp_Bairro', FILTER_SANITIZE_STRING);
$txtcodUF = filter_input(INPUT_POST, 'txtcodUF', FILTER_SANITIZE_STRING);
$txtcodCidade = filter_input(INPUT_POST, 'txtcodCidade', FILTER_SANITIZE_STRING);
$txtemp_CEP = filter_input(INPUT_POST, 'txtemp_CEP', FILTER_SANITIZE_STRING);
$txtemp_Fixo = filter_input(INPUT_POST, 'txtemp_Fixo', FILTER_SANITIZE_STRING);
$txt_tipoEmpresa = filter_input(INPUT_POST, 'txt_tipoEmpresa', FILTER_SANITIZE_STRING);

$query_insert = "INSERT INTO Empresa (emp_CNPJ, emp_RasaoSocial, emp_TipoEmpresa, emp_Descricao, emp_Logradouro, emp_Numero, emp_Complemento,
emp_Bairro, cid_Codigo, est_Codigo, emp_CEP, emp_Fixo, tem_Codigo) VALUES ('$txtemp_CNPJ', '$txtemp_RasaoSocial', '$txtemp_TipoEmpresa',
'$txtemp_Descricao', '$txtemp_Logradouro', '$txtemp_Numero', '$txtemp_Complemento','$txtemp_Bairro', '$txtcodCidade', '$txtcodUF', '$txtemp_CEP',
'$txtemp_Fixo', '$txt_tipoEmpresa')";   



if($txtemp_CNPJ == ""){
    echo'Atenção ! Informe o <strong>CNPJ</strong> para prosseguir';
    die();
}elseif($txtemp_RasaoSocial == ""){
    echo'Atenção ! Informe o <strong>Razão Social</strong> para prosseguir';
    die();
}elseif($txtemp_TipoEmpresa == ""){
    echo'Atenção ! Informe o <strong>Tipo Empresa</strong> para prosseguir';
    die();
}elseif($txtemp_Descricao == ""){
    echo'Atenção ! Informe o <strong>Descrição</strong> para prosseguir';
    die();
}elseif($txtemp_Logradouro == ""){
    echo'Atenção ! Informe o <strong>Logradouro</strong> para prosseguir';
    die();
}elseif($txtemp_Bairro == ""){
    echo'Atenção ! Informe o <strong>Bairro/Setor</strong> para prosseguir';
    die();
}elseif($txtcodUF == "-Selecione-"){
    echo'Atenção ! Informe o <strong>Estado</strong> para prosseguir';
    die();
}elseif($txtcodCidade == ""){
    echo'Atenção ! Informe o <strong>Cidade</strong> para prosseguir';
    die();
}elseif($txtemp_CEP == ""){
    echo'Atenção ! Informe o <strong>CEP</strong> para prosseguir';
    die();
}elseif($txt_tipoEmpresa == "-Selecione-"){
    echo'Atenção ! Informe a <strong>Empresa</strong> para prosseguir';
    die();
}

$result_insert = mysqli_query($link, $query_insert);

if($result_insert == true){
    echo 'Empresa cadastrada com sucesso !';
}else{
    echo 'Atenção ! existe um erro ao tentar executar script'.'<br>';
}
?>