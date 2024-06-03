<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require dirname(__DIR__) . '/mail/src/Exception.php';
    require dirname(__DIR__) . '/mail/src/PHPMailer.php';
    require dirname(__DIR__) . '/mail/src/SMTP.php';

   function sendEmail ($emailRec, $contentEmail){ 
    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'khalidmarzoug9@gmail.com';
        $mail->Password   = 'ljbc ghny giat crbv';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('khalidmarzoug9@gmail.com');
        $mail->addAddress($emailRec);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Confirmation Email';
        $mail->Body    = $contentEmail;

        $mail->send();
    
    }