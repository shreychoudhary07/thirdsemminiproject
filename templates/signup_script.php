<?php
session_start();
require '../includes/common.php';
$n = 1;
$name = mysqli_real_escape_string($con, $_POST['name']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$regrex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
$_SESSION['email'] = $email;
if (!preg_match($regrex_email, $email))
{
	echo 'This email is invalid.';
	echo ("<script>location.href='signup.php'</script>");
}
$email_q = "SELECT id from users WHERE email = '$email'";
$email_q_res = mysqli_query($con, $email_q) or die(mysqli_error($con));
if (mysqli_num_rows($email_q_res) != 0)
{
	echo "Email already exists. Please enter a valid email or login to existing account.";
	echo ("<script>location.href='signup.php'</script>");
	$n = 0;
}
$password = mysqli_real_escape_string($con, $_POST['password']);
if (strlen($password) <= 6)
{
	echo "Password should be of atleast 6 characters.";
}
$pass_word = md5($password);
$phone_number = mysqli_real_escape_string($con, $_POST['phone']);
$branch = mysqli_real_escape_string($con, $_POST['branch']);
$f_name = mysqli_real_escape_string($con, $_POST['f_name']);
$m_name = mysqli_real_escape_string($con, $_POST['m_name']);
$roll_num = mysqli_real_escape_string($con, $_POST['roll_num']);
if ($n == 1)
{
	$signup_q = "INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `branch`, `f_name`, `m_name`, `roll_num`) VALUES (NULL, '$name', '$email', '$pass_word', '$phone_number', '$branch', '$f_name', '$m_name', '$roll_num')";
	$signup_q_res = mysqli_query($con, $signup_q) or die(mysqli_error($con));
	echo ("<script>location.href='home.php'</script>");
}
else
{
	echo ("<script>location.href='home.php'</script>");
}
?>
