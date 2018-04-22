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

$endDate = $startDate + 86400;

/* $startDate = $startDate - 600;
  $endDate = $endDate + 600; */

//$sql = "SELECT node, state FROM reserve_table WHERE plane = '$var2' AND (UNIX_TIMESTAMP('$var1') BETWEEN startdate AND enddate)";
//$sql = "SELECT * FROM data WHERE central = '$var2' AND (date >= $var1 AND date < $var3)";

/* $sql = "SELECT * "
  . "FROM ("
  . "SELECT * "
  . ", @rn := @rn + 1 AS rn "
  . "FROM data "
  . "join (SELECT @rn := 0) j"
  . ") k "
  . "WHERE central = '$var2' AND rn mod 40 = 0 AND (date >= $var1 AND date < $var3);"; */
//echo $sql;

$sql = "SELECT date FROM data WHERE central = '$central' AND date >= $endDate LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //Aqui vamos a calcular todo lo del día pasado
   /*$sql = "SELECT ROUND(AVG(var1),1) as \"Tension AC media\", 
        ROUND(SUM(var3/(60*(60/(86400/@total))))/1000,1) as \"Energia AC generada\", 
        ROUND(AVG(var6),1) as \"Frecuencia\",  
        ROUND(SUM(var12/(60*(60/(86400/@total))))/1000,1) as \"Energia DC generada\", 
        ROUND(SUM(var13/(60*(60/(86400/@total))))/1000,1) as \"Irradiación total\", 
        ROUND(AVG(var15),1) as \"Temp. ambiente media\", 
        SUM(var3/(60*(60/(86400/@total))))/1000 as \"EACG\", 
        SUM(var12/(60*(60/(86400/@total))))/1000 as \"EDCG\", 
        SUM(var13/(60*(60/(86400/@total))))/1000 as \"IT\" 
            FROM data JOIN(SELECT @total:=COUNT(*) FROM data WHERE central = '$central' AND date BETWEEN $startDate AND $endDate) r  
        WHERE central = '$central' 
            AND date BETWEEN $startDate AND $endDate;";*/
    $sql="SELECT ROUND(SUM(var1/(60*(60/(@intervale))))/1000,1) as \"Tension AC media\", 
ROUND(SUM(var3/(60*(60/(@intervale))))/1000,1) as \"Energia AC generada\", 
ROUND(AVG(var6),1) as \"Frecuencia\",  
ROUND(SUM(var12/(60*(60/(@intervale))))/1000,1) as \"Energia DC generada\", 
ROUND(SUM(var13/(60*(60/(@intervale))))/1000,1) as \"Irradiación total\", 
ROUND(AVG(var15),1) as \"Temp. ambiente media\", 
SUM(var3/(60*(60/(@intervale))))/1000 as \"EACG\", 
SUM(var12/(60*(60/(@intervale))))/1000 as \"EDCG\", 
SUM(var13/(60*(60/(@intervale))))/1000 as \"IT\" 
FROM data JOIN(SELECT @intervale:=time FROM central WHERE central='$central') r  
WHERE central = '$central' AND date BETWEEN $startDate AND $endDate;";
    
    
    
    
    
    //$return['lastValues'] = array("label" => $sql);
    $result = $conn->query($sql);
    
    //echo "<script>console.log('$sql');</script>";

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        //$row["Rendimiento Inversor"] = ($row["Energia AC generada"]/$row["Energia DC generada"]);
        $stats['stats'] = array("mode" => "previousDay", "data" => $row);
    }
    //$stats['stats'] = array("mode" => "previousDay", "data" => array());
} else {
    $sql = "SELECT var1 as v1, var2 as v2, var6 as v3, var10 as v4, var11 as v5, var15 as v6 FROM data WHERE date < $endDate AND central = '$central' ORDER BY date DESC LIMIT 1;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stats['stats'] = array("mode" => "lastDay", "data" => $row);
    }
}

$var1 = array();
$var2 = array();
$var3 = array();
$var4 = array();
//$var5 = array();
//$var6 = array();
//$var7 = array();
//$var8 = array();
//$var9 = array();
$var10 = array();
$var11 = array();
$var12 = array();
$var13 = array();
$var14 = array();
$var15 = array();

//$sql = "SELECT * FROM data WHERE central = '$central' AND date BETWEEN $startDate - 600 AND $startDate  ORDER BY date DESC LIMIT 1;";
/* $sql = "  SELECT ROUND(avg(var1),1) var1
  ,ROUND(avg(var2),1) var2
  ,ROUND(avg(var3),1) var3
  ,ROUND(avg(var4),1) var4
  ,ROUND(avg(var5),1) var5
  ,ROUND(avg(var6),1) var6
  ,ROUND(avg(var10),1) var10
  ,ROUND(avg(var11),1) var11
  ,ROUND(avg(var12),1) var12
  ,ROUND(avg(var13),1) var13
  ,ROUND(avg(var14),1) var14
  ,ROUND(avg(var15),1) var15
  FROM data
  WHERE `central` = '$central'
  AND `date` >= $startDate - 300
  AND `date` <= $startDate + 300;";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $javastart = intval($startDate) * 1000;
  array_push($var1, array($javastart, $row["var1"]));
  array_push($var2, array($javastart, $row["var2"]));
  array_push($var3, array($javastart, $row["var3"]));
  array_push($var4, array($javastart, $row["var4"]));
  //array_push($var5, array($row["date"], $row["var5"]));
  //array_push($var6, array($row["date"], $row["var6"]));
  //array_push($var7, array($row["date"], $row["var7"]));
  //array_push($var8, array($row["date"], $row["var8"]));
  //array_push($var9, array($row["date"], $row["var9"]));
  array_push($var10, array($javastart, $row["var10"]));
  array_push($var11, array($javastart, $row["var11"]));
  array_push($var12, array($javastart, $row["var12"]));
  array_push($var13, array($javastart, $row["var13"]));
  array_push($var14, array($javastart, $row["var14"]));
  array_push($var15, array($javastart, $row["var15"]));
  }else{
  $javastart = intval($startDate) * 1000;
  array_push($var1, array($javastart, 0));
  array_push($var2, array($javastart, 0));
  array_push($var3, array($javastart, 0));
  array_push($var4, array($javastart, 0));
  //array_push($var5, array($row["date"], $row["var5"]));
  //array_push($var6, array($row["date"], $row["var6"]));
  //array_push($var7, array($row["date"], $row["var7"]));
  //array_push($var8, array($row["date"], $row["var8"]));
  //array_push($var9, array($row["date"], $row["var9"]));
  array_push($var10, array($javastart, 0));
  array_push($var11, array($javastart, 0));
  array_push($var12, array($javastart, 0));
  array_push($var13, array($javastart, 0));
  array_push($var14, array($javastart, 0));
  array_push($var15, array($javastart, 0));
  } */



//Esta sentencia saca de la BBDD los datos para el día dado en intervalos de 10 minutos
/*$sql = "SELECT date, var1,var2,var3,var4,var5,var6,var10,var11,var12,var13,var14,var15 FROM 
  (SELECT CONCAT( DATE_FORMAT(from_unixtime(`date`), '%H'), ':', (10*FLOOR(minute(from_unixtime(`date`))/10))) dateQuarter
	 ,ROUND(AVG(`date`)) `date`
     ,ROUND(avg(var1),1) var1
	 ,ROUND(avg(var2),1) var2
	 ,ROUND(avg(var3),1) var3
	 ,ROUND(avg(var4),1) var4
	 ,ROUND(avg(var5),1) var5
	 ,ROUND(avg(var6),1) var6
	 ,ROUND(avg(var10),1) var10
	 ,ROUND(avg(var11),1) var11
	 ,ROUND(avg(var12),1) var12
	 ,ROUND(avg(var13),1) var13
	 ,ROUND(avg(var14),1) var14
	 ,ROUND(avg(var15),1) var15
  FROM data
    WHERE `central` = '$central'
    AND `date` >= $startDate
    AND `date` <= $endDate
  GROUP BY 1
  ) s
  ORDER BY date;";*/

//Esta sentencia saca de la BBDD los datos para el día dado en intervalos de 10 minutos
  $sql="SELECT date, var1,var2,var3,var4,var5,var6,var10,var11,var12,var13,var14,var15 FROM 
  (SELECT CONCAT( DATE_FORMAT(from_unixtime(`date`), '%H'), ':', (10*FLOOR(minute(from_unixtime(`date`))/10))) dateQuarter
	 ,ROUND(AVG(`date`)) `date`
     ,ROUND(SUM(var1)/(600/@intervale),1) var1
	 ,ROUND(SUM(var2)/(600/@intervale),1) var2
	 ,ROUND(SUM(var3)/(600/@intervale),1) var3
	 ,ROUND(SUM(var4)/(600/@intervale),1) var4
	 ,ROUND(SUM(var5)/(600/@intervale),1) var5
	 ,ROUND(SUM(var6)/(600/@intervale),1) var6
	 ,ROUND(SUM(var10)/(600/@intervale),1) var10
	 ,ROUND(SUM(var11)/(600/@intervale),1) var11
	 ,ROUND(SUM(var12)/(600/@intervale),1) var12
	 ,ROUND(SUM(var13)/(600/@intervale),1) var13
	 ,ROUND(SUM(var14)/(600/@intervale),1) var14
	 ,ROUND(SUM(var15)/(600/@intervale),1) var15
  FROM data JOIN(SELECT @intervale:=time FROM central WHERE central='$central') r 
    WHERE `central` = '$central'
    AND `date` >= $startDate
    AND `date` <= $endDate
  GROUP BY 1
  ) s
  ORDER BY date;";




//$sql = "SELECT * FROM data WHERE central = '$central' AND (date >= $startDate AND date < $endDate)";

 /*$sql = "SELECT date, var1,var2,var3,var4,var5,var6,var10,var11,var12,var13,var14,var15 FROM 
  (  SELECT CONCAT( DATE_FORMAT(from_unixtime(`date`), '%H'), ':', (10*FLOOR(DATE_FORMAT(from_unixtime(`date`), '%i')/10)) ) dateQuarter
  ,ROUND(MIN(date) + (MAX(date) - MIN(date))/2) date
  ,ROUND(avg(var1),1) var1
  ,ROUND(avg(var2),1) var2
  ,ROUND(avg(var3),1) var3
  ,ROUND(avg(var4),1) var4
  ,ROUND(avg(var5),1) var5
  ,ROUND(avg(var6),1) var6
  ,ROUND(avg(var10),1) var10
  ,ROUND(avg(var11),1) var11
  ,ROUND(avg(var12),1) var12
  ,ROUND(avg(var13),1) var13
  ,ROUND(avg(var14),1) var14
  ,ROUND(avg(var15),1) var15
  FROM data
  WHERE `central` = '$central'
  AND `date` >= $startDate
  AND `date` <= $endDate
  GROUP BY 1
  ) s
  ORDER BY date;";*/

//$sql = "SELECT * FROM (SELECT *, @i := @i + 1 AS i FROM data JOIN(SELECT @i:=0) r WHERE central = '$var2' AND (date >= $var1 AND date < $var3)) a WHERE MOD(a.i, 40) = 1;";
//SELECT * FROM (SELECT *, @i := @i + 1 AS i FROM data JOIN(SELECT @i:=0) r WHERE central = '$var2' AND (date >= $var1 AND date < $var3)) a WHERE MOD(a.i, 40) = 0;
//echo $sql;
$result = $conn->query($sql);



if ($result->num_rows > 0) {
    // output data of each row
    $i = 0;
    while ($row = $result->fetch_assoc()) {

        if ($i == 0) {
            $sdate = $startDate * 1000;
            array_push($var1, array($sdate, $row["var1"]));
            array_push($var2, array($sdate, $row["var2"]));
            array_push($var3, array($sdate, $row["var3"]));
            array_push($var4, array($sdate, $row["var4"]));
            array_push($var10, array($sdate, $row["var10"]));
            array_push($var11, array($sdate, $row["var11"]));
            array_push($var12, array($sdate, $row["var12"]));
            array_push($var13, array($sdate, $row["var13"]));
            array_push($var14, array($sdate, $row["var14"]));
            array_push($var15, array($sdate, $row["var15"]));
        }
        
        $row["date"] = $row["date"] * 1000;
        array_push($var1, array($row["date"], $row["var1"]));
        array_push($var2, array($row["date"], $row["var2"]));
        array_push($var3, array($row["date"], $row["var3"]));
        array_push($var4, array($row["date"], $row["var4"]));
        array_push($var10, array($row["date"], $row["var10"]));
        array_push($var11, array($row["date"], $row["var11"]));
        array_push($var12, array($row["date"], $row["var12"]));
        array_push($var13, array($row["date"], $row["var13"]));
        array_push($var14, array($row["date"], $row["var14"]));
        array_push($var15, array($row["date"], $row["var15"]));

        if ($i == ($result->num_rows - 1)) {
            if ($stats['stats']['mode'] === "previousDay") {
                $edate = ($endDate - 15) * 1000;
                array_push($var1, array($edate, $row["var1"]));
                array_push($var2, array($edate, $row["var2"]));
                array_push($var3, array($edate, $row["var3"]));
                array_push($var4, array($edate, $row["var4"]));
                array_push($var10, array($edate, $row["var10"]));
                array_push($var11, array($edate, $row["var11"]));
                array_push($var12, array($edate, $row["var12"]));
                array_push($var13, array($edate, $row["var13"]));
                array_push($var14, array($edate, $row["var14"]));
                array_push($var15, array($edate, $row["var15"]));
            }
        }

        $i++;
    }
}

/* $sql = "  SELECT ROUND(avg(var1),1) var1
  ,ROUND(avg(var2),1) var2
  ,ROUND(avg(var3),1) var3
  ,ROUND(avg(var4),1) var4
  ,ROUND(avg(var5),1) var5
  ,ROUND(avg(var6),1) var6
  ,ROUND(avg(var10),1) var10
  ,ROUND(avg(var11),1) var11
  ,ROUND(avg(var12),1) var12
  ,ROUND(avg(var13),1) var13
  ,ROUND(avg(var14),1) var14
  ,ROUND(avg(var15),1) var15
  FROM data
  WHERE `central` = '$central'
  AND `date` >= $endDate - 300
  AND `date` <= $endDate + 300;";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $javaend = intval($endDate-1) * 1000;
  array_push($var1, array($javaend, $row["var1"]));
  array_push($var2, array($javaend, $row["var2"]));
  array_push($var3, array($javaend, $row["var3"]));
  array_push($var4, array($javaend, $row["var4"]));
  //array_push($var5, array($row["date"], $row["var5"]));
  //array_push($var6, array($row["date"], $row["var6"]));
  //array_push($var7, array($row["date"], $row["var7"]));
  //array_push($var8, array($row["date"], $row["var8"]));
  //array_push($var9, array($row["date"], $row["var9"]));
  array_push($var10, array($javaend, $row["var10"]));
  array_push($var11, array($javaend, $row["var11"]));
  array_push($var12, array($javaend, $row["var12"]));
  array_push($var13, array($javaend, $row["var13"]));
  array_push($var14, array($javaend, $row["var14"]));
  array_push($var15, array($javaend, $row["var15"]));
  }else{
  $javastart = intval($endDate-1) * 1000;
  array_push($var1, array($javaend, 0));
  array_push($var2, array($javaend, 0));
  array_push($var3, array($javaend, 0));
  array_push($var4, array($javaend, 0));
  //array_push($var5, array($row["date"], $row["var5"]));
  //array_push($var6, array($row["date"], $row["var6"]));
  //array_push($var7, array($row["date"], $row["var7"]));
  //array_push($var8, array($row["date"], $row["var8"]));
  //array_push($var9, array($row["date"], $row["var9"]));
  array_push($var10, array($javaend, 0));
  array_push($var11, array($javaend, 0));
  array_push($var12, array($javaend, 0));
  array_push($var13, array($javaend, 0));
  array_push($var14, array($javaend, 0));
  array_push($var15, array($javaend, 0));
  } */

$return = array(
    "Irradiancia" => array("label" => "Irradiancia (W/m&sup2)", "data" => $var13, "yaxis" => 1),
    "Temp modulo" => array("label" => "Temp. módulo (ºC)", "data" => $var14, "yaxis" => 2),
    "Corriente DC" => array("label" => "Corriente DC (A)", "data" => $var11, "yaxis" => 4),
    "Tension DC" => array("label" => "Tensión DC (V)", "data" => $var10, "yaxis" => 3),
    "Potencia activa" => array("label" => "Potencia AC activa (W)", "data" => $var3, "yaxis" => 1),
    "Potencia AC" => array("label" => "Potencia AC aparente (VA)", "data" => $var4, "yaxis" => 1),
    "Potencia DC" => array("label" => "Potencia DC (W)", "data" => $var12, "yaxis" => 1),
    "Corriente AC" => array("label" => "Corriente AC (A)", "data" => $var2, "yaxis" => 4),
    "Tension AC" => array("label" => "Tensión AC (V)", "data" => $var1, "yaxis" => 3),
    "Temp ambiente" => array("label" => "Temp. ambiente (ºC)", "data" => $var15, "yaxis" => 2)
        //"Potencia reactiva" => array("label" => "Potencia reactiva (var)", "data" => $var5),
        //"Frecuencia" => array("label" => "Frecuencia (Hz)", "data" => $var6),
        //"Factor de potencia" => array("label" => "Factor de potencia", "data" => $var7),
        //"Energia total" => array("label" => "Energia total (kW h)", "data" => $var8),
        //"Energia parcial" => array("label" => "Energia parcial (kW h)", "data" => $var9),
);

if ($result->num_rows < 1) {
    $stats['stats'] = array("mode" => "emptyDay");
    echo json_encode(array("data" => $return, "stats" => $stats));
    exit();
}









echo json_encode(array("data" => $return, "stats" => $stats));

$conn->close();
?>