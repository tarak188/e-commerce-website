<?php
function verif($con, $password) {
	$sql = "SELECT * FROM login WHERE password = '$password'";
	$result = mysqli_query($con, $sql);
	$count = mysqli_num_rows($result);

	if($count == 1) {
		return false;
	}
	else {
		return true;
	}
}

$con = mysqli_connect('localhost', 'root', '', 'modeco');

// Check if the connection was successful
if (!$con) {
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Perform validation
if (!verif($con, $_POST['password'])) {
	echo "Email exists";
	exit;
}

$txtName = mysqli_real_escape_string($con, $_POST['name1']);
$name2 = mysqli_real_escape_string($con, $_POST['name2']);
$mail = mysqli_real_escape_string($con, $_POST['mail']);
$pass = mysqli_real_escape_string($con, $_POST['password']);

$sql = "INSERT INTO tarak2 (Id, nom, prenom, email, password) VALUES (0, '$txtName', '$name2', '$mail', '$pass')";

$rs = mysqli_query($con, $sql);

if ($rs) {
	echo "Contact Records Inserted";
} else {
	echo "Failed to insert contact records: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>
