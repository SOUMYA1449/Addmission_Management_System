<?php
// Assuming you have already established a database connection
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "student_login"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['sphone'])) {
    $sphone = $_GET['sphone'];
    $sql = "DELETE FROM student_details WHERE sphone = $sphone";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Prepare SQL query to retrieve student data from the database
$sql = "SELECT * FROM student_details";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data</title>
    <style>
        /* Your CSS styles */
        table {
            border:2px solid lack;
            border-radius: 5px;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Student Data</h2>
    <table>
        <tr>
            <th>Full Name</th>
            <th>Father's Name</th>
            <th>Mother's Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Parent's Phone</th>
            <th>Gender</th>
            <th>Date of Birth</th>
            <th>Address</th>
            <th>Program</th>
            <th>Action</th>
        </tr>
        <?php
        // Check if there are rows in the result
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["sname"] . "</td>";
                echo "<td>" . $row["fname"] . "</td>";
                echo "<td>" . $row["mname"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["sphone"] . "</td>";
                echo "<td>" . $row["pphone"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "<td>" . $row["dob"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["program"] . "</td>";
                echo "<td><a href='edit.php?sphone=" . $row["sphone"] . "'>Edit</a> | <a href='?action=delete&sphone=" . $row["sphone"] . "'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='12'>No records found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
