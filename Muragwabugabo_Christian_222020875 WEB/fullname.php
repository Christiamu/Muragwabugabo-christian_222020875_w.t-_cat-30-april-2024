<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;<!DOCTYPE html>

      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1300px; /* Adjust this value as needed */

      padding: 8px;
     
    }
  </style>
  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  
<header>
   

</head>

<body bgcolor="skyblue">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./Images/logo.jpg" width="90" height="60" alt="Logo">
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./HOME.html">HOME</a>
    <li style="display: inline; margin-right: 10px;"><a href="./ABOUT US.html">ABOUT US</a>
      <li style="display: inline; margin-right: 10px;"><a href="./CONTACT US.html">CONTACT US</a>
    <li style="display: inline; margin-right: 10px;"><a href="./books.php">Books</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./book_count.php">Book_count</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./fullname.php">fullname</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./issuedbook.php">Issuedbook</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./issuedmagazine.php">Issuedmagazine</a>
  </li>

  <li style="display: inline; margin-right: 10px;"><a href="./librarian.php">Librarian</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./magazine.php">Magazine</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./publisher.php">Publisher</a>
  </li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color:darkgreen; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>
<h1>Book_count</h1>

     <form method="post" onsubmit="return confirmInsert();">
        <label for="UserID">UserID:</label>
        <input type="number" id="UserID" name="UserID"><br><br>

        <label for="FirstName">FirstName:</label>
        <input type="text" id="FirstName" name="FirstName" required><br><br>

        <label for="LastName">LastName:</label>
        <input type="text" id="LastName" name="LastName" required><br><br>

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    // Connection details
    include('database-connection.php');


    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO fullname (UserID, FirstName,LastName) VALUES (?,?,?)");
        $stmt->bind_param("iss", $UserID, $FirstName,$LastName);

        // Set parameters from POST data with validation (optional)
        $UserID = intval($_POST['UserID']); // Ensure integer for ID
        $FirstName = htmlspecialchars($_POST['FirstName']); // Prevent XSS
        $LastName = htmlspecialchars($_POST['LastName']);
        
        // Execute prepared statement with error handling
        if ($stmt->execute()) {
            echo "New record has been added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $connection->close();
    ?>

<?php
// Connection details
include('database-connection.php');

// SQL query to fetch data from fullname table
$sql = "SELECT * FROM fullname";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of fullname</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of Fullname</h2></center>
    <table border="5">
        <tr>
         
            <th>UserID</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Define connection parameters
        include('database-connection.php');

        // Prepare SQL query to retrieve all fullname
        $sql = "SELECT * FROM fullname";
        $result = $connection->query($sql);

        // Check if there are any fullname
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $appid = $row['UserID']; // Fetch the fullname
                echo "<tr>
                    <td>" . $row['UserID'] . "</td>
                    <td>" . $row['FirstName'] . "</td>
                    <td>" . $row['LastName'] . "</td>
                    <td><a style='padding:4px' href='delete_fullname.php?UserID=$appid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_fullname.php?UserID=$appid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
  </body>
    </section>

  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 & reg, Designer by: @CHRISTIAN MURAGWABUGABO</h2></b>
  </center>
</footer>
</body>
</html>