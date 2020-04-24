<?php
    require_once("../Connections/Conexao.php");
    $ObjDB = new DB();
    $link = $ObjDB->connecta_mysql();
?>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../CSS/style2.css">
<script src="../jquery/jquery-3.4.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
    $(document).ready(function () { 
        $("#textrem_Fixo").mask("(99)9999-9999");
        $("#textrem_Movel").mask("(99) 99999-9999");

        $('#btnCadastrar').click(function(){
        $.ajax({
            url: '../controllers/remetente_cadastro_dao.php',
            method: 'post',
            data: $('#form-Remetente').serialize(),
            success:function(data){
                alert(data);
                $('#textrem_Remetente').val('');
                $('#textrem_Abreviado').val('');
                $('#textrem_Fixo').val('');
                $('#textrem_Movel').val('');
                $('#txtemp_Codigo').val('-Selecione-');
                $('#txtrem_Ativo').val('-Selecione-');
            }
        })
    });
    $('#btn_Voltar').click(function(){
        window.location = '../views/homepage.php';
    })
    });
</script>
<div class="container">
    <div class="shadow-lg mb-5 p-3 rounded border">
        <button class="btn btn-sm btn-light" id="btn_Voltar">Voltar</button>
        <hr>
        <form id="form-Remetente">
        <div class="row">
        <div class="form-group col-sm-5">
            <label for="textrem_Remetente">Remetente</label>
            <input type="text" name="textrem_Remetente" id="textrem_Remetente" class="form-control form-control-sm">
        </div>
        <div class="form-group col-sm-4">
            <label for="textrem_Abreviado">Remetente Abreviado</label>
            <input type="text" name="textrem_Abreviado" id="textrem_Abreviado" class="form-control form-control-sm">
        </div>
        <div class="form-group col-sm-2">
            <label for="textrem_Fixo">Fixo</label>
            <input type="text" name="textrem_Fixo" id="textrem_Fixo" class="form-control form-control-sm">
        </div>
        <div class="form-group col-sm-2">
            <label for="textrem_Movel">Movél</label>
            <input type="text" name="textrem_Movel" id="textrem_Movel" class="form-control form-control-sm">
        </div>
        <div class="form-group col-3">
            <label for="txtemp_Codigo">Empresa</label>
                <select name="txtemp_Codigo" id="txtemp_Codigo" class="form-control form-control-sm">
                    <option selected>-Selecione-</option>
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
                <div class="form-group col-3">
                    <label for="txtrem_Ativo">Situação</label>
                    <select name="txtrem_Ativo" id="txtrem_Ativo" class="form-control form-control-sm">
                        <option selected>-Selecione-</option>
                        <option value="1">1 - Ativo</option>';
                        <option value="0">2 - Inativo</option>';
                    </select>
                </div>
                <div class="form-group col-12">
                    <button type="button" class="btn btn-sm btn-primary" id="btnCadastrar">Cadastrar</button>
                    <button type="reset" class="btn btn-sm btn-primary">Limpar</button>
                </div>
        </div>
        </form>
    </div>
</div>