<!DOCTYPE html>
<head>
    <title>{RES:JobListManagerTitle}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Rosario Carvello - rosario.carvello@gmail.com">
    <meta name="generator" content="Powered by PHP WEB MVC Framework">
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
    <style>
        .modal-dialog{
            overflow-y: initial !important
        }
        .modal-body{
            height: 600px;
            overflow-y: auto;
        }
        input[list]
        {
            border: .1em solid #137da0;
            font-size: 1em;
            font-weight: bold;
            color: blue;
            padding: 1px 1px;
            cursor: pointer;
        }

    </style>
</head>
<body>
{Controller:hr\common\NavigationBar}
<div class="container">
    <form action="" method="post" name="form_select_job">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a data-toggle="modal" data-target="#modal_job" class="btn btn-default"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {RES:JobButtonCaption}</a>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12 col-md-12 input-group">
                        <input class="input-group" id="find_job" list="find_job_list" name="find_job" placeholder="{RES:BTD_FIND}" autocomplete = "off">
                        <datalist id="find_job_list">
                            <!-- BEGIN JobOptionList -->
                            <option value="{option_job_id}">{option_job_name}</option>
                            <!-- END JobOptionList -->
                        </datalist>
                    </div>
                    <div class="col-lg-12 col-md-12 input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                        </div>
                        <select class="form-control" id="id_job" name="id_job">
                            <option value="">{RES:SelectAJob}</option>
                            <!-- BEGIN JobOptionList -->
                            <option value="{option_job_id}">{option_job_name}</option>
                            <!-- END JobOptionList -->

                        </select>
                    </div>
                    {job_description}
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container">
    <form action="" method="post" name="form_jobs_skills">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a data-toggle="modal"data-target="#modal_skills" class="btn btn-default"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {RES:SkillsButtonCaption}</a>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-condensed table-hover">
                        <thead>
                        <tr>
                            <th>{RES:SkillCaption}</th>
                            <th>{RES:SkillExpectedValueCaption}</th>
                            <th><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- BEGIN JobsSkills -->
                        <tr>
                            <td>{skill_name}</td>
                            <td>
                                <div class="col-lg-4 col-md-4">
                                    <select class="form-control select-option" id="expected_levels[{id_skill}]" name="expected_levels[{id_skill}]" data-option-selected="{expected_level}" required>
                                        <option value="">{RES:Value}</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </td>
                            <td><input class="{hide_remove_jobs_skills}" name="removes_id_skill[{id_skill}]" type="checkbox" value=""></td>
                        </tr>
                        <!-- END JobsSkills -->
                        <!-- BEGIN NoJobsSkills -->
                        <tr>
                            <td colspan="2">{RES:NoJobsFoundMessage}</td>
                        </tr>
                        <!-- END NoJobsSkills -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer text-center">
                <input type="submit" class="btn btn-primary {jobs_skills_action_hide}" value="{RES:SubmitUpdateJobsSkillCaption}"  name="submit_update_jobs_skills" id="submit_save_jobs_skills">
            </div>
        </div>
    </form>
</div>
<div id="divLoading"></div>

<!-- Modal for Jobs Management -->
<div class="modal fade" id="modal_job" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{RES:MJCaption}</h4>
            </div>
            <div class="modal-body">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-add-job" data-toggle="tab">{RES:MJAddTabCaption}</a></li>
                        <li class="{hide_when_no_job}"><a href="#tab-edit-job" data-toggle="tab">{RES:MJUpdateTabCaption}</a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="tab-add-job">
                            <br/>
                            <form name="form_add_job" method="post">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        {RES:MJNewJobPanelTitle}
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="col-lg-4 col-md-4 control-label">
                                                <label>{RES:NameLabel}</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 input-group">
                                                <div class="input-group-addon">
                                                    <i class="glyphicon glyphicon glyphicon-tag"></i>
                                                </div>
                                                <input class="form-control" type="text" value="" id="name" name="name" placeholder="{RES:JobNamePlaceHolder}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-4 col-md-4 control-label">
                                                <label>{RES:DescriptionLabel}</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 input-group">
                                                <div class="input-group-addon">
                                                    <i class="glyphicon glyphicon glyphicon-edit"></i>
                                                </div>
                                                <input class="form-control" type="text" value="" id="description" name="description"   placeholder="{RES:JobDescriptionPlaceHolder}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-footer">
                                        <input type="submit" class="btn btn-success" name="submit_add_job" value="{RES:AddButton}">
                                        <a href="#" class="btn btn-default" data-dismiss="modal">{RES:CancelLinkCaption}</a>

                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="tab-edit-job">
                            <br/>
                            <form name="form_edit_job" method="post">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        {RES:MJEditJobPanelTitle}
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="col-lg-4 col-md-4 control-label">
                                                <label>{RES:NameLabel}</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 input-group">
                                                <div class="input-group-addon">
                                                    <i class="glyphicon glyphicon glyphicon-tag"></i>
                                                </div>
                                                <input class="form-control" type="text"  id="name" name="name" value="{job_name}" placeholder="{RES:JobNamePLaceHolder}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-4 col-md-4 control-label">
                                                <label>{RES:DescriptionLabel}</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 input-group">
                                                <div class="input-group-addon">
                                                    <i class="glyphicon glyphicon glyphicon-edit"></i>
                                                </div>
                                                <input class="form-control" type="text" id="description" name="description" value="{job_description}" placeholder="{RES:JobDescriptionPlaceHolder}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-footer">
                                        <input type="submit" class="btn btn-success" name="submit_edit_job"  value="{RES:UpdateButton}">
                                        <input type="submit" class="btn btn-danger"  name="submit_delete_job" value="{RES:DeleteButton}">
                                        <a href="#" class="btn btn-default" data-dismiss="modal">{RES:CancelLinkCaption}</a>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="divLoading"></div>
</div>

<!-- Modal For Jobs Skills Management -->
<div class="modal fade" id="modal_skills" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{RES:MJSTitle}</h4>
            </div>
            <div class="modal-body">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-seleziona-compentenze" data-toggle="tab">{RES:MJSSelectTabCaption}</a></li>
                        <li class="{hide_when_no_job}"><a href="#tab-nuova-competenza" data-toggle="tab">{RES:MJSAddTabCaption}</a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="tab-seleziona-compentenze">
                            <br />
                            <form name="form_unassigned_skills" method="post">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        {RES:SelectOneOrMoreSkillsPanelTitle}
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-borderd table-hover table-striped" id="table_elenco_competenze">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>{RES:SkillThCaption}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- BEGIN UnassignedSkills -->
                                            <tr>
                                                <td><input name="skills[{unassigned_id_skill}]" type="checkbox" value=""></td>
                                                <td>{unassigned_skill_name}</td>
                                            </tr>
                                            <!-- END UnassignedSkills -->
                                            <!-- BEGIN NoUnassignedSkills -->
                                            <tr>
                                                <td colspan="2">{RES:NoSkillsForSelecting}</td>
                                            </tr>
                                            <!-- END NoUnassignedSkills -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="panel-footer {unassigned_skills_actions_hide}">
                                        <input class="btn btn-success" type="submit" name ="submit_select_skills" value="{RES:AssigButton}">
                                        <input class="btn btn-danger" type="submit" name ="submit_delete_skills" value="{RES:DeleteButton}">
                                        <a href="#" class="btn btn-default" data-dismiss="modal">{RES:CancelLinkCaption}</a>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div class="tab-pane" id="tab-nuova-competenza">
                            <br />
                            <form name="form_create_skill" role="form" action="" method="post">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        {RES:AddSkillPanelTitle}
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="col-lg-4 col-md-4 control-label">
                                                <label>{RES:NameLabel}</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 input-group">
                                                <div class="input-group-addon">
                                                    <i class="glyphicon glyphicon glyphicon-tag" aria-hidden="true"></i>
                                                </div>
                                                <input class="form-control" type="text" value="" id="name" name="name" placeholder="{RES:SkillNamePlaceHolder}" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-4 col-md-4 control-label">
                                                <label>{RES:DescriptionLabel}</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 input-group">
                                                <div class="input-group-addon">
                                                    <i class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></i>
                                                </div>
                                                <input class="form-control" type="text" value="" id="description" name="description" placeholder="{RES:SkillDescriptionPlaceHolder}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-4 col-md-4 control-label">
                                                <label>{RES:ExpectedValueLabel}</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 input-group">
                                                <div class="input-group-addon">
                                                    <i class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></i>
                                                </div>
                                                <select class="form-control" id="expected_level" name="expected_level" required>
                                                    <option value="">{RES:Value}</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <input type="submit" class="btn btn-success" name="submit_create_skill" value="{RES:AddButton}">
                                        <a href="#" class="btn btn-default" data-dismiss="modal">{RES:CancelLinkCaption}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
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

    var dataTableAction = {data_table_action};
    if (dataTableAction) {
        $('#table_elenco_competenze').dataTable({
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

        //$('#table_elenco_competenze').DataTable();
    }
    $("#id_job").change(function(){
        document.forms['form_select_job'].submit();
        $("#divLoading").addClass('show');
    });


    $("#find_job").on('input', function () {
        var val = this.value;
        if($('#find_job_list').find('option').filter(function(){
                return this.value.toUpperCase() === val.toUpperCase();
            }).length) {
            document.forms['form_select_job'].submit();
            $("#divLoading").addClass('show');
        }
    });

    var id_current_job = {id_current_job};
    if (id_current_job > 0)
        $("#id_job").val(id_current_job);

    var selects = $(".select-option");
    $.each(selects, function(key,value){
        currentSelect = $(value);
        defaultValue = currentSelect.attr("data-option-selected");
        currentSelect.val(defaultValue);
    });

});

</script>
<script src="{GLOBAL:SITEURL}/js/spinner/spinner.js"></script>
</body>
</html>