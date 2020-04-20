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
        $("#txtemp_CNPJ").mask("99.999.999/9999-99");
        $("#txtemp_Fixo").mask("(99)9999-9999");
        $("#txtemp_CEP").mask("99999-999");
        
    $("#txtcodUF").change(function(){
    var valor = $('#txtcodUF option:selected').val();
    $.ajax({
        url: '../controllers/busca_cidade_uf.php?uf=valor',
        method: 'post',
        data: {ufs: $('#txtcodUF').val()},
        success:function(data){
            $('#txtcodCidade').html(data).show();
        }
        });
    })
    /*$("#txtcodCidade").change(function(){
    var cid = $('#txtcodCidade option:selected').val();
    alert(cid);
    })*/

    $('#btnCadastrar').click(function(){

        $.ajax({
            url: '../controllers/empresa_cadastro_dao.php',
            method: 'post',
            data: $('#form_Empresa').serialize(),
            success:function(data){
                alert(data);
                $('#txtemp_CNPJ').val('');
                $('#txtemp_RasaoSocial').val('');
                $('#txtemp_TipoEmpresa').val('');
                $('#txtemp_Descricao').val('');
                $('#txtemp_Logradouro').val('');
                $('#txtemp_Numero').val('');
                $('#txtemp_Complemento').val('');
                $('#txtemp_Bairro').val('');
                $('#txtcodUF').val('-Selecione-');
                $('#txtcodCidade').val('-Selecione-');
                $('#txtemp_CEP').val('');
                $('#txtemp_Fixo').val('');
                $('#txt_tipoEmpresa').val('-Selecione-');
            }
        })
    });

    $('#btn_Voltar').click(function(){
        window.location = '../views/homepage.php';
    });
    
    });
</script>
<div class="container">
    <div class="shadow-lg mb-auto p-3 rounded border">
    <button class="btn btn-sm btn-light" id="btn_Voltar">Voltar</button>
    <hr>
    <form id="form_Empresa">
    <div class="row col">
        <div class="form-group col-3">
            <label for="txtemp_CNPJ">CNPJ</label>
            <input type="text" name="txtemp_CNPJ" id="txtemp_CNPJ" class="form-control form-control-sm">
        </div>
        <div class="form-group col-4">
            <label for="txtemp_RasaoSocial">Rasão Social</label>
            <input type="text" name="txtemp_RasaoSocial" id="txtemp_RasaoSocial" class="form-control form-control-sm">
        </div>
        <div class="form-group col-2">
            <label for="txtemp_TipoEmpresa">Tipo Empresa</label>
            <input type="text" name="txtemp_TipoEmpresa" id="txtemp_TipoEmpresa" class="form-control form-control-sm">
        </div>
        <div class="form-group col-3">
            <label for="txtemp_Descricao">Descrição</label>
            <input type="text" name="txtemp_Descricao" id="txtemp_Descricao" class="form-control form-control-sm">
        </div>
        <div class="form-group col-6">
            <label for="txtemp_Logradouro">Logradouro</label>
            <input type="text" name="txtemp_Logradouro" id="txtemp_Logradouro" class="form-control form-control-sm">
        </div>
        <div class="form-group col-1">
            <label for="txtemp_Numero">N°</label>
            <input type="text" name="txtemp_Numero" id="txtemp_Numero" class="form-control form-control-sm">
        </div>
        <div class="form-group col-5">
            <label for="txtemp_Complemento">Complemento</label>
            <input type="text" name="txtemp_Complemento" id="txtemp_Complemento" class="form-control form-control-sm">
        </div>
        <div class="form-group col-4">
            <label for="txtemp_Bairro">Bairro</label>
            <input type="text" name="txtemp_Bairro" id="txtemp_Bairro" class="form-control form-control-sm">
        </div>
        
        <div class="form-group col-2">
            <label for="txtcodUF">UF</label>
            <select name="txtcodUF" id="txtcodUF" class="form-control form-control-sm">
                <option selected>-Selecione-</option>
                <?
                    $query_uf ="select * from UF";
                    $result_uf = mysqli_query($link, $query_uf);
                    $rows_uf = mysqli_num_rows($result_uf);
                    foreach($result_uf as $rows_uf){
                        echo'<option value="'.$rows_uf['codUf'].'">'.$rows_uf['UF'].'</option>';
                        $uf = $rows_uf['codUf'];
                    }
                ?>
            </select>
        </div>
        <div class="form-group col-4">
            <label for="txtcodCidade">Cidade</label>
            <select name="txtcodCidade" id="txtcodCidade" class="form-control form-control-sm">
                <option selected>-Selecione-</option>
            </select>
        </div>
        <div class="form-group col-2">
            <label for="txtemp_CEP">CEP</label>
            <input type="text" name="txtemp_CEP" id="txtemp_CEP" class="form-control form-control-sm">
        </div>
        <div class="form-group col-2">
            <label for="txtemp_Fixo">Fixo</label>
            <input type="text" name="txtemp_Fixo" id="txtemp_Fixo" class="form-control form-control-sm">
        </div>
        <div class="form-group col-3">
            <label for="txt_tipoEmpresa">Empresa</label>
            <select name="txt_tipoEmpresa" id="txt_tipoEmpresa" class="form-control form-control-sm">
                <option selected>-Selecione-</option>
                <?
                    $query_tmp ="select * from TipoEmpresa";
                    $result_tmp = mysqli_query($link, $query_tmp);
                    $rows_tmp = mysqli_num_rows($result_tmp);
                    foreach($result_tmp as $rows_tmp){
                        echo'<option value="'.$rows_tmp['tem_Codigo'].'">'.$rows_tmp['tem_TipoEmpresa'].'</option>';
                    }
                ?>
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