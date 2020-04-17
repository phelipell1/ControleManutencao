<?php
require_once("../Connections/Conexao.php");
$ObjDB = new DB();
$link = $ObjDB->connecta_mysql();
?>
<script>
    $(document).ready(function() {
        $('#btn_Concluir').hide();
        $("#est_Codigo").change(function() {
            var valor = $('#est_Codigo option:selected').val();
            $.ajax({
                url: '../controllers/busca_cidade_uf.php?uf=valor',
                method: 'post',
                data: {
                    ufs: $('#est_Codigo').val()
                },
                success: function(data) {
                    $('#cid_Codigo').html(data).show();
                }
            });
        })

        $('#btn_Cadastrar').click(function(){
        $.ajax({
            url: '../controllers/remessa_cadastro_dao.php',
            method: 'post',
            data: $('#form_Remessa').serialize(),
            success:function(data){
                alert(data);
                $('#btn_Cadastrar').hide();
                $('#btn_Concluir').show();
            }
        })
        $('#btn_Concluir').click(function(){
            window.location = '../views/homepage.php?rms=1';
        })
    });
    });
</script>
<link rel="stylesheet" href="../CSS/style2.css">
<form id="form_Remessa">
    <div class="row col">

        <div class="form-group col-2">
            <label for="rem_Remetente">Remetente</label>
            <select name="rem_Remetente" id="rem_Remetente" class="form-control form-control-sm">
                <option selected>Selecione</option>
                <?
                $query_rem = "select * from Remetente";
                $result_rem = mysqli_query($link, $query_rem);
                $rows_rem = mysqli_num_rows($result_rem);
                foreach ($result_rem as $rows_rem) {
                    echo '<option  value="' . $rows_rem['rem_Codigo'] . '">' . $rows_rem['rem_Abreviado'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group col-2">
            <label for="rem_Destinatario">Destinatário</label>
            <select name="rem_Destinatario" id="rem_Destinatario" class="form-control form-control-sm">
                <option selected>Selecione</option>
                <?
                $query_des = "select * from Destinatario";
                $result_des = mysqli_query($link, $query_des);
                $rows_des = mysqli_num_rows($result_des);
                foreach ($result_des as $rows_des) {
                    echo '<option  value="' . $rows_des['cod_Destinatario'].'">' . $rows_des['desc_AcAbreviado'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group col-2">
            <label for="est_Codigo">UF</label>
            <select name="est_Codigo" id="est_Codigo" class="form-control form-control-sm">
                <option selected>Selecione</option>
                <?
                $query_uf = "select * from UF";
                $result_uf = mysqli_query($link, $query_uf);
                $rows_uf = mysqli_num_rows($result_uf);
                foreach ($result_uf as $rows_uf) {
                    echo '<option  value="' . $rows_uf['codUf'] . '">' . $rows_uf['UF'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group col-4" id="cid">
            <label for="cid_Codigo">Destino</label>
            <select name="cid_Codigo" id="cid_Codigo" class="form-control form-control-sm">
                <option selected>Selecione</option>
            </select>
        </div>
        <div class="form-group col-2">
            <label for="temp_Empresa">Envio</label>
            <select name="temp_Empresa" id="temp_Empresa" class="form-control form-control-sm">
                <option selected>Selecione</option>
                <?
                        $query_tmp ="select * from Empresa";
                        $result_tmp = mysqli_query($link, $query_tmp);
                        $rows_tmp = mysqli_num_rows($result_tmp);
                        foreach($result_tmp as $rows_tmp){
                            echo'<option value="'.$rows_tmp['emp_Codigo'].'">'.$rows_tmp['emp_RasaoSocial'].'</option>';
                        }
                    ?>
            </select>
        </div>
        <div class="form-group col-12">
            <label for="rms_Descricao">Descrição</label>
            <textarea name="rms_Descricao" id="rms_Descricao" cols="3" rows="3" class="form-control "></textarea>
        </div>
        <div class="form-group col-12">
            <button type="button" class="btn btn-sm btn-success" id="btn_Cadastrar">Cadastrar</button>
            <button type="button" class="btn btn-sm btn-success" id="btn_Concluir">Concluir</button>
            <button type="reset" class="btn btn-sm btn-success">Limpar</button>

        </div>
    </div>
</form>