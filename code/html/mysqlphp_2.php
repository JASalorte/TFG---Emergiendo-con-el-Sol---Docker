<?php

$startDate = $_POST['var1'];
$central = $_POST['var2'];




require './mysqlData.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT SUBSTRING(dateCompact,-2) as date, 
var1 as `Tension AC Media`, 
var2 as `Energia AC generada`,
var3 as `Frecuencia`,
var4 as `Energia DC generada`,
var5 as `Irradiacion total`,
var6 as `Temp. ambiente media`,
var7 as `EACG`,
var8 as `EDCG`,
var9 as `IT` 
FROM dataYear 
WHERE date BETWEEN $startDate AND UNIX_TIMESTAMP(FROM_UNIXTIME($startDate) + INTERVAL 1 YEAR) AND central = '$central';";

$result = $conn->query($sql);

$var1 = array();
$var2 = array();
$var3 = array();
$var4 = array();
$var5 = array();
$var6 = array();
$var7 = array();
$var8 = array();
$var9 = array();

$sql = "  SELECT date 
  FROM data 
    WHERE `central` = '$central'
    AND `date` > UNIX_TIMESTAMP(FROM_UNIXTIME($startDate) + INTERVAL 1 YEAR)
  LIMIT 1;";

$result2 = $conn->query($sql);


if ($result->num_rows> 0) {
    $i = 0;
    while ($result->num_rows - 1 > $i++ && $row = $result->fetch_assoc()) {
            array_push($var1, array($row["date"], $row["Tension AC Media"]));
            array_push($var2, array($row["date"], $row["Energia AC generada"]));
            array_push($var3, array($row["date"], $row["Frecuencia"]));
            array_push($var4, array($row["date"], $row["Energia DC generada"]));
            array_push($var5, array($row["date"], $row["Irradiacion total"]));
            array_push($var6, array($row["date"], $row["Temp. ambiente media"]));
            array_push($var7, array($row["date"], $row["EACG"]));
            array_push($var8, array($row["date"], $row["EDCG"]));
            array_push($var9, array($row["date"], $row["IT"]));
        }
    
}

if ($result2->num_rows === 1) {
    $row = $result->fetch_assoc();

    array_push($var1, array($row["date"], $row["Tension AC Media"]));
    array_push($var2, array($row["date"], $row["Energia AC generada"]));
    array_push($var3, array($row["date"], $row["Frecuencia"]));
    array_push($var4, array($row["date"], $row["Energia DC generada"]));
    array_push($var5, array($row["date"], $row["Irradiacion total"]));
    array_push($var6, array($row["date"], $row["Temp. ambiente media"]));
    array_push($var7, array($row["date"], $row["EACG"]));
    array_push($var8, array($row["date"], $row["EDCG"]));
    array_push($var9, array($row["date"], $row["IT"]));
}

$return = array(
    "Energia DC generada" => array("label" => "Energía DC generada (kWh)", "label2" => "Energía DC generada", "data" => $var4, "yaxis" => 1),
    "Energia AC generada" => array("label" => "Energía AC generada (kWh)", "label2" => "Energía AC generada", "data" => $var2, "yaxis" => 1),
    "Irradiacion diaria" => array("label" => "Irradiación diaria (kWh/m&sup2 dia)", "label2" => "Irradiación diaria", "data" => $var5, "yaxis" => 1),
    "Tension AC Media" => array("label" => "Tensión AC Media (V)", "label2" => "Tensión AC Media", "data" => $var1, "yaxis" => 2),
    "Frecuencia" => array("label" => "Frecuencia media (Hz)", "label2" => "Frecuencia media", "data" => $var3, "yaxis" => 3),
    "Temp. ambiente media" => array("label" => "Temp. ambiente media (ºC)", "label2" => "Temp. ambiente media", "data" => $var6, "yaxis" => 4)
);

$var = array(
    "EACG" => array("data" => $var7),
    "EDCG" => array("data" => $var8),
    "IT" => array("data" => $var9)
);




echo json_encode(array("data" => $return, "var" => $var));

$conn->close();
?>