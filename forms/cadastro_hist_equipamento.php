<?
    require_once('../Connections/Conexao.php');
    $Obj = new DB();
    $link = $Obj->connecta_mysql();
    $id = $_GET['cod'];
?>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<script src="../jquery/jquery-3.4.1.js"></script>
<script>
    $(document).ready(function() {
        $('#btnReturn').click(function() {
            window.location = "../views/homepage.php?rms=6";
        })
        $('#btn_cancelar').click(function() {
            window.location = "../views/homepage.php?rms=6";
        })
        $('#btn_cadastrar').click(function() {
            $.ajax({
            url: '../controllers/update_new_historico.php',
            method: 'post',
            data: $('#update_new').serialize(),
        success:function(data){
            alert(data);
        }
        });
        })
    })
</script>
<div class="container">
    <div class="shadow-lg mb-5 p-3 rounded border">
        <button id="btnReturn" class="btn btn-sm btn-secondary">Voltar</button>
        <hr>
        <p>Teste</p>
        <hr>
        <form id="update_new">
            <div class="row col">
                <div class="form-group col">
                    <label for="txtId">Cód</label>
                    <input type="text" id="txtId" name="txtId" class="form-control form-control-sm" value="<?echo$id?>" readonly>
                </div>
                <div class="form-group col-12">
                    <label for="txt_descricao">Dados para registro</label>
                    <textarea class="form-control" name="txt_descricao" id="txt_descricao" cols="3" rows="3"></textarea>
                </div>
                <div class="form-group col-sm-2">
                    <label for="">Status</label>
                    <select name="cbmStatus" id="cbmStatus" class="form-control form-control-sm">
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
            </div>
            <div class="form-group col">
                <button type="button" id="btn_cadastrar" class="btn btn-success">Cadastrar</button>
                <button type="button" id="btn_cancelar" class="btn btn-warning">Cancelar</button>
            </div>
        </form>
    </div>
</div>