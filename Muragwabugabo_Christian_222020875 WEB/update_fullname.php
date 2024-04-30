<?php
// Connection details
 include('database-connection.php');

// Check if User_Id is set
if(isset($_REQUEST['UserID'])) {
    $usrid = $_REQUEST['UserID'];
    //fullname (UserID, FirstName,LastName
    $stmt = $connection->prepare("SELECT * FROM fullname WHERE UserID=?");
    $stmt->bind_param("i", $usrid);
    $stmt->execute();
    $result = $stmt->get_result();
   //fullname (UserID, FirstName,LastName
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['UserID'];
        $c = $row['FirstName'];
        $d = $row['LastName'];
       
    } else {
        echo "UserID not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update fullname</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update fullname form -->
    <h2><u>Update Form of fullname</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
      
        <label for="fname">FirstName:</label>
        <input type="text" name="fname" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="lname">LastName:</label>
        <input type="text" name="lname" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

       
        <input type="submit" name="up" value="Update">
        
    </form></center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Fname = $_POST['fname'];
    $Lname = $_POST['lname'];
   
   //fullname (UserID, FirstName,LastName
    // Update the fullname in the database
    $stmt = $connection->prepare("UPDATE fullname SET FirstName=?,LastName=? WHERE UserID=?");
    $stmt->bind_param("ssi",$Fname, $Lname, $usrid);
    $stmt->execute();
    
    // Redirect to fullname.php
    header('Location: fullname.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
