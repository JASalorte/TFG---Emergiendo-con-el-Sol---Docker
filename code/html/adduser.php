<?php
/* * * begin the session ** */
session_start();

/* Instrucciones para poner la restricción de login */

/* Comentar desde aquí */
session_start();
if (!isset($_SESSION['user_id'])) {
    $valid = false;
} else {
    $valid = true;
}
/* Hasta aquí */

/* Descomentar desde aquí */
/* if (!isset($_SESSION['user_id'])) {
  $message = 'You must be logged in to access this page';

  $valid = false;
  } else {
  try {
  require './mysqlData.php';

  $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $dbh->prepare("SELECT username FROM users WHERE id = :id");

  $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);

  $stmt->execute();

  $username = $stmt->fetchColumn();

  $valid = false;
  if ($username == false) {
  $message = 'Access Error';
  } else {
  $message = 'Welcome ' . $username;
  $valid = true;
  }
  } catch (Exception $e) {
  $message = 'We are unable to process your request. Please try again later"';
  }
  } */

/* Hasta aquí */
/* Fin de la instrucciones */

/* * * set a form token ** */
$form_token = md5(uniqid('auth', true));

/* * * set the session form token ** */
$_SESSION['form_token'] = $form_token;
?>



<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">


        <title>Emergiendo con el sol - Añadir Administrador</title>


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

    </head>



    <body>
        <?php if ($valid === TRUE): ?>
            <div id="wrapper">
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
                                <li><a href="#"><i class="fa fa-user fa-fw"></i> Añadir administrador</a>
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

                <div class="page-wrapper">
                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-4" >
                            <h1 class="page-header" style="margin-top: 10px; margin-bottom: 5px; padding-bottom: 0px;">Añadir Administrador</h1>
                        </div>
                    </div>
                    <div  class="row">
                        <div id="mainPanel" class="col-lg-2 col-lg-offset-5">
                            <div class="panel panel-default">
                                <div class="panel-heading" >

                                    <form action="adduser_submit.php" method="post">
                                        <fieldset>
                                            <p>
                                                <label for="username">Username</label>
                                                <input type="text" id="username" name="username" value="" maxlength="20" />
                                            </p>
                                            <p>
                                                <label for="password">Password</label>
                                                <input type="password" id="password" name="password" value="" maxlength="20" />
                                            </p>
                                            <p>
                                                <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
                                                <input type="submit" value="Crear" />
                                            </p>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php header("HTTP/1.0 404 Not Found"); ?>
            <?php endif; ?>
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
