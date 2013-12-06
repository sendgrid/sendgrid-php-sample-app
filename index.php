<?php
require_once 'lib/SendGrid.php';
require_once 'lib/Unirest.php';

SendGrid::register_autoloader();

// <sendgrid_username>,<sendgrid_password> should be replaced with the SendGrid credentials
$sendgrid_username = '<sendgrid_username>';
$sendgrid_password = '<sendgrid_password>';
// update the <from_address> with your email address
$from_email = "<from_address>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
  // get values from form
  $to = $_POST['emailto'];
  $subject = $_POST['subject'];
  $content = $_POST['content'];

  // make a secure connection to SendGrid
  $sendgrid = new SendGrid($sendgrid_username, $sendgrid_password);
  $mail     = new SendGrid\Email();

  $mail->addTo($to)->
    setFrom($from_email)->
    setSubject($subject)->
    setText($content);

  # use the Web API to send your message
  $response = $sendgrid->web->send($mail);

  # check request response
  if ($response->message == 'success')
  {
    $message = "Email sent successfully";
    $status = ' success';
    $to = '';
    $subject = '';
    $content = '';
  }
  else
  {

    $message = "Email not sent - " . $response->errors[0];
    $status = ' error';
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>SendGrid</title>
    <link type="text/css" rel="stylesheet" href="/stylesheets/main.css" />
  </head>
  <body>
    <div class="header">
      <div class="header-top">
        <img src="/images/sendgrid_logo.png" style="width: 150px;" />
      </div>
    </div>
    <div class="content">
      <div class="form">
        <?php if ($message) : ?>
          <div class="message<?php echo $status; ?>"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="/index.php" method="post">
          <div class="form-input">
            <label>To:</label> 
            <input name="emailto" value="<?php echo isset($to) ? $to : '' ; ?>"/>
          </div>
          <div class="form-input">
            <label>Subject: </label>
            <input name="subject" value="<?php echo isset($subject) ? $subject : ''; ?>"/>
          </div>
          <div class="form-input">
            <label>Content: </label>
            <textarea name="content" rows="10" cols="60"><?php echo isset($content) ? $content : ''; ?></textarea>
          </div>
          <div>
            <input type="submit" value="Send" class="buttton" />
          </div>
        </form>
      </div>
    </div>
  </body>
</html>