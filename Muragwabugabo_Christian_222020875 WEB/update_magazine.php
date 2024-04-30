<?php
// Connection details
 include('database-connection.php');

// Check if Mag_Id is set
if(isset($_REQUEST['MagID'])) {
    $magid = $_REQUEST['MagID'];
    
    $stmt = $connection->prepare("SELECT * FROM magazine WHERE MagID=?");
    $stmt->bind_param("i", $magid);
    $stmt->execute();
    $result = $stmt->get_result();
   //magazine(MagID, VolNo, Mname, Magazine, MagazineShelf, Genre, Publisher
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['MagID'];
        $c = $row['VolNo'];
        $d = $row['Mname'];
        $e = $row['Magazine'];
        $f = $row['MagazineShelf'];
        $g = $row['Genre'];
        $h = $row['Publisher'];
    } else {
        echo "magazine not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update magazine</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update magazine form -->
    <h2><u>Update Form of magazine</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="volvo">VolNo:</label>
        <input type="text" name="volvo" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="magname">Mname:</label>
        <input type="text" name="magname" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="mgzn">Magazine:</label>
        <input type="text" name="mgzn" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <label for="magshelf">MagazineShelf:</label>
        <input type="text" name="magshelf" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>

         <label for="gen">Genre:</label>
        <input type="text" name="gen" value="<?php echo isset($g) ? $g : ''; ?>">
        <br><br>

        <label for="pub">Publisher:</label>
        <input type="text" name="pub" value="<?php echo isset($h) ? $h : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form></center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $VolNo = $_POST['volvo'];
    $Mname = $_POST['magname'];
    $Magazine = $_POST['mgzn'];
    $MagazineShelf = $_POST['magshelf'];
    $Genre = $_POST['gen'];
    $Publisher = $_POST['pub'];
   //magazine(MagID, VolNo, Mname, Magazine, MagazineShelf, Genre, Publisher
    // Update the magazine in the database
    $stmt = $connection->prepare("UPDATE magazine SET VolNo=?, Mname=?, Magazine=?, MagazineShelf=?, Genre=?, Publisher=? WHERE MagID=?");
    $stmt->bind_param("ssssssi",$VolNo, $Mname, $Magazine, $MagazineShelf, $Genre, $Publisher, $magid);
    $stmt->execute();
    
    // Redirect to magazine.php
    header('Location: magazine.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
