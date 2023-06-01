<?php
include("config.php");

$limit = 20;
$page_number = isset($_GET['page']) ? $_GET['page'] : 1;
$initial_page = ($page_number - 1) * $limit;

$sql = "SELECT product.id, images.id, images.p_path
        FROM product
        INNER JOIN images
        ON product.id = images.Inv_id;";

// $image = $_FILES['images.p_path'];

$result = mysqli_query($con, $sql);


$sql = "SELECT * FROM product LIMIT $initial_page, $limit";

if ($result === false) {
    // Query execution failed, handle the error
    echo "Error: " . mysqli_error($con);
    // You may also consider redirecting the user or showing a user-friendly error message
} else {

    $total_rows = mysqli_num_rows($result);
    $total_pages = ceil($total_rows / $limit);
}



$result = mysqli_query($con, $sql);

$sql = "SELECT p_path, inv_id FROM images";

$i_result = mysqli_query($con, $sql);

$image = array();

while ($row1 = $i_result->fetch_assoc()) {
    $pid = $row1["inv_id"];
    $imagePath = $row1["p_path"];
    $image[$pid][] = $imagePath;
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Test</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet/app.bundle.css">
    <link rel="stylesheet" href="stylesheet/vendors.bundle.css">

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>


        <div class="container">
            <h2>Product</h2>
            <a class="btn btn-info" href="index1.php">Create</a>
            <?php
            include("csv.php");
            ?>
            <button class="btn btn-info" id="myBtn">Upload Csv File</button>

            <!-- The Modal -->
            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <table>
                        <form action="" method="post" enctype="multipart/form-data">
                            <th>
                                <div>
                                    <input class="btn btn-info" value="Only csv!!" type="file" name="csv_file"
                                        accept=".csv" required>
                                </div>
                            </th>
                            <th>
                                <div>
                                    <button class="btn btn-info" type="submit" name="upload">Upload</button>
                                </div>
                            </th>
                        </form>
                    </table>
                </div>

            </div>
        </div>
        <!-- <a class="btn btn-info" href="csv.php" type="file" >Import only CSV</a> -->
        <table class="table" id="product">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Reserved</th>
                    <th>Sold</th>
                    <th>Available Stock</th>
                    <th>Summary</th>
                    <th>Picture</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['item_name'] . '</td>';
                        echo '<td>' . $row['price'] . '</td>';
                        echo '<td>' . $row['reserved'] . '</td>';
                        echo '<td>' . $row['sold'] . '</td>';
                        echo '<td>' . $row['available_stock'] . '</td>';
                        echo '<td>' . $row['summary'] . '</td>';
                        ?>
                        <td>
                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="frame-wrap">
                                        <button type="button" class="btn btn-lg btn-default" data-toggle="modal"
                                            data-target="#example-modal-fullscreen-<?= $row['id'] ?>">Modal Fullscreen</button>
                                    </div>
                                    <?php
                                    if (isset($image[$row['id']])) {
                                        $slides = $image[$row['id']]; // Get the slides array
                                        ?>
                                        <!-- Fullscreen Modal -->
                                        <div class="modal fade modal-fullscreen" id="example-modal-fullscreen-<?= $row['id'] ?>"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content h-100 border-0 shadow-0 bg-fusion-800">
                                                    <button type="button"
                                                        class="close p-sm-2 p-md-4 text-white fs-xxl position-absolute pos-right mr-sm-2 mt-sm-1 z-index-space"
                                                        data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                    </button>
                                                    <div class="modal-body p-0">
                                                        <div id="example-carousel-fullscreen-<?= $row['id'] ?>"
                                                            class="carousel slide" data-ride="carousel">
                                                            <ol class="carousel-indicators">
                                                                <?php
                                                                foreach ($slides as $index => $slide) {
                                                                    $activeClass = ($index === 0) ? 'active' : '';
                                                                    ?>
                                                                    <li data-target="#example-carousel-fullscreen-<?= $row['id'] ?>"
                                                                        data-slide-to="<?= $index ?>" class="<?= $activeClass ?>"></li>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </ol>
                                                            <div class="carousel-inner">
                                                                <?php
                                                                foreach ($slides as $index => $slide) {
                                                                    $activeClass = ($index === 0) ? 'active' : '';
                                                                    ?>
                                                                    <div class="carousel-item <?= $activeClass ?>">
                                                                        <img class="d-block w-100" src="<?= $slide ?>"
                                                                            style="width: 100%" alt="Slide <?= $index + 1 ?>">
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <a class="carousel-control-prev"
                                                                href="#example-carousel-fullscreen-<?= $row['id'] ?>" role="button"
                                                                data-slide="prev">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                <span class="sr-only">Previous</span>
                                                            </a>
                                                            <a class="carousel-control-next"
                                                                href="#example-carousel-fullscreen-<?= $row['id'] ?>" role="button"
                                                                data-slide="next">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                <span class="sr-only">Next</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </td>
                        <?php
                        echo '<td> 
                            <a class="btn btn-info" href="update.php?id=' . $row['id'] . '">Edit</a>
                            <a class="btn btn-danger" href="delete.php?id=' . $row['id'] . '">Delete</a>
                            </td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
        // $result = mysqli_stmt_insert_id($con);
        if ($total_pages > 1) {
            echo '<div class="pagination">';

            // Display "Previous" button
            if ($page_number > 1) {
                echo '<a class="btn btn-primary" href="view.php?page=' . ($page_number - 1) . '">Previous</a>';
            }

            // Calculate start and end page for the buttons
            $start_page = max(1, $page_number - 2);
            $end_page = min($start_page + 6, $total_pages);

            // Display pagination buttons
            for ($page = $start_page; $page <= $end_page; $page++) {
                $active = ($page == $page_number) ? ' active' : '';
                echo '<a class="btn btn-primary' . $active . '" href="view.php?page=' . $page . '">' . $page . '</a>';
            }

            // Display "Next" button
            if ($page_number < $total_pages) {
                echo '<a class="btn btn-primary" href="view.php?page=' . ($page_number + 1) . '">Next</a>';
            }

            // Display the last button
            echo '<a class="btn btn-primary" href="view.php?page=' . $total_pages . '">Last</a>';

            echo '</div>';
        }
        ?>
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
<script src="js/app.bundle.js"></script>
<script src="js/vendors.bundle.js"></script>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</html>