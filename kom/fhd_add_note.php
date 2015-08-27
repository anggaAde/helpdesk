<?php
ob_start();
include("includes/session.php");
include("includes/checksession.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Note Add/Edit</title>
<?php
include("fhd_config.php");
include("includes/header.php");
include("includes/all-nav.php");
include("includes/ez_sql_core.php");
include("includes/ez_sql_mysqli.php");
include("includes/functions.php");
$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);

// <UPDATE>
if (isset($_POST['update'])){
 if ( $_POST['nacl'] == md5(AUTH_KEY.$db->get_var("select user_password from site_users where user_id = $user_id;")) ) {
	$note_id = checkid($_POST['note_id']);
	$call_id = checkid($_POST['call_id']);
	$user_id = $_SESSION['user_id'];
	if ( $user_id == $db->get_var("select note_post_user from site_notes where note_post_user = $user_id;") ) {
		$note_body = trim( htmlentities($db->escape($_POST['note_body'])) );
		$note_post_ip = $db->escape( $_SERVER['REMOTE_ADDR'] );
		$db->query("UPDATE site_notes SET note_body='$note_body',note_post_ip='$note_post_ip' WHERE note_id=$note_id;");
		header("Location: fhd_call_edit.php?call_id=$call_id");
		//echo exit;
		}
 }else{
	//not verified, warning and exit!
	echo "<p>Warning: Verification Error!</p>";
 	exit;
}
}
// </UPDATE>

// <ADD>
if (isset($_POST['add'])){
 if ( $_POST['nacl'] == md5(AUTH_KEY.$db->get_var("select user_password from site_users where user_id = $user_id;")) ) {
	//authentication verified, continue.
	$note_relation = checkid($_POST['note_relation']);
	$note_body = trim( htmlentities( $db->escape($_POST['note_body']) ) );
	$note_post_date = mktime(date('n/j/y g:i a'));
	$note_post_ip = $_SERVER['REMOTE_ADDR'];
	$note_post_user = $_SESSION['user_id'];
	$db->query("INSERT INTO site_notes(note_type,note_title,note_body,note_relation,note_post_date,note_post_ip,note_post_user) VALUES( 1,'$note_title','$note_body',$note_relation,$note_post_date,'$note_post_ip','$note_post_user');");
	//$call_user = $db->get_var("select call_user from site_calls where call_id = $note_relation;");
		//<SEND EMAIL>
		if ($db->get_var("select user_msg_send from site_users where user_id = $user_id;") == 1){
		$call_email = $db->get_var("select call_email from site_calls where call_id = $note_relation;");
		$headers = "From:" . FROM_EMAIL . "\r\n";
		$headers .="Reply-To: " . FROM_EMAIL . "\r\n";
		$headers .="X-Mailer: PHP/" . phpversion() ."\r\n";
		$headers .="MIME-Version: 1.0" . "\r\n";
		$headers .="Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$subject = "Ticket [# $note_relation] Updated";
		$message = "
		<html>
		<head>
		<title>Ticket Updated</title>
		</head>
		<body>
		<p>Ticket Updated.</p>
		<p>Ticket Number: $note_relation</p>
		<p>Note Details: $note_body</p>
		";
		mail($call_email, $subject, $message, $headers);
		$mailsent = "&mailsent=yes";
		}
		//notify admin
		mail(TO_EMAIL, $subject, $message, $headers);
		//</SEND EMAIL>

		//where to redirect...
		if(isset($_SESSION['admin'])){
			header("Location: fhd_call_edit.php?call_id=$note_relation");
			}else{
			header("Location: fhd_call_details.php?call_id=$note_relation$mailsent");
		}

 }else{
	//not verified, warning and exit!
	echo "<p>Warning: Verification Error.</p>";
 	exit;
}
}
// </ADD>

// EDIT note
//check type variable
if (isset($_GET['note_id'])) {
$note_id = checkid($_GET['note_id']);
$call_id = checkid($_GET['call_id']);
$nacl = md5(AUTH_KEY.$db->get_var("select user_password from site_users where user_id = $user_id;"));
$note_body = $db->get_var("select note_body from site_notes where note_id = $note_id;");
?>
<h4>Edit Note</h4>
<form action="fhd_add_note.php" method="post">
<table class="<?php echo $table_style_2;?>" style="width: 75%;">
	<tr><td><textarea cols="65" rows="6" name="note_body" style="width: auto;"><?php echo $note_body;?></textarea></td></tr>
	<tr><td colspan='1'><input type='submit' name='update' value='update' class='btn btn-primary'></td></tr>
</table>
<input type="hidden" name="call_id" value="<?php echo checkid($_GET['call_id']);?>">
<input type='hidden' name='nacl' value='<?php echo $nacl;?>'>
<input type='hidden' name='note_id' value='<?php echo checkid($_GET['note_id']);?>'>
</form>
<h5><i class="fa fa-arrow-left"></i> <a href="fhd_call_edit.php?call_id=<?php echo $call_id;?>">back to ticket details</a></h5>
<?php } 

//ADD note
//check type variable
$action = $db->escape( $_GET['action'] );
if ($action=="add") {
$call_id = checkid($_GET['call_id']);
$nacl = md5(AUTH_KEY.$db->get_var("select user_password from site_users where user_id = $user_id;"));
?>
<h4>Add Note</h4>
<table class="<?php echo $table_style_2;?>" style='width: 75%;'>
<form action="fhd_add_note.php" method="post" class="form-horizontal">
<input type='hidden' name='nacl' value='<?php echo $nacl;?>'>
<input type='hidden' name='note_relation' value='<?php echo $call_id;?>'>
<!-- 	<tr><td valign="top">Title: </td><td><input type="text" name="note_title" size="43"></td></tr> -->
	<tr><td><textarea rows="4" name="note_body" style="width: 100%";></textarea></td></tr>
	<tr><td colspan='1'><input type='submit' name="add" value='add' class='btn btn-primary'></td></tr>
</form>
</table>
	<?php if(isset($_SESSION['admin'])){ ?>
		<h5><i class="fa fa-arrow-left"></i> <a href="fhd_call_edit.php?call_id=<?php echo $call_id;?>">back to ticket details</a></h5>
		<?php }else{ ?>
		<h5><i class="fa fa-arrow-left"></i> <a href="fhd_call_details.php?call_id=<?php echo $call_id;?>">back to ticket details</a></h5>
	<?php } ?>

<?php } ?>

<?php
if(isset($_SESSION['name'])){
	
	echo "<br /><p><strong>Login Name:</strong> " . $_SESSION['name'] . "</p>";
}
include("includes/footer.php");