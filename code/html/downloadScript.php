<?php

session_start();
if (isset($_SESSION['user_id'])) {

    $filename = htmlspecialchars($_GET["a"]);

    $dl_path = "/var/www/Installer"; // parent folder of this script
//$filename = 'test.txt';
    $file = $dl_path . "/" . $filename;

// Does the file exist?
    if (!is_file($file)) {
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        header("Status: 404 Not Found");
        echo 'File not found!';
        die;
    }

// Is it readable?
    if (!is_readable($file)) {
        header("{$_SERVER['SERVER_PROTOCOL']} 403 Forbidden");
        header("Status: 403 Forbidden");
        echo 'File not accessible!';
        die;
    }

// We are good to go!
    header('Content-Description: File Transfer');
    header('Content-Type: application/zip');
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/download");
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary ");
    header('Content-Length: ' . filesize($file));
    while (ob_get_level())
        ob_end_clean();
    flush();
    readfile($file);
    die;
}