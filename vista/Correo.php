<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'duranparck20@gmail.com';                     //SMTP username
    $mail->Password   = 'rrevaihxpyiwnkxp';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('duranparck20@gmail.com', 'Restaurante +');
    
    $mail->addAddress($_POST["email"], $_POST["nombre"]);     //Add a recipient
    /*$mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');
    */

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Prueba de Envio de Correo con PHPMailer';
    $mail->Body    = '
        <!DOCTYPE html>
            <html lang="es">
            <head>
            <title>Validacion de Cuenta</title>';
        $mail->Body .= '
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                font-family: "Times New Roman", Times, serif;
                font-size: 20px;
                font-weight: 300;
                color: rgb(65, 190, 244);
                background-color:rgba(142, 238, 252, 0.5);
                line-height: 30px;
                text-align: center;
            }
            .contenedor{
                width: 80%;
                min-height:auto;
                text-align: center;
                margin: 0 auto;
                background: #666565;
                border-top: 5px solid ##00fbff;
            }
            .btnlink{
                padding:15px 30px;
                text-align:center;
                background-color:#89ccdb;
                color: crimson !important;
                font-weight: 600;
                text-decoration: blue;
            }
            .btnlink:hover{
                color: rgb(65, 190, 244) !important;
            }
            .imgBanner{
                width:100%;
                margin-left: auto;
                margin-right: auto;
                display: block;
                padding:0px;
            }
            .misection{
                color: #34495e;
                margin: 4% 10% 2%;
                text-align: center;
                font-family: sans-serif;
            }
            .mt-5{
                margin-top:50px;
            }
            .mb-5{
                margin-bottom:50px;
            }
        </style>
        ';

        $mail->Body .= '
        </head>
        <body>
            <div class="contenedor">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
                <tr>
                    <td style="padding: 0">
                        
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #ffffff;">
                        <div class="misection">
                            <h2 style="color: red; margin: 0 0 7px">Bienvenido, '.$_POST["nombre"].'</h2>
                            <p style="margin: 2px; font-size: 18px">Para activar tu cuenta haga click en el siguiente boton:</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <a href="http://localhost:8080/Reservacion-Py/?ctrl=CtrlUsuario&accion=validarCorreo" class="btnlink">Validar Cuenta </a>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                        </div>
                    </td>
                </tr>
        </table>';
        $mail->Body .= '
                </div>
            </body>
        </html>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Mensaje enviado CORRECTO!';
} catch (Exception $e) {
    echo "No se puedo enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
}