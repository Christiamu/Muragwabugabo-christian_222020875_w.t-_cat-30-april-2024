<?php
// Connection details
 include('database-connection.php');
 
// Check if User_id is set
if(isset($_REQUEST['UserID'])) {
    $usrid = $_REQUEST['UserID'];
    //fullname (UserID, FirstName,LastName
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM fullname WHERE UserID=?");
    $stmt->bind_param("i", $usrid);
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
            <input type="hidden" name="usrid" value="<?php echo $usrid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='fullname.php'>OK</a>";
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
    echo "User Id is not set.";
}

$connection->close();
?>
