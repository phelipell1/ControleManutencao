<?php
    session_start();
    require_once('../Connections/Conexao.php');
    $id = $_SESSION['id'];

    $Obj = new DB();
    $link = $Obj->connecta_mysql();

    $consulta = "SELECT u.IdUsuario, l.Login, p.Perfil, u.Nome, u.EhAtivo, u.DataCadastro, u.Email,
    u.Cargo, u.Regiao, u.Imagem FROM Usuario AS u
    INNER JOIN Login AS l ON l.idLogin = u.IdLogin
    INNER JOIN Perfil AS p ON p.IdPerfil =  u.IdPerfil
    WHERE l.idLogin = $id";

    $result = mysqli_query($link, $consulta);

    if($result){
        while($reg = mysqli_fetch_array($result)){
            $codUser = $reg['IdUsuario'];
            $login = $reg['Login'];
            $perfil = $reg['Perfil'];
            $UserNome = $reg['Nome'];
            $EhAtivo = $reg['EhAtivo'];
            $DataCadastro = $reg['DataCadastro'];
            $Email = $reg['Email'];
            $Cargo = $reg['Cargo'];
            $Regiao = $reg['Regiao'];
        }
    }else{
        echo'Atenção ! Consulta não retornou registros </br>';
        echo 'ID:'.$_SESSION['id'];
    }


?>