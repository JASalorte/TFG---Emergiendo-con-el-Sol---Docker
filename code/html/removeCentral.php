<?php
/* * * begin the session ** */
session_start();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (!isset($_SESSION['user_id'])) {
    $message = 'You must be logged in to access this page';

    $valid = false;
} else {
    $valid = true;

    if ($valid && ($_SERVER["REQUEST_METHOD"] == "POST")) {
        $arrayPost = array();

        $arrayPost['centralID'] = test_input($_POST["var1"]);



        $string = file_get_contents("JSON/centrals.json");
        $json = json_decode($string, TRUE);

        if($json[$arrayPost['centralID']]["visible"] == "1"){
            $json[$arrayPost['centralID']]["visible"] = "0";
        }else{
            $json[$arrayPost['centralID']]["visible"] = "1";
        }
        
        $json = json_encode($json);
        file_put_contents("JSON/centrals.json", $json);


        echo "<script>console.log(\"Hemos llegado bien.\");</script>";
    }
}
?>