<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 

if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $udate = $conn->prepare("DELETE FROM cart WHERE id='$id'");

    $udate->execute();
}

?>

<?php require "../includes/footer.php"; ?>