<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encode Files</title>
    <link rel="stylesheet" href="Encode.css">
</head>
<body>
    <h2>Upload Files for Encoding</h2>
    <form action="encode.php" method="post" enctype="multipart/form-data">
        <label for="files">Select files to encode:</label><br>
        <input type="file" name="files[]" id="files" multiple accept=".txt,.pdf,.doc,.docx,.csv,.xml,.json,.html,.htm,.js,.css,.php"><br><br>
        
        <label for="save_path">Choose where to save encoded files:</label><br>
        <input type="text" name="save_path" id="save_path" placeholder="e.g., /path/to/save/"><br><br>

        <button type="submit">Upload and Encode</button>
    </form>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Getting Key and IV
    $key = require('key.php');  // Path To Your Key.php File
    $iv = require('IV.php');    // Path To Your IV.php File

    // Getting Save Path
    $savePath = $_POST['save_path'];

    // Does The Save Path Exist ? !!
    if (!file_exists($savePath) || !is_dir($savePath)) {
        die('Invalid save path.');
    }

    // Processing Uploaded Files
    foreach ($_FILES['files']['tmp_name'] as $index => $tmpFilePath) {
        $originalFileName = basename($_FILES['files']['name'][$index]);

        // Reading The File....
        $data = file_get_contents($tmpFilePath);

        // Encode With OpenSSL
        $encryptedData = openssl_encrypt($data, 'AES-128-CBC', $key, 0, $iv);

        if ($encryptedData === false) {
            die('Encryption failed.');
        }

        // Path For Save File
        $saveFilePath = rtrim($savePath, '/') . '/encoded_' . $originalFileName;

        // Save The File
        if (file_put_contents($saveFilePath, $encryptedData)) {
            echo "File {$originalFileName} encoded and saved to {$saveFilePath}<br>";
        } else {
            echo "Failed to save the encoded file {$originalFileName}.<br>";
        }
    }
} else {
    echo "No files uploaded.";
}
?>

<!-- ******************************************************
     *            MRVH  9/19/2024                         *
     *          @ This Product Is Not For Sale            *
     *                                                    *
     *      %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%          *
     *      ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^          *
     *      ()()(())()(())(())()()()()()(())()(())        *
     *       Follow Github: https://github.com/MrVH-IR    *
     *                                                    *
     *                                                    *
     *        You Can Change Your IV And Key              *
     *         In Key.php And IV.php Files                *
     *          Remember IV Must Be 16 Bytes              *
     *                    Enjoy :)                        *
     *                                                    *
     *                                                    *
     *                                                    *
     *                                                    *
     *                                                    *
     *                                                    *
     *                                                    *
     *                                                    *
     *                                                    *
     *                                                    *
     *                                                    *
    ******************************************************* -->