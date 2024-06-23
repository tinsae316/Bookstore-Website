<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php require "../vendor/autoload.php"; ?>

<?php 

/* at the top of 'check.php' */
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    /* 
       Up to you which header to send, some prefer 404 even if 
       the files does exist for security
    */
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die(header('location: '.APPURL.'' ));
}

    if (!isset($_SESSION['username'])){
        header("location: ".APPURL."");
    }


if (isset($_POST['email'])) {
    \Stripe\Stripe::setApiKey($secret_key);

    try {
        // Ensure price is an integer before multiplying
        $price = (int)$_SESSION['price'];

        $charge = \Stripe\Charge::create([
            'source' => $_POST['stripeToken'],
            'amount' => $price * 100, // Convert to cents
            'currency' => 'usd',
        ]);

        echo "paid"; // This should be printed after a successful charge

        if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['fname']) || empty($_POST['lname'])) {
            echo "<script>alert('one or more inputs are empty');</script>";
        } else {
            $email = $_POST["email"];
            $username = $_POST["username"];
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $token = $_POST['stripeToken'];
            $user_id = $_SESSION['user_id'];

            $insert = $conn->prepare("INSERT INTO orders (email, username, fname, lname, token, price, user_id) VALUES (:email, :username, :fname, :lname, :token, :price, :user_id)");

            $insert->execute([
                ':email' => $email,
                ':username' => $username,
                ':fname' => $fname,
                ':lname' => $lname,
                ':token' => $token,
                ':price' => $price,
                ':user_id' => $user_id,
            ]);   

            header("Location: " . APPURL . "/download.php");
            exit; // Make sure to exit after redirect to prevent further code execution
        }
    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Handle Stripe API errors
        echo 'Error: ' . $e->getMessage();
    } catch (Exception $e) {
        // Handle other errors
        echo 'Error: ' . $e->getMessage();
    }
}
?>
