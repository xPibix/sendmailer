<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26.06.2017
 * Time: 12:04
 */
header( "refresh:4;url=index.html" );

require_once('lib/phpmailer/PHPMailerAutoload.php');
$msg = '';
$style = '';

/*If all required fields not emtpy - done, else stop*/
if((isset($_POST['mail'])&&$_POST['mail']!="")&&(isset($_POST['massage'])&&$_POST['massage']!="")){ //If our input-fields not empty
if (!preg_match("/^[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}$/i", $_POST['mail'])){
exit("Enter mail like somebody@server.com");}}

$mailer = $_POST['mail'];
$mailer = htmlspecialchars(urldecode(trim($mailer)));
$subject = 'Test For Hanna';
$message = $_POST['massage'];
$message = urldecode(trim($message));
$message = "<html><head></head><body style=\"background: #3DC6FF; color:#EBF9FF; link:#f0f8ff; margin: 10px;\">".$message."</body></html>";
$mail = new PHPMailer;

$mail->SetFrom('test@awesome-keys.com', 'test@awesome-keys.com');
$mail->addAddress($mailer);
$mail->Subject = $subject;
$mail->msgHTML($message);
$i = 1;

/*Adding all fyles*/
while (isset($_FILES['file-'.$i]['name'])) {
    $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['file-'.$i]['name']));
    $filename = $_FILES['file-'.$i]['name'];
    if (move_uploaded_file($_FILES['file-'.$i]['tmp_name'], $uploadfile)) {
        $mail->addAttachment($uploadfile, $filename);
    } else {
        $msg .= 'Failed to move file to ' . $uploadfile;
    }
    $i++;
}

if (!$mail->send()) {
    $msg .= "<h1>Mailer Error: " . $mail->ErrorInfo. "</h1>";
} else {
    $msg .= "<h1>Message sent!</h1>";
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>SendFilesToMail</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div>
<?php if (empty($msg)) { ?>
<?php } else {
    echo $msg;
} ?>
</div>
</body>
</html>