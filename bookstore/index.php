<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>

<?php 
    $rows = $conn->query("SELECT * FROM product WHERE status = 1");
    $rows->execute();
    $allRows = $rows->fetchAll(PDO::FETCH_OBJ);
?>

<div class="row mt-5">
    <?php foreach($allRows as $product) : ?>
        <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1 mb-4"> <!-- Added mb-4 for margin-bottom -->
            <div class="card shadow-sm hover-card"> <!-- Added shadow-sm and hover-card class -->
                <img height="213px" class="card-img-top" src="images/<?php echo $product->image; ?>">
                <div class="card-body">
                    <h5 class="d-inline"><b><?php echo $product->name; ?></b></h5>
                    <h5 class="d-inline"><div class="text-muted d-inline"><?php echo $product->price; ?></div></h5>
                    <p><?php echo substr($product->description, 0, 120); ?></p>
                    <a href="<?php echo APPURL; ?>/shopping/single.php?id=<?php echo $product->id; ?>" class="btn btn-primary w-100 rounded my-2"> More <i class="fas fa-arrow-right"></i> </a>      
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require "includes/footer.php"; ?>

<!-- Custom CSS for hover effect -->
<style>
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3); /* Increased shadow */
    }
</style>
