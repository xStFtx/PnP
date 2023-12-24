<?php
if(isset($_POST['submit'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

        // Calling the Python script for image classification
        $command = escapeshellcmd("python main.py " . escapeshellarg($target_file));
        $output = shell_exec($command);
        echo "Classification Result: " . $output;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
