<?php
require "config.php";

if (isset($_POST['update'])) {
    $product_id = $_POST['id'];
    $_name = $con->real_escape_string($_POST['item_name']);
    $_price = $_POST['price'];
    $_pdate = $_POST['purchased_date'];
    $_reserved = $_POST['reserved'];
    $_sold = $_POST['sold'];
    $_available_stock = $_POST['available_stock'];
    $_summary = $_POST['summary'];
    $_image = $_FILES['image'];
    // print_r($_FILES);    
    // image move and update into database  

    // error_reporting(0);
    $filename = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $_image = ("image/" . $filename);
    move_uploaded_file($tempname, $_image);


    // update query

    $sql = "UPDATE product SET item_name='$_name', price='$_price', purchased_date='$_pdate', sold='$_sold', available_stock='$_available_stock', summary='$_summary', image='$_image' WHERE id='$product_id'";

    if (mysqli_query($con, $sql)) {
        // Redirect to a success page
        header("Location: view.php");
        exit();
    } else {
        echo "Error executing query: " . $con->error;
    }
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $sql = "SELECT * FROM `product` WHERE `id` = '$product_id'";

    $result = mysqli_query($con, $sql);



    if ($result === false) {
        echo "Error executing query: " . $con->error;
    } else {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_name = $row['item_name'];
                $_price = $row['price'];
                $_pdate = $row['purchased_date'];
                $_reserved = $row['reserved'];
                $_sold = $row['sold'];
                $_available_stock = $row['available_stock'];
                $_summary = $row['summary'];
                $_image = $row['image'];
                $id = $row['id'];
            }
        }




        ?>
        <!doctype html>
        <html lang="en">

        <head>
            <title>Title</title>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS v5.2.1 -->
            <link rel="stylesheet" href="stylesheet/update_style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

        </head>

        <body>
            <header>
                <!-- place navbar here -->
            </header>
            <main>

                <div class="form-body">
                    <div class="row">
                        <div class="form-holder">
                            <div class="form-content">
                                <div class="form-items">
                                    <div class="">
                                        <h3>Create Stock Form</h3>
                                        <p>Fill in the data below.</p>
                                    </div>
                                    <div>
                                        <div></div>
                                        <p></p>
                                        <div>
                                            <p>Item name:</p>
                                        </div>
                                        <div>
                                            <p>Price:</p>
                                        </div>
                                        <div>
                                            <p>Purchased date : </p>
                                        </div>
                                        <div>
                                            <p>Reserved:</p>
                                        </div>
                                        <div>
                                            <p>Sold:</p>
                                        </div>
                                        <div>
                                            <p>Number:</p>
                                        </div>
                                        <div>
                                            <p>Summary:</p>
                                        </div>
                                    </div>
                                    <div>
                                        <form action="http://localhost/inventory/view.php" enctype="multipart/form-data"
                                            method="POST">
                                            <div class="fp">
                                                <!-- Item Name: -->
                                                <input type="text" class="form-control" name="item_name"
                                                    value="<?php echo $_name; ?>">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            </div>
                                            <div class="fp">
                                                <!-- Price: -->
                                                <input type="number" class="form-control" name="price"
                                                    value="<?php echo $_price; ?>">
                                            </div>
                                            <div class="fp">
                                                <input class="form-control" type="date" name="purchased_date"
                                                    value="<?php echo $_pdate; ?>">
                                            </div>
                                            <div class="fp">
                                                <input class="form-control" type="number" name="reserved"
                                                    value="<?php echo $_reserved; ?>">
                                            </div>
                                            <div class="fp">
                                                <input class="form-control" type="number" name="sold"
                                                    value="<?php echo $_sold; ?>">
                                            </div>
                                            <div class="">
                                                <input class="form-control" type="number" name="available_stock"
                                                    value="<?php echo $_available_stock; ?>">
                                            </div>
                                            <div class="fp">
                                                <input class="form-control" type="text" name="summary"
                                                    value="<?php echo $_summary ?>">
                                            </div>
                                            <div class="fp">
                                                <input class="form-control" type="file" multiple name="image"
                                                    value="<?php echo $_image ?>">
                                            </div>
                                            <div class="fp">
                                                <button class="form-control" type="update" required
                                                    value="upload">Submit</button>
                                                <!-- end form -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





            </main>
            <footer>
                <!-- place footer here -->
            </footer>
            <!-- Bootstrap JavaScript Libraries -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
                integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
                </script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
                integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
                </script>
        </body>

        </html>
        <?php

    }
}









?>