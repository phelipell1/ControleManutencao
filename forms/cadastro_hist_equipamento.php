<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<script src="../jquery/jquery-3.4.1.js"></script>
<script>
    $(document).ready(function() {
        $('#btnReturn').click(function() {
            window.location = "../views/homepage.php?rms=6";
        })
    })
</script>
<div class="container">
    <div class="shadow-lg mb-5 p-3 rounded border">
        <button id="btnReturn" class="btn btn-sm btn-secondary">Voltar</button>
        <hr>
        <p>Teste</p>
        <hr>
        <form action="">
            <div class="row col">
                <div class="form-group col-12">
                    <label for="txt_descricao">Dados para registro</label>
                    <textarea class="form-control" name="txt_descricao" id="txt_descricao" cols="3" rows="3"></textarea>
                </div>
                <div class="form-group col-sm-2">
                    <label for="">Status</label>
                    <select name="" id="" class="form-control form-control-sm">
                        <option value="">Teste</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label for="">Status</label>
                    <select name="" id="" class="form-control form-control-sm">
                        <option value="">Teste</option>
                    </select>
                </div>
            </div>
        </form>

    </div>
</div>