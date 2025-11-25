<?php
//envoi d'email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once "../../bdd/BDD.php";
require_once '../../modele/Utilisateur.php';
require_once '../../repository/UtilisateurRepository.php';
require_once '../../../vendor/autoload.php';
if(isset($_POST['email'])) {
    $email=$_POST['email'];
    $repo=new UtilisateurRepository();

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
            $lien="http:http://localhost/SLAM/PHP/Projets%20PHP/LesTetard93/vue/reinitialiserMdp.php?token=".$token;
            try {
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'adminLprs991@gmail.com';
                $mail->Password = 'igbi rgzv jeyh cbjg';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom("testcinema92@gmail.com", 'Support');
                $mail->addAddress($compte['email'],$compte["prenom"]);
                $mail->addreplyTo("testcinema92@gmail.com", 'Support');
                $mail->isHTML();
                $mail->Subject = "Modification de votre mot de passe";
                $mail->Body = "<p>Bonjour,</p>
                <p>Cliquez sur le lien pour modifier votre mot de passe :</p> 
                <p><a href='$lien'>$lien</a></p>
                <p>Si vous n'avez pas demandé cette réinitialisation, ignorez cet email.</p>";
                $mail->AltBody = "Bonjour,\n\nCliquez sur le lien suivant pour modifier votre mot de passe : $lien\n\n
                Si vous n'avez pas demandé cette réinitialisation, ignorez cet email.";
                if($mail->send()){
                    echo 'to:'.$mail->getToAddresses()[0][0];
                    header("location:../../../vue/VueMail/mailCOnfirmationMessage");
                }else{
                    echo"le message n'a pas pu etre envoyer(".$mail->ErrorInfo.")";

                }
            }catch (Exception $e){
                echo"Erreur lors de l'envoi de votre mail : (".$mail->ErrorInfo.")";

            }
        }
    }
}