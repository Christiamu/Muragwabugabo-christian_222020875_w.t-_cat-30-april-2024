<?php
// Connection details
 include('database-connection.php');
 
// Check if Book_id is set
if(isset($_REQUEST['BookID'])) {
    $bkid = $_REQUEST['BookID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM issuedbook WHERE BookID=?");
    $stmt->bind_param("i", $bkid);
     ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="bkid" value="<?php echo $bkid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='issuedbook.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "issuedbook Id is not set.";
}

$connection->close();
?>
