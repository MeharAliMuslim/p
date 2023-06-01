
<?php
require "config.php";

if (isset($_POST['upload'])) {
    $file = $_FILES['csv_file']['tmp_name'];

    if ($_FILES['csv_file']['error'] == 0 && !empty($file)) {
        $handle = fopen($file, "r");

        if ($handle !== false) {
            $batchSize = 1000; // Number of records to insert per batch
            $rowCount = 0;
            $batchCount = 0;

            while (($data = fgetcsv($handle)) !== false) {
                // Process CSV data and prepare SQL query

                $record = [
                    // Map CSV fields to database table columns
                    'item_name' => $data[0],
                    'price' => $data[1],
                    'purchased_date' => $data[2],
                    'reserved' => $data[3],
                    'sold' => $data[4],
                    'available_stock' => $data[5],
                    'summary' => $data[6],
                    'image' => $data[7],
                    
                    // Add more fields as needed
                ];

                // Build the SQL query
                $values[] = "('" . implode("', '", $record) . "')";

                $rowCount++;

                if ($rowCount % $batchSize === 0) {
                    // Insert batch of records
                    $sql = "INSERT INTO product (item_name, price, purchased_date, reserved, sold, available_stock, summary, image) VALUES " . implode(', ', $values);

                    // Execute the query
                    mysqli_query($con, $sql);

                    // Reset variables
                    $values = [];
                    $batchCount++;

                    echo "Inserted $rowCount records in batch $batchCount.<br>";
                }
            }

            // Insert the remaining records
            if (!empty($values)) {
                $sql = "INSERT INTO product (item_name, price, purchased_date, reserved, sold, available_stock, summary, image) VALUES " . implode(', ', $values);

                mysqli_query($con, $sql);

                $batchCount++;

                echo "Inserted $rowCount records in batch $batchCount.<br>";
            }

            fclose($handle);

            echo "CSV file has been successfully uploaded and records have been inserted.";
        } else {
            echo "Failed to open the CSV file.";
        }
    } else {
        echo "Error uploading the CSV file.";
    }
}
?>

<div style = "display:none">
    <h2>CSV File Upload</h2>
<form action="csv.php" method="post" enctype="multipart/form-data">
    <input type="file" id="abc" name="csv_file">
    <input type="submit" name="upload" value="Upload">
</form>
</div>
