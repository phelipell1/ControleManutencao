<?php
    require_once('../Connections/Conexao.php');
    $obj = new DB();
    $link = $obj->connecta_mysql();

    $id_user = $_POST['txt_cod_user'];
    $name_user = $_POST['txt_usuario'];
    $login_name = $_POST['txt_user_login'];
    $email = $_POST['txt_user_email'];


    $query = "UPDATE Usuario SET nome = '$name_user',
    Email = '$email' where IdUsuario = '$id_user'";

    $result = mysqli_query($link, $query);

    if($result == true){
        $valor = 1;

        if($valor == 1){
            $query2 = "UPDATE Login set Login = '$login_name', DataUIAlteracao = now() where idLogin = $id_user";
            mysqli_query($link,$query2);
        }
        echo 'Dados atualizados com sucesso !';
    }else{
        echo 'Eita ! Algo deu errado, não sei dizer o que é, mas e bom ligar pro suporte =P'.mysqli_error($link);
    }

?>