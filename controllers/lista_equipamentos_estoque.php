<?php
require_once('../Connections/Conexao.php');
$ObjDB = new DB();
$link = $ObjDB->connecta_mysql();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data = strftime('%Y-%m', strtotime('today'));
$query_busca = "select t.codEntrada, e.descricao, m.NomeModelo , t.IMEI, t.codigoSut, t.patrimonio,
t.descricaoDefeito, date_format(t.dateEntrada,'%d-%m-%Y %h:%m:%s') as dat, c.Cidade, u.UF, d.Departamento, s.Status, l.Nome,
t.rms_codigo from EntradaManutencao as t
inner join Equipamentos as e on e.codEquipamento = t.codEquipamento
inner join ModeloEquipamento as m on m.codModelo = t.codMDE
inner join Cidades as c on c.codCidade = t.codCidade
inner join UF as u on u.codUf = t.codUf
inner join Departamento as d on d.codDepartamento = t.codDepartamento
inner join StatusServico as s on s.codStatus = t.codStatus
inner join Usuario as l on l.IdUsuario = t.codUser";

$resust_busca = mysqli_query($link, $query_busca);
$linhas = $resust_busca->num_rows;
?>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../CSS/style2.css">
<script src="../jquery/jquery-3.4.1.js"></script>
<script src="../jquery/mask_det.js"></script>

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
                            <th scope="col">Status</th>
                            <th>Ações</th>
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
                                            <td scope="row">' . $reg['descricao'] . '</td>
                                            <td scope="row">' . $reg['NomeModelo'] . '</td>
                                            <td scope="row">' . $reg['IMEI'] . '</td>
                                            <td scope="row">' . $reg['codigoSut'] . '</td>
                                            <td scope="row">' . $reg['patrimonio'] . '</td>
                                            <td scope="row">' . $reg['dat'] . '</td>
                                            <td scope="row">' . $reg['Status'] . '</td>
                                            <td scope="row"><a href="../forms/cadastro_hist_equipamento.php?cod='.$reg['codEntrada'].'"><button class="btn btn-warning btn-sm">Nova OS</button></a></td>
                                        </tr>
                                        </tbody>
                                        ';
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