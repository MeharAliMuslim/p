<?php
include("config.php");
$sql = "SELECT p_path, inv_id FROM images";

$i_result = mysqli_query($con, $sql);

$image = array();


while ($row1 = $i_result->fetch_assoc()) {
    $pid = $row1["inv_id"];
    $imagePath = $row1["p_path"];
    $image[$pid][] = $imagePath; 
}
if(isset($image[$row['id']])){
    for ($i=0; $i < count($image[$row['id']]); $i++) { 
   
   
        echo '<td><img height="50px" width="30" src="'. $image[$row['id']][$i].'"> </td>'; 
            
    }
}



'<div class="carousel-inner">
<div class="carousel-item">
    <img class="d-block w-100" src="image/1.png" alt="First slide">
    <div class="carousel-caption d-none d-md-block">
        <h5 class="color-white opacity-70">First slide label</h5>
        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
    </div>';
// echo"<pre>";
// print_r($image);
?>

<?php
// include("config.php");
// $sql = "SELECT p_path, inv_id FROM images";

// $i_result = mysqli_query($con, $sql);

// $image = array();

// while ($row1 = $i_result->fetch_assoc()) {
//     $pid = $row1["inv_id"];
//     $imagePath = $row1["p_path"];
//     $image[$pid][] = $imagePath; 
// }

// foreach ($image as $pid => $paths) {
//     foreach ($paths as $path) {
//         echo '<img src="'.$path.'">';
//     }
// }
?>


<button type="button" class="btn btn-default" data-toggle="modal" data-target="#default-example-modal-sm-center">Centered Small</button>

<div class="modal fade" id="default-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Modal title</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                            </button>
                                                        </div>



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
                                <input class="btn btn-info" value="Only csv!!" type="file" name="csv_file" accept=".csv"
                                    required>
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
        </div>