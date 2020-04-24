<?php
require_once('../Connections/Conexao.php');
$ObjDB = new DB();
$link = $ObjDB->connecta_mysql();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data = strftime('%Y-%m', strtotime('today'));
$reg = $_GET['reg'];
$query_busca = "select * from EntradaManutencao where rms_Codigo = $reg";

$resust_busca = mysqli_query($link, $query_busca);
$linhas = $resust_busca->num_rows;
?>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../CSS/style2.css">
<script src="../jquery/jquery-3.4.1.js"></script>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="shadow-lg mb-5 p-3 rounded border">
            <h4>Itens</h4>
            <hr>
            <div class="table-responsive" id="tbl_dados">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Equipamento</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Imei</th>
                            <th scope="col">SUT</th>
                            <th scope="col">Patrimonio</th>
                            <th scope="col">Entrada</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                            <?
                            if ($resust_busca == true) {
                                if ($linhas <= 0) {
                                    echo 'Não possui registros.';
                                } else {
                                    while ($reg = mysqli_fetch_array($resust_busca)) {
                                        echo '
                                        <tbody class="small">
                                        <tr>
                                        <td scope="row">' . $reg['codEquipamento'] . '</td>
                                                <td scope="row">' . $reg['codMDE'] . '</td>
                                                <td scope="row">' . $reg['IMEI'] . '</td>
                                                <td scope="row">' . $reg['codigoSut'] . '</td>
                                                <td scope="row">' . $reg['patrimonio'] . '</td>
                                                <td scope="row">' . $reg['dateEntrada'] . '</td>
                                                <td scope="row"><a href="../relatorios/relatorio_garantia.php?cod='.$reg['codEntrada'].'">Imprimir</a></td>
                                                </tr>
                                                </tbody>';
                                    }
                                }
                            }
                            ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>