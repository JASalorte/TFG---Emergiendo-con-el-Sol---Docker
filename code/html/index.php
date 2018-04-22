<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $valid = false;
} else {
    $valid = true;
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

        <title>Emergiendo con el sol - Página principal</title>


        <style>
            .ui-datepicker{ 
                z-index: 9999 !important;
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

            .panel-current{
                color: #3974B6;
                border-color: #3974B6;
                border: 2px solid ! important;
                margin-bottom: 3px ! important;    
                border-radius: 0px ! important;

            }

            .panel-small {
                //margin-bottom: 20px;
                background-color: #fff;
                //border: 1px solid transparent;
                //border-radius: 4px;
                -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
                box-shadow: 0 1px 1px rgba(0,0,0,.05);
            }

            .panel-color-blue{
                border-color: #d9534f;
                color: #fff;
                background-color: #d9534f;
            }

            .panel-color-lightblue{
                border-color: lightcoral;
                color: #000;
                background-color: lightcoral;
            }

            .panel-heading-top {
                padding: 5px 10px;
                //border-bottom: 1px solid transparent;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
                font-size: 12px;
            }

            .panel-heading-small {
                padding: 5px 10px;
                //border-bottom: 1px solid transparent;
                /*border-top-left-radius: 3px;
                border-top-right-radius: 3px;*/
                font-size: 12px;
            }

            .panel-heading-bottom {
                padding: 5px 10px;
                border-bottom-left-radius: 5px;
                border-bottom-right-radius: 5px;
                /*border-top-left-radius: 3px;
                border-top-right-radius: 3px;*/
                font-size: 12px;
            }

            .ui-datepicker-trigger{
                padding: 0px 4px;
            }

            #currentCentral{
                padding-left: 15px;
            }

            #placeholder {
                opacity: 0.99;
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

        <!-- Morris Charts CSS -->
        <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

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
                <!--<div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                    <a class="navbar-brand2" href="main.php"><img src="Image/ujaen.GIF" alt="Ujaen" height="38" width="38"></a>
                    <a class="navbar-brand" href="main.php">Emergiendo con el Sol</a>

                </div>-->
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



                    <?php if ($valid): ?>  
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="centralAdmin.php"><i class="fa fa-gear fa-fw"></i> Gestionar centrales</a>
                                </li>
                                <li><a href="addCentral.php"><i class="fa fa-edit fa-fw"></i> Añadir central</a>
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
                    <?php else: ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Iniciar sesión</a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>

                    <?php endif; ?>

                    <img src="Image/JuntaDeAndalucia.jpg" alt="Ujaen" height="90" width="356">
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation" style="margin-top: 90px; overflow-y: auto; max-height: 630px;">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu" >
                            <li class="active">
                                <a href="#"><i class="fa fa-bar-chart-o fa-fw" ></i> Centrales<span class="fa arrow"></span></a>
                                <ul id="centralSidebar" class="nav nav-second-level">     
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <h1 id="currentCentral" class="page-header" style="margin-top: 10px; margin-bottom: 5px; padding-bottom: 0px;"></h1>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <h1 id="currentDay" style="font-size: 14px; text-align: right; margin-top: 34px; border-bottom: 1px solid #eee;"></h1>
                    </div>
                </div>
                <div  class="row">
                    <div id="mainPanel" class="col-lg-10 col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-heading" >
                                <input id="inCalendar" class="left-align" type="text" readonly="readonly" size="9" style="text-align: center">
                                <input id="inCalendarMonth" class="left-align" type="text" readonly="readonly" size="6" style="text-align: center"/>
                                <input id="inCalendarYear" class="left-align" type="text" readonly="readonly" size="6" style="text-align: center"/>
                                <!--<button class="dataUpdate">Actualizar gráfico</button>-->
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <?php if ($valid): ?>  
                                            <label for='hideCentral' style="width: 120px; margin-left: 15px;"><input type='checkbox' id='hideCentral'></input>Ocultar central</label>

                                            <a id="fullDownload" class="btn btn-default btn-xs dropdown-toggle" >
                                                Descargar datos
                                                <!--<span class="caret"></span>-->
                                            </a>
                                        <?php endif; ?>
                                        <button type="button" id="changeMode" class="btn btn-default btn-xs dropdown-toggle" style="margin-left: 15px;border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                            Mostrar todas las variables medidas
                                            <!--<span class="caret"></span>-->
                                        </button>
                                        <!--<ul class="dropdown-menu pull-right" role="menu">
                                            <li><a class="modeUpdate" href="PleaseEnableJavascript.html" onclick="
                                                    return false;" id="mainData">Datos principales</a>
                                            </li>
                                            <li><a class="modeUpdate" href="PleaseEnableJavascript.html" onclick="
                                                    return false;" id="fullData">Todos los datos</a>
                                            </li>
                                        </ul>-->
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">

                                <div class="demo-container">
                                    <div id="warningmessage" class="alert alert-danger" style="display: none" >
                                        Sólo se puede seleccionar dos variables al mismo tiempo.
                                    </div>                                    
                                    <div id="choices"></div>
                                    <div id="choicesMonth"></div>
                                    <div id="choicesYear"></div>
                                    <div id="placeholder" class="demo-placeholder" style="float:left; width:100%; height:390px;"></div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="todayDataRow" class="col-lg-2 col-md-2" style="display: none;">
                        <div class="panel panel-current">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>Tensión AC</strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param1">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-current">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>Corriente AC</strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param2">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-current">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>Frecuencia</strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param3">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-current">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>Tensión DC</strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param4">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-current">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>Corriente DC</strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param5">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-current">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>Temp. ambiente</strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param6">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="previousDataRow" class="col-lg-2 col-md-2" style="display: none;">
                        <div class="panel-small">
                            <div class="panel-heading-top panel-color-blue">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>Tensión AC media</strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param7">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-small">
                            <div class="panel-heading-small panel-color-lightblue">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>Energía AC generada</strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param8">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-small">
                            <div class="panel-heading-small panel-color-blue">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>Frecuencia media</strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param9">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-small">
                            <div class="panel-heading-small panel-color-lightblue">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>Energía DC generada</strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param10">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-small">
                            <div class="panel-heading-small panel-color-blue">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>Irradiación diaria (H)</strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param11">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-small">
                            <div class="panel-heading-small panel-color-lightblue">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>Temp. ambiente media</strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param12">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-small">
                            <div class="panel-heading-small panel-color-blue">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>Performance ratio</strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param13">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-small">
                            <div class="panel-heading-small panel-color-lightblue">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>Y<sub>r</sub> - Y<sub>a</sub> - Y<sub>f</sub></strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param14">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-small">
                            <div class="panel-heading-small panel-color-blue">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>L<sub>BOS</sub> - Efic<sub>BOS</sub></strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param15">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-small">
                            <div class="panel-heading-bottom panel-color-lightblue">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <strong>L<sub>c</sub></strong>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div id="param16">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div id="emptyDataRow" class="col-lg-2 col-md-2" style="display: none;">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-right">
                                        <strong>No hay datos para este día</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- BEGIN: Powered by Supercounters.com -->
            <div class="hitcounter"  <?php if (!$valid): ?>  style="display: none  <?php endif; ?>  ">
                <center>
                    <script type="text/javascript" src="http://widget.supercounters.com/flag.js"></script>
                    <script type="text/javascript">sc_flag(1162772, "FFFFFF", "000000", "cccccc", 8, 100, 0, 0)</script>
                    <br>
                    <noscript><a href="http://www.supercounters.com/">Flag Counter</a></noscript>
                </center>
            </div>
            <!-- END: Powered by Supercounters.com -->
            <!-- /#wrapper -->
            <footer class="footer">
                <div class="container text-center" >
                    <p class="text-muted">Desarrollado por <strong>Jesús Alberto Salazar Ortega</strong> en colaboración con: </p>

                    <a href="http://www.ujaen.es/investiga/solar/"><img src="Image/GrupoIDEA.jpg" width="50" height="80" style="margin-right: 80px;"></a>
                    <a href="http://xxiispes.perusolar.org/"><img src="Image/CER.jpg" width="100" height="60" style="margin-right: 80px;"></a>
                    <a href="http://simidat.ujaen.es/"><img src="Image/simidat.png" width="100" height="60" ></a>

                </div>
            </footer>




        </div>

        <!-- jQuery -->
        <!--<script src="../bower_components/jquery/dist/jquery.min.js"></script>-->
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>


        <!-- Bootstrap Core JavaScript -->
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

        <!-- Flot Charts JavaScript -->
        <script src="../bower_components/flot/jquery.flot.js"></script>
        <script src="../bower_components/flot/jquery.flot.resize.js"></script>
        <script src="../bower_components/flot/jquery.flot.time.js"></script>
        <script src="../bower_components/flot/jquery.flot.image.js"></script>
        <script src="../bower_components/flot/jquery.flot.crosshair.js"></script>

        <!-- Data Picker JavaScript -->
        <!--<script src="../bower_components/datapicker/jquery-ui.min.js"></script>-->
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
        <script src="../bower_components/datapicker/jquery.ui.datepicker-es.js"></script>


        <!-- Morris Charts JavaScript -->
        <script src="../bower_components/raphael/raphael-min.js"></script>
        <script src="../bower_components/morrisjs/morris.min.js"></script>
        <!--<script src="../dist/js/morris-data.js"></script>-->

        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js"></script>
        <!--<script src="dist/js/centrals.js"></script>-->

        <script type="text/javascript">

                                function logout() {
                                    $.get("logout.php");
                                    document.location.href = "login.php";
                                    //parent.window.location.reload();
                                    return false;
                                }

                                function timeConverter(UNIX_timestamp) {
                                    date = new Date(UNIX_timestamp);
                                    /*console.log("Aqui");
                                     console.log(date);
                                     console.log(date.getTime());*/
                                    date = ((date.getTime() / 1000) + date.getTimezoneOffset() * 60);
                                    //console.log(date);
                                    var a = new Date(date * 1000);
                                    //console.log(a);
                                    //var months = ['En', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                                    var year = a.getFullYear();
                                    var month = a.getMonth() + 1;
                                    var date = a.getDate();
                                    var hour = a.getHours();
                                    var min = a.getMinutes();
                                    var sec = a.getSeconds();
                                    var time = date + '/' + month + '/' + year + ' ' + hour + ':' + min + ':' + sec;
                                    return time;
                                }

                                function dayConverter(UNIX_timestamp) {
                                    var a = new Date(UNIX_timestamp * 1000);
                                    var months = ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'];
                                    var year = a.getFullYear();
                                    var month = months[a.getMonth()];
                                    var date = "0" + a.getDate();
                                    var time = date.substr(-2) + '_' + month + '_' + year;
                                    return time;
                                }

                                function loadJSON(callback) {
                                    var xobj = new XMLHttpRequest();
                                    xobj.overrideMimeType("application/json");
                                    xobj.open('GET', 'JSON/centrals.json', true); // Replace 'my_data' with the path to your file
                                    xobj.onreadystatechange = function () {
                                        if (xobj.readyState == 4 && xobj.status == "200") {
                                            // Required use of an anonymous callback as .open will NOT return a value but simply returns undefined in asynchronous mode
                                            callback(xobj.responseText);
                                        }
                                    };
                                    xobj.send(null);
                                }



                                $(function () {

                                    /* Array.prototype.max = function () {
                                     return Math.max.apply(null, this);
                                     };*/
                                    /*var centralData = {
                                     "Lima": {"Nombre": "Lima", "Potencia GFV": 3.0, "Potencia Inversor": 3, "Image": "Lima.jpg"},
                                     "Arequipa": {"Nombre": "Arequipa", "Potencia GFV": 3.24, "Potencia Inversor": 3, "Image": "Arequipa.png"},
                                     "Tacna": {"Nombre": "Tacna", "Potencia GFV": 3.24, "Potencia Inversor": 3, "Image": "Tacna.jpg"},
                                     "Experimental": {"Nombre": "Experimental", "Potencia GFV": 3.0, "Potencia Inversor": 3, "Image": "ujaen.GIF"}
                                     };*/

                                    var centralData;
                                    loadJSON(function (response) {
                                        centralData = JSON.parse(response);


                                        console.log(centralData["Lima"]);

                                        var centralSidebar = $("#centralSidebar");
                                        var i = 0;
                                        for (var key in centralData) {
<?php if (!$valid): ?>
                                                if (centralData[key]["visible"] != "0")
<?php endif; ?>
                                            if (i === 0) {
                                                centralSidebar.append("<li><a class='fetchSeries' id='" + centralData[key]["Nombre"] + "' title='Click to see " + centralData[key]["Nombre"] +
                                                        " stadistics' href = 'PleaseEnableJavascript.html' onclick='return false; '>" + centralData[key]["Nombre"] + "</a></li>");
                                                i++;
                                            } else
                                            {
                                                centralSidebar.append("<li><a class = 'fetchSeries' id='" + centralData[key]["Nombre"] + "' title='Click to see " + centralData[key]["Nombre"] +
                                                        " stadistics' href = 'PleaseEnableJavascript.html' onclick='return false;'>" + centralData[key]["Nombre"] + "</a></li>");
                                            }
                                        }




                                        //centralData["Lima"] = ["Potencia GFV" => 3, "Potencia Inversor" => 3];
                                        //centralData['Lima'] = "hola";
                                        /*centralData["Lima"]["Potencia GFV"] = 3;
                                         centralData["Lima"]["Potencia Inversor"] = 3;*/
                                        /*centralData["Arequipa"] = array("Potencia GFV" => 3, 24, "Potencia Inversor" => 3);
                                         centralData["Tacna"] = array("Potencia GFV" => 3, 24, "Potencia Inversor" => 3);*/

                                        var centralID = 0;
                                        var datasets;
                                        var mode = true;
                                        var chartmode = "day";
                                        var stats;
                                        //var first = true;

                                        $("#previousDataRow").css("display", "none");
                                        $("#emptyDataRow").css("display", "none");
                                        $("#todayDataRow").css("display", "none");
                                        //$("ui-datepicker-calendar").css("display", "inline-block");
                                        $("#inCalendar").datepicker({
                                            showOn: "button",
                                            buttonImage: "Image/calendar.gif",
                                            buttonImageOnly: true,
                                            buttonText: "Seleccionar fecha",
                                            changeMonth: true,
                                            changeYear: true,
                                            dateFormat: "dd-mm-yy",
                                            maxDate: 0,
                                            showButtonPanel: true,
                                            closeText: "Cerrar",
                                            onSelect: function (event, inst) {
                                                //$('#divDay').html(weekday[($(this).datepicker('getDate').getUTCDay())]);
                                                //refreshData();
                                                //console.log($(this).datepicker('getDate'));
                                                chartmode = "day";
                                                refreshChart($(this).datepicker('getDate'), centralID);
                                                /*$(this).data('datepicker').inline = true;    */
                                                event.preventDefault();
                                            }
                                        });
                                        $("#inCalendar").datepicker('setDate', new Date());
                                        $("#inCalendar").focus(function () {
                                            $(".ui-datepicker-current").hide();
                                        });
                                        $("#inCalendarMonth").datepicker({
                                            showOn: "button",
                                            buttonImage: "Image/calendar.gif",
                                            buttonImageOnly: true,
                                            buttonText: "Seleccionar fecha",
                                            dateFormat: 'mm-yy',
                                            changeMonth: true,
                                            changeYear: true,
                                            showButtonPanel: true,
                                            maxDate: 0/*,
                                             onClose: function (dateText, inst) {
                                             
                                             //console.log(getNextMonthdatapicker(new Date(year, month, 1)));
                                             }*/
                                        });
                                        $("#inCalendarMonth").focus(function () {
                                            $(".ui-datepicker-current").html("Este mes");
                                            $(".ui-datepicker-close").html("Aceptar");
                                            $(".ui-datepicker-close").click(function () {
                                                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                                                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                                $("#inCalendarMonth").datepicker('option', 'defaultDate', new Date(year, month, 1));
                                                $("#inCalendarMonth").val($.datepicker.formatDate('mm-yy', new Date(year, month, 1)));
                                                chartmode = "month";
                                                refreshMonthChart(new Date(year, month, 1), centralID);
                                                /*console.log(getMonthdatapicker(new Date(year, month, 1)));
                                                 console.log($("#inCalendarMonth").datepicker('getDate'));*/
                                            });
                                            $(".ui-datepicker-calendar").hide();
                                            $("#ui-datepicker-div").position({
                                                my: "center top",
                                                at: "center bottom",
                                                of: $(this)
                                            });
                                        });
                                        $("#inCalendarMonth").datepicker('setDate', new Date());
                                        function getMonthdatapicker(dateMonth) {
                                            return new Date(dateMonth.getFullYear(), dateMonth.getMonth(), 1).getTime();
                                        }
                                        /*function getNextMonthdatapicker(dateMonth) {
                                         return new Date(dateMonth.getFullYear(), dateMonth.getMonth() + 1, 1).getTime();
                                         }*/


                                        $('#inCalendarYear').datepicker({
                                            showOn: "button",
                                            buttonImage: "Image/calendar.gif",
                                            buttonImageOnly: true,
                                            buttonText: "Seleccionar fecha",
                                            changeYear: true,
                                            changeMonth: false,
                                            showButtonPanel: true,
                                            dateFormat: 'yy',
                                            onClose: function (dateText, inst) {
                                                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                                $(this).datepicker('setDate', new Date(year, 1));
                                            }
                                        });
                                        $("#inCalendarYear").focus(function () {
                                            $(".ui-datepicker-current").html("Este año");
                                            $(".ui-datepicker-close").html("Aceptar");
                                            $(".ui-datepicker-month").hide();
                                            $(".ui-datepicker-prev").hide();
                                            $(".ui-datepicker-next").hide();
                                            $(".ui-datepicker-calendar").hide();
                                            $(".ui-datepicker-close").click(function () {
                                                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                                $("#inCalendarYear").datepicker('option', 'defaultDate', new Date(year, 0, 1));
                                                $("#inCalendarYear").val($.datepicker.formatDate('yy', new Date(year, 0, 1)));
                                                chartmode = "year";
                                                console.log(new Date(year, 0, 1));
                                                refreshYearChart(new Date(year, 0, 1), centralID);
                                            });
                                            $("#ui-datepicker-div").position({
                                                my: "center top",
                                                at: "center bottom",
                                                of: $(this)
                                            });
                                        });
                                        $("#inCalendarYear").datepicker('setDate', new Date());
                                        $("a.fetchSeries").click(function () {

                                            var ref = $(this);
                                            $("a.fetchSeries").each(function () {
                                                $(this).css("background-color", "transparent");
                                            });
                                            $(this).css("background-color", "lightgrey");
                                            centralID = ref.attr("id");
                                            console.log(centralID + " está en modo: " + centralData[centralID]["visible"])
                                            if (centralData[centralID]["visible"] == "1") {
                                                $("#hideCentral").attr("checked", false);
                                            } else {
                                                $("#hideCentral").attr("checked", true);
                                            }
                                            $('#currentCentral').html(ref.html());
                                            if (chartmode === "day") {
                                                console.log("Seleccionando otra central en modo dia");
                                                var temp = $("#inCalendar").datepicker('getDate');
                                                refreshChart(temp, centralID);
                                            }
                                            if (chartmode === "month") {
                                                console.log("Seleccionando otra central en modo mes");
                                                var temp = $("#inCalendarMonth").datepicker('getDate');
                                                temp = new Date(temp.getFullYear(), temp.getMonth(), 1);
                                                console.log(temp);
                                                refreshMonthChart(temp, centralID);
                                            }
                                            if (chartmode === "year") {
                                                console.log("Seleccionando otra central en modo año");
                                                var temp = $("#inCalendarYear").datepicker('getDate');
                                                temp = new Date(temp.getFullYear(), 0, 1);
                                                console.log(temp);
                                                refreshYearChart(temp, centralID);
                                            }



                                            //console.log(temp);
                                            //if(chartmode === "month")

                                            //console.log(temp.valueOf() + " " + centralID);
                                            //var dataurl = button.siblings("a").attr("href");
                                        });
                                        /*$("button.dataUpdate").click(function () {
                                         
                                         var temp = $("#inCalendar").datepicker('getDate');
                                         //console.log(temp.valueOf() + " " + centralID);
                                         refreshChart(temp, centralID);
                                         
                                         });*/

                                        $("#hideCentral").click(function () {
                                            console.log(centralID);
                                            $.ajax({
                                                url: 'removeCentral.php',
                                                type: 'POST',
                                                /*contentType: "application/json; charset=utf-8",*/
                                                /*dataType: "json",*/
                                                data: {var1: centralID},
                                                success: function (data) {

                                                }
                                            });
                                        });

                                        $("#changeMode").click(function () {

                                            mode = !mode;
                                            console.log("Mode: " + mode);
                                            var choiceContainer = $("#choices");
                                            //var ref = $(this);
                                            var temp = $("#inCalendar").datepicker('getDate');
                                            //console.log(ref.attr("id"));

                                            if (mode) {
                                                $(this).html("Mostrar todas las variables medidas");
                                                var i = 0;
                                                choiceContainer.find("input").each(function () {
                                                    if (i > 4) {
                                                        $(this).css("display", "none");
                                                        $(this).attr("checked", false);
                                                    }
                                                    i++;
                                                });
                                                i = 0;
                                                choiceContainer.find("label").each(function () {
                                                    if (i > 4) {
                                                        $(this).css("display", "none");
                                                    }
                                                    i++;
                                                });
                                                plotAccordingToChoices();
                                            }
                                            else {
                                                $(this).html("Mostrar variables principales");
                                                choiceContainer.find("input").each(function () {
                                                    $(this).css("display", "inline-block");
                                                    $(this).attr("checked", false);
                                                });
                                                choiceContainer.find("label").each(function () {
                                                    $(this).css("display", "inline-block");
                                                });
                                                //plotAccordingToChoices()
                                            }



                                        });
                                        function showTooltip(x, y, color, contents) {
                                            $('<div id="tooltip">' + contents + '</div>').css({
                                                position: 'absolute',
                                                display: 'none',
                                                top: y - 40,
                                                left: x - 120,
                                                border: '2px solid ' + color,
                                                padding: '3px',
                                                'z-index': 99999,
                                                'font-size': '12px',
                                                'border-radius': '5px',
                                                'background-color': '#fff',
                                                'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
                                                opacity: 0.9
                                            }).appendTo("body").fadeIn(200);
                                        }

                                        function plotAccordingToChoices() {

                                            var data = [];
                                            var date = $("#inCalendar").datepicker('getDate');
                                            date = new Date(date);
                                            date = ((date.getTime() / 1000) - date.getTimezoneOffset() * 60);
                                            var choiceContainer = $("#choices");
                                            choiceContainer.find("input:checked").each(function () {
                                                var key = $(this).attr("name");
                                                if (key && datasets[key]) {
                                                    data.push(datasets[key]);
                                                }

                                            });
                                            //console.log(data);

                                            if (data.length > 0) {

                                                var minGrades = 0.0;
                                                var maxAmperes = 0.0;
                                                for (var l = 0; l < data.length; l++)
                                                    if (data[l].yaxis === 2)
                                                        for (var h = 0; h < data[l].data.length; h++)
                                                            data[l].data[h][1] < minGrades ? minGrades = data[l].data[h][1] : false;
                                                for (var l = 0; l < data.length; l++)
                                                    if (data[l].yaxis === 4)
                                                        for (var h = 0; h < data[l].data.length; h++)
                                                            data[l].data[h][1] > maxAmperes ? maxAmperes = data[l].data[h][1] : false;
                                                maxAmperes = Math.round((parseFloat(maxAmperes) + 2));
                                                //Math.round(val)maxAmperes += maxAmperes % 2;
                                                //console.log(maxAmperes);
                                                var plot = $.plot("#placeholder", data, {
                                                    yaxes: [{
                                                            position: "right",
                                                            tickDecimals: 0,
                                                            //max: 1000
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val) : "W";
                                                            }
                                                        }, {
                                                            position: "right",
                                                            label: "ºC",
                                                            min: minGrades,
                                                            tickDecimals: 0,
                                                            /*min: 1000,*/
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val) : "ºC";
                                                            }
                                                        }
                                                        , {
                                                            position: "right",
                                                            tickDecimals: 0,
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val) : "V";
                                                            }
                                                        }
                                                        , {
                                                            position: "right",
                                                            tickDecimals: 1,
                                                            /*ticks: maxAmperes/2,*/
                                                            max: maxAmperes,
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val * 10.0) / 10.0 : "A";
                                                            }

                                                        }],
                                                    xaxis: {
                                                        mode: "time",
                                                        timeformat: "%h",
                                                        tickSize: [1, "hour"],
                                                        //color: "black",
                                                        axisLabel: "Horas",
                                                        axisLabelUseCanvas: true,
                                                        axisLabelFontSizePixels: 12,
                                                        axisLabelFontFamily: 'Verdana, Arial',
                                                        axisLabelPadding: 3,
                                                        min: (date) * 1000,
                                                        max: (date + 86400) * 1000
                                                    }, series: {
                                                        lines: {
                                                            show: true,
                                                        },
                                                        points: {
                                                            radius: 0,
                                                            show: true
                                                        },
                                                        shadowSize: 2
                                                                /* points: {
                                                                 show: true
                                                                 }*/
                                                    }, crosshair: {
                                                        mode: "x"
                                                    }, grid: {
                                                        hoverable: true,
                                                        autoHighlight: false,
                                                        clickable: true
                                                    }

                                                });
                                                if(centralData[centralID]["Image"] !== "null")  
                                                $("#placeholder").append("<img src=\"Image/" + centralData[centralID]["Image"] + "\" style=\"position: relative;width: 100px;margin-left: 20px;margin-top: 20px;opacity: 0.7;z-index: -1 \">");
                                                //$("#placeholder").UseTooltip();


                                                /*var encodedUri = encodeURI(csvContent);
                                                 var link = $("#fullDownload");
                                                 link.setAttribute("href", encodedUri);
                                                 link.setAttribute("download", "my_data.csv");*/
                                                $('#placeholder').hover(
                                                        function () {
                                                            $('#tooltip').css('display', 'inline-block');
                                                        },
                                                        function () {
                                                            $('#tooltip').css('display', 'none');
                                                        }
                                                );
                                                //console.log("Antes " + data.length);
                                                $("<div id='tooltip'></div>").css({
                                                    position: "absolute",
                                                    display: "none",
                                                    border: "1px solid #fdd",
                                                    padding: "2px",
                                                    'z-index': 99999,
                                                    "background-color": "#fee",
                                                    opacity: 0.80
                                                }).appendTo("body");
                                                $("#placeholder").unbind("plothover");
                                                $("#placeholder").bind("plothover", function (event, pos, item)
                                                {
                                                    //console.log(event);

                                                    //console.log("Después " + data.length);

                                                    var i,
                                                            j,
                                                            selectPoint,
                                                            shortestDistance,
                                                            testDistance;
                                                    // Loop through all the points in plot2.
                                                    //selectPoint = plot.getData()[0].data[0];
                                                    //console.log("Lenght: " + data[0].data.length);
                                                    if (stats["stats"].mode !== "emptyDay") {
                                                        for (i = 0; i < data[0].data.length; ++i) {

                                                            selectPoint = data[0].data[i];
                                                            //console.log(data[0].data[i]);
                                                            if (selectPoint[0] > pos.x.toFixed(2)) {
                                                                break;
                                                            }

                                                        }

                                                        i === data[0].data.length ? i-- : false;
                                                        //console.log("Punto: " + selectPoint);

                                                        var d = new Date(selectPoint[0]);
                                                        /*console.log(selectPoint[0]);
                                                         console.log(d.getTime());
                                                         console.log(d.getTimezoneOffset());*/

                                                        d = ((d.getTime() / 1000) + (d.getTimezoneOffset() * 60));
                                                        d = d * 1000;
                                                        d = new Date(d);
                                                        var hours = d.getHours();
                                                        var minutes = "0" + d.getMinutes();
                                                        d = hours + ":" + minutes.substr(-2);
                                                        // var d = new Date(selectPoint[0]).format('h:i:s');

                                                        $("#tooltip").html(
                                                                "Hora: " + d
                                                                ).css({top: pos.pageY + 5, left: pos.pageX + 5});
                                                        for (j = 0; j < data.length; ++j) {


                                                            var last = data[j].label.lastIndexOf(" ");
                                                            /*$("#tooltip").append("<br>" + data[j].label.substring(0,last));
                                                             $("#tooltip").append(": " + data[j].data[i][1] + " " + data[j].label.substring(last + 1,data[j].label.lenght));*/
                                                            $("#tooltip").append("<br>" + data[j].label);
                                                            $("#tooltip").append(": " + data[j].data[i][1]);
                                                        }
                                                    }


                                                });
                                            }
                                        }


                                        function refreshChart(date, central) {
                                            //console.log("First date: " + date);
                                            date = new Date(date);
                                            //console.log("First date: " + date);
                                            //console.log(date.getTimezoneOffset() * 60);
                                            date = ((date.getTime() / 1000) - date.getTimezoneOffset() * 60);
                                            //date = ((date.getTime() / 1000));



                                            /*$("#emptyDataRow").css("display", "none");
                                             $("#previousDataRow").css("display", "none");
                                             $("#todayDataRow").css("display", "none");*/
                                            $("#choices").css("display", "inline-block");
                                            $("#warningmessage").css("display", "none");
                                            $("#choicesMonth").css("display", "none");
                                            $("#choicesYear").css("display", "none");
                                            $("#mainPanel").attr("class", "col-lg-10 col-md-10");
                                            $("#changeMode").css("display", "inline-block");
                                            $("#currentDay").parent().attr("class", "col-lg-5 col-md-5");
                                            $("#currentCentral").parent().attr("class", "col-lg-5 col-md-5");
                                            //date = ((date.getTime() / 1000) + 7200);
                                            console.log("First date: " + date);
                                            //console.log(new Date().getTime());

                                            $.ajax({
                                                url: 'mysqlphp.php',
                                                type: 'POST',
                                                /*contentType: "application/json; charset=utf-8",*/
                                                /*dataType: "json",*/
                                                data: {var1: date, var2: central},
                                                success: function (data) {
                                                    //console.log(data);
                                                    datasets = JSON.parse(data);
                                                    //console.log(datasets);
                                                    stats = datasets["stats"];
                                                    datasets = datasets["data"];
                                                    var i = 0;
                                                    $.each(datasets, function (key, val) {
                                                        val.color = i;
                                                        ++i;
                                                    });
                                                    // insert checkboxes 

                                                    var choiceContainer = $("#choices");
                                                    //choiceContainer.empty();
                                                    i = 0;
                                                    //console.log(choiceContainer.html());
                                                    if (choiceContainer.html().length === 0) {
                                                        $.each(datasets, function (key, val) {
                                                            if (i < 5)
                                                                choiceContainer.append("<label for='id" + key + "' style='width: 200px'><input type='checkbox' name='" + key +
                                                                        "' checked='checked' id='id" + key + "'></input>"
                                                                        + val.label + "</label>");
                                                            else
                                                                choiceContainer.append("<label for='id" + key + "' style='width: 200px; display: none;'><input type='checkbox' name='" + key +
                                                                        "'  id='id" + key + "' style='display: none;'></input>"
                                                                        + val.label + "</label>");
                                                            i++;
                                                        });
                                                        choiceContainer.find("input").click(plotAccordingToChoices);
                                                    }
                                                    /*console.log(datasets["Irradiancia"].data[datasets["Irradiancia"].data.length - 1]);*/
                                                    if (stats["stats"].mode === "lastDay") {
                                                        $("#emptyDataRow").css("display", "none");
                                                        $("#previousDataRow").css("display", "none");
                                                        $("#todayDataRow").css("display", "block");
                                                        //console.log(stats["stats"].data);
                                                        $("#param1").html(stats["stats"].data.v1 + " V");
                                                        $("#param2").html(stats["stats"].data.v2 + " A");
                                                        $("#param3").html(stats["stats"].data.v3 + " Hz");
                                                        $("#param4").html(stats["stats"].data.v4 + " V");
                                                        $("#param5").html(stats["stats"].data.v5 + " A");
                                                        $("#param6").html(stats["stats"].data.v6 + " ºC");
                                                    } else {
                                                        $("#emptyDataRow").css("display", "none");
                                                        $("#todayDataRow").css("display", "none");
                                                        if (stats["stats"].mode === "previousDay") {
                                                            $("#previousDataRow").css("display", "block");
                                                            // console.log(stats["stats"].data);
                                                            $("#param7").html(stats["stats"].data["Tension AC media"] + " V");
                                                            $("#param8").html(stats["stats"].data["Energia AC generada"] + " kWh");
                                                            $("#param9").html(stats["stats"].data["Frecuencia"] + " Hz");
                                                            $("#param10").html(stats["stats"].data["Energia DC generada"] + " kWh");
                                                            $("#param11").html(stats["stats"].data["Irradiación total"] + " kWh/m&sup2 dia");
                                                            $("#param12").html(stats["stats"].data["Temp. ambiente media"] + " ºC");
                                                            $("#param13").html(Math.round((stats["stats"].data["EACG"] / (centralData[centralID]["Potencia GFV"] * stats["stats"].data["IT"])) * 10000.0) / 100.0 + "%");
                                                            //console.log("AC: " + stats["stats"].data["EACG"]);
                                                            //console.log("DC: " + stats["stats"].data["EDCG"]);
                                                            var YR = stats["stats"].data["IT"];
                                                            var YA = stats["stats"].data["EDCG"] / centralData[centralID]["Potencia GFV"];
                                                            var YF = stats["stats"].data["EACG"] / centralData[centralID]["Potencia GFV"];
                                                            $("#param14").html(
                                                                    //Yr
                                                                    Math.round(YR * 100.0) / 100.0 + " kWh/kWp dia" + "<br>" +
                                                                    //Ya
                                                                    Math.round(YA * 100.0) / 100.0 + " kWh/kWp dia" + "<br>" +
                                                                    //Yf
                                                                    Math.round(YF * 100.0) / 100.0 + " kWh/kWp dia"
                                                                    );
                                                            //console.log("YF " + stats["stats"].data["Energia AC generada"] / centralData[centralID]["Potencia GFV"]);
                                                            //$("#param15").html(stats["stats"].data["Rendimiento Inversor"] + "%");
                                                            $("#param15").html(
                                                                    //LBOS
                                                                    Math.abs(Math.round((YA - YF) * 100.0) / 100.0) + " kWh/kWp dia" + "<br>" +
                                                                    //EficBOS
                                                                    Math.round((stats["stats"].data["EACG"] / stats["stats"].data["EDCG"]) * 10000) / 100 + "%"

                                                                    );
                                                            $("#param16").html(Math.round((YR - YA) * 100.0) / 100.0 + " kWh/kWp dia");
                                                            //console.log("Aqui " + centralData[centralID]["Potencia GFV"]);
                                                            /*console.log("EACG " + stats["stats"].data["EACG"]);
                                                             console.log("EDCG " + stats["stats"].data["EDCG"]);
                                                             console.log("IT " + stats["stats"].data["IT"]);
                                                             console.log("PGFV " + centralData[centralID]["Potencia GFV"]);*/
                                                        } else {
                                                            $("#emptyDataRow").css("display", "block");
                                                            $("#todayDataRow").css("display", "none");
                                                            $("#previousDataRow").css("display", "none");
                                                        }
                                                    }

                                                    var csvContent = "Fecha__hora__;";
                                                    var csvContentArray = [];
                                                    var keys = [];
                                                    //console.log(datasets);
                                                    choiceContainer.find("input").each(function () {
                                                        keys.push($(this).attr("name"));
                                                    });
                                                    for (var x = 0; x < keys.length; x++) {
                                                        csvContent += keys[x] + ";";
                                                    }

                                                    csvContentArray.push(csvContent);
                                                    var tam = datasets[keys[0]].data.length;
                                                    //console.log(tam);
                                                    for (var z = 0; z < tam; z++) {
                                                        csvContent = "";
                                                        if (z !== 0 && z !== tam - 1) {
                                                            for (var x = 0; x < keys.length; x++) {
                                                                if (x === 0)
                                                                    csvContent += timeConverter(datasets[keys[x]].data[z][0]) + ";";
                                                                csvContent += datasets[keys[x]].data[z][1] + ";";
                                                            }
                                                            csvContentArray.push(csvContent);
                                                        }
                                                    }


                                                    csvContent = csvContentArray.join("\n");
                                                    //console.log(csvContent);

                                                    var encodedUri = encodeURI("data:text/csv;charset=utf-8," + csvContent);
                                                    var link = $("#fullDownload");
                                                    link.attr("href", encodedUri);
                                                    link.attr("download", centralData[centralID].Nombre + "_" + dayConverter(date) + ".csv");
                                                    var fulldate = new Date(date * 1000);
                                                    var fullTitle = "Día " + fulldate.getDate() + " de " + fulldate.toLocaleString("es-es", {month: "long"}) + " de " + fulldate.getFullYear();
                                                    $('#currentDay').html(fullTitle);
                                                    plotAccordingToChoices();
                                                }
                                            });
                                        }

                                        function refreshMonthChart(date, central) {
                                            date = new Date(date);
                                            date = date.getTime() / 1000;
                                            console.log("Fecha: " + date + " central: " + central);
                                            //console.log("First date: " + date);
                                            $("#emptyDataRow").css("display", "none");
                                            $("#previousDataRow").css("display", "none");
                                            $("#todayDataRow").css("display", "none");
                                            $("#choices").css("display", "none");
                                            $("#changeMode").css("display", "none");
                                            $("#choicesYear").css("display", "none");
                                            $("#choicesMonth").css("display", "inline-block");
                                            $("#warningmessage").css("display", "inline-block");
                                            $("#mainPanel").attr("class", "col-lg-12 col-md-12");
                                            $("#currentDay").parent().attr("class", "col-lg-6 col-md-6");
                                            $("#currentCentral").parent().attr("class", "col-lg-6 col-md-6");
                                            $.ajax({
                                                url: 'mysqlphp_1.php',
                                                type: 'POST',
                                                /*contentType: "application/json; charset=utf-8",*/
                                                /*dataType: "json",*/
                                                data: {var1: date, var2: central},
                                                success: function (data) {

                                                    datasets = JSON.parse(data);
                                                    var vars = datasets["var"];
                                                    datasets = datasets["data"];
                                                    //console.log(vars);



                                                    var data1 = [];
                                                    var data2 = [];
                                                    // console.log(datasets);

                                                    for (var g = 0; g < vars["EACG"].data.length; g++) {
                                                        data1.push([vars["EACG"].data[g][0], Math.round((vars["EACG"].data[g][1] / (centralData[centralID]["Potencia GFV"] * vars["IT"].data[g][1])) * 10000.0) / 100.0]);
                                                        data2.push([vars["EACG"].data[g][0], vars["EACG"].data[g][1] / centralData[centralID]["Potencia GFV"]]);
                                                    }
                                                    datasets["Performance ratio"] = {"data": data1, "label": "Performance ratio (%)", "label2": "Performance ratio", "yaxis": 6};
                                                    datasets["Yr"] = {"data": datasets["Irradiacion diaria"].data, "label": "Y<sub>r</sub> (kWh/kWp dia)", "label2": "Y<sub>r</sub>", "yaxis": 5};
                                                    data1 = [];
                                                    for (var g = 0; g < vars["EDCG"].data.length; g++) {
                                                        data1.push([vars["EDCG"].data[g][0], vars["EDCG"].data[g][1] / centralData[centralID]["Potencia GFV"]]);
                                                    }
                                                    datasets["Ya"] = {"data": data1, "label": "Y<sub>a</sub> (kWh/kWp dia)", "label2": "Y<sub>a</sub>", "yaxis": 5};
                                                    datasets["Yf"] = {"data": data2, "label": "Y<sub>f</sub> (kWh/kWp dia)", "label2": "Y<sub>f</sub>", "yaxis": 5};
                                                    data2 = [];
                                                    for (var g = 0; g < datasets["Ya"].data.length; g++) {
                                                        data2.push([datasets["Ya"].data[g][0], Math.abs(Math.round((datasets["Ya"].data[g][1] - datasets["Yf"].data[g][1]) * 100.0) / 100.0)]);
                                                    }
                                                    datasets["Lbos"] = {"data": data2, "label": "L<sub>BOS</sub> (kWh/kWp dia)", "label2": "L<sub>BOS</sub>", "yaxis": 5};
                                                    data1 = [];
                                                    for (var g = 0; g < vars["EACG"].data.length; g++) {
                                                        data1.push([vars["EACG"].data[g][0], Math.round((vars["EACG"].data[g][1] / vars["EDCG"].data[g][1]) * 10000.0) / 100.0]);
                                                    }
                                                    datasets["Eficbos"] = {"data": data1, "label": "Efic<sub>BOS</sub> (%)", "label2": "Efic<sub>BOS</sub>", "yaxis": 6};
                                                    data2 = [];
                                                    for (var g = 0; g < vars["IT"].data.length; g++) {
                                                        data2.push([vars["IT"].data[g][0], Math.abs(Math.round((vars["IT"].data[g][1] - datasets["Ya"].data[g][1]) * 100.0) / 100.0)]);
                                                    }
                                                    datasets["Lc"] = {"data": data2, "label": "L<sub>c</sub> (kWh/kWp dia)", "label2": "L<sub>c</sub>", "yaxis": 5};
                                                    //console.log(datasets["Ya"].data[0][1]);

                                                    for (var g = 0; g < datasets["Ya"].data.length; g++) {
                                                        datasets["Ya"].data[g][1] = Math.round(datasets["Ya"].data[g][1] * 100.0) / 100.0;
                                                    }
                                                    for (var g = 0; g < datasets["Yf"].data.length; g++) {
                                                        datasets["Yf"].data[g][1] = Math.round(datasets["Yf"].data[g][1] * 100.0) / 100.0;
                                                    }


                                                    // console.log(datasets);
                                                    var i = 0;
                                                    $.each(datasets, function (key, val) {
                                                        val.color = i;
                                                        ++i;
                                                    });
                                                    // insert checkboxes 
                                                    var choiceContainer = $("#choicesMonth");
                                                    i = 0;
                                                    if (choiceContainer.html().length === 0) {
                                                        $.each(datasets, function (key, val) {
                                                            if (i < 1)
                                                                choiceContainer.append("<label for='id" + key + "' style='width: 200px'><input type='checkbox' name='" + key +
                                                                        "' checked ='checked' id='id" + key + "'></input>"
                                                                        + val.label2 + "</label>");
                                                            else
                                                            if (i > 6)
                                                                choiceContainer.append("<label for='id" + key + "' style='width: 85px;'><input type='checkbox' name='" + key +
                                                                        "'  id='id" + key + "'></input>"
                                                                        + val.label2 + "</label>");
                                                            else
                                                                choiceContainer.append("<label for='id" + key + "' style='width: 200px;'><input type='checkbox' name='" + key +
                                                                        "'  id='id" + key + "'></input>"
                                                                        + val.label2 + "</label>");
                                                            i++;
                                                        });
                                                        choiceContainer.find("input").click(plotAccordingToMonthChoices);
                                                    }

                                                    var csvContent = "Fecha__hora__;";
                                                    var csvContentArray = [];
                                                    var keys = [];
                                                    //console.log(datasets);
                                                    choiceContainer.find("input").each(function () {
                                                        keys.push($(this).attr("name"));
                                                    });
                                                    for (var x = 0; x < keys.length; x++) {
                                                        csvContent += keys[x] + ";";
                                                    }

                                                    csvContentArray.push(csvContent);
                                                    var tam = datasets[keys[0]].data.length;
                                                    var monthCSV = new Date(date * 1000).getMonth() + 1, yearCSV = new Date(date * 1000).getFullYear();
                                                    //console.log(tam);
                                                    for (var z = 0; z < tam; z++) {
                                                        csvContent = "";
                                                        //if (z !== 0 && z !== tam - 1) {
                                                        for (var x = 0; x < keys.length; x++) {
                                                            if (x === 0)
                                                                csvContent += datasets[keys[x]].data[z][0] + "/" + monthCSV + "/" + yearCSV + ";";
                                                            csvContent += datasets[keys[x]].data[z][1] + ";";
                                                        }
                                                        csvContentArray.push(csvContent);
                                                        //}
                                                    }


                                                    csvContent = csvContentArray.join("\n");
                                                    //console.log(csvContent);

                                                    var encodedUri = encodeURI("data:text/csv;charset=utf-8," + csvContent);
                                                    var link = $("#fullDownload");
                                                    link.attr("href", encodedUri);
                                                    link.attr("download", centralData[centralID].Nombre + "_" + monthCSV + "/" + yearCSV + ".csv");
                                                    var fulldate = new Date(date * 1000);
                                                    var fullTitle = fulldate.toLocaleString("es-es", {month: "long"}) + " de " + fulldate.getFullYear();
                                                    $('#currentDay').html(fullTitle);
                                                    plotAccordingToMonthChoices();
                                                }
                                            });
                                        }


                                        function plotAccordingToMonthChoices() {

                                            var data = [];
                                            var choiceContainer = $("#choicesMonth");
                                            var num = choiceContainer.length;
                                            choiceContainer.find("input:checked").each(function () {
                                                var key = $(this).attr("name");
                                                if (key && datasets[key]) {
                                                    data.push(datasets[key]);
                                                }
                                            });
                                            if (data.length === 2) {
                                                data[0]["bars"] = {"barWidth": 0.4, "align": "left"};
                                                data[1]["bars"] = {"barWidth": 0.4, "align": "right"};
                                            }

                                            if (data.length === 1) {
                                                data[0]["bars"] = {"barWidth": 0.8, "align": "center"};
                                            }

                                            if (data.length > 1) {
                                                choiceContainer.find("input").each(function () {
                                                    $(this).attr('disabled', 'disabled');
                                                });
                                                choiceContainer.find("input:checked").each(function () {
                                                    $(this).removeAttr('disabled');
                                                });
                                            } else {
                                                choiceContainer.find("input").each(function () {
                                                    $(this).removeAttr('disabled');
                                                });
                                            }
                                            console.log(data);
                                            if (data.length > 0) {

                                                var plot = $.plot("#placeholder", data, {
                                                    series: {
                                                        bars: {
                                                            show: true,
                                                            fill: 0.8
                                                        }
                                                    },
                                                    grid: {
                                                        hoverable: true,
                                                        clickable: true
                                                    },
                                                    yaxes: [{
                                                            position: "right",
                                                            tickDecimals: 0,
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val) : "kWh/m2";
                                                            }
                                                        },
                                                        {
                                                            position: "right",
                                                            tickDecimals: 0,
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val) : "V";
                                                            }
                                                        }, {
                                                            position: "right",
                                                            tickDecimals: 0,
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val) : "Hz";
                                                            }
                                                        }, {
                                                            position: "right",
                                                            tickDecimals: 0,
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val) : "ºC";
                                                            }
                                                        }, {
                                                            position: "right",
                                                            tickDecimals: 2,
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val * 100.0) / 100.0 : "kWh/kWp";
                                                            }
                                                        }, {
                                                            position: "right",
                                                            tickDecimals: 0,
                                                            max: 100,
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val) : "100%";
                                                            }
                                                        }],
                                                    xaxis: {
                                                        ticksDecimal: 0,
                                                        ticks: 31,
                                                        min: 0.5,
                                                        max: 31.5
                                                                //autoscaleMargin: 0.5
                                                    },
                                                    bars: {
                                                        barWidth: 0.9,
                                                        align: "center"
                                                    }
                                                });
                                                if(centralData[centralID]["Image"] !== "null")  
                                                $("#placeholder").append("<img src=\"Image/" + centralData[centralID]["Image"] + "\" style=\"position: relative;width: 100px;margin-left: 20px;margin-top: 20px;opacity: 0.7;z-index: -1 \">");
                                                $("#placeholder").unbind("plothover");
                                                /*$("#placeholder").bind("plothover", function (event, pos, item)
                                                 {
                                                 
                                                 });*/
                                                var previousPoint = null,
                                                        previousLabel = null;
                                                $("#placeholder").on("plothover", function (event, pos, item) {
                                                    if (item) {
                                                        if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                                                            previousPoint = item.dataIndex;
                                                            previousLabel = item.series.label;
                                                            $("#tooltip").remove();
                                                            var x = item.datapoint[0];
                                                            var y = item.datapoint[1];
                                                            var color = item.series.color;
                                                            //console.log(item.series.xaxis.ticks[x].label);  
                                                            var n = item.series.label.indexOf("(");
                                                            var labelvar = item.series.label.substring(0, n - 1);
                                                            var labelmag = item.series.label.substring(n + 1, item.series.label.length - 1);
                                                            showTooltip(item.pageX,
                                                                    item.pageY,
                                                                    color,
                                                                    "<strong>" + labelvar + "</strong><br>Día " + item.series.xaxis.ticks[x].label + " : <strong>" + Math.round(y * 100.0) / 100.0 + "</strong>" + labelmag);
                                                        }
                                                    } else {
                                                        $("#tooltip").remove();
                                                        previousPoint = null;
                                                    }
                                                });
                                            }

                                            $('#placeholder').unbind('mouseenter mouseleave');
                                        }




                                        function refreshYearChart(date, central) {
                                            date = new Date(date);
                                            date = date.getTime() / 1000;
                                            console.log("Fecha: " + date + " central: " + central);
                                            $("#emptyDataRow").css("display", "none");
                                            $("#previousDataRow").css("display", "none");
                                            $("#todayDataRow").css("display", "none");
                                            $("#choices").css("display", "none");
                                            $("#changeMode").css("display", "none");
                                            $("#choicesMonth").css("display", "none");
                                            $("#choicesYear").css("display", "inline-block");
                                            $("#warningmessage").css("display", "inline-block");
                                            $("#mainPanel").attr("class", "col-lg-12 col-md-12");
                                            $("#currentDay").parent().attr("class", "col-lg-6 col-md-6");
                                            $("#currentCentral").parent().attr("class", "col-lg-6 col-md-6");
                                            $.ajax({
                                                url: 'mysqlphp_2.php',
                                                type: 'POST',
                                                data: {var1: date, var2: central},
                                                success: function (data) {
                                                    console.log(data);
                                                    datasets = JSON.parse(data);
                                                    var vars = datasets["var"];
                                                    datasets = datasets["data"];
                                                    var data1 = [];
                                                    var data2 = [];
                                                    console.log("Length: " + centralData.length);
                                                    console.log("Data: " + centralData[0]);
                                                    for (var g = 0; g < vars["EACG"].data.length; g++) {
                                                        data1.push([vars["EACG"].data[g][0], Math.round((vars["EACG"].data[g][1] / (centralData[centralID]["Potencia GFV"] * vars["IT"].data[g][1])) * 10000.0) / 100.0]);
                                                        data2.push([vars["EACG"].data[g][0], vars["EACG"].data[g][1] / centralData[centralID]["Potencia GFV"]]);
                                                    }
                                                    datasets["Performance ratio"] = {"data": data1, "label": "Performance ratio (%)", "label2": "Performance ratio", "yaxis": 6};
                                                    datasets["Yr"] = {"data": datasets["Irradiacion diaria"].data, "label": "Y<sub>r</sub> (kWh/kWp dia)", "label2": "Y<sub>r</sub>", "yaxis": 5};
                                                    data1 = [];
                                                    for (var g = 0; g < vars["EDCG"].data.length; g++) {
                                                        data1.push([vars["EDCG"].data[g][0], vars["EDCG"].data[g][1] / centralData[centralID]["Potencia GFV"]]);
                                                    }
                                                    datasets["Ya"] = {"data": data1, "label": "Y<sub>a</sub> (kWh/kWp dia)", "label2": "Y<sub>a</sub>", "yaxis": 5};
                                                    datasets["Yf"] = {"data": data2, "label": "Y<sub>f</sub> (kWh/kWp dia)", "label2": "Y<sub>f</sub>", "yaxis": 5};
                                                    data2 = [];
                                                    for (var g = 0; g < datasets["Ya"].data.length; g++) {
                                                        data2.push([datasets["Ya"].data[g][0], Math.abs(Math.round((datasets["Ya"].data[g][1] - datasets["Yf"].data[g][1]) * 100.0) / 100.0)]);
                                                    }
                                                    datasets["Lbos"] = {"data": data2, "label": "L<sub>BOS</sub> (kWh/kWp dia)", "label2": "L<sub>BOS</sub>", "yaxis": 5};
                                                    data1 = [];
                                                    for (var g = 0; g < vars["EACG"].data.length; g++) {
                                                        data1.push([vars["EACG"].data[g][0], Math.round((vars["EACG"].data[g][1] / vars["EDCG"].data[g][1]) * 10000.0) / 100.0]);
                                                    }
                                                    datasets["Eficbos"] = {"data": data1, "label": "Efic<sub>BOS</sub> (%)", "label2": "Efic<sub>BOS</sub>", "yaxis": 6};
                                                    data2 = [];
                                                    for (var g = 0; g < vars["IT"].data.length; g++) {
                                                        data2.push([vars["IT"].data[g][0], Math.abs(Math.round((vars["IT"].data[g][1] - datasets["Ya"].data[g][1]) * 100.0) / 100.0)]);
                                                    }
                                                    datasets["Lc"] = {"data": data2, "label": "L<sub>c</sub> (kWh/kWp dia)", "label2": "L<sub>c</sub>", "yaxis": 5};
                                                    for (var g = 0; g < datasets["Ya"].data.length; g++) {
                                                        datasets["Ya"].data[g][1] = Math.round(datasets["Ya"].data[g][1] * 100.0) / 100.0;
                                                    }
                                                    for (var g = 0; g < datasets["Yf"].data.length; g++) {
                                                        datasets["Yf"].data[g][1] = Math.round(datasets["Yf"].data[g][1] * 100.0) / 100.0;
                                                    }

                                                    var i = 0;
                                                    $.each(datasets, function (key, val) {
                                                        val.color = i;
                                                        ++i;
                                                    });
                                                    var choiceContainer = $("#choicesYear");
                                                    i = 0;
                                                    if (choiceContainer.html().length === 0) {
                                                        $.each(datasets, function (key, val) {
                                                            if (i < 1)
                                                                choiceContainer.append("<label for='id" + key + "' style='width: 200px'><input type='checkbox' name='" + key +
                                                                        "' checked ='checked' id='id" + key + "'></input>"
                                                                        + val.label2 + "</label>");
                                                            else
                                                            if (i > 6)
                                                                choiceContainer.append("<label for='id" + key + "' style='width: 85px;'><input type='checkbox' name='" + key +
                                                                        "'  id='id" + key + "'></input>"
                                                                        + val.label2 + "</label>");
                                                            else
                                                                choiceContainer.append("<label for='id" + key + "' style='width: 200px;'><input type='checkbox' name='" + key +
                                                                        "'  id='id" + key + "'></input>"
                                                                        + val.label2 + "</label>");
                                                            i++;
                                                        });
                                                        choiceContainer.find("input").click(plotAccordingToYearChoices);
                                                    }

                                                    var csvContent = "Fecha__hora__;";
                                                    var csvContentArray = [];
                                                    var keys = [];
                                                    choiceContainer.find("input").each(function () {
                                                        keys.push($(this).attr("name"));
                                                    });
                                                    for (var x = 0; x < keys.length; x++) {
                                                        csvContent += keys[x] + ";";
                                                    }

                                                    csvContentArray.push(csvContent);
                                                    var tam = datasets[keys[0]].data.length;
                                                    var monthCSV = new Date(date * 1000).getMonth() + 1, yearCSV = new Date(date * 1000).getFullYear();
                                                    for (var z = 0; z < tam; z++) {
                                                        csvContent = "";
                                                        for (var x = 0; x < keys.length; x++) {
                                                            if (x === 0)
                                                                csvContent += datasets[keys[x]].data[z][0] + "/" + yearCSV + ";";
                                                            csvContent += datasets[keys[x]].data[z][1] + ";";
                                                        }
                                                        csvContentArray.push(csvContent);
                                                    }


                                                    csvContent = csvContentArray.join("\n");
                                                    var encodedUri = encodeURI("data:text/csv;charset=utf-8," + csvContent);
                                                    var link = $("#fullDownload");
                                                    link.attr("href", encodedUri);
                                                    link.attr("download", centralData[centralID].Nombre + "_" + yearCSV + ".csv");
                                                    var fulldate = new Date(date * 1000);
                                                    var fullTitle = "Año " + fulldate.getFullYear();
                                                    $('#currentDay').html(fullTitle);
                                                    plotAccordingToYearChoices();
                                                }
                                            });
                                        }

                                        function plotAccordingToYearChoices() {

                                            var data = [];
                                            var choiceContainer = $("#choicesYear");
                                            var num = choiceContainer.length;
                                            choiceContainer.find("input:checked").each(function () {
                                                var key = $(this).attr("name");
                                                if (key && datasets[key]) {
                                                    data.push(datasets[key]);
                                                }
                                            });
                                            if (data.length === 2) {
                                                data[0]["bars"] = {"barWidth": 0.4, "align": "left"};
                                                data[1]["bars"] = {"barWidth": 0.4, "align": "right"};
                                            }

                                            if (data.length === 1) {
                                                data[0]["bars"] = {"barWidth": 0.8, "align": "center"};
                                            }

                                            if (data.length > 1) {
                                                choiceContainer.find("input").each(function () {
                                                    $(this).attr('disabled', 'disabled');
                                                });
                                                choiceContainer.find("input:checked").each(function () {
                                                    $(this).removeAttr('disabled');
                                                });
                                            } else {
                                                choiceContainer.find("input").each(function () {
                                                    $(this).removeAttr('disabled');
                                                });
                                            }
                                            console.log(data);
                                            if (data.length > 0) {

                                                var plot = $.plot("#placeholder", data, {
                                                    series: {
                                                        bars: {
                                                            show: true,
                                                            fill: 0.8
                                                        }
                                                    },
                                                    grid: {
                                                        hoverable: true,
                                                        clickable: true
                                                    },
                                                    yaxes: [{
                                                            position: "right",
                                                            tickDecimals: 0,
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val) : "kWh/m2";
                                                            }
                                                        },
                                                        {
                                                            position: "right",
                                                            tickDecimals: 0,
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val) : "V";
                                                            }
                                                        }, {
                                                            position: "right",
                                                            tickDecimals: 0,
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val) : "Hz";
                                                            }
                                                        }, {
                                                            position: "right",
                                                            tickDecimals: 0,
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val) : "ºC";
                                                            }
                                                        }, {
                                                            position: "right",
                                                            tickDecimals: 2,
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val * 100.0) / 100.0 : "kWh/kWp";
                                                            }
                                                        }, {
                                                            position: "right",
                                                            tickDecimals: 0,
                                                            max: 100,
                                                            tickFormatter: function (val, axis) {
                                                                return val < axis.max ? Math.round(val) : "100%";
                                                            }
                                                        }],
                                                    xaxis: {
                                                        ticksDecimal: 0,
                                                        ticks: 12,
                                                        min: 0.5,
                                                        max: 12.5
                                                                //autoscaleMargin: 0.5
                                                    },
                                                    bars: {
                                                        barWidth: 0.9,
                                                        align: "center"
                                                    }
                                                });
                                                if(centralData[centralID]["Image"] !== "null")  
                                                $("#placeholder").append("<img src=\"Image/" + centralData[centralID]["Image"] + "\" style=\"position: relative;width: 100px;margin-left: 20px;margin-top: 20px;opacity: 0.7;z-index: -1 \">");
                                                $("#placeholder").unbind("plothover");
                                                /*$("#placeholder").bind("plothover", function (event, pos, item)
                                                 {
                                                 
                                                 });*/
                                                var previousPoint = null,
                                                        previousLabel = null;
                                                $("#placeholder").on("plothover", function (event, pos, item) {
                                                    if (item) {
                                                        if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                                                            previousPoint = item.dataIndex;
                                                            previousLabel = item.series.label;
                                                            $("#tooltip").remove();
                                                            var x = item.datapoint[0];
                                                            var y = item.datapoint[1];
                                                            var color = item.series.color;
                                                            //console.log(item.series.xaxis.ticks[x].label);  
                                                            var n = item.series.label.indexOf("(");
                                                            var labelvar = item.series.label.substring(0, n - 1);
                                                            var labelmag = item.series.label.substring(n + 1, item.series.label.length - 1);
                                                            showTooltip(item.pageX,
                                                                    item.pageY,
                                                                    color,
                                                                    "<strong>" + labelvar + "</strong><br>Mes " + item.series.xaxis.ticks[x].label + " : <strong>" + Math.round(y * 100.0) / 100.0 + "</strong>" + labelmag);
                                                        }
                                                    } else {
                                                        $("#tooltip").remove();
                                                        previousPoint = null;
                                                    }
                                                });
                                            }

                                            $('#placeholder').unbind('mouseenter mouseleave');
                                        }




                                        // Load the first series by default, so we don't have an empty plot

                                        $("a.fetchSeries:first").click();
                                        //document.getElementById("fetchSeries").firstChild.click();

                                        setInterval(function () {
                                            /*var temp = $("#inCalendar").datepicker('getDate');
                                            refreshChart(temp, centralID);*/
                                            if (chartmode === "day") {
                                                var temp = $("#inCalendar").datepicker('getDate');
                                                refreshChart(temp, centralID);
                                            }
                                            if (chartmode === "month") {
                                                var temp = $("#inCalendarMonth").datepicker('getDate');
                                                temp = new Date(temp.getFullYear(), temp.getMonth(), 1);
                                                refreshMonthChart(temp, centralID);
                                            }
                                            if (chartmode === "year") {
                                                var temp = $("#inCalendarYear").datepicker('getDate');
                                                temp = new Date(temp.getFullYear(), 0, 1);
                                                refreshYearChart(temp, centralID);
                                            }
                                        }, 600000);
                                    });
                                });



        </script>



    </body>

</html>
