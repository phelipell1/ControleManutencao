<?
require_once('../Connections/Conexao.php');
$Obj = new DB();
$link = $Obj->connecta_mysql();
$cod = $_GET['cod'];
$query_busca = "select reg.sed_Codigo, reg.sed_Data, emp.emp_Descricao,r.rem_Abreviado, cid.Cidade, est.UF,
des.desc_AcAbreviado, reg.sed_Cod_rastreio, reg.sed_Valor, reg.sed_Pago, reg.sed_Extraviado, st.Status from regSedex as reg
left join Empresa as emp on emp.emp_Codigo = reg.emp_Codigo
left join Cidades as cid on cid.codCidade = reg.cid_Codigo
left join UF as est on est.codUf = reg.est_Codigo
left join Destinatario as des on des.cod_Destinatario = reg.des_Codigo
left join Remetente as r on r.rem_Codigo = reg.rem_Codigo
left join StatusServico as st on st.codStatus = reg.rem_Codigo
where sed_Codigo = $cod";

$result =  mysqli_query($link, $query_busca);
$rowns = mysqli_num_rows($result);
if ($result == true) {
    if ($rowns <= 0) {
        echo 'Error: Não foi possível identificar o problema, entre em contato com o suporte.';
        $date_p = null;
            $cod_descricao = null;
            $cod_cidade = null;
            $cod_est = null;
            $cod_acAbreviado = null;
            $rem_abreviado = null;
            $rastreio = null;
            $valor = null;
            $pago = null;
            $extraviado = null;
            $status = null;
    } else {
        foreach ($result as $rowns) {
            $date_p = $rowns['sed_Data'];
            $cod_descricao = $rowns['emp_Descricao'];
            $cod_cidade = $rowns['Cidade'];
            $cod_est = $rowns['UF'];
            $cod_acAbreviado = $rowns['desc_AcAbreviado'];
            $rem_abreviado = $rowns['rem_Abreviado'];
            $rastreio = $rowns['sed_Cod_rastreio'];
            $valor = $rowns['sed_Valor'];
            $pago = $rowns['sed_Pago'];
            $extraviado = $rowns['sed_Extraviado'];
            $status = $rowns['Status'];
        }
    }
} else {
            
}
?>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../CSS/style2.css">
<script src="../jquery/jquery-3.4.1.js"></script>
<script src="../jquery/mask.js"></script>
<script src="../jquery/mask_det.js"></script>

<script>
    $(document).ready(function() {
        $('#txt_Valor').mask('000.000.000.000.000.00', {
            reverse: true
        });
        $("#txt_cod_rastreio").change(function() {
            $(this).val($(this).val().toUpperCase());
        });

        
        $('#btn_update').click(function(){
            $.ajax({
                url: '../controllers/update_remessa_dao.php?id=<?echo$cod?>',
                method: 'post',
                data: $('#formulario_update').serialize(),
                success: function(data){
                    alert(data);
                    window.location = "../forms/remessas_enviadas.php";
                }
            });
        })
    });
</script>
<div class="container">
    <div class="shadow-lg mb-5 p-3 rounded-bottom border">
        <h5>Editar Remessa.</h5>
        <hr>
        <form id="formulario_update">
            <div class="row">
                <div class="form-group col-2">
                    <label for="txtDtPostagem">Dt Postagem:</label>
                    <input type="date" name="txtDtPostagem" id="txtDtPostagem" class="form-control form-control-sm" value="<?echo$date_p?>">
                </div>
                <div class="form-group col-2">
                    <label for="txtcod_Empresa">Empresa:</label>
                    <input type="text" name="txtcod_Empresa" id="txtcod_Empresa" class="form-control form-control-sm" value="<? echo $cod_descricao ?>" readonly>
                </div>
                <div class="form-group col-2">
                    <label for="txtcod_Remetente">Remetente:</label>
                    <input type="text" name="txtcod_Remetente" id="txtcod_Remetente" class="form-control form-control-sm" value="<? echo $rem_abreviado ?>" readonly>
                </div>
                <div class="form-group col-3">
                    <label for="txtcod_Cidade">Cidade:</label>
                    <input type="text" name="txtcod_Cidade" id="txtcod_Cidade" class="form-control form-control-sm" value="<? echo $cod_cidade ?>" readonly>
                </div>
                <div class="form-group col-1">
                    <label for="txtcod_Estado">Estado:</label>
                    <input type="text" name="txtcod_Estado" id="txtcod_Estado" class="form-control form-control-sm" value="<? echo $cod_est ?>" readonly>
                </div>
                <div class="form-group col-3">
                    <label for="txtcod_Destinatário">Destinatário:</label>
                    <input type="text" name="txtcod_Destinatário" id="txtcod_Destinatário" class="form-control form-control-sm" value="<? echo $cod_acAbreviado ?>" readonly>
                </div>
                <div class="form-group col-2">
                    <label for="txt_cod_rastreio">Cód Rastreio:</label>
                    <input type="text" name="txt_cod_rastreio" id="txt_cod_rastreio" class="form-control form-control-sm" maxlength="13" value="<?echo$rastreio?>">
                </div>
                
                <div class="form-group col-1">
                    <label for="txt_Valor">Valor:</label>
                    <input type="text" name="txt_Valor" id="txt_Valor" class="form-control form-control-sm" value="<?echo$valor?>">
                </div>
                <div class="form-group col-1">
                    <label for="txtcod_Pago">Pago:</label>
                    <Select id="txtcod_Pago" name="txtcod_Pago" class="form-control form-control-sm">
                        <?if($pago == '1'){
                            echo'<option value="1">Sim</option>';
                        }else{
                            echo '<option value="0">Não</option>';
                        }
                            ?>
                    </Select>
                </div>
                <div class="form-group col-1">
                    <label for="cmb_Extraviado">Extraviado:</label>
                    <Select id="cmb_Extraviado" name="cmb_Extraviado" class="form-control form-control-sm">
                    <?if($extraviado == '1'){
                       
                            echo'<option value="1">Sim</option>';
                        }else{
                            echo '<option value="0">Não</option>';
                        }
                            ?>
                    </Select>
                </div>
                <div class="form-group col-2">
                    <label for="cmb_Extraviado">Status</label>
                    <Select id="cmb_Extraviado" name="cmb_Extraviado" class="form-control form-control-sm">
                        <?
                            $query_status = "SELECT * FROM StatusServico";
                            $result_status = mysqli_query($link, $query_status);
                            if($result_status == true){
                                while($st = mysqli_fetch_array($result_status)){
                                    if($status == $st['Status']){
                                        echo '<option value="'.$st['codStatus'].'">'.$st['Status'].'</option>';
                                    }else{
                                        echo '<option value="'.$st['codStatus'].'">'.$st['Status'].'</option>';
                                    }
                                
                                }
                            }else{
                                echo '<option">Sem Resultado</option>';
                            }
                        ?>
                    </Select>
                </div>
                <div class="form-group col-6">
                    <button type="button" class="btn btn-sm btn-dark" id="btn_update">Alterar</button>
                </div>
            </div>
        </form>
    </div>
</div>