<?php
// Connection details
 include('database-connection.php');
 
// Check if Book_id is set
if(isset($_REQUEST['BookNo'])) {
    $bkno = $_REQUEST['BookNo'];
//book_count BookNo, UserID
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM book_count WHERE BookNo=?");
    $stmt->bind_param("i", $bkno);
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
            <input type="hidden" name="bkno" value="<?php echo $bkno; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='book_count.php'>OK</a>";
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
    echo "book_count Id is not set.";
}

$connection->close();
?>
