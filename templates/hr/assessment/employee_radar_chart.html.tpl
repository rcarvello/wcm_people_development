<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Radar Chart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Rosario Carvello - rosario.carvello@gmail.com">
    <meta name="generator" content="Powered by PHP WEB MVC Framework - https://github.com/rcarvello/webmvcframework">
    <meta name="copyright" content="Rosario Carvello">
    <meta name="robots" content="all">

    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
    <link href="http://localhost/peopledev/js/spinner/spinner.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <!--style>
        .container {
            width: 100%;
            #margin: 15px auto;
        }
    </style -->
</head>
<body>
{Controller:hr\common\NavigationBar}
<div class="container">
        <form action="" method="post" name="form_select_job">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <a class="btn btn-default loading" href="{GLOBAL:SITEURL}/hr/organization/employees"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {CurrentEmployeeFullName}</a>
                    <a class="btn btn-default loading" href="{GLOBAL:SITEURL}/hr/assessment/employee_assessment"><span class="glyphicon glyphicon-saved" aria-hidden="true"></span> </a>
                    <a href="#" class="btn btn-default" onclick="$('#radarChart').css('width','+=10');$('#radarChart').css('height','+=10');"> <span class="glyphicon glyphicon-zoom-in"></span></a>
                    <a href="#" class="btn btn-default" onclick="$('#radarChart').css('width','-=10');$('#radarChart').css('height','-=10');"> <span class="glyphicon glyphicon-zoom-out"></span></a>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-lg-12 col-md-12 input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                            </div>
                            <select class="form-control" id="id_job" name="id_job">
                                <option value="">{RES:SelectAnAssignedJob}</option>
                                <!-- BEGIN JobOptionList -->
                                <option value="{option_id_job}">{option_job_name}</option>
                                <!-- END JobOptionList -->

                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <!-- BEGIN NoRadarChart -->
    <h3>{RES:UnavailableChart}</h3>
    <!-- END NoRadarChart -->
</div>

<!-- BEGIN RadarChart -->
<canvas id="radarChart"></canvas>
<!-- END RadarChart -->
<div id="divLoading"></div>
</body>

<script>
    var ctx = document.getElementById("radarChart");
    var shwowRadarChart = {ShowRadar};
    if (shwowRadarChart) {
        var radarChart = new Chart(ctx, {
            type: 'radar',
            scaleOverride: true,
            scaleSteps: 1,
            scaleStepWidth: 5,
            scaleStartValue: 1,
            data: {
                labels: [{SKILLS}],
                datasets: [
                    {
                        label: '{RES:PreviousLegend}',
                        backgroundColor: "rgba(224, 224, 224, 0.4)",
                        borderColor: "rgba(224, 224, 224, 1)",
                        data: [{PREVIOUS_LEVELS}]
                    },
                    {
                        label: '{RES:AssessedLegend}',
                        backgroundColor: "rgba(0,102,0,0.4)",
                        borderColor: "rgba(0,102,0,1)",
                        data: [{ASSESSMENT_LEVELS}]
                    },
                    {
                        label: '{RES:ExpectedLegend}',
                        backgroundColor: "rgba(50,125,181,0.93)",
                        borderColor: "rgba(11, 40, 75, 1)",
                        data: [{EXPECTED_LEVELS}]
                    },

                ]
            }
        });
    }

    var id_current_job = {id_current_job};
    if (id_current_job > 0)
        $("#id_job").val(id_current_job);


    $("#id_job").change(function(){
        document.forms['form_select_job'].submit();
        $("#divLoading").addClass('show');
    });

</script>
<script src="{GLOBAL:SITEURL}/js/spinner/spinner.js"></script>

</html>
