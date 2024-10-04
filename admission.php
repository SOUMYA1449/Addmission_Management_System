<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = 'localhost';
    $username = 'root';
    $password = ''; // default password is empty for XAMPP
    $dbname = 'student_login';

    // Create connection
    $connectionObj = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($connectionObj->connect_error) {
        die("Connection failed: " . $connectionObj->connect_error);
    }

    // Retrieve form data
    $sname = $_POST['full_name'] ?? '';
    $fname = $_POST['ffull_name'] ?? '';
    $mname = $_POST['mfull_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $sphone = $_POST['phone'] ?? '';
    $pphone = $_POST['pphone'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $address = $_POST['address'] ?? '';
    $program = $_POST['program'] ?? '';

    // SQL query to insert data into the database
    $stmt = $connectionObj->prepare("INSERT INTO student_details (sname, fname, mname, email, sphone, pphone, gender, dob, address, program) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $sname, $fname, $mname, $email, $sphone, $pphone, $gender, $dob, $address, $program);

    if ($stmt->execute()) {
        echo 'Thank You For Enroll';
    } else {
        // Handle unique constraint violation or other errors
        echo 'Error: ' . $stmt->error;
    }

    // Close the prepared statement and the connection
    $stmt->close();
    $connectionObj->close();
}

?>
