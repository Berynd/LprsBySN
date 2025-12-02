<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
if(isset($_POST['email'])) {
    $email=$_POST['email'];
    $repo=new UtilisateurRepository();
var_dump();
    $token = bin2hex(random_bytes(32));
    setlocale(LC_ALL, 'fr_FR.UTF-8');
    $dateFin=date('Y-m-d H:i', strtotime('+1 hour'));
    $compte=$repo->rechercheUtilisateurParMail($email);
    if(!$compte){
        echo"email non trouvé";
        header("location:../../index.php");
    }else{
        $ajout=$repo->addTokens($token,$dateFin,$compte['email']);
        if($ajout){
            $lien="http://localhost/SLAM/PHP/Projets%20PHP/LesTetard93/vue/reinitialiserMdp.php?token=".$token;

            try {
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'g.berinde@lprs.fr';
                $mail->Password = 'isps seow efga vmyn';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom("g.berinde@lprs.fr", 'Support');
                $mail->addAddress($compte['email'],$compte["prenom"]);
                $mail->addreplyTo("g.berinde@lprs.fr", 'Support');
                $mail->isHTML();
                $mail->Subject = "Modification de votre mot de passe";
                $mail->Body = "<p>Bonjour,</p>
                <p>Cliquez sur le lien pour verifier votre compte:</p> 
                <p><a href='$lien'>$lien</a></p>
                <p>Si vous n'avez pas demandé cette réinitialisation, ignorez cet email.</p>";
                $mail->AltBody = "Bonjour,\n\nCliquez sur le lien suivant pour modifier votre mot de passe : $lien\n\n
                Si vous n'avez pas demandé cette réinitialisation, ignorez cet email.";
                if($mail->send()){
                    echo 'to:'.$mail->getToAddresses()[0][0];
                    header("location:../../vue/messageConfirmation.php");
                }else{
                    echo"le message n'a pas pu etre envoyer(".$mail->ErrorInfo.")";

                }
            }catch (Exception $e){
                echo"Erreur lors de l'envoi de votre mail : (".$mail->ErrorInfo.")";

            }
        }
    }
}
