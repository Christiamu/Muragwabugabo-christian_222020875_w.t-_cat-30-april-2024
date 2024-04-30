<?php
// Connection details
 include('database-connection.php');
 
// Check if Librarian_id is set
if(isset($_REQUEST['LibrarianID'])) {
    $libid = $_REQUEST['LibrarianID'];
    //librarian WHERE LibrarianID
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM librarian WHERE LibrarianID=?");
    $stmt->bind_param("i", $libid);
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
            <input type="hidden" name="libid" value="<?php echo $libid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='customers.php'>OK</a>";
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
    echo "librarian Id is not set.";
}

$connection->close();
?>
