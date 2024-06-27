<?php
session_start();
require "includes/header.php";
require "config/config.php";

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Assuming payment is confirmed, replace with your payment confirmation logic
    $payment_confirmed = true;

    if($payment_confirmed) {
        // Retrieve current cart items for the logged-in user
        $select = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
        $select->execute([$user_id]);
        $cartItems = $select->fetchAll(PDO::FETCH_OBJ);

        if(count($cartItems) > 0) {
            // Prepare the zip file for download
            $zipname = 'bookstore.zip';
            $zip = new ZipArchive;
            $zip->open($zipname, ZipArchive::CREATE);

            // Add each cart item's file to the zip archive
            foreach ($cartItems as $item) {
                // Assuming the file path is 'books/' + $item->pro_file
                $file_path = 'books/' . $item->pro_file;
                if(file_exists($file_path)) {
                    $zip->addFile($file_path, basename($file_path));
                } else {
                    echo "File not found: $file_path";
                }
            }
            $zip->close();

            // Set headers to initiate file download
            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename='.$zipname);
            readfile($zipname);

            // Optionally delete items from the cart after successful download
            $delete = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
            $delete->execute([$user_id]);
        } else {
            echo "Cart is empty.";
        }
    } else {
        echo "Payment not confirmed.";
    }
} else {
    echo "User not logged in.";
}
?>
