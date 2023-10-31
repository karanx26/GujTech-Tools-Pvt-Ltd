<?php
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$city = $_POST['city'];
	$msg = $_POST['msg'];

	// Database connection
	$conn = new mysqli('localhost','root','','contact');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into contactus(name, phone, email, city, msg) values(?, ?, ?, ?, ?)");
		$stmt->bind_param("sisss", $name, $phone, $email, $city, $msg);
		$execval = $stmt->execute();
		//echo $execval;
		//echo "Submitted successfully...";
		if ($execval) {
			// If the insertion was successful, redirect to contact.html
			echo "<script type ='text/javascript'>alert('Message Sent');window.location.href='contactus.html';
                </script>";
			exit; // Ensure no more code is executed after the redirection
		} else {
			echo "Submission failed.";
		}
		$stmt->close();
		$conn->close();
	}
?>