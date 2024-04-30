<?php
// Connection details
 include('database-connection.php');

// Check if book_Id is set
if(isset($_REQUEST['BookNo'])) {
    $usrid = $_REQUEST['BookNo'];
    
    $stmt = $connection->prepare("SELECT * FROM book_count WHERE BookNo=?");
    $stmt->bind_param("i", $usrid);
    $stmt->execute();
    $result = $stmt->get_result();
   //book_count BookNo, UserID
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['BookNo'];
        $c = $row['UserID'];
       
    } else {
        echo "book not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update book_count</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update book_count form -->
    <h2><u>Update Form of book_count</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="usrid">User Id:</label>
        <input type="number" name="usrid" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        
        <input type="submit" name="up" value="Update">
        
    </form></center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $userid = $_POST['usrid'];
   
    //book_count BookNo, UserID
    // Update the book_count in the database
    $stmt = $connection->prepare("UPDATE book_count SET UserID=? WHERE BookNo=?");
    $stmt->bind_param("ii",$userid, $bkNo);
    $stmt->execute();
    
    // Redirect to book_count.php
    header('Location: book_count.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
