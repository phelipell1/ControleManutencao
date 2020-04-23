<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../CSS/style2.css">
<script src="../jquery/jquery-3.4.1.js"></script>
<script src="../jquery/mask.js"></script>
<script src="../jquery/mask_det.js"></script>

<script>
    $(document).ready(function(){
        $('#txt_Valor').mask('000.000.000.000.000,00', {reverse: true});
    });
</script>
<form id="formulario_update">
    <div class="row">
        <div class="form-group col-3">
            <label for="txtDtPostagem">Dt Postagem:</label>
            <input type="date" name="txtDtPostagem" id="txtDtPostagem" class="form-control form-control-sm">
        </div>
        <div class="form-group col-2">
            <label for="txtcod_Empresa">Empresa:</label>
            <input type="text" name="txtcod_Empresa" id="txtcod_Empresa" class="form-control form-control-sm">
        </div>
        <div class="form-group col-2">
            <label for="txtcod_Remetente">Remetente:</label>
            <input type="text" name="txtcod_Remetente" id="txtcod_Remetente" class="form-control form-control-sm">
        </div>
        <div class="form-group col-2">
            <label for="txtcod_Cidade">Cidade:</label>
            <input type="text" name="txtcod_Cidade" id="txtcod_Cidade" class="form-control form-control-sm">
        </div>
        <div class="form-group col-2">
            <label for="txtcod_Estado">Estado:</label>
            <input type="text" name="txtcod_Estado" id="txtcod_Estado" class="form-control form-control-sm">
        </div>
        <div class="form-group col-2">
            <label for="txtcod_Destinatário">Destinatário:</label>
            <input type="text" name="txtcod_Destinatário" id="txtcod_Destinatário" class="form-control form-control-sm">
        </div>
        <div class="form-group col-2">
            <label for="txtcod_Destinatário">Cód Rastreio:</label>
            <input type="text" name="txtcod_Destinatário" id="txtcod_Destinatário" class="form-control form-control-sm">
        </div>
        <div class="form-group col-2">
            <label for="txtcod_Destinatário">Cód Rastreio:</label>
            <input type="text" name="txtcod_Destinatário" id="txtcod_Destinatário" class="form-control form-control-sm">
        </div>
        <div class="form-group col-2">
            <label for="txt_Valor">Valor:</label>
            <input type="text" name="txt_Valor" id="txt_Valor" class="form-control form-control-sm">
        </div>
        <div class="form-group col-2">
            <label for="cmb_Extraviado">Extraviado:</label>
            <Select id="cmb_Extraviado" name="cmb_Extraviado" class="form-control form-control-sm">
                <option selected></option>
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </Select>
        </div>

    </div>
</form>