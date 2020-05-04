<?php
require_once('../Connections/Conexao.php');
$ObjDB = new DB();
$link = $ObjDB->connecta_mysql();
/*setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    $data = strftime('%Y-%m', strtotime('today'));*/
$cep = $_POST['cep'];
$codR = $_POST['codR'];
if ($cep == "") {
    $query_busca = "select date_format(reg.sed_DataPostagem,'%d-%m-%Y') as dat, des.desc_AcAbreviado, cid.Cidade, des.desc_CEP,
        reg.sed_Cod_rastreio, reg.sed_Valor, reg.sed_Pago from regSedex as reg
        left join Cidades as cid on cid.codCidade = reg.cid_Codigo
        left join Destinatario as des on des.cod_Destinatario = reg.des_Codigo
        where sed_Pago = true
        and sed_Cod_rastreio like '%$codR%'";
} else if ($codR == "") {
    $query_busca = "select date_format(reg.sed_DataPostagem,'%d-%m-%Y') as dat, des.desc_AcAbreviado, cid.Cidade, des.desc_CEP,
        reg.sed_Cod_rastreio, reg.sed_Valor, reg.sed_Pago from regSedex as reg
        left join Cidades as cid on cid.codCidade = reg.cid_Codigo
        left join Destinatario as des on des.cod_Destinatario = reg.des_Codigo
        where sed_Pago = true
        and desc_CEP like '%$cep%'";
} else if ($codR == $codR || $cep == $cep) {
    echo 'Atenção! Pesquise utilizando apenas um campo por vez.';
    $error = 500;
    die();
}

$resust_busca = mysqli_query($link, $query_busca);
$linhas = $resust_busca->num_rows;

if ($resust_busca == true) {
    if ($linhas <= 0) {
        echo '
            <p id="info">Busca não retornou registros.</p>';
    } else {
        echo '
            <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="../CSS/style2.css">
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
            <script>
            $(document).ready(function () { 
                var error == "' . $error . '";
                if(error == 500){
                    $("#tbl").hide();
                }else{
                    $("tbl").show();
                }
            </script>
            <table id="tbl" class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Dt postagem</th>
                                    <th scope="col">Aos Cuidados</th>
                                    <th scope="col">Cidade</th>
                                    <th scope="col">CEP</th>
                                    <th scope="col">Cód. Rastreio</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Pago?</th>
                                    <th scope="col">ações</th>
                                </tr>
                            </thead>
                            
                        ';
        while ($reg = mysqli_fetch_array($resust_busca)) {
            echo '
                <tbody class="small">
                <tr>
                    <td scope="row" id="data">' . $reg['dat'] . '</td>
                    <td scope="row">' . $reg['desc_AcAbreviado'] . '</td>
                    <td scope="row">' . $reg['Cidade'] . '</td>
                    <td scope="row">' . $reg['desc_CEP'] . '</td>
                    <td scope="row">' . $reg['sed_Cod_rastreio'] . '</td>
                    <td scope="row">' . $reg['sed_Valor'] . '</td>
                    <td scope="row">' . $reg['sed_Pago'] . '</td>
                    <td scope="row"><a href="../controllers/rastreio_envios.php?cod_rastreio=' . $reg['sed_Cod_rastreio'] . '"><img src="../imagens/logo-rastreamento.png" width="90" alt=""></a></td>
                    
                </tr>
                </tbody>
            </tale>
                ';
        }
    }
} else {
    echo 'ERROR: ' . mysqli_error($link);
}
?>
<script>
    $(document).ready(function() {
        $("#info").css({
            "color": "red"
        });
    });
</script>