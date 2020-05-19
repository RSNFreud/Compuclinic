<?php 
    $user = $_POST['name'];
    include('../admin/php/config.php');
    ini_set ('display_errors', 'on');
    ini_set ('log_errors', 'on');
    ini_set ('display_startup_errors', 'on');
    ini_set ('error_reporting', E_ALL);
    $stmt = $pdo->prepare("SELECT contactemail, sitename FROM settings");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $email = $stmt->fetch();
  require '../../../../vendor/autoload.php';
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  $mail = new PHPMailer(true);
  date_default_timezone_set('Etc/UTC');
  //Tell PHPMailer to use SMTP
  $mail->isSMTP();
  //Enable SMTP debugging
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  $mail->SMTPDebug = 0;
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPAuth = true;
  $mail->SMTPSecure  = "tls";
  $mail->Username = 'noreply@freud-online.co.uk';
  $mail->Password = 'PasswordMail123';
  //Set who the message is to be sent from
  $mail->setFrom('noreply@freud-online.co.uk', $email["sitename"]);
  //Set who the message is to be sent to
  $mail->addAddress($email["contactemail"]);
  $mail->isHTML(true);            
  $mail->Subject = 'New Testimonial';
  $mail->Body = '<div style="background-color: #dfe8ef; padding: 20px; margin: 0; box-sizing: border-box; width: 100%;">
    <table style="background-color: white; padding: 30px; box-sizing: border-box; border-radius: 10px; font-family: Helvetica Neue; width: 100%;">
        <tr>
            <td> You have received a new testimonial from '.$user .'! Please go to your admin panel to approve or deny it.</td>
        </tr>
        <tr>
            <td align="center">
                <a href="https://compuclinicuk.co.uk/admin" style="text-decoration: none;">
                    <div style="background-color:#131c35;width:200px;color:white;text-align:center;padding:10px;box-sizing:border-box;margin-top:20px">Go to Admin Console</div>
                </a>
            </td>
        </tr>

    </table>
    <div style="box-sizing: border-box; width: 100%; font-family: Helvetica Neue; font-style: italic; color: grey;opacity: 0.7; text-align: center; padding: 10px 0px 0px; box-sizing: border-box;">This contact form is managed by Freud-Online</div>
</div>';

  //send the message, check for errors
  if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    echo 'Message could not be sent. Please contact a system administrator.';
  } else {
    echo 'Email successfully sent!';
  } 
?>
