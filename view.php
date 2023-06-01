<?php
include("config.php");

$limit = 20;
$page_number = isset($_GET['page']) ? $_GET['page'] : 1;
$initial_page = ($page_number - 1) * $limit;

$sql = "SELECT * FROM product";
$result = mysqli_query($con, $sql);
$total_rows = mysqli_num_rows($result);
$total_pages = ceil($total_rows / $limit);

$sql = "SELECT * FROM product LIMIT $initial_page, $limit";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Page</title>
    <link rel="stylesheet" href="stylesheet/view_style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="container">
        <h2>Product</h2>
        <a class="btn btn-info" href="index1.php">Create</a>
        <?php
        include("csv.php");
        ?>
        <button id="myBtn">Open Modal</button>

        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <p><input type="file"></p>
            </div>

        </div>

        <label class="btn btn-info" for="abc">Import Csv File </label>
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
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['item_name'] . '</td>';
                    echo '<td>' . $row['price'] . '</td>';
                    echo '<td>' . $row['reserved'] . '</td>';
                    echo '<td>' . $row['sold'] . '</td>';
                    echo '<td>' . $row['available_stock'] . '</td>';
                    echo '<td>' . $row['summary'] . '</td>';
                    echo '<td><img style="width: 240px; height: 120px; border: 1px solid black" src="' . $row['image'] . '"></td>';
                    echo '<td>
                    <a class="btn btn-info" href="update.php?id=' . $row['id'] . '">Edit</a>
                    <a class="btn btn-danger" href="delete.php?id=' . $row['id'] . '">Delete</a>
                </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <?php
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
</body>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
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

</html>`