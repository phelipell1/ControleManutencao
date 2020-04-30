<?php
session_start();
$regi =  $_GET['id'];
require_once('../Connections/Conexao.php');
$ObjDB = new DB();
$link = $ObjDB->connecta_mysql();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data = strftime('%Y-%m', strtotime('today'));
$query_busca = "select date_format(reg.sed_DataPostagem,'%d-%m-%Y') as dat, des.desc_AcAbreviado, cid.Cidade, des.desc_CEP,
    reg.sed_Cod_rastreio, reg.sed_Valor, reg.sed_Pago, reg.sed_Codigo from regSedex as reg
    left join Cidades as cid on cid.codCidade = reg.cid_Codigo
    left join Destinatario as des on des.cod_Destinatario = reg.des_Codigo
    where sed_Data like '%$data%' and sed_Codigo = $regi";

$resust_busca = mysqli_query($link, $query_busca);
$linhas = $resust_busca->num_rows;
if ($resust_busca == true) {
    if ($linhas <= 0) {
        echo 'Não possui registros.';
    } else {
        while ($reg = mysqli_fetch_array($resust_busca)) {
                    $datas = $reg['dat'];
                    $desc_Ac = $reg['desc_AcAbreviado'];
                    $cidade = $reg['Cidade'];
                    $cep = $reg['desc_CEP'];
                    $rastreio = $reg['sed_Cod_rastreio'];
                    $valor = $reg['sed_Valor'];
                    if($reg['sed_Pago'] == true){
                        $pago = 'SIM';
                    }else{
                        $pago = 'NÃO';
                    }
        }
    }
}

// Inclui o arquivo class.phpmailer.php localizado na mesma pasta do arquivo php 
include "../configEmail/PHPMailer/PHPMailerAutoload.php";

// Inicia a classe PHPMailer 
$mail = new PHPMailer(); 

// Método de envio 
$mail->IsSMTP(); 

// Enviar por SMTP 
$mail->Host = "smtp.office365.com"; 

// Você pode alterar este parametro para o endereço de SMTP do seu provedor 
$mail->Port = 587; 


// Usar autenticação SMTP (obrigatório) 
$mail->SMTPAuth = true; 

// Usuário do servidor SMTP (endereço de email) 
// obs: Use a mesma senha da sua conta de email 
//$mail->Username = 'webmaster@freng.com.br';
$mail->Username = 'frincorporadora@hotmail.com';
//$mail->Username = 'webmaster@freng.com.br'; 
$mail->Password = 'Fw38q1V7sN';

// Configurações de compatibilidade para autenticação em TLS 
$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) ); 

// Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro. 
 //$mail->SMTPDebug = 2; 

// Define o remetente 
// Seu e-mail 
$mail->From = "frincorporadora@hotmail.com";

// Seu nome 
$mail->FromName = "CPD"; 

// Define o(s) destinatário(s) 
$mail->AddAddress("frincorporadora@hotmail.com", "CPD"); 

// Opcional: mais de um destinatário
//Comentado enquanto e efetuado teste.
 $mail->AddAddress('webmaster@freng.com.br'); 

// Opcionais: CC e BCC
// $mail->AddCC('joana@provedor.com', 'Joana'); 
// $mail->AddBCC('roberto@gmail.com', 'Roberto'); 

// Definir se o e-mail é em formato HTML ou texto plano 
// Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
$mail->IsHTML(true); 

// Charset (opcional) 
$mail->CharSet = 'UTF-8'; 

// Assunto da mensagem 
$mail->Subject = "Confirmação de envio de Remessa"; 

// Corpo do email 
$mail->Body = 
"
<head>
    <style>
    element.style {
    }
    .p-3 {
        padding: 1rem!important;
    }
    .mb-5, .my-5 {
        margin-bottom: 3rem!important;
    }
    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }
    .rounded {
        border-radius: .25rem!important;
    }
    .border {
        border: 1px solid #dee2e6!important;
    }
    .p-3 {
        padding: 1rem!important;
    }
    .mb-5, .my-5 {
        margin-bottom: 3rem!important;
    }
    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }
    .rounded {
        border-radius: .25rem!important;
    }
    .border {
        border: 1px solid #dee2e6!important;
    }
    *, ::after, ::before {
        box-sizing: border-box;
    }
    *, ::after, ::before {
        box-sizing: border-box;
    }
    user agent stylesheet
    div {
        display: block;
    }
    body {
        font-family: 'Poppins', sans-serif;
        background: #fafafa;
    }
    body {
        margin: 0;
        font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: left;
        background-color: #fff;
    }
    body {
        margin: 0;
        font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: left;
        background-color: #fff;
    }
    :root {
        --blue: #007bff;
        --indigo: #6610f2;
        --purple: #6f42c1;
        --pink: #e83e8c;
        --red: #dc3545;
        --orange: #fd7e14;
        --yellow: #ffc107;
        --green: #28a745;
        --teal: #20c997;
        --cyan: #17a2b8;
        --white: #fff;
        --gray: #6c757d;
        --gray-dark: #343a40;
        --primary: #007bff;
        --secondary: #6c757d;
        --success: #28a745;
        --info: #17a2b8;
        --warning: #ffc107;
        --danger: #dc3545;
        --light: #f8f9fa;
        --dark: #343a40;
        --breakpoint-xs: 0;
        --breakpoint-sm: 576px;
        --breakpoint-md: 768px;
        --breakpoint-lg: 992px;
        --breakpoint-xl: 1200px;
        --font-family-sans-serif: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';
        --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,'Liberation Mono','Courier New',monospace;
    }
    :root {
        --blue: #007bff;
        --indigo: #6610f2;
        --purple: #6f42c1;
        --pink: #e83e8c;
        --red: #dc3545;
        --orange: #fd7e14;
        --yellow: #ffc107;
        --green: #28a745;
        --teal: #20c997;
        --cyan: #17a2b8;
        --white: #fff;
        --gray: #6c757d;
        --gray-dark: #343a40;
        --primary: #007bff;
        --secondary: #6c757d;
        --success: #28a745;
        --info: #17a2b8;
        --warning: #ffc107;
        --danger: #dc3545;
        --light: #f8f9fa;
        --dark: #343a40;
        --breakpoint-xs: 0;
        --breakpoint-sm: 576px;
        --breakpoint-md: 768px;
        --breakpoint-lg: 992px;
        --breakpoint-xl: 1200px;
        --font-family-sans-serif: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';
        --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,'Liberation Mono','Courier New',monospace;
    }
    html {
        font-family: sans-serif;
        line-height: 1.15;
        -webkit-text-size-adjust: 100%;
        -webkit-tap-highlight-color: transparent;
    }
    html {
        font-family: sans-serif;
        line-height: 1.15;
        -webkit-text-size-adjust: 100%;
        -webkit-tap-highlight-color: transparent;
    }
    *, ::after, ::before {
        box-sizing: border-box;
    }
    *, ::after, ::before {
        box-sizing: border-box;
    }
    *, ::after, ::before {
        box-sizing: border-box;
    }
    *, ::after, ::before {
        box-sizing: border-box;
    }
    .table-bordered thead td, .table-bordered thead th {
        border-bottom-width: 2px;
    }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        .table-bordered thead td, .table-bordered thead th {
            border-bottom-width: 2px;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        .table-bordered thead td, .table-bordered thead th {
            border-bottom-width: 2px;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .table-sm td, .table-sm th {
            padding: .3rem;
        }
        .table td, .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .table-sm td, .table-sm th {
            padding: .3rem;
        }
        .table td, .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .table-sm td, .table-sm th {
            padding: .3rem;
        }
        .table td, .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        th {
            text-align: inherit;
        }
        th {
            text-align: inherit;
        }
        th {
            text-align: inherit;
        }
        *, ::after, ::before {
            box-sizing: border-box;
        }
        *, ::after, ::before {
            box-sizing: border-box;
        }
        *, ::after, ::before {
            box-sizing: border-box;
        }
        user agent stylesheet
        th {
            display: table-cell;
            vertical-align: inherit;
            font-weight: bold;
            text-align: -internal-center;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        table {
            border-collapse: collapse;
        }
        table {
            border-collapse: collapse;
        }
        table {
            border-collapse: collapse;
        }
        user agent stylesheet
        table {
            border-collapse: separate;
            border-spacing: 2px;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: #fafafa;
        }
        body {
            margin: 0;
            font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }
        body {
            margin: 0;
            font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: #fafafa;
        }
        body {
            margin: 0;
            font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }
        :root {
            --blue: #007bff;
            --indigo: #6610f2;
            --purple: #6f42c1;
            --pink: #e83e8c;
            --red: #dc3545;
            --orange: #fd7e14;
            --yellow: #ffc107;
            --green: #28a745;
            --teal: #20c997;
            --cyan: #17a2b8;
            --white: #fff;
            --gray: #6c757d;
            --gray-dark: #343a40;
            --primary: #007bff;
            --secondary: #6c757d;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --breakpoint-xs: 0;
            --breakpoint-sm: 576px;
            --breakpoint-md: 768px;
            --breakpoint-lg: 992px;
            --breakpoint-xl: 1200px;
            --font-family-sans-serif: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';
            --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,'Liberation Mono','Courier New',monospace;
        }
        :root {
            --blue: #007bff;
            --indigo: #6610f2;
            --purple: #6f42c1;
            --pink: #e83e8c;
            --red: #dc3545;
            --orange: #fd7e14;
            --yellow: #ffc107;
            --green: #28a745;
            --teal: #20c997;
            --cyan: #17a2b8;
            --white: #fff;
            --gray: #6c757d;
            --gray-dark: #343a40;
            --primary: #007bff;
            --secondary: #6c757d;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --breakpoint-xs: 0;
            --breakpoint-sm: 576px;
            --breakpoint-md: 768px;
            --breakpoint-lg: 992px;
            --breakpoint-xl: 1200px;
            --font-family-sans-serif: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';
            --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,'Liberation Mono','Courier New',monospace;
        }
        :root {
            --blue: #007bff;
            --indigo: #6610f2;
            --purple: #6f42c1;
            --pink: #e83e8c;
            --red: #dc3545;
            --orange: #fd7e14;
            --yellow: #ffc107;
            --green: #28a745;
            --teal: #20c997;
            --cyan: #17a2b8;
            --white: #fff;
            --gray: #6c757d;
            --gray-dark: #343a40;
            --primary: #007bff;
            --secondary: #6c757d;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --breakpoint-xs: 0;
            --breakpoint-sm: 576px;
            --breakpoint-md: 768px;
            --breakpoint-lg: 992px;
            --breakpoint-xl: 1200px;
            --font-family-sans-serif: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';
            --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,'Liberation Mono','Courier New',monospace;
        }
        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
        }
        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
        }
        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
        }
        *, ::after, ::before {
            box-sizing: border-box;
        }
        *, ::after, ::before {
            box-sizing: border-box;
        }
        *, ::after, ::before {
            box-sizing: border-box;
        }
        *, ::after, ::before {
            box-sizing: border-box;
        }
        *, ::after, ::before {
            box-sizing: border-box;
        }
        *, ::after, ::before {
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <h4>Remessa enviada para manutenção</h4>
    <hr>
    <p>Volume: $regi</p>
    <p>A baixo segue informações sobre o volume enviado.</p>
    <div class='table-responsive' id='tbl_dados'>
        <table class='table table-bordered table-sm'>
            <thead>
                <tr>
                    <th scope='col'>Dt postagem</th>
                    <th scope='col'>Aos Cuidados</th>
                    <th scope='col'>Cidade</th>
                    <th scope='col'>CEP</th>
                    <th scope='col'>Cód. Rastreio</th>
                    <th scope='col'>Valor</th>
                    <th scope='col'>Pago?</th>
                    <th scope='col'>Ações</th>
                </tr>
            </thead>
            <tbody class='small'>
                <tr>
                <td scope='row'>$datas</td>
                <td scope='row'>$desc_Ac</td>
                <td scope='row'>$cidade</td>
                <td scope='row'>$cep</td>
                <td scope='row'>$rastreio</td>
                <td scope='row'>$valor</td>
                <td scope='row'>$pago</td>
                <td><a href='http://192.168.1.29/ControleManutencao/views/homepage.php'>Visualizar</a></td>
                </tr>
                </tbody>
        </table>
    </div>
";

// Opcional: Anexos 
// $mail->AddAttachment("/home/usuario/public_html/documento.pdf", "documento.pdf"); 

// Envia o e-mail 
$enviado = $mail->Send(); 

// Exibe uma mensagem de resultado 
if ($enviado) 
{ 
    echo "Seu email foi enviado com sucesso!"; 
    //include "../Views/chamado.php";
} else { 
    echo "Houve um erro enviando o email: ".$mail->ErrorInfo; 
    //include "../Views/chamado.php";
}
