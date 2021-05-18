<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './classes/PHPMailer/Exception.php';
require './classes/PHPMailer/PHPMailer.php';
require './classes/PHPMailer/SMTP.php';
require './templates/email.php';

$mail = new PHPMailer;

$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = "netocosta.com.br";
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Username = "contato@netocosta.com.br";
$mail->Password = "neto2301";
$mail->CharSet = "utf-8";
$mail->setFrom('naoresponder@asstje.com.br', 'ASSTJE-PB - Eleição');
$mail->isHTML(true);
