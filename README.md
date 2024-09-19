# CipherBox
 CipherBox is a PHP-based web application for encoding and decoding files. The application uses OpenSSL for encryption and decryption, and it provides two main functionalities: encoding and decoding files in bulk.

Bulk Encoding: Upload multiple files to encode them using AES-128-CBC encryption.
Bulk Decoding: Upload multiple encoded files to decode them using AES-128-CBC decryption.
Customizable Paths: Specify where to save encoded and decoded files

PHP 8.2.12 or higher
OpenSSL PHP extension

Installation
Clone the repository
git clone https://github.com/MrVH-IR/CipherBox.git

Move to the project directory:
cd CipherBox

Set up the project:

Place your key.php and IV.php files in the C:/xampp/htdocs/CipherBox directory (or your project's root directory).
Make sure these files contain your encryption key and initialization vector (IV).
Start XAMPP and access the project:

Start Apache and MySQL from the XAMPP control panel.
Open your browser and navigate to http://localhost/CipherBox

Usage

Encoding Files
Navigate to the Encode page.
Select the files you want to encode.
Enter the path where you want to save the encoded files.
Click the Upload and Encode button.

Decoding Files
Navigate to the Decode page.
Select the encoded files you want to decode.
Enter the path where you want to save the decoded files.
Click the Upload and Decode button.

Security Considerations
Keep your key.php and IV.php files secure and private.
Ensure that the encryption key and IV are kept confidential.

Contributing
Feel free to fork the repository and submit pull requests. Contributions are welcome!

License
This project is licensed under the MIT License - see the LICENSE file for details.

Acknowledgements
Thanks to the OpenSSL project for providing the encryption tools used in this application.