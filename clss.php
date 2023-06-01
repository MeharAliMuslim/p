<?php
if (!in_array($extension, [ 'jpg']))
{
echo "
<script>alert('You file extension must be .jpg');</script>";
}
else {
// move the uploaded (temporary) file to the specified destination
if (move_uploaded_file($file, $destination)) {
$sql = "INSERT INTO imageformat (filename) VALUES ('$filename')";
if (mysqli_query($conn, $sql))
{
echo "
<script>alert('Image uploaded successfully');</script>";
} else {
echo "
<script>alert('Failed to upload file.');</script>";
}
}
}
?>