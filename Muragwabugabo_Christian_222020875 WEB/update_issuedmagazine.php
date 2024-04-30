<?php
// Connection details
 include('database-connection.php');

// Check if Mag ID is set
if(isset($_REQUEST['MagID'])) {
    $magid = $_REQUEST['MagID'];
    //issuedmagazine (MagID, UserID,IssueDate,ReturnDate
    $stmt = $connection->prepare("SELECT * FROM issuedmagazine WHERE MagID=?");
    $stmt->bind_param("i", $magid);
    $stmt->execute();
    $result = $stmt->get_result();
 
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['MagID'];
        $c = $row['UserID'];
        $d = $row['IssueDate'];
        $e = $row['ReturnDate'];
     
    } else {
        echo "issuedmagazine not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update issuedmagazine</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update issuedmagazine form -->
    <h2><u>Update Form of issuedmagazine</u></h2>
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
    //issuedmagazine (MagID, UserID,IssueDate,ReturnDate
    // Update the issuedmagazine in the database
    $stmt = $connection->prepare("UPDATE issuedmagazine SET UserID=?,IssueDate=?,ReturnDate=? WHERE MagID=?");
    $stmt->bind_param("issi",$UserID, $IssueDate, $ReturnDate, $magid);
    $stmt->execute();
    
    // Redirect to issuedmagazine.php
    header('Location: issuedmagazine.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
