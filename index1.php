<?php include 'config.php';

if (isset($_POST['item_name']) && isset($_FILES['image'])) {

    // variables declare 

    $_name = $_POST['item_name'];
    $_price = $_POST['price'];
    $_pdate = $_POST['purchased_date'];
    $_reserved = $_POST['reserved'];
    $_sold = $_POST['sold'];
    $_available_stock = $_POST['available_stock'];
    $_summary = $_POST['summary'];

    // image move and saving into database  

    $filename = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $targetDirectory = "image/";
    $targetPath = $targetDirectory . $filename;
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $allowTypes = array('jpg','png','jpeg','gif');

    // Check if the file extension is jpg
    if (!in_array($extension,$allowTypes)) {
        echo "<script>alert('Your file extension must be .jpg, PNG, jepg, gif');</script>";
    } else {
        // Create the target directory if it doesn't exist
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 07777, true);
        }

        // Move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($tempname, $targetPath)) {
            // Insert the file path into the database using prepared statement
            $stmt = $con->prepare("INSERT INTO `product` (`item_name`, `price`, `purchased_date`, `reserved`, `sold`, `available_stock`, `summary`, `image`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $_name, $_price, $_pdate, $_reserved, $_sold, $_available_stock, $_summary, $targetPath);

            if ($stmt->execute()) {
                echo "<script>alert('Image uploaded successfully');</script>";
            } else {
                echo "<script>alert('Failed to upload file.');</script>";
            }
            $stmt->close();
        }
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
    <link rel="stylesheet" href="stylesheet/index_style.css">
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
                            <h3>Create Stock Form</h3>
                            <p>Fill in the data below.</p>
                            <form method="POST" enctype="multipart/form-data"
                                action="http://localhost/inventory/index1.php">
                                <div class = "fp">
                                    
                                    <input class="form-control" type="text" required name="item_name"
                                        placeholder="Enter product name">
                                </div>
                                <div class = "fp">
                                    <input class="form-control" type="number" required name="price"
                                        placeholder="Enter Price">
                                </div>
                                <div class = "fp">
                                    <input class="form-control" type="date" required name="purchased_date"
                                        placeholder="Purchase Date">
                                </div>
                                <div class = "fp">
                                    <input class="form-control" type="number" required name="reserved"
                                        placeholder="Reserved">
                                </div>
                                <div class = "fp">
                                    <input class="form-control" type="number" required name="sold"
                                        placeholder="Sold">
                                </div>
                                <div class = "">
                                    <input class="form-control" type="number" required name="available_stock"
                                        placeholder="available_stock">
                                </div>
                                <div class = "fp">
                                    <input class="form-control" type="text" required name="summary"
                                        placeholder="Summary">
                                </div>
                                <div class = "fp">
                                    <input class="form-control" type="file" required name="image">
                                </div>
                                <div class = "fp">
                                    <button class="form-control" type="submit" required value="upload">Submit</button>
                                    <!-- end form -->
                                </div>
                            </form>
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