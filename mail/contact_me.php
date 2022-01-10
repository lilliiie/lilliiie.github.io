<?php
// Check for empty fields

require "../Mailer/class.phpmailer.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }
   
$votreNom = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
   var_dump($_POST);

// smtp du ini.php modifier localhost en smtp.voo.b

  $sujet="Ton cv";


  //Create a new PHPMailer instance
  $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPAutoTLS = true; 
  $mail->port =  587;
 // $mail->SMTPSecure = 'tls';
  $mail->Username = "lillyjones7700@gmail.com";
  $mail -> Host  =  'smtp.gmail.com';       // Spécifiez les serveurs SMTP principaux et de sauvegarde 
                 // Activer l'authentification SMTP 
  // Nom d'utilisateur SMTP 
$mail -> Password  =  'Loisetclark' ;

  

  // Code properly the charset
  $mail->CharSet = "UTF-8";

if($mail->validateAddress($email)){
   $mail->From = $email;
}
else{
  echo '<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  Entrer une adresse mail valide.
</div>';
  exit;
}
$mail->setFrom = $email;
$mail->FromName=$votreNom;
$mail->AddAddress("lillyjones7700@gmail.com");//contient email annonceur
  //Indique l'objet du mon gmail
$mail->Subject = $sujet;//"Nouveaux contact via le site de GARDE-INFI CONFORT";
$body = '';
    
$body.= '<p>';
$body.= '<b><u>Quelqu\'un sembe intéresser par ton cv :</u></b> :<br /><br/>';
$body.= 'Nom et prénom : <b>'.$votreNom.'</b><br/>';
$body.= 'Email : <b>'.$email.'</b> <br/>';
$body.= '</p>';
$body.= '<p>';
$body.= '<b><u>Message :</u></b>:<br /><br />';
$body.= '<b>'.$message.'</b> <br /></p>';
   // On définit le contenu de cette page comme message
   $mail->MsgHTML($body); 
   //grande priorité
   //$mail->Priority = 1;
 //  $mail->AddCustomHeader("X-MSMail-Priority: High");
   //$mail->AddCustomHeader("Importance: High");
   // On pourra définir un message alternatif pour les boîtes de
   // messagerie n'acceptant pas le html
  // $mail->AltBody = "Ce message est au format HTML, votre messagerie n'accepte pas ce format.";
   //copie du message au client
  // $mail->AddAddress($email,$votreNom);
   // Pour finir, on envoi l'e-mail
   
   ini_set('sendmail_from',$email);
echo $body;
   //  var_dump($mail);
     if(!$mail->Send())
  {
    echo $mail->ErrorInfo;
    echo '<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  Un probléme s\'est produit veuillez réessayer plus tard.
</div>';//$mail->ErrorInfo; 
 // var_dump($mail);
 

  }

  else
  {
    return true;

  }
 // echo $mail->Send();

       
?>
