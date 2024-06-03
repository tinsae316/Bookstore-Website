<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 

if(isset($_POST['delete'])){

    $udate = $conn->prepare("DELETE FROM cart WHERE user_id='$_SESSION[user_id]'");

    $udate->execute();
}

?>

<?php require "../includes/footer.php"; ?>