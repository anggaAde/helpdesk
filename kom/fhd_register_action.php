<?php include("includes/session.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<title>Registration</title>
<?php
include("fhd_config.php");
include("includes/header.php");
include("includes/ez_sql_core.php");
include("includes/ez_sql_mysqli.php");
include("includes/functions.php");
//initilize db
$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);

if (ALLOW_REGISTER <> "yes"){
	echo "<p>Registration is Closed</p>";
	include("includes/footer.php");
	exit;
	}

if (CAPTCHA_REGISTER == "yes"){
$captchasession = $_SESSION['captcha']['code'];
$captcha = $db->escape(trim($_POST['captcha']));
	if($captchasession <> $captcha) {
	echo "<div class=\"alert alert-danger\" style=\"max-width: 350px;\">Invalid Captcha Code.</div>";
	include("includes/footer.php");
	exit;
	}
}

//IP and DATE field
$ip = $_SERVER['REMOTE_ADDR'];


//EMAIL address
$email = $db->escape(trim($_POST['email']));

if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
	echo "<div class=\"alert alert-danger\" style=\"max-width: 350px;\">That email address appears to be invalid.</div>";
	include("includes/footer.php");
	exit;
}

if ($email) {
	//check if email already exists.
	$num = $db->get_var("select count(user_email) from site_users where user_email = '$email';");
		if ($num > 0) {
			echo "<div class=\"alert alert-danger\" style=\"max-width: 350px;\">That email address has already registered.</div>";
			include("includes/footer.php");
			exit;
		}
}else {
	echo "<div class=\"alert alert-danger\" style=\"max-width: 350px;\">Please check the email address field again.</div>";
	include("includes/footer.php");
	exit;
}

//NAME FIELD
$name = $db->escape(trim(strip_tags($_POST['name'])));
	$strlen = (strlen($name));
	if ($strlen < 3) {
		echo "<div class=\"alert alert-danger\" style=\"max-width: 350px;\">Name is to short, it must be at least 3 characters.</div>";
		include("includes/footer.php");
    	exit;
		}

//LOGIN NAME FIELD
$login = $db->escape(trim(strip_tags($_POST['login'])));
	//make sure search length is at least 15 chars.
	$strlen = (strlen($login));
	if ($strlen < 3) {
		echo "<div class=\"alert alert-danger\" style=\"max-width: 350px;\">Login name is to short, it must be at least 3 characters.</div>";
		include("includes/footer.php");
    	exit;
		}
	//check if login name is unique.
	$num = $db->get_var("select count(user_login) from site_users where user_login = '$login';");
		if ($num > 0) {
			echo "<div class=\"alert alert-danger\" style=\"max-width: 350px;\">That login name has already registered.</div>";
			include("includes/footer.php");
			exit;
		}

//PASSWORD FIELD
$password = $db->escape(trim(strip_tags($_POST['password'])));
if ($password) {
	$passwordlength = strlen($password);
	if($passwordlength >= 5){
		$user_password = makepwd( trim( $db->escape( $password ) ) );
	} else {
		echo "<div class=\"alert alert-danger\" style=\"max-width: 350px;\">Password must be at least 5 characters.</div>";
		include("includes/footer.php");
		exit;
	}
}

//pending
if (REGISTER_APPROVAL == "yes"){
	$user_pending = 1;
	}else{
	$user_pending = 0;
}

//user_msg_send
$user_msg_send = 1;

$query = "INSERT into site_users(user_login,user_email,user_name,user_password,last_ip,user_status,user_level,user_pending,user_msg_send)VALUES('$login','$email','$name','$user_password','$ip',1,1,$user_pending,$user_msg_send);";
$db->query($query);
//notify admin
$from	 = FROM_EMAIL;
$to      = TO_EMAIL;
$subject = FHD_TITLE . ' New Registration';
// message
$message = '
<html>
<head>
  <title>New Registration</title>
</head>
<body>
  <p>New User Registration</p>
  <p>Name: ' . $name . '</p>
  <p>Login: ' . $login . '</p>
  <p>Email: ' .  $email. '</p>
</body>
</html>
';
$headers = "From:" . $from . "\r\n";
$headers .="Reply-To: " .$from . "\r\n";
$headers .="X-Mailer: PHP/" . phpversion() ."\r\n";
$headers .="MIME-Version: 1.0" . "\r\n";
$headers .="Content-type: text/html; charset=iso-8859-1" . "\r\n";
mail($to, $subject, $message, $headers);
?>

<h3>Registration Received</h3>

<h4><a href="index.php">Login</a></h4>

<?php include("includes/footer.php");