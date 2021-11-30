<?php
/*-----------------------------------------------
  # Variables
  ---------------------------------------------*/
$name       = $_POST['name'];
$email      = $_POST['email'];
$website    = isset($_POST['website']) && !empty($_POST['website']) ? $_POST['website'] : 'No Website';
$subject    = isset($_POST['subject']) && !empty($_POST['subject']) ? $_POST['subject'] : 'New message from your site contact form';
$content    = $_POST['content'];
$toMail     = 'Mominul Islam <mominulfed@gmail.com>'; // Your name & mail address here example 'Your Name <contact@domain.com>'.

/*-----------------------------------------------
  # Error Reporting need first
  ---------------------------------------------*/
$error      = false;
$msg        = '';
$body       = '';

// Check Name
if (empty($name)) {
  $error = true;
  $msg   .= '<strong>Required:</strong> Please enter your name.';
  $msg   .= '<br>';
} else {
  $body  .= '<strong>Name:</strong> ' . $name;
  $body  .= '<br><br>';
}

// Check Email
if (empty($email)) {
  $error = true;
  $msg   .= '<strong>Required:</strong> Please enter your valid email address.';
  $msg   .= '<br>';
} else {
  $body  .= '<strong>Email:</strong> ' . $email;
  $body  .= '<br><br>';
}

// Check Content
if (empty($content)) {
  $error = true;
  $msg   .= '<strong>Required: </strong> Please write something. Can\'t here you from our home';
  $msg   .= '<br>';
} else {
  // Subject
  $body  .= '<strong>Subject:</strong> ' . $subject;
  $body  .= '<br><br>';

  // Website
  $body  .= '<strong>Website:</strong> ' . $website;
  $body  .= '<br><br>';

  // Body Content
  $body  .= '<strong>Message:</strong> ' . $content;
  $body  .= '<br><br>';
}

/*-----------------------------------------------
  # Prepare send mail
  ---------------------------------------------*/
if ($error == true) {
  $msg    .= '<strong>Error:</strong> Please fill form with above info requirement.';
} else {
  $body   .= $_SERVER['HTTP_REFERER'] ? '<br><br><br>This form was submitted from: ' . $_SERVER['HTTP_REFERER'] : '';
  $error   = false;
  $msg    .= '<strong>Success:</strong> Your message has been send.';

  // Mail Headers
  $headers   = array();
  $headers[] = "MIME-Version: 1.0";
  $headers[] = "Content-type: text/html; charset=iso-8859-1";
  $headers[] = "From: {$name} <{$email}>";
  $headers[] = "Reply-To: {$name} <{$email}>";
  $headers[] = "Subject: {$subject}";
  $headers[] = "X-Mailer: PHP/".phpversion();

  mail($toMail, $subject, $body, implode("\r\n", $headers));
}
// Make as json obj
$dataReturn = array(
                'error'   => $error,
                'message'   => $msg,
                'data'  => array(
                  'name' => $name,
                  'email' => $email,
                  'subject' => $subject,
                  'content' => $content
                )
              );
header('Content-type: application/json');
echo json_encode($dataReturn);