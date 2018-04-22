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


        /* $id = $nombre = $edificio = $dependencia = $sector = $servicio = $departamento = $email = $telefono = $movil = "";
          $espacio = $node = $startdate = $enddate = $eventdate = $event = $observaciones = $num_per_mesa_presi = $botellas = $site = "";
         */
        $error = "";

        if (empty($_POST["name"])) {
            $error = $error . "No ha introducido un nombre para la central.<br>";
        } else {
            if (!preg_match("/^[a-z0-9 .\-áéíóúÁÉÍÓÚ.,-]+$/i", test_input($_POST["name"]))) {
                $error = $error . "Solo se admiten letras, números y espacios en el nombre de la central.<br>";
            } else {
                $arrayPost['name'] = test_input($_POST["name"]);
            }
        }

        if (empty($_POST["power"])) {
            $error = $error . "No ha introducido una potencia STC de la central.<br>";
        } else {
            $arrayPost['power'] = test_input($_POST["power"]);
        }

        if (empty($_POST["inversor"])) {
            $error = $error . "No ha introducido la potencia del inversor de la central.<br>";
        } else {
            $arrayPost['inversor'] = test_input($_POST["inversor"]);
        }

        if (empty($_POST["interval"])) {
            $error = $error . "No ha introducido un intervalo para los datos.<br>";
        } else {
            $arrayPost['interval'] = test_input($_POST["interval"]);
            if ($arrayPost['interval'] <= 0) {
                $error = $error . "El intervalo tiene que ser mayor que 0.<br>";
            }
        }






        if ($error === "") {
            $string = file_get_contents("JSON/centrals.json");
            $json = json_decode($string, TRUE);
            if (empty($json[$arrayPost['name']])) {
                $temporary = explode(".", $_FILES["file"]["name"]);
                $file_extension = end($temporary);

                if ((($_FILES["file"]["type"] == "image/png") ||
                        ($_FILES["file"]["type"] == "image/jpg") ||
                        ($_FILES["file"]["type"] == "image/jpeg")) &&
                        ($_FILES["file"]["size"] < 200000)//approx. 100kb files can be uploaded
                ) {
                    if ($_FILES["file"]["error"] > 0) {
                        $error = $error . "Error con la imagen: " . $_FILES["file"]["error"] . "<br>";
                    } else {
                        $filefullname = $arrayPost['name'] . "." . $file_extension;
                        /*if (file_exists("Image/" . $filefullname)) {
                            $error = $error . "Esa imagen ya existe.<br>";
                        } else {*/
                            if (!move_uploaded_file($_FILES["file"]["tmp_name"], "Image/" . $filefullname)) {
                                $error = $error . "No se ha podido subir la foto.<br>";
                            }
                        //}
                    }
                } else {
                    if ($_FILES["file"]["size"] != 0){
                        if ($_FILES["file"]["size"] < 200000) {
                            $error = $error . "La imagen pesa demasiado. <br>";
                        } else {
                            $error = $error . "Tipo de imagen no permitido. <br>";
                        }
                    }else{
                        $filefullname = "null";
                    }
                }

                if ($error === "") {
                    //Aqui va el cambio de JSON
                    $json[$arrayPost['name']] = array("Nombre" => $arrayPost['name'], "Potencia GFV" => $arrayPost['power'], "Potencia Inversor" => $arrayPost['inversor'], "Image" => $filefullname);
                    $json = json_encode($json);
                    file_put_contents("JSON/centrals.json", $json);

                    $string = file_get_contents("JSON/Main.conf");
                    $string = explode(PHP_EOL, $string);
                    //array_pop($string);

                    $newUsers = intval(substr($string[10], 20)) + 1;

                    $string[10] = "Número de usuarios:" . $newUsers;

                    if ($newUsers < 10) {
                        $newUsers = "000" . $newUsers;
                    } else
                    if ($newUsers < 100) {
                        $newUsers = "00" . $newUsers;
                    } else
                    if ($newUsers < 1000) {
                        $newUsers = "0" . $newUsers;
                    }
                    //print_r($string);
                    array_push($string, "Usuario:user" . $newUsers);
                    array_push($string, "Central:" . $arrayPost['name']);
                    $string = implode(PHP_EOL, $string);

                    //print_r($string);
                    file_put_contents("JSON/Main.conf", $string);

                    require './mysqlData.php';

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "INSERT INTO central VALUES (NULL, '" . $arrayPost['name'] . "'," . $arrayPost['power'] . "," . $arrayPost['inversor'] . "," . $arrayPost['interval'] . ");";
                    $conn->query($sql);
                    $success = "La central ha sido introducida correctamente.";
                    echo "<script>console.log(\"Hemos llegado bien.\");</script>";
                }
            }
        } else {
            echo "<script>console.log(\"$error\");</script>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Emergiendo con el sol - Añadir Central</title>


        <style>
            #page-wrapper{
                margin: 0 !important;
            }
            .navbar-brand2 {
                //float: left;
                font-variant: small-caps;
                color: #777;
                height: 90px;
                text-shadow: 2px 2px 1px lightgray;
                font-size: 26px;
                font-weight: bold;
                padding-top: 5px;
                //font-size: 18px;
                line-height: 20px;
            }
            .tableValidate {
                width: 100%;
                display: table;
                margin-bottom: 5px;
            }
            label {
                float: left
            }
            span {
                display: block;
                overflow: hidden;
                padding: 0 4px 0 6px
            }
            input {
                width: 100%
            }
            .list-group-item {
                position: relative;
                display: block;
                padding: 10px 15px;
                margin-bottom: -1px;
                background-color: #fff;
                border: 1px solid #ddd;
            }
        </style>
        <!-- Bootstrap Core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap Core CSS -->
        <!--<link rel="stylesheet" type="text/css" href="../bower_components/datapicker/jquery.ui.datepicker-style.css">-->
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">



        <!-- MetisMenu CSS -->
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

                <!-- /.navbar-header -->
                <ul class="nav navbar-top-links navbar-left">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index.php"><img src="Image/logo.gif"  alt="Ujaen" height="70" width="154" style="margin: 8px; margin-left: 30px"></a>
                    <a class="navbar-brand2" href="index.php">Emergiendo con el Sol</a>

                </ul>


                <ul class="nav navbar-top-links navbar-right">




                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="centralAdmin.php"><i class="fa fa-gear fa-fw"></i> Gestionar centrales</a>
                            </li>
                            <li><a href="#"><i class="fa fa-edit fa-fw"></i> Añadir central</a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="adduser.php"><i class="fa fa-user fa-fw"></i> Añadir administrador</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#" onclick="logout()" ><i class="fa fa-sign-out fa-fw"></i> Cerrar sesión</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <img src="Image/JuntaDeAndalucia.jpg" alt="Ujaen" height="90" width="356">
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4" >
                        <h1 class="page-header" style="margin-top: 10px; margin-bottom: 5px; padding-bottom: 0px;">Añadir central</h1>
                    </div>
                </div>
                <div  class="row">
                    <div id="mainPanel" class="col-lg-4 col-lg-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-heading" >
                                <?php
                                /* $string = file_get_contents("JSON/centrals.json");
                                  $json = json_decode($string, TRUE);
                                  //$json["Jaén"] = array("Nombre" => "Jaén city", "Potencia GFV" => 3.0, "Potencia Inversor" => 3, "Image" => "ujaen.GIF");

                                  $json = json_encode($json);
                                  echo $json;
                                  file_put_contents("JSON/centrals.json", $json); */
                                echo $error;
                                echo $success;
                                ?>

                                <?php if ($valid): ?>  
                                    <form id="reserveForm" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                        <div class="list-group-item">

                                            <table class="tableValidate">
                                                <tr>
                                                    <td>
                                                        <div id="inner">
                                                            <label>
                                                                <?php echo "Nombre central: "; ?>
                                                            </label>
                                                            <span><input class="inputBold inputfillspace" type = "text" name = "name"></span>
                                                        </div>  
                                                    </td>
                                                </tr>
                                            </table>

                                            <table class="tableValidate">
                                                <tr>
                                                    <td>
                                                        <div id="inner">
                                                            <label>
                                                                <?php echo "Potencia del GFV en STC (kWp): " ?>
                                                            </label>
                                                            <span>
                                                                <input class="inputBold inputfillspace" type="number" step="0.01" name = "power">
                                                            </span>  
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>

                                            <table class="tableValidate">
                                                <tr>
                                                    <td>
                                                        <div id="inner">
                                                            <label>
                                                                <?php echo "Potencia del Inversor (kVA): " ?>
                                                            </label>
                                                            <span>
                                                                <input class="inputBold inputfillspace" type = "number" step="0.01" name = "inversor">
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>

                                            <table class="tableValidate">
                                                <tr>
                                                    <td>
                                                        <div id="inner">
                                                            <label>
                                                                <?php echo "Segundos entre datos: " ?>
                                                            </label>
                                                            <span>
                                                                <input class="inputBold inputfillspace" type = "number" name = "interval">
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>  

                                            <table class="tableValidate">
                                                <tr>
                                                    <td>
                                                        <div id="inner">
                                                            <label>
                                                                <?php echo "Logo: " ?>
                                                            </label>
                                                            <span>
                                                                <input class="inputBold inputfillspace" type = "file" name = "file">
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>    
                                        </div>
                                        <div class="list-group-item">
                                            <table style="width: 100%">
                                                <tr>
                                                    <td>
                                                        <input type='submit' id="accept" value='Introducir central'>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </form>
                                <?php else: ?>
                                    <p>Tienes que estar logeado para ver esta página.</p> <a href="login.php">Iniciar sesión</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- /#wrapper -->
                <footer class="footer">
                    <div class="container text-center" >
                        <p class="text-muted">Desarrollado por <strong>Jesús Alberto Salazar Ortega</strong> en colaboración con: </p>

                        <img src="Image/GrupoIDEA.jpg" width="50" height="80" style="margin-right: 80px;">
                        <img src="Image/CER.jpg" width="100" height="60" style="margin-right: 80px;">
                        <img src="Image/simidat.png" width="100" height="60" >

                    </div>
                </footer>
            </div>

            <!-- jQuery -->
            <!--<script src="../bower_components/jquery/dist/jquery.min.js"></script>-->
            <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

            <!-- Metis Menu Plugin JavaScript -->
            <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

            <!-- Custom Theme JavaScript -->
            <script src="../dist/js/sb-admin-2.js"></script>

            <script type="text/javascript">

                                function logout() {
                                    $.get("logout.php");
                                    document.location.href = "login.php";
                                    //parent.window.location.reload();
                                    return false;
                                }
            </script>



    </body>

</html>
