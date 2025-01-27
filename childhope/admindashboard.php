<?php

session_start();

if(!isset($_SESSION['email']))
{
    header("Location: login.html");
    exit();
}elseif($_SESSION['email']!="admin@fsktm.com")
{
    header("Location: login.html");
    exit();

}else{

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "childhope";

      // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      $sql = "SELECT name ,age , area , email , known_about, phone_number, volunteer FROM contactus;";
      $result = $conn->query($sql);

      
      
?>
<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>

<body class="bg-body-secondary">
    <div class="container mt-4 ">
        
        <?php 
        if (isset($_SESSION['email'])) {?>
            
            <h1>Current username Login <?php echo $_SESSION['email'] ?></h1>
            <?php } ?>

        <?php
        include('_navbar.php');
        ?> 
        <h2 class="mt-3">Users List</h2>
    <table border="1" class="table">

        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>phone_number</th>
            <th>known_about</th>
            <th>volunteer</th>
            <th>area</th>
            
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Fetch each row from the result set
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["age"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["phone_number"]; ?></td>
                    <td><?php echo $row["known_about"]; ?></td>
                    <td><?php echo $row["volunteer"]; ?></td>
                    <td><?php echo $row["area"]; ?></td>
                    
                </tr>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='3'>No users found</td></tr>";
        }
        // Close connection
        $conn->close();
        ?>
    </table>
</div>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>


<?php }

?>