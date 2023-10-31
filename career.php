<?php 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    // Process file upload
    $uploadDir = 'uploads/'; // Create a directory for uploaded files
    $uploadedFile = $uploadDir . basename($_FILES['file']['name']);
    
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFile)) {
        // File uploaded successfully
        
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'contact');
        if ($conn->connect_error) {
            echo "$conn->connect_error";
            die("Connection Failed : " . $conn->connect_error);
        } else {
            // Prepare and execute an SQL INSERT statement
            $stmt = $conn->prepare("INSERT INTO career(name, email, phone, file) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $phone, $uploadedFile);
            $execval = $stmt->execute();
            
            if ($execval) {
                echo "<script type ='text/javascript'>alert('uploaded');window.location.href='career.html';
                </script>";
                // header('Location: career.html');
            } else {
                echo "Job enquiry submission failed.";
            }
            
            $stmt->close();
            $conn->close();
        }
    } else {
        // File upload failed
        echo "File upload failed. Your job enquiry was not submitted.";
    }

?>
