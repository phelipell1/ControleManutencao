<?
    require_once('../config/consulta.php');
?>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../CSS/style2.css">
<script src="../jquery/jquery-3.4.1.js"></script>
<script>
    $(document).ready(function(){
        $('#btn-concluir').hide();
        $('#btn-cancelar').hide();

        $('#btn-editar').click(function(){
            $('#txt_usuario').prop("readonly", false);
            $('#txt_user_login').prop("readonly", false);
            $('#txt_user_email').prop("readonly", false);
            $('#btn-concluir').show();
            $('#btn-cancelar').show();
            $('#btn-editar').hide();

        });
        /*---------------------------------*/
        $('#btn-concluir').click(function(){
            $.ajax({
            url: '../controllers/update_dados_usuario.php',
            method: 'post',
            data: $('#form-config').serialize(),
            success:function(data){
            $('#mensagem').html(data);
            $('#btn-editar').show();
            $('#txt_usuario').prop("readonly", true);
            $('#txt_user_login').prop("readonly", true);
            $('#txt_user_email').prop("readonly", true);
            $('#btn-concluir').hide();
            $('#btn-cancelar').hide();
        }
        });
        });
        /*---------------------------------*/
        $('#btn-cancelar').click(function(){
            $('#btn-editar').show();
            $('#txt_usuario').prop("readonly", true);
            $('#txt_user_login').prop("readonly", true);
            $('#txt_user_email').prop("readonly", true);
            $('#btn-concluir').hide();
            $('#btn-cancelar').hide();
            location.reload(true);
            
        })
    });

</script>
<body>
    <div class="container">
        <div class="shadow-lg mb-5 p-3 rounded border top">
            <form id="form-config">
                <p>Dados Usuários</p>
                <hr>
                <div class="row col">
                    <p id="mensagem"></p>
                    <div class="form-group col-sm-12">
                        <label for="cod_user" class="label">Cód Usuário</label>
                        <input type="text" name="txt_cod_user" id="txt_cod_user" class="form-control form-control-sm col-sm-1" value="<?echo$codUser?>" readonly></input>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="nome_usuario" class="label">Usuário</label>
                        <input type="text" name="txt_usuario" id="txt_usuario" class="form-control form-control-sm" value="<?echo$UserNome?>" readonly>
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="user_login" class="label">Login</label>
                        <input type="text" name="txt_user_login" id="txt_user_login" class="form-control form-control-sm" value="<?echo$login?>" readonly>
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="txt_user_perfil" class="label">Perfil</label>
                        <input type="text" name="txt_user_perfil" id="txt_user_perfil" class="form-control form-control-sm" value="<?echo$perfil?>" readonly>
                    </div>

                    <div class="form-group col-sm-2">
                        <label for="txt_user_cargo" class="label">Cargo</label>
                        <input type="text" name="txt_user_cargo" id="txt_user_cargo" class="form-control form-control-sm" value="<?echo$Cargo?>" readonly>
                    </div>
                    
                    <div class="form-group col-sm-4">
                        <label for="txt_user_email" class="label">Email</label>
                        <input type="text" name="txt_user_email" id="txt_user_email" class="form-control form-control-sm" value="<?echo$Email?>"readonly>
                    </div>

                    <div class="form-group col-sm-2">
                        <label for="txt_user_regiao" class="label">Região</label>
                        <input type="text" name="txt_user_regiao" id="txt_user_regiao" class="form-control form-control-sm" value="<?echo$Regiao?>" readonly>
                    </div>

                    <div class="form-group col-sm-1">
                        <label for="txt_user_ativo" class="label">Ativo</label>
                        <input type="text" name="txt_user_ativo" id="txt_user_ativo" class="form-control form-control-sm" value="<?echo$EhAtivo?>" readonly>
                    </div>

                    <div class="form-group col-12">
                        <button type="button" id="btn-editar" class="btn-editar">Editar</button>
                        <button type="button" id="btn-concluir" class="btn-concluir">Concluir</button>
                        <button type="button" id="btn-cancelar" class="btn-cancelar">Cancelar</button>
                        
                    </div>

                </div>
            </form>
        </div>
    </div>
</body>