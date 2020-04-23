<?php
require_once('../Connections/Conexao.php');
$ObjDB = new DB();
$link = $ObjDB->connecta_mysql();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data = strftime('%Y-%m', strtotime('today'));
$query_busca = "select date_format(reg.sed_DataPostagem,'%d-%m-%Y') as dat, des.desc_AcAbreviado, cid.Cidade, des.desc_CEP,
    reg.sed_Cod_rastreio, reg.sed_Valor, reg.sed_Pago, reg.sed_Codigo from regSedex as reg
    left join Cidades as cid on cid.codCidade = reg.cid_Codigo
    left join Destinatario as des on des.cod_Destinatario = reg.des_Codigo
    where sed_Data like '%$data%' and sed_Pago = false";

$resust_busca = mysqli_query($link, $query_busca);
$linhas = $resust_busca->num_rows;
?>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../CSS/style2.css">
<script src="../jquery/jquery-3.4.1.js"></script>
<script>
    $(document).ready(function() {
        $('#formulario').hide();
        $('#btn_Editar').click(function() {
            $.ajax({
                url: '../forms/update_remessa.php',
                success: function(data) {
                    $("#formulario").html(data).show();
                    $('#dados-info').hide();
                }
            });
            $('#tbl_dados').hide();
            $('#formulario').show();
        });
    });
</script>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h4>Remessas Enviadas</h4>
    <hr>
    <div class="table-responsive" id="tbl_dados">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th scope="col">Dt postagem</th>
                    <th scope="col">Aos Cuidados</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">CEP</th>
                    <th scope="col">Cód. Rastreio</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Pago?</th>
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
                                <td scope="row" id="data">' . $reg['dat'] . '</td>
                                        <td scope="row">' . $reg['desc_AcAbreviado'] . '</td>
                                        <td scope="row">' . $reg['Cidade'] . '</td>
                                        <td scope="row" id="cep">' . $reg['desc_CEP'] . '</td>
                                        <td scope="row">' . $reg['sed_Cod_rastreio'] . '</td>
                                        <td scope="row">' . $reg['sed_Valor'] . '</td>
                                        <td scope="row">' . $reg['sed_Pago'] . '</td>
                                        <td scope="row"><a class="btn btn-info btn-sm" id="btn_Editar">Editar</a>
                                        <a href="../forms/listar_itens_remessa.php?reg=' . $reg['sed_Codigo'] . '" class="btn btn-info btn-sm" id="btn_Visualizar">Visualizar</a></td>
                                        </tr>
                                    </tbody>';
                    }
                }
            }
            ?>
            
        </table>
    </div>
    <div class="container" id="formulario">
    </div>
</body>

</html>