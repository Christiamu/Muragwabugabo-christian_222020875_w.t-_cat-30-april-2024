<?php
// Connection details
 include('database-connection.php');

// Check if book_Id is set
if(isset($_REQUEST['BookID'])) {
    $bkid = $_REQUEST['BookID'];
    //issuedbook (BookID, UserID,IssueDate,ReturnDate
    $stmt = $connection->prepare("SELECT * FROM issuedbook WHERE BookID=?");
    $stmt->bind_param("i", $bkid);
    $stmt->execute();
    $result = $stmt->get_result();
 
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['BookID'];
        $c = $row['UserID'];
        $d = $row['IssueDate'];
        $e = $row['ReturnDate'];
     
    } else {
        echo "issuedbook not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update issuedbook</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update issuedbook form -->
    <h2><u>Update Form of issuedbook</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="usrid">UserID:</label>
        <input type="number" name="usrid" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="IsueDate">IssueDate:</label>
        <input type="date" name="IsueDate" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="RtrnDate">ReturnDate:</label>
        <input type="date" name="RtrnDate" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        
        <input type="submit" name="up" value="Update">
        
    </form></center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $userid = $_POST['usrid'];
    $IssueDate = $_POST['IsueDate'];
    $ReturnDate = $_POST['RtrnDate'];
    
    //issuedbook (BookID, UserID,IssueDate,ReturnDate
    // Update the issuedbook in the database
    $stmt = $connection->prepare("UPDATE issuedbook SET UserID=?,IssueDate=?,ReturnDate=? WHERE BookID=?");
    $stmt->bind_param("issi",$userid, $IssueDate, $ReturnDate, $bkid);
    $stmt->execute();
    
    // Redirect to issuedbook.php
    header('Location: issuedbook.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
