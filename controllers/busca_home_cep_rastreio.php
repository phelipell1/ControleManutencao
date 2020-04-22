<?php
    require_once('../Connections/Conexao.php');
    $ObjDB = new DB();
    $link = $ObjDB -> connecta_mysql();
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    $data = strftime('%Y-%m', strtotime('today'));
    $query_busca = "select r.rms_Codigo, r.rms_dataCriacao, c.Cidade, r.rms_Rastreio, e.emp_Descricao, e.emp_CEP, d.desc_AcAbreviado from Remessas as r
    left join Cidades as c on c.codCidade= r.rms_Codigo
    left join Empresa as e on e.emp_Codigo = r.rms_Codigo
    left join Destinatario as d on d.cod_Destinatario = rms_Codigo 
    where rms_dataCriacao like '%$data%'";

    $resust_busca = mysqli_query($link, $query_busca);
    $linhas = $resust_busca->num_rows;
    
    if($resust_busca == true){
        if($linhas <= 0){
            echo'Não possui registros.';
        }else{
            echo'
            <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="../CSS/style2.css">
            <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Dt postagem</th>
                                    <th scope="col">Aos Cuidados</th>
                                    <th scope="col">Cidade</th>
                                    <th scope="col">CEP</th>
                                    <th scope="col">Cód. Rastreio</th>
                                </tr>
                            </thead>
                            
                        ';
            while($reg = mysqli_fetch_array($resust_busca)){
                echo'
                <tbody class="small">
                <tr>
                    <td scope="row">'.$reg['rms_dataCriacao'].'</td>
                    <td scope="row">'.$reg['desc_AcAbreviado'].'</td>
                    <td scope="row">'.$reg['Cidade'].'</td>
                    <td scope="row">'.$reg['emp_CEP'].'</td>
                    <td scope="row">'.$reg['rms_Rastreio'].'</td>
                    
                </tr>
                </tbody>
            </tale>
                ';
            }
        }
    }else{
        echo mysqli_error($link);
    }
?>