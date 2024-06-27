<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 
    $select = $conn->query("SELECT * FROM categories");
    $select->execute();
    $categories = $select->fetchAll(PDO::FETCH_OBJ);
?>
<div class="row mt-5">
    <?php foreach ($categories as $category): ?>
        <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1 mb-4"> <!-- Added mb-4 for margin-bottom -->
            <div class="card shadow-sm hover-card"> <!-- Added shadow-sm and hover-card class -->
                <img height="213px" class="card-img-top" src="images/<?php echo $category->image; ?>">
                <div class="card-body">
                    <h5><b><?php echo $category->name; ?></b></h5>
                    <div class="d-flex flex-row my-2">
                        <div class="text-muted"><?php echo $category->description; ?></div>
                    </div> 
                    <a href="<?php echo APPURL; ?>/categories/single-category.php?id=<?php echo $category->id; ?>" class="btn btn-primary w-100 rounded my-2">Discover Products</a>      
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require "../includes/footer.php"; ?>

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
