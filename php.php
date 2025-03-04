<?php
	$name = $_POST['name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$subject = $_POST['subject'];
	$symptoms = $_POST['symptoms'];
	// $number = $_POST['number'];

	// Database connection
	$conn = new mysqli('localhost','root','','medical');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into medical(name, email, mobile, subject, symptoms) values(?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssi", $name, $email, $mobile, $subject, $symptoms);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
	}
?>