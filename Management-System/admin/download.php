<?php
include ("../includes/config.php");
if (isset($_GET['id'])) {
    $fileId = $_GET['id'];

    // Fetching the file data from the database based on the file ID
    $query = "SELECT filename, filedata FROM library WHERE id = $fileId";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $filename = $row['filename'];
        $filedata = $row['filedata'];

        // Sending appropriate headers for download
        header("Content-Disposition: attachment; filename=\"$filename\"");
        echo $filedata;
    } else {
        echo "File not found.";
    }
}



if (isset($_GET['result_id'])) {
    $fileId = $_GET['result_id'];

    // Fetching the file data from the database based on the file ID
    $query = "SELECT filename, filedata FROM result WHERE result_id = $fileId";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $filename = $row['filename'];
        $filedata = $row['filedata'];

        // Sending appropriate headers for download
        header("Content-Disposition: attachment; filename=\"$filename\"");
        echo $filedata;
    } else {
        echo "File not found.";
    }
}
?>
?>