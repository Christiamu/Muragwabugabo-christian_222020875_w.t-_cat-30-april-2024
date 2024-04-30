<?php
// Connection details
 include('database-connection.php');

// Check if book_Id is set
if(isset($_REQUEST['LibrarianID'])) {
    $libid = $_REQUEST['LibrarianID'];
    
    $stmt = $connection->prepare("SELECT * FROM librarian WHERE LibrarianID=?");
    $stmt->bind_param("i", $libid);
    $stmt->execute();
    $result = $stmt->get_result();
   ///librarian (LibrarianID, FullName,UserName,Password,Email
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['LibrarianID'];
        $c = $row['FullName'];
        $d = $row['UserName'];
        $e = $row['Password'];
        $f = $row['Email'];
        
    } else {
        echo "librarian not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update librarian</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update librarian form -->
    <h2><u>Update Form of librarian</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="fullname">FullName:</label>
        <input type="text" name="fullname" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="usrname">UserName:</label>
        <input type="text" name="usrname" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="pass">Password:</label>
        <input type="password" name="pass" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <label for="eml">Email:</label>
        <input type="email" name="eml" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>

        
        <input type="submit" name="up" value="Update">
        
    </form></center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $full_name = $_POST['fullname'];
    $username = $_POST['usrname'];
    $password = $_POST['pass'];
    $email = $_POST['eml'];
    
    //librarian (LibrarianID, FullName,UserName,Password,Email
    // Update the librarian in the database
    $stmt = $connection->prepare("UPDATE librarian SET FullName=?,UserName=?,Password=?,Email=? WHERE LibrarianID=?");
    $stmt->bind_param("ssssi",$full_name, $username, $password, $email, $libid);
    $stmt->execute();
    
    // Redirect to librarian.php
    header('Location: librarian.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
