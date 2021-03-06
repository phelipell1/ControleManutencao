<?php
    $entrada = $_GET['cod'];
?>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<script src="../jquery/jquery-3.4.1.js"></script>
<script>
    $(document).ready(function(){
        $('#btn_Gravar').click(function() {
            $.ajax({
                url: '../controllers/gravar_hist_manutencao.php',
                method: 'post',
                data: $('#cadastro_historico').serialize(),
                success: function(data) {
                    alert(data);
                }
            })
        });
        $('#btn_Voltar').click(function() {
            window.location = '../views/homepage.php?rms=5';
        });
        
    });
</script>
<div class="container">
    <div class="shadow-lg mb-5 p-3 rounded border">
    <h4>Atualizar informações manutenção</h4>
    <hr>
        <form id="cadastro_historico">
            <div class="row col">
            <div class="form-group col-sm-8">
                    <label for="text_cod_entrada">Código</label>
                    <input type="text" name="text_cod_entrada" id="text_cod_entrada" class="form-control form-control-sm col-1" value="<?echo$entrada?>" readonly>
                </div>
                <div class="form-group col-sm-12">
                    <label for="text_hist_descricao">Resolução</label>
                    <textarea name="text_hist_descricao" id="text_hist_descricao" cols="" rows="2" class="form-control"></textarea>
                </div>
                <div class="form-group col-2">
                    <label for="txt_hist_dataDevolucao">Devolução</label>
                    <input type="date" name="txt_hist_dataDevolucao" id="txt_hist_dataDevolucao" class="form-control form-control-sm">
                </div>
                <div class="form-group col-2">
                    <label for="txt_hist_dataPostagem">Postagem</label>
                    <input type="date" name="txt_hist_dataPostagem" id="txt_hist_dataPostagem" class="form-control form-control-sm">
                </div>
                <div class="form-group col-2">
                    <label for="txt_hist_dataDespacho">Despacho</label>
                    <input type="date" name="txt_hist_dataDespacho" id="txt_hist_dataDespacho" class="form-control form-control-sm">
                </div>
                <div class="form-group col-2">
                    <label for="txt_hist_dataServico">Serviço</label>
                    <input type="date" name="txt_hist_dataServico" id="txt_hist_dataServico" class="form-control form-control-sm">
                </div>
                <div class="form-group col-2">
                    <label for="txt_hist_fechamento">Fechamento</label>
                    <input type="date" name="txt_hist_fechamento" id="txt_hist_fechamento" class="form-control form-control-sm">
                </div>
                <div class="form-group col-2">
                    <label for="txt_hist_dataRetorno">Retorno</label>
                    <input type="date" name="txt_hist_dataRetorno" id="txt_hist_dataRetorno" class="form-control form-control-sm">
                </div>
                <div class="form-group col-3">
                    <label for="txt_tec_sut">Téc Sut</label>
                    <input type="text" name="txt_tec_sut" id="txt_tec_sut" class="form-control form-control-sm">
                </div>
                <div class="form-group col-2">
                    <label for="txt_num_os">N° OS</label>
                    <input type="text" name="txt_num_os" id="txt_num_os" class="form-control form-control-sm">
                </div>
                <div class="col-6"></div>
                <div class="form-group col">
                <button type="button" id="btn_Gravar" class="btn btn-sm btn-success">Gravar</button>
                <button type="button" id="btn_Voltar" class="btn btn-sm btn-success">Voltar</button>
                </div>
            </div>
        </form>

    </div>
</div>