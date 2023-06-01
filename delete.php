<?php

include "config.php";

if (isset($_GET['id'])) {

    $product_id = $_GET['id'];

    $sql = "DELETE FROM `product` WHERE `id`='$product_id'";

    $result = $con->query($sql);

    if ($result == TRUE) {

        echo "Record deleted successfully.";
        header("Location: view.php");
        exit();

    } else {

        echo "Error:" . $sql . "<br>" . $con->error;

    }

}

?>