<?php
session_start();
$regi =  $_GET['id'];
require_once('../Connections/Conexao.php');
$ObjDB = new DB();
$link = $ObjDB->connecta_mysql();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data = strftime('%Y-%m', strtotime('today'));
$query_busca = "select date_format(reg.sed_DataPostagem,'%d-%m-%Y') as dat, cid.Cidade, des.desc_CEP, emp.emp_Descricao,
reg.sed_Cod_rastreio from regSedex as reg
left join Cidades as cid on cid.codCidade = reg.cid_Codigo
left join Destinatario as des on des.cod_Destinatario = reg.des_Codigo
left join Empresa as emp on reg.emp_Codigo = emp.emp_Codigo
where sed_Codigo = $regi";

$resust_busca = mysqli_query($link, $query_busca);
$linhas = $resust_busca->num_rows;
if ($resust_busca == true) {
    if ($linhas <= 0) {
        echo 'Não possui registros.';
    } else {
        while ($reg = mysqli_fetch_array($resust_busca)) {
                    $dataE = $reg['dat'];
                    $cid = $reg['Cidade'];
                    $cep = $reg['desc_CEP'];
                    $emp_Des = $reg['emp_Descricao'];
                    $cod_Ras = $reg['sed_Cod_rastreio'];
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
$mail->Username = 'frincorporadora@hotmail.com';
//$mail->Username = 'webmaster@freng.com.br'; 
$mail->Password = '**********';

// Configurações de compatibilidade para autenticação em TLS 
$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) ); 

// Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro. 
 //$mail->SMTPDebug = 2; 

// Define o remetente 
// Seu e-mail 
$mail->From = "frincorporadora@hotmail.com";

// Seu nome 
$mail->FromName = "Webmaster"; 

// Define o(s) destinatário(s) 
$mail->AddAddress("santana@freng.com.br", "Pedro Santana");
//$mail->AddAddress("webmaster@freng.com.br", "Teste");


// Opcional: mais de um dest1inatário
//Comentado enquanto e efetuado teste.
 //$mail->AddAddress('webmaster@freng.com.br'); 

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
$mail->Body = utf8_decode('
<style>
        div{
        margin-top: 100px;
        }
        th{
        background-color: rgba(93, 131, 167, 0.698);
        color: rgb(255, 255, 255);
        
        }
        </style>
<table width="0%" height="505" border="0" cellspacing="58" cellpadding="0"
background="http://192.168.1.29/ControleManutencao/imagens/ola.png" background="no-repeat">
    <tr>
        <td>
        <div style="margin-left:-50px">
        <table border="1" >
    <thead>
        <tr>
            <th style="font-size: 13px">Dt postagem</th>
            <th style="font-size: 13px">Cód. Rastreio</th>
            <th style="font-size: 13px">Destinátario</th>
            <th  style="font-size: 13px">Modal</th>
            <th  style="font-size: 13px">CEP</th>

        </tr>
    </thead>
    <tbody class="small">
        <tr>
            <td style="font-size: 13px" scope="row">'.$dataE.'</td>
            <td style="font-size: 13px" scope="row">'.$cod_Ras.'</td>
            <td style="font-size: 13px">'.$emp_Des.'</td>
            <td  style="font-size: 13px">Sedex</td>
            <td style="font-size: 13px" scope="row">'.$cep.'</td>
        </tr></>
    </tbody>
</table>
</div>
</td>
</tr>
</table>
</body>
');

/*$mail->Body = 
"
<!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>email</title>
    <style>
    body{
    background-image: url('../imagens/olá.png');
    background-repeat: no-repeat;
    }
    div{
    margin-top: 250px;
    }
    th{
        background-color: rgba(93, 131, 167, 0.698);
        color: rgb(255, 255, 255);
    }
    </style>
</head>
<body>
    <div class='table-responsive' id='tbl_dados'>
        <table  border='1px' cellpadding='10px' cellspacing='1'>
            <thead>
                <tr>
                    <th>Dt postagem</th>
                    <th>Cód. Rastreio</th>
                    <th>Destinátario</th>
                    <th>Modal</th>
                    <th>CEP</th>
                </tr>
            </thead>
            <tbody class='small'>
                <tr>
                <td scope='row'>$dataE</td>
                <td scope='row'>$cod_Ras</td>
                <td>$emp_Des</td>
                <td>Sedex</td>
                <td scope='row'>$cep</td>
                </tr>
                </tbody>
        </table>
    </div>
</body>
</html>
";*/

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
