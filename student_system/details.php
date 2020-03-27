<?php

if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['Access']) && $_SESSION['Access'] == "admin"){

    echo "<div class='message success'>Welcome ".$_SESSION['UserLogin']."</div><br/><br/>";

}else{
    echo header("Location: index.php");
}

include_once("connections/connection.php");

$con = connection();

$id = $_GET['ID'];

$sql = "SELECT * FROM student_list WHERE id = '$id'";
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

    <div class="wrapper">
        <form action="delete.php" method="post">
            <div class="button-container">
                <a href="index.php">Back</a>
                <a href="edit.php?ID=<?php echo $row['id'];?>">Edit</a>

                <?php if($_SESSION['Access'] == "admin"){?>
                <button type="submit" name="delete" class="button-danger">Delete</button>
                <?php }?>
            </div>

            <input type="hidden" name="ID" value="<?php echo $row['id'];?>">

        </form>

        <br/>

        <h2><?php echo $row['first_name']?> <?php echo $row['last_name']?></h2>
        <p>is a <?php echo $row['gender'];?></p>
    </div>


</body>
</html>