<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>People Development Manager</title>
    <meta charset="{RES:HTMLENCODING}">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta name="author" content="Rosario Carvello - rosario.carvello@gmail.com">
    <meta name="generator" content="Powered by PHP WEB MVC Framework">
    <meta name="copyright" content="Rosario Carvello">
    <meta name="robots" content="all">

    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="{GLOBAL:SITEURL}/js/spinner/spinner.css" rel="stylesheet">
    <link rel="manifest" href="manifest.webmanifest">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->

    <!--  IOS -->
    <!-- meta name = "viewport" content = "user-scalable=no, width=device-width"-->
    <meta name="apple-mobile-web-app-title" content="People Development">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="apple-touch-icon" href="{GLOBAL:SITEURL}/icons/icon36.png">
    <link rel="apple-touch-startup-image" href="{GLOBAL:SITEURL}/icons/icon256.png">


</head>
<body>
{Controller:hr\common\NavigationBar}
<div class="container">
    <img src="{GLOBAL:SITEURL}/imgs/main.jpg" class="center-block img-responsive">
    <a href="{GLOBAL:SITEURL}/hr/organization/employees" class="btn btn-lg btn-info btn-block"><span class="glyphicon glyphicon-user"></span> {RES:HomeEmployeeManager}</a>
    <!-- a href="{GLOBAL:SITEURL}/common/user_accounts" class="btn btn-lg btn-info btn-block"><span class="glyphicon glyphicon-user"></span> {RES:HomeUserManager}</a -->
    <a href="{GLOBAL:SITEURL}/hr/jobdescription/jobs_skills" class="btn btn-lg btn-info btn-block"><span class="glyphicon glyphicon-align-justify"></span> {RES:HomeJobListManager}</a>
    <a href="{GLOBAL:SITEURL}/hr/assessment/employee_assessment" class="btn btn-lg btn-info btn-block"><span class="glyphicon glyphicon-saved"></span> {RES:HomeAssessment}</a>
    <a href="{GLOBAL:SITEURL}/hr/assessment/employee_radar_chart" class="btn btn-lg btn-info btn-block"><span class="glyphicon glyphicon-stats"></span> {RES:HomeEvaluationGraph}</a>
    <br>
    <img src="{GLOBAL:SITEURL}/imgs/customer_logo.png" class="brand center-block img-responsive">

</div>
<div id="divLoading"></div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="{GLOBAL:SITEURL}/js/spinner/spinner.js"></script>
</body>
</html>
