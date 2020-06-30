<?php
$email_host = ''; // SMTP host ex. smtp.gmail.com for gmail mailserver
$email = ''; // Your Email Address
$email_passsword = ''; //  Password

$welcome_subject = "Thank you for getting in touch!"; //Success Message Subject


     /*
    |--------------------------------
    | Mailer module
    |--------------------------------
    | For Contact Form
    |
    */

    //PHPMailer Include
    require 'php-mailer/PHPMailer.php';
    require 'php-mailer/SMTP.php';
    require 'php-mailer/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

  

    /** SIMPLE VALIDATION FUNCTION */

    

    $response = array();
    $response['status'] = "warning";

    function validate_post($post){
        if(isset($post) && $post != ""){
            return true;
        }
        return false;
    }

    if( validate_post($_POST['name']) && validate_post($_POST['email']) ){

        try{
            
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Mailer = "smtp";
            //Server settings
            $mail->SMTPDebug = 0; 
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls'; 
            $mail->Port = 587;  


            $mail->Host = $email_host; 
            $mail->Username = $email; 
            $mail->Password = $email_passsword;

            //Recipients
            $mail->addAddress($_POST['email']);
            $mail->SetFrom($email);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $welcome_subject;

            
            $mail_template = new DOMDocument();
            $mail_template->loadHTMLFile('success-message.html');
            
            $mail->Body = $mail_template->saveHTML();

            $mail->send();

            $mail->ClearAllRecipients(); // Clear
        

            $rec_template = new DOMDocument();
            $rec_template->loadHTMLFile('message.html');
            $rec_template->getElementById('name')->nodeValue = "Name: " . $_POST['name'];
            $rec_template->getElementById('email')->nodeValue = "Email: " . $_POST['email'];
            $rec_template->getElementById('message')->nodeValue = $_POST['text'];


            $mail->Subject = $_POST['subject'];
            $mail->Body = $rec_template->saveHTML();

            $mail->addAddress($email);
            $mail->addReplyTo($_POST['email'], 'Information');
            $mail->send();


            $response['status'] = 'success';
            

        }catch(Exception $e)
        {
            $response['status'] = 'error';
        }
        

    }
    echo json_encode($response);
?>



