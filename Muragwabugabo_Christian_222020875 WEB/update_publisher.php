<?php
// Connection details
 include('database-connection.php');

// Check if publisher_Id is set
if(isset($_REQUEST['PublisherID'])) {
    $pubid = $_REQUEST['PublisherID'];
    ////publisher (PublisherID, PublisherName)
    $stmt = $connection->prepare("SELECT * FROM publisher WHERE PublisherID=?");
    $stmt->bind_param("i", $pubid);
    $stmt->execute();
    $result = $stmt->get_result();
  
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['PublisherID'];
        $c = $row['PublisherName'];
       
    } else {
        echo "publisher not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update publisher</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update publisher form -->
    <h2><u>Update Form of publisher</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="publisher_name">Publisher Name:</label>
        <input type="text" name="publisher_name" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
        
    </form></center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $pub_name = $_POST['publisher_name'];
   
    // Update the publisher in the database
    $stmt = $connection->prepare("UPDATE books SET PublisherName=? WHERE PublisherID=?");
    $stmt->bind_param("si",$pub_name, $pubid);
    $stmt->execute();
    
    // Redirect to publisher.php
    header('Location: publisher.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
