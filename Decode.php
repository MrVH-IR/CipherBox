<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decode Files</title>
    <link rel="stylesheet" href="Decode.css">
</head>
<body>
    <form action="decode.php" method="post" enctype="multipart/form-data">
        <h2>Upload Files for Decoding</h2>

        <label for="files">Select files to decode:</label><br>
        
        <input type="file" name="files[]" id="files" multiple accept=".txt,.pdf,.doc,.docx,.csv,.xml,.json,.html,.htm,.js,.css,.php"><br><br>

        <label for="save_path">Choose where to save decoded files:</label><br>
        <input type="text" name="save_path" id="save_path" placeholder="e.g., /path/to/save/"><br><br>

        <button type="submit">Upload and Decode</button>
    </form>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Getting Save Path
    $savePath = $_POST['save_path'];

    // Does The Save Path Exist ? !!
    if (!file_exists($savePath) || !is_dir($savePath)) {
        echo '<p class="error">Error: Invalid save path.</p>';
    } else {
        // Getting Key and IV
        $key = require 'C:/xampp/htdocs/CipherBox/key.php';
        $iv = require 'C:/xampp/htdocs/CipherBox/IV.php';

        // Decoding Files
        foreach ($_FILES['files']['tmp_name'] as $index => $tmpFilePath) {
            $originalFileName = basename($_FILES['files']['name'][$index]);

            // Reading File Content
            $data = file_get_contents($tmpFilePath);

            // Decoding Data With OpenSSL
            $decryptedData = openssl_decrypt($data, 'AES-128-CBC', $key, 0, $iv);

            if ($decryptedData === false) {
                echo '<p class="error">Decryption failed for file ' . htmlspecialchars($originalFileName) . '.</p>';
                continue;
            }

            // Decoded File Save Path
            $saveFilePath = rtrim($savePath, '/') . '/decoded_' . $originalFileName;

            // Save Decoded Data To The Selected Path
            if (file_put_contents($saveFilePath, $decryptedData)) {
                echo "File {$originalFileName} decoded and saved to {$saveFilePath}<br>";
            } else {
                echo '<p class="error">Failed to save the decoded file ' . htmlspecialchars($originalFileName) . '.</p>';
            }
        }
    }
} else {
    echo '<p class="error">No files uploaded.</p>';
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