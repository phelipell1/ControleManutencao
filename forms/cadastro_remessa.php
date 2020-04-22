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
        //Essa parte irá buscar os destinatários com base na Cidade.
        $("#cid_Codigo").change(function() {
            var valor = $('#cid_Codigo option:selected').val();
            $.ajax({
                url: '../controllers/busca_destinatarios.php',
                method: 'post',
                data: {
                    cid: $('#cid_Codigo').val()
                },
                success: function(data) {
                    $('#cbmAcDestinatario').html(data).show();
                }
            });
        })


        $('#btn_Cadastrar').click(function() {
            $.ajax({
                url: '../controllers/remessa_cadastro_dao.php',
                method: 'post',
                data: $('#form_Remessa').serialize(),
                success: function(data) {
                    alert(data);
                    $('#rem_Remetente').val('Selecione');
                    $('#rem_Destinatario').val('Selecione');
                    $('#est_Codigo').val('Selecione');
                    $('#cid_Codigo').val('Selecione');
                    $('#temp_Empresa').val('Selecione');
                    $('#rms_Descricao').val('');

                    $('#btn_Cadastrar').hide();
                    $('#btn_Concluir').show();
                }
            })
            $('#btn_Concluir').click(function() {
                window.location = '../views/homepage.php?rms=1';
            })
        });
    });
</script>
<link rel="stylesheet" href="../CSS/style2.css">
<div class="container">
    <div class="shadow-lg mb-5 p-3 rounded border">
        <form id="form_Remessa">
            <div class="row">
                <div class="col-sm-5">
                    <fieldset class="border">
                        <legend>
                            <h6>Remetente</h6>
                        </legend>
                        <div class="row col">
                            <div class="form-group col">
                                <label for="cbmEmpresa">Empresa</label>
                                <select name="cbmEmpresa" id="cbmEmpresa" class="form-control form-control-sm">
                                    <option selected></option>
                                    <?
                                    $query_tmp = "select * from Empresa";
                                    $result_tmp = mysqli_query($link, $query_tmp);
                                    $rows_tmp = mysqli_num_rows($result_tmp);
                                    foreach ($result_tmp as $rows_tmp) {
                                        echo '<option value="' . $rows_tmp['emp_Codigo'] . '">' . $rows_tmp['emp_RasaoSocial'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="cmbExpeditor">Expeditor</label>
                                <select name="cmbExpeditor" id="cmbExpeditor" class="form-control form-control-sm">
                                    <option selected></option>
                                    <?
                                    $query_tmp = "select * from Remetente";
                                    $result_tmp = mysqli_query($link, $query_tmp);
                                    $rows_tmp = mysqli_num_rows($result_tmp);
                                    foreach ($result_tmp as $rows_tmp) {
                                        echo '<option value="' . $rows_tmp['rem_Codigo'] . '">' . $rows_tmp['rem_Abreviado'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-sm-7">
                    <fieldset class="border">
                        <legend>
                            <h6>Destinatario</h6>
                        </legend>
                        <div class="row col">
                            <div class="form-group col-3">
                                <label for="est_Codigo">UF</label>
                                <select name="est_Codigo" id="est_Codigo" class="form-control form-control-sm">
                                    <option selected>-Selecione-</option>
                                    <?
                                    $query_uf = "select * from UF";
                                    $result_uf = mysqli_query($link, $query_uf);
                                    $rows_uf = mysqli_num_rows($result_uf);
                                    foreach ($result_uf as $rows_uf) {
                                        echo '<option value="' . $rows_uf['codUf'] . '">' . $rows_uf['UF'] . '</option>';
                                        $uf = $rows_uf['codUf'];
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="cid_Codigo">Cidade</label>
                                <select name="cid_Codigo" id="cid_Codigo" class="form-control form-control-sm">
                                    <option selected>-Selecione-</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="cbmAcDestinatario">Aos Cuidados</label>
                                <select name="cbmAcDestinatario" id="cbmAcDestinatario" class="form-control form-control-sm">
                                    <option selected>-Selecione-</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="form-group col">
                    <br>
                    <button type="button" class="btn btn-primary" id="btn_Cadastrar">Cadastrar</button>
                    <button type="button" class="btn btn-success" id="btn_Concluir">Concluir</button>
                    <button type="reset" class="btn btn-warning">Limpar</button>
                </div>
            </div>
        </form>
    </div>
</div>