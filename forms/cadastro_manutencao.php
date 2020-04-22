<?php
    require_once("../Connections/Conexao.php");
    $rms = isset($_GET['rms']) ? $_GET['rms'] : 0;
    $ObjDB = new DB();
    $link = $ObjDB->connecta_mysql();
    $date_atual = date('Y-m-d');
?>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../CSS/style2.css">
<script src="../jquery/jquery-3.4.1.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
        $('#txtCodEquipamento').change(function() {
        var valor = $('#txtCodEquipamento option:selected').val();
        });
        $('#textcodigoSut').keyup(function() {
            $(this).val(this.value.replace(/\D/g, ''));
        });
        $('#textpatrimonio').keyup(function() {
            $(this).val(this.value.replace(/\D/g, ''));
        });
        $('#txtCodEquipamento').change(function() {
            var valor = $('#txtCodEquipamento option:selected').val();
            if (valor == '2') {
                $('#textcodigoSut').attr('disabled', true);
                $('#textIMEI').attr('disabled', false);
            } else if (valor == '1') {
                $('#textIMEI').attr('disabled', false);
                $('#textcodigoSut').attr('disabled', false);
            }
        });
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

    $("#txtCodEquipamento").change(function(){
        var valor = $('#txtCodEquipamento option:selected').val();
        $.ajax({
            url: '../controllers/busca_equipamento.php?mme=valor',
            method: 'post',
            data: {mme: $('#txtCodEquipamento').val()},
        success:function(data){
            $('#txtCodMDE').html(data).show();
        }
        });
    })
    $("#btn_Registrar").click(function(){
        $.ajax({
            url: '../controllers/manutencao_cadastro_dao.php',
            method: 'post',
            data: $('#form-cadastra-manutencao').serialize(),
        success:function(data){
            alert(data);
            $('#txtCodEquipamento').val("-Selecione-");
            $('#txtCodMDE').val("");
            $('#textIMEI').val("");
            $('#textcodigoSut').val("");
            $('#textpatrimonio').val("");
            $('#textdescricaoDefeito').val("");
            $('#txtcodUF').val("-Selecione-");
            $('#txtcodCidade').val("-Selecione-");
            $('#txtcodDepartamento').val("");
            $('#txtcodStatus').val("-Selecione-'");
        }
        });
    })
    $('#btn_Voltar').click(function(){
        window.location = '../views/homepage.php';
    })
    });
</script>
<div class="container">
    <div class="shadow-lg p-3 mb-5 rounded border">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Atenção!</strong> Se for enviar Remessa para manutenção cadastrar Remessa. 
        ou clique <a href="../views/homepage.php?rms=2"><strong>aqui</strong></a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
        <button class="btn btn-light btn-sm" id="btn_Voltar">Voltar</button>
        <hr>
        <form id="form-cadastra-manutencao">
            <div class="row col">
                
                <div class="form-group col">
                    <label for="txtCodEquipamento">Equipamento</label>
                    <select name="txtCodEquipamento" id="txtCodEquipamento" class="form-control form-control-sm">
                        <option selected>-Selecione-</option>
                        <?
                            $tpequipamento = "select * from Equipamentos";
                            $result = mysqli_query($link, $tpequipamento);
                            $rows = mysqli_num_rows($result);
                            foreach($result as $rows){
                                echo'<option value="'.$rows['codEquipamento'].'">'.$rows['descricao'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col">
                    <label for="txtCodMDE">Modelo</label>
                    <select name="txtCodMDE" id="txtCodMDE" class="form-control form-control-sm">
                        <option selected>-Selecione-</option>
                    </select>
                </div>
                <div class="form-group col">
                    <label for="textIMEI">IMEI</label>
                    <input type="text" name="textIMEI" id="textIMEI" class="form-control form-control-sm" placeholder="000000" maxlength="15">
                </div>
                <div class="form-group col">
                    <label for="textcodigoSut">SUT</label>
                    <input type="text" name="textcodigoSut" id="textcodigoSut" class="form-control form-control-sm" placeholder="000000" maxlength="5">
                </div>
                <div class="form-group col">
                    <label for="textpatrimonio">Patrimônio</label>
                    <input type="text" name="textpatrimonio" id="textpatrimonio" class="form-control form-control-sm" placeholder="00000" maxlength="5">
                </div>
                <div class="form-group col-12">
                    <label for="textdescricaoDefeito">Defeito</label>
                    <textarea name="textdescricaoDefeito" id="textdescricaoDefeito" cols="3" rows="2" class="form-control"></textarea>
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
                <div class="form-group col">
                    <label for="txtcodDepartamento">Departamento</label>
                    <select name="txtcodDepartamento" id="txtcodDepartamento" class="form-control form-control-sm">
                        <option selected>-Selecione-</option>
                        <?
                            $query_dep ="select * from Departamento order by Departamento";
                            $result_dep = mysqli_query($link, $query_dep);
                            $uf_rows = mysqli_num_rows($result_dep);
                            foreach($result_dep as $rows_dep){
                                echo'<option value="'.$rows_dep['codDepartamento'].'">'.$rows_dep['Departamento'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col">
                    <label for="txtcodStatus">Status</label>
                    <select name="txtcodStatus" id="txtcodStatus" class="form-control form-control-sm">
                        <option selected>-Selecione-</option>
                        <?
                            $query_sts ="select * from StatusServico order by Status";
                            $result_sts = mysqli_query($link, $query_sts);
                            $rows_sts = mysqli_num_rows($result_sts);
                            foreach($result_sts as $rows_sts){
                                echo'<option value="'.$rows_sts['codStatus'].'">'.$rows_sts['Status'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col">
                    <label for="txtcodRemessa">Cód Remessa</label>
                    <select name="txtcodRemessa" id="txtcodRemessa" class="form-control form-control-sm">
                        <option selected>-Selecione-</option>
                        <?
                            $query_sts ="select * from regSedex where sed_Data like '%$date_atual%'";
                            $result_sts = mysqli_query($link, $query_sts);
                            $rows_sts = mysqli_num_rows($result_sts);
                            foreach($result_sts as $rows_sts){
                                echo'<option value="'.$rows_sts['sed_Codigo'].'">'.$rows_sts['sed_Codigo'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-12">
                    <button type="button" class="btn btn-sm btn-success" id="btn_Registrar">Registrar</button>
                    <button type="reset" class="btn btn-sm btn-warning">Limpar</button>
                </div>
            </div>
        </form>
    </div>
</div>
