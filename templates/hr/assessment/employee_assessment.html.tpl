<!DOCTYPE html>
<head>
    <title>{RES:AssessmentTitle}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Rosario Carvello - rosario.carvello@gmail.com">
    <meta name="generator" content="Powered by PHP WEB MVC Framework https://github.com/rcarvello/webmvcframework">
    <meta name="copyright" content="Rosario Carvello">
    <meta name="robots" content="all">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
    <link href="{GLOBAL:SITEURL}/js/spinner/spinner.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->
</head>
<body>
{Controller:hr\common\NavigationBar}
<div class="container">
    <form action="" method="post" name="form_select_job">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a data-toggle="modal" data-target="#modal_job_assignment_management" class="btn btn-default"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> {CurrentEmployeeFullName}</a>
                <a class="btn btn-default loading" href="{GLOBAL:SITEURL}/hr/assessment/employee_radar_chart"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> </a>
                <a class="btn btn-default loading" href="{GLOBAL:SITEURL}/hr/organization/employees"><span class="glyphicon glyphicon-repeat" aria-hidden="true"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
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
</div>

<div class="container">
    <!-- BEGIN Notify -->
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span>
            <span class="sr-only">Close</span></button>
        <br/>
        <span>{NotifyStatus}</span>
    </div>
    <!-- END Notify -->

    <form action="" method="post" name="form_jobs_skills">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-saved" aria-hidden="true"></span> {RES:AssessmentPanelCaption}</a>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-condensed table-hover">
                        <thead>
                        <tr>
                            <th>{RES:SkillNameCaption}</th>
                            <th>{RES:SkillExpectedValueCaption}</th>
                            <th>{RES:SkillAssessedLevelCaption}</th>
                            <th class="text-center"><span class="glyphicon glyphicon-step-backward"></th>
                            <th class="text-center"><span class="glyphicon glyphicon-triangle-top"></span></th>
                            <th class="text-center"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- BEGIN EmployeeAssessment -->
                        <tr>
                            <td>{skill_name}</td>
                            <td>{expected_level}</td>
                            <td>
                                <div>
                                    <select class="form-control select-option" id="assessed_levels[{id_skill}]" name="assessed_levels[{id_skill}]" data-option-selected="{assessed_level}" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </td>
                            <td class="text-center">{previous_level}</td>
                            <td class="text-center"><span class="badge alert-{delta_alert_class}">{delta}</span></td>
                            <td class="text-center"><a href="{errror_link}" class="btn btn-{error_class}">{error_caption}</a></td>
                        </tr>
                        <!-- END EmployeeAssessment -->
                        <!-- BEGIN NoEmployeeAssessment -->
                        <tr>
                            <td colspan="6">{RES:NoEmployeeAssessmentMessage}</td>
                        </tr>
                        <!-- END NoEmployeeAssessment -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer text-center">
                <input type="submit" class="btn btn-primary {assessment_action_hide}" value="{RES:SubmitAssessmentCaption}"  name="submit_assessment" id="submit_assessment">
                <input type="submit" class="btn btn-warning" value="{RES:CloseAssessmentCaption}"  name="close_assessment" id="close_assessment">
            </div>
        </div>
    </form>
</div>
<div id="divLoading"></div>

<!-- Modal for modal_job_assignment_management -->
<div class="modal fade" id="modal_job_assignment_management" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{RES:JobsAssignmentModalTitle}</h4>
            </div>
            <div class="modal-body">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active {hide_when_no_unassigned_jobs}"><a href="#tab-unassign-employee-job" data-toggle="tab">{RES:JobsToAssignTabCaption}</a></li>
                        <li class="{hide_when_no_assigned_jobs}"><a href="#tab-assign-employee-job" data-toggle="tab">{RES:JobsToUnassignTabCaption}</a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="tab-unassign-employee-job">
                            <br/>
                            <form name="form_assign_jobs" method="post">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        {RES:UnassignedJobsPanelTitle}
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-borderd table-hover table-striped" id="table_unassigned_jobs">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>{RES:JobThCaption}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- BEGIN UnassignedJobs -->
                                            <tr>
                                                <td><input name="unassigned_jobs[{unassigned_id_job}]" type="checkbox" value=""></td>
                                                <td>{unassigned_job_name}</td>
                                            </tr>
                                            <!-- END UnassignedJobs -->
                                            <!-- BEGIN NoUnassignedJobs -->
                                            <tr>
                                                <td colspan="2">{RES:NoUnassignedJobsMessage}</td>
                                            </tr>
                                            <!-- END NoUnassignedJobs -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="panel-footer {assign_jobs_actions_hide}">
                                        <input class="btn btn-success {hide_assign}" type="submit" name ="submit_assign_jobs" value="{RES:AssignJobsButton}">
                                        <a href="#" class="btn btn-default" data-dismiss="modal">{RES:CancelLinkCaption}</a>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div class="tab-pane" id="tab-assign-employee-job">
                            <br/>
                            <form name="form_unassign_jobs" method="post">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        {RES:AssignedJobsPanelTitle}
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-borderd table-hover table-striped" id="table_assigned_jobs">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>{RES:JobThCaption}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- BEGIN AssignedJobs -->
                                            <tr>
                                                <td><input name="assigned_jobs[{assigned_id_job}]" type="checkbox" value=""></td>
                                                <td>{assigned_job_name}</td>
                                            </tr>
                                            <!-- END AssignedJobs -->
                                            <!-- BEGIN NoAssignedJobs -->
                                            <tr>
                                                <td colspan="2">{RES:NoAssignedJobsMessage}</td>
                                            </tr>
                                            <!-- END NoAssignedJobs -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="panel-footer {unassign_jobs_actions_hide}">
                                        <input class="btn btn-danger {hide_unassign}" type="submit" name ="submit_unassign_jobs" value="{RES:UnassignJobsButton}">
                                        <a href="#" class="btn btn-default" data-dismiss="modal">{RES:CancelLinkCaption}</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <br/>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">

    $(document).ready(function() {
        $('#notify-link').click(function () {
            $('#message').removeClass('hide');
        });
        var dataTableAction = {data_table_action};
        if (dataTableAction) {
            $('#table_unassigned_jobs').dataTable({
                "responsive": true,
                "paging": true,
                "columnDefs": [
                    {
                        "orderable": false,
                        "targets": 0,
                    }
                ],
                "language": {
                    "lengthMenu": "_MENU_ {RES:BTD_LENGTH_FOR_PAGE}",
                    "zeroRecords": "{RES:BTD_NO_RECORDS}",
                    "info": "_PAGE_ {RES:BTD_OF} _PAGES_",
                    "infoEmpty": "{RES:BTD_NO_RECORDS}",
                    "search": "",
                    "searchPlaceholder": "{RES:BTD_FIND}",
                    "infoFiltered": "({RES:BTD_RESULT_OF} _MAX_ {RES:BTD_RESULT_TOTALS})",
                    "paginate": {
                        "first": "{RES:BTD_FIRST}",
                        "last": "{RES:BTD_LAST}",
                        "next": "{RES:BTD_NEXT}",
                        "previous": "{RES:BTD_PREVIOUS}",
                    }
                    ,
                }
            });

        }

        var id_current_job = {id_current_job};
        if (id_current_job > 0)
            $("#id_job").val(id_current_job);

        var selects = $(".select-option");
        $.each(selects, function(key,value){
            currentSelect = $(value);
            defaultValue = currentSelect.attr("data-option-selected");
            currentSelect.val(defaultValue);
        });

        $("#id_job").change(function(){
            document.forms['form_select_job'].submit();
            $("#divLoading").addClass('show');
        });

    });

</script>
<script src="{GLOBAL:SITEURL}/js/spinner/spinner.js"></script>

</body>
</html>
