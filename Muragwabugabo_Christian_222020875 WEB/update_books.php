<?php
// Connection details
 include('database-connection.php');

// Check if book_Id is set
if(isset($_REQUEST['BookID'])) {
    $bkid = $_REQUEST['BookID'];
    
    $stmt = $connection->prepare("SELECT * FROM books WHERE BookID=?");
    $stmt->bind_param("i", $bkid);
    $stmt->execute();
    $result = $stmt->get_result();
   //books (BookID, BookName, Genre, Author, Publisher, Shelf, Row
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['BookID'];
        $c = $row['BookName'];
        $d = $row['Genre'];
        $e = $row['Author'];
        $f = $row['Publisher'];
        $g = $row['Shelf'];
        $h = $row['Row'];
    } else {
        echo "book not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update books</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update books form -->
    <h2><u>Update Form of books</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
//books (BookID, BookName, Genre, Author, Publisher, Shelf, Row
        <label for="bkname">BookName:</label>
        <input type="text" name="bkname" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="bkgenre">Genre:</label>
        <input type="text" name="bkgenre" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="bkauth">Author:</label>
        <input type="text" name="bkauth" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <label for="bkpub">Publisher:</label>
        <input type="text" name="bkpub" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>

         <label for="bkshelf">Shelf:</label>
        <input type="text" name="bkshelf" value="<?php echo isset($g) ? $g : ''; ?>">
        <br><br>

        <label for="bkrow">Row:</label>
        <input type="text" name="bkrow" value="<?php echo isset($h) ? $h : ''; ?>">
        <br><br>

        
        <input type="submit" name="up" value="Update">
        
    </form></center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $book_name = $_POST['bkname'];
    $genre = $_POST['bkgenre'];
    $auther = $_POST['bkauth'];
    $publish = $_POST['bkpub'];
    $shelf = $_POST['bkshelf'];
    $row = $_POST['bkrow'];
    //books (BookID, BookName, Genre, Author, Publisher, Shelf, Row
    // Update the customer in the database
    $stmt = $connection->prepare("UPDATE books SET BookName=?, Genre=?, Author=?, Publisher=?, Shelf=?, Row=? WHERE BookID=?");
    $stmt->bind_param("ssssssi",$book_name, $genre, $auther, $publish, $shelf, $row, $bkid);
    $stmt->execute();
    
    // Redirect to books.php
    header('Location: Books.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
