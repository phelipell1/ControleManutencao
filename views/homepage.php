<?php
session_start();
require_once('../Connections/Conexao.php');
$perfil_acesso = $_SESSION['userperfil'];
$rms = isset($_GET['rms']) ? $_GET['rms'] : 0;
//$data = date('A');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data = strftime('%B', strtotime('today'));
$Obj = new DB();
$link = $Obj->connecta_mysql();
if (!isset($_SESSION['login'])) {
    header('Location: ../views/index.php?erro=1');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/style2.css">
    <link rel="stylesheet" href="../CSS/home.css">
    <!-- Font Awesome JS -->
    <script src="../jquery/jquery-3.4.1.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <!--Carrega dados da tabela-->
    <script>
        $(document).ready(function(){
            $.ajax({
                    url: '../controllers/preenche_tabela_home.php',
                    success: function(data) {
                        $("#tbody-dados").html(data);
                    }
                });
        });
    </script>

    <!--Essa parte carrega as informações com base no perfil do Usuario-->
    <script>
        $(document).ready(function() {
            //Acesso segundo perfil do Usuário
            var perfil = "<? echo $perfil_acesso ?>";

            if (perfil == 'Suporte') {
                $('#btnDestinatarios').show();
                $('#btnEmpresas').show();
                $('#btnRemetente').show();
                $('#SubMenuTicketOpen').show();
                $('#bt').show();
            } else if (perfil == 'Administrador') {
                $('#btnDestinatarios').show();
                $('#btnEmpresas').show();
                $('#btnRemetente').show();
                $('#SubMenuTicketOpen').show();
                $('#bt').show();
            } else if (perfil == "Operador") {
                $('#btnDestinatarios').hide();
                $('#btnEmpresas').hide();
                $('#btnRemetente').hide();
                $('#SubMenuTicketOpen').hide();
                $('#bt').show();
            }

            var sts_page = "<? echo $rms ?>";
            if (sts_page == '1') {
                $.ajax({
                    url: '../forms/cadastro_manutencao.php?rms=1',
                    success: function(data) {
                        $("#new-form").html(data).show();
                        $('#dados-info').hide();
                    }
                });
            } else if (sts_page == '2') {
                $.ajax({
                    url: '../forms/cadastro_remessa.php',
                    success: function(data) {
                        $("#new-form").html(data).show();
                        $('#dados-info').hide();
                    }
                });
            }

            /*Deste bom em diante será configurado as funções dos botões*/
            $('#bt').click(function() {
                $.ajax({
                    url: '../forms/cadastro_manutencao.php',
                    success: function(data) {
                        $("#new-form").html(data).show();
                        $('#dados-info').hide();
                    }
                });
            });

            $('#btnRemessa').click(function() {
                $.ajax({
                    url: '../forms/cadastro_remessa.php',
                    success: function(data) {
                        $("#new-form").html(data).show();
                        $('#dados-info').hide();
                    }
                });
            });

            $('#btnDestinatarios').click(function() {
                $.ajax({
                    url: '../forms/cadastro_destinatario.php',
                    success: function(data) {
                        $("#new-form").html(data).show();
                        $('#dados-info').hide();
                    }
                });
            });

            $('#btnRemetente').click(function() {
                $.ajax({
                    url: '../forms/cadastro_remetente.php',
                    success: function(data) {
                        $("#new-form").html(data).show();
                        $('#dados-info').hide();
                    }
                });
            });

            $('#btnEmpresas').click(function() {
                $.ajax({
                    url: '../forms/cadastro_empresa.php',
                    success: function(data) {
                        $("#new-form").html(data).show();
                        $('#dados-info').hide();
                    }
                });
            });

        });
    </script>
    <!--Script para mascara de input-->
    <script>
        $(document).ready(function() {
            $('#txtCep').mask('99999-999');
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
            </div>
            <div class="img-user">
                <?
                if ($_SESSION['imagem'] == NULL) {
                    echo '<span class="span"><img class="span" src="../imagens/user.png" width="60"></span>';
                } else {
                    echo '<span class="span"><img class="span" src="' . $_SESSION['imagem'] . '" width="38"></span>';
                }
                ?>
            </div>
            <div>
                <p class="col"><span class="sp-nome"><? echo $_SESSION['username'] ?></span></p>
                <p class="col tx"><span class="tx"><? echo $_SESSION['userperfil'] ?></span></p>
            </div>
            <hr>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="../views/homepage.php"><img src="../imagens/home.png" width="30" alt=""><span> Home</span></a>
                </li>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><img src="../imagens/ticket.png" width="30" alt="">Cadastros</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li id="btnDestinatarios">
                            <a href="#">Destinatarios</a>
                        </li>
                        <li id="btnEmpresas">
                            <a href="#">Empresas</a>
                        </li>
                        <li id="btnRemetente">
                            <a href="#">Remetente</a>
                        </li>
                        <li id="SubMenuTicketOpen">
                            <a href="#" id="li-redefinir">Redefinir senha</a>
                        </li>
                        <!--<li id="btnRemessa">
                            <a href="#">Remessas</a>
                        </li>-->
                        <li id="bt">
                            <a href="#" id="btnManutencao">Manutenção</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><img src="../imagens/relatorio.png" width="30" alt=""> Relatórios</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="../relatorios/relatoriogeral.php">Remessas Enviadas</a>
                        </li>
                        <li>
                            <a href="../relatorios/relatoriogeral.php">Manutenção</a>
                        </li>
                        <li>
                            <a href="../relatorios/relatoriogeral.php">Remessas Enviadas</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" id="btnContatos"><img src="../imagens/contatos.png" width="30" alt=""> Contatos</a>
                </li>
                <li>
                    <a href="../views/logout.php"><img src="../imagens/logout2.png" width="25" alt=""><span> Sair</span></a>
                </li>
            </ul>
            <div class="row">
                <div class="col-sm-12">
                    <a class="float-lefts" href="../configuracoes/config.php"><img src="../imagens/conf.png" width="20" alt=""></a>
                </div>
            </div>
        </nav>
        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <span>Dashboard</span>
                        </ul>
                    </div>
                </div>

            </nav>
            <div class="container" id="dados-info">
                <div class="shadow-lg mb-5 p-3 rounded border">
                    <form action="">
                        <? echo $data ?>
                        <div class="row">
                            <div class="form-group col-2">
                                <label for="txtCep">CEP</label>
                                <input type="text" name="txtCep" id="txtCep" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-2">
                                <label for="txtCodRastreio">Cód Rastreio</label>
                                <input type="text" name="txtCodRastreio" id="txtCodRastreio" class="form-control form-control-sm" onkeydown="this.value = this.value.toUpperCase();" maxlength="13">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm btn-conf">Buscar</button>
                            </div>
                            <div class="col-3"></div>
                            <div class="form-group">
                                <label for="cbm_Mes">Mês</label>
                                <select name="cbm_Mes" id="cbm_Mes" class="form-control form-control-sm">
                                    <option selected><? echo $data ?></option>
                                    <option value="01">aneiro</option>
                                    <option value="02">fevereiro</option>
                                    <option value="03">março</option>
                                    <option value="04">abril</option>
                                    <option value="05">maio</option>
                                    <option value="06">junho</option>
                                    <option value="07">julho</option>
                                    <option value="08">agosto</option>
                                    <option value="09">setembro</option>
                                    <option value="010">outubro</option>
                                    <option value="11">novembro</option>
                                    <option value="12">dezembro</option>
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="cbm_Mes">Mês</label>
                                <select name="cbm_Mes" id="cbm_Mes" class="form-control form-control-sm">
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="col">
                        <div id="tbody-dados">

                        </div>
                    </div>

                </div>
            </div>
            <div id="new-form"></div>
            <div id="form-remessa"></div>
        </div>
    </div>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'true');
            });
        });
    </script>
</body>

</html>