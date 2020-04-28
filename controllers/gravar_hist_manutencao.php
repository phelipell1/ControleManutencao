<?php
session_start();
require_once("../Connections/Conexao.php");
$obj = new DB();
$link = $obj-> connecta_mysql();
$codEntrada = filter_input(INPUT_POST, 'text_cod_entrada', FILTER_SANITIZE_STRING);
$text_hist_descricao = filter_input(INPUT_POST, 'text_hist_descricao', FILTER_SANITIZE_STRING);
$txt_hist_dataDevolucao = filter_input(INPUT_POST, 'txt_hist_dataDevolucao', FILTER_SANITIZE_STRING);
$txt_hist_dataPostagem = filter_input(INPUT_POST, 'txt_hist_dataPostagem', FILTER_SANITIZE_STRING);
$txt_hist_dataDespacho = filter_input(INPUT_POST, 'txt_hist_dataDespacho', FILTER_SANITIZE_STRING);
$txt_hist_dataServico = filter_input(INPUT_POST, 'txt_hist_dataServico', FILTER_SANITIZE_STRING);
$txt_hist_fechamento = filter_input(INPUT_POST, 'txt_hist_fechamento', FILTER_SANITIZE_STRING);
$txt_hist_dataRetorno = filter_input(INPUT_POST, 'txt_hist_dataRetorno', FILTER_SANITIZE_STRING);
$txt_tec_sut = filter_input(INPUT_POST, 'txt_tec_sut', FILTER_SANITIZE_STRING);
$txt_num_os = filter_input(INPUT_POST, 'txt_num_os', FILTER_SANITIZE_STRING);
$txtcodStatus = filter_input(INPUT_POST, 'txtcodStatus', FILTER_SANITIZE_STRING);
$cod_User = $_SESSION['id'];
$insert = null;


$query_update = "insert into histManutencao (cod_entrada, hist_resolucao, hist_DataDevolucao, hist_DataPostagem, hist_DataDespacho,
hist_DataServico, hist_DataFechamento, hist_DataRetorno, hist_TecSut, hist_numOs, cod_User)
values
('$codEntrada', '$text_hist_descricao', '$txt_hist_dataDevolucao', '$txt_hist_dataPostagem','$txt_hist_dataDespacho','$txt_hist_dataServico'
,'$txt_hist_fechamento','$txt_hist_dataRetorno','$txt_tec_sut','$txt_num_os', '$cod_User')";

$result_query = mysqli_query($link, $query_update);

if($codEntrada == "" || $text_hist_descricao == "" || $txt_hist_dataDevolucao == "" 
|| $txt_hist_dataPostagem == "" || $txt_hist_dataDespacho == "" || $txt_hist_dataServico == ""
|| $txt_hist_fechamento == "" || $txt_hist_dataRetorno == "" || $txt_tec_sut == "" || $txt_num_os == ""){
    echo'Todos os campos são obrigatórios.';
    die();
}

if($result_query == true){
    $insert = 1;
}else{
    echo "Não foi possível processar a requisição solicitada.".mysqli_error($link);
    $insert = 0;
}
if($insert == 1){
    $query_reg = "UPDATE EntradaManutencao set codStatus = 4 WHERE codEntrada = '$codEntrada'";
    $resut = mysqli_query($link, $query_reg);
    if($resut == true){
        echo'Atenção ! Registro solicitado foi alterado';
    }else{
        echo "Não foi possível processar a requisição solicitada.";
    }
}else{
    die();
}
?>