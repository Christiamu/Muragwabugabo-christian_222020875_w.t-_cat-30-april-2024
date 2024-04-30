<?php
// Connection details
 include('database-connection.php');
 
// Check if magazine_id is set
if(isset($_REQUEST['MagID'])) {
    $magid = $_REQUEST['MagID'];
    //magazine(MagID, VolNo, Mname, Magazine, MagazineShelf, Genre, Publisher
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM magazine WHERE MagID=?");
    $stmt->bind_param("i", $magid);
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
            <input type="hidden" name="magid" value="<?php echo $magid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='magazine.php'>OK</a>";
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
    echo "magazine Id is not set.";
}

$connection->close();
?>
