<?php
// Connection details
 include('database-connection.php');
 
// Check if Publisher_id is set
if(isset($_REQUEST['PublisherID'])) {
    $pubid = $_REQUEST['PublisherID'];

    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM publisher WHERE PublisherID=?");
    $stmt->bind_param("i", $pubid);
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
            <input type="hidden" name="pubid" value="<?php echo $pubid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='publisher.php'>OK</a>";
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
    echo "Publisher Id is not set.";
}

$connection->close();
?>
