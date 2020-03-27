<?php

if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['UserLogin'])){

    echo "<div class='message success'>Welcome ".$_SESSION['UserLogin'].'</div>';

}else{
    echo "<div class='message info'>Welcome Guest</div>";
}

include_once("connections/connection.php");

$con = connection();

$sql = "SELECT * FROM student_list ORDER BY id DESC";
$students = $con->query($sql) or die ($con->error);
$row = $students->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" type="" href="css/style.css">

</head>
<body>
    <br/>
    <h1>Student Management System</h1>
    <br/>
    <br/>

    <div class="wrapper">

        <div class="search-container">
            <form action="result.php" method="get">
                <input type="text" name="search" id="search" class="search-input">
                <button type="submit" class="search-button">search</button>
            </form>
        </div>

        <div class="button-container">
            <?php if(isset($_SESSION['UserLogin'])){?>
                <a href="logout.php">Logout</a>
            <?php }else{?>
                    <a href="login.php">Login</a>
            <?php }?>
            <a href="add.php">Add New</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
            </thead>
            
            <tbody>
            <?php do{ ?>
                <tr>
                    <td width="30"><a href="details.php?ID=<?php echo $row['id'];?>" class="button-small">view</a></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                </tr>
            <?php }while($row = $students->fetch_assoc()); ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>