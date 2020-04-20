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
        $("#txtdesc_CPF").mask("999.999.999-99");
        $("#txtdesc_CEP").mask("99999-999");
        $("#txtdesc_Fixo").mask("(99)9999-9999");
        $("#txtdesc_Movel").mask("(99) 9 9999-9999");
        $("#txtdesc_Latitude").mask("-99.999999");
        $("#txtdesc_Longitude").mask("-99.999999");
        $('#txtdesc_Numero').keyup(function() {
            $(this).val(this.value.replace(/\D/g, ''));
        });
    //Atenção Script abaixo realiza a busca das cidades com base no codido do UF//    
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

    //Script para inserir dados no banco de dados.//
    $('#btnCadastrar').click(function(){

            $.ajax({
            url: '../controllers/destinatario_dao.php',
            method: 'post',
            data: $('#form_Destinatario').serialize(),
            success:function(data){
                alert(data);
                $('#txtdesc_destinatario').val('');
                $('#txtdesc_AC').val('');
                $('#txtdesc_AcAbreviado').val('');
                $('#txtdesc_CPF').val('');
                $('#txtdesc_Logradouro').val('');
                $('#txtdesc_Numero').val('');
                $('#txtdesc_Complemento').val('');
                $('#txtdesc_Bairro').val('');
                $('#txtcodUF').val('-Selecione-');
                $('#txtcodCidade').val('');
                $('#txtdesc_CEP').val('');
                $('#txtdesc_Fixo').val('');
                $('#txtdesc_Movel').val('');
                $('#txt_Transporte').val('');
                $('#txtdesc_Ativo').val('');
                $('#txtdesc_Latitude').val('');
                $('#txtdesc_Longitude').val('');

            }
        })
    });
    
    $('#btn_Voltar').click(function(){
        window.location = '../views/homepage.php';
    })
    });
</script>
<div class="cotainer">
    <div class="shadow-lg mb-5 p-3 rounded border">
    <button type="button" class="btn btn-sm btn-light" id="btn_Voltar">Voltar</button>
    <hr>
        <form id="form_Destinatario">
            <div class="row col">
                <div class="form-group col-3">
                    <label for="txtdesc_destinatario">Destinatário</label>
                    <input type="text" name="txtdesc_destinatario" id="txtdesc_destinatario" class="form-control form-control-sm">
                </div>
                <div class="form-group col-3">
                    <label for="txtdesc_AC">Aos Cuidados</label>
                    <input type="text" name="txtdesc_AC" id="txtdesc_AC" class="form-control form-control-sm">
                </div>
                <div class="form-group col-3">
                    <label for="txtdesc_AcAbreviado">AC Abreviado</label>
                    <input type="text" name="txtdesc_AcAbreviado" id="txtdesc_AcAbreviado" class="form-control form-control-sm">
                </div>
                <div class="form-group col-2">
                    <label for="txtdesc_CPF">CPF</label>
                    <input type="text" name="txtdesc_CPF" id="txtdesc_CPF" class="form-control form-control-sm">
                </div>
                <div class="form-group col-6">
                    <label for="txtdesc_Logradouro">Logradouro</label>
                    <input type="text" name="txtdesc_Logradouro" id="txtdesc_Logradouro" class="form-control form-control-sm">
                </div>
                <div class="form-group col-1">
                    <label for="txtdesc_Numero">Número</label>
                    <input type="text" name="txtdesc_Numero" id="txtdesc_Numero" class="form-control form-control-sm">
                </div>
                <div class="form-group col-4">
                    <label for="txtdesc_Complemento">Complemento</label>
                    <input type="text" name="txtdesc_Complemento" id="txtdesc_Complemento" class="form-control form-control-sm">
                </div>
                <div class="form-group col-6">
                    <label for="txtdesc_Bairro">Bairro</label>
                    <input type="text" name="txtdesc_Bairro" id="txtdesc_Bairro" class="form-control form-control-sm">
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
                <div class="form-group col-3">
                    <label for="txtcodCidade">Cidade</label>
                    <select name="txtcodCidade" id="txtcodCidade" class="form-control form-control-sm">
                        <option selected>-Selecione-</option>
                    </select>
            </div>
                <div class="form-group col-2">
                    <label for="txtdesc_CEP">CEP</label>
                    <input type="text" name="txtdesc_CEP" id="txtdesc_CEP" class="form-control form-control-sm">
                </div>
                <div class="form-group col-2">
                    <label for="txtdesc_Fixo">Fixo</label>
                    <input type="text" name="txtdesc_Fixo" id="txtdesc_Fixo" class="form-control form-control-sm">
                </div>
                <div class="form-group col-2">
                    <label for="txtdesc_Movel">Movél</label>
                    <input type="text" name="txtdesc_Movel" id="txtdesc_Movel" class="form-control form-control-sm">
                </div>
                <div class="form-group col-3">
                    <label for="txt_Transporte">Transportadora</label>
                    <select name="txt_Transporte" id="txt_Transporte" class="form-control form-control-sm">
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
                <div class="form-group col-2">
                    <label for="txtdesc_Ativo">Ativo</label>
                    <select name="txtdesc_Ativo" id="txtdesc_Ativo" class="form-control form-control-sm">
                        <option selected>-Selecione-</option>
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                            
                    </select>
                </div>
                <div class="form-group col-3">
                    <label for="txtdesc_Latitude">Latitude</label>
                    <input type="text" name="txtdesc_Latitude" id="txtdesc_Latitude" class="form-control form-control-sm">
                </div>
                <div class="form-group col-3">
                    <label for="txtdesc_Longitude">Longitude</label>
                    <input type="text" name="txtdesc_Longitude" id="txtdesc_Longitude" class="form-control form-control-sm">
                </div>
                <div class="form-group col-12">
                    <button type="button" class="btn btn-sm btn-primary" id="btnCadastrar">Cadastrar</button>
                    <button type="reset" class="btn btn-sm btn-primary">Limpar</button>
                </div>
        </form>
    </div>
</div>