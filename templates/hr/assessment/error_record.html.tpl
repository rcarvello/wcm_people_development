<!DOCTYPE html>
<head>
    <title>{RES:ErrorAssignmentTitle}</title>
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body>
{Controller:hr\common\NavigationBar}


<div class="container">
    <form name="employee_error" id="employee_error" method="post" class="form-horizontal">
        <div class="panel panel-primary">

            <div class="panel-heading">
                <h1 class="panel-title">{FormTitle}</h1>
            </div>

            <div class="panel-body">

                <!-- BEGIN ValidationErrors -->
                <div class="form-group col-sm-12">
                    <div class="col-sm-1"></div>
                    <div class="alert alert-danger alert-dismissible col-sm-10" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span></button>{RES:ErrorMessageTitle}
                        <br/>
                        <!-- BEGIN RecordErrors -->
                        <span>{RecordError}</span>
                        <!-- END RecordErrors -->
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <!-- END ValidationErrors -->

                <div class="form-group col-sm-12 hide">
                    <div class="col-sm-4 control-label">
                        <label>Info</label>
                    </div>
                    <div class="col-sm-6 input-group">
                        <input type="hidden" name="id_employee" value="{id_employee}">
                        <input type="hidden" name="id_skill" value="{id_skill}">
                        <input type="hidden" name="assigned_by" value="{assigned_by}">
                        <input type="hidden" name="assignment_date" value="{assignment_date}">

                        {id_job}

                    </div>
                </div>

                <div class="form-group col-sm-12">
                    <div class="col-sm-4 control-label">
                        <label>{RES:FullNameLabel}</label>
                    </div>
                    <div class="col-sm-6 input-group text-danger">
                        <span class="btn btn-default">{CurrentEmployeeFullName}</span>
                    </div>
                </div>

                <div class="form-group col-sm-12">
                    <div class="col-sm-4 control-label">
                        <label>{RES:JobNameLabel}</label>
                    </div>
                    <div class="col-sm-6 input-group">
                        <span class="btn btn-default">{CurrentJobName}</span>
                    </div>
                </div>

                <div class="form-group col-sm-12">
                    <div class="col-sm-4 control-label">
                        <label>{RES:SkillNameLabel}</label>
                    </div>
                    <div class="col-sm-6 input-group">
                        <span class="btn btn-default">{CurrentSkillName}</span>
                    </div>
                </div>

                <div class="form-group col-sm-12">
                    <div class="col-sm-4 control-label">
                        <label>{RES:AssessmentInfo}</label>
                    </div>
                    <div class="col-sm-6 input-group">
                        {AssessorName} - {AsssmentDate}
                    </div>
                </div>

                <div class="form-group col-sm-12">
                    <div class="col-sm-4 control-label">
                        <label class="text-danger">{RES:DescriptionLabel}</label>
                    </div>
                    <div class="col-xs-12 input-group">
                        <textarea class="form-control" rows="7" name="description">{description}</textarea>
                    </div>
                </div>

                <div class="form-group row col-sm-12">
                    <div class="col-sm-4 control-label">
                        <a href="#" id="twttp-quest-btn" data-toggle="modal" data-target="#questionnaires"  class="btn btn-default">
                            <span class="glyphicon glyphicon-list-alt"></span> {RES:TWTTPResultLabel}&nbsp;
                        </a>
                    </div>
                    <div class="col-sm-6 input-group">
                        <label class="radio-inline text-success"><input type="radio" value="ok" id="twttp_result" name="twttp_result">OK</label>
                        <label class="radio-inline text-danger"> <input type="radio" value="ko" id="twttp_result" name="twttp_result">KO</label>
                    </div>
                </div>


                <div class="form-group col-sm-12">
                    <div class="col-sm-4 control-label">
                        <a href="#" id="herca-quest-btn" data-toggle="modal" data-target="#questionnaires"  class="btn btn-default">
                            <span class="glyphicon glyphicon-list-alt"></span> {RES:HERCALabel}
                        </a>
                        <br>
                    </div>
                    <div class="col-sm-6 input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                        </div>
                        <select class="form-control select-option" name="herca_result" id="herca_result" data-option-selected="{herca_result}">
                            <option value="">{RES:SelectValue}</option>
                            <option value="1.1">{RES:Result11}</option>
                            <option value="1.2">{RES:Result12}</option>
                            <option value="2.1">{RES:Result21}</option>
                            <option value="2.2">{RES:Result22}</option>
                            <option value="3.1">{RES:Result31}</option>
                            <option value="3.2">{RES:Result32}</option>
                            <option value="3.3">{RES:Result33}</option>
                            <option value="3.4">{RES:Result34}</option>
                            <option value="3.5">{RES:Result35}</option>
                            <option value="3.6">{RES:Result36}</option>
                            <option value="3.7">{RES:Result37}</option>
                            <option value="4.1">{RES:Result41}</option>
                            <option value="4.2">{RES:Result42}</option>
                            <option value="4.3">{RES:Result43}</option>
                            <option value="4.4">{RES:Result44}</option>
                            <option value="4.5">{RES:Result45}</option>
                            <option value="5.1">{RES:Result51}</option>
                            <option value="5.2">{RES:Result52}</option>
                            <option value="6.1">{RES:Result61}</option>
                            <option value="6.2">{RES:Result62}</option>
                            <option value="6.3">{RES:Result63}</option>
                            <option value="6.4">{RES:Result64}</option>
                        </select>
                    </div>
                </div>


            </div>

            <div class="panel-footer">
                <div class="form-group text-center">
                    <label class="col-sm-1 control-label"></label>
                    <div class="col-sm-10">
                        {Record:ErrorAssignment}
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<div class="container">
    <!-- BEGIN AddError -->
    <a href="{GLOBAL:SITEURL}/hr/assessment/error_record/add/{id_employee}/{id_job}/{id_skill}" class="btn btn-info">{RES:AddError}</a>
    <!-- END AddError -->
    <div class="table-responsive {hide_when_noerrors}">
        <h4>{RES:ErrorsList}</h4>
        <table class="table table-bordered table-hover" id="table_errors">
            <thead>
            <tr>
                <th>{RES:AssignmentDateLabel}</th>
                <th>{RES:TWTTPResultLabel}</th>
                <th>{RES:HERCALabel}</th>
            </tr>

            </thead>
            <tbody>
            <!-- BEGIN ErrorsList -->
                <tr>
                    <td><a href="{GLOBAL:SITEURL}/hr/assessment/error_record/open/{id_assignment}/{id_employee}/{id_job}/{id_skill}">{l_assignment_date}</a></td>
                    <td>{l_twttp_result}</td>
                    <td>{l_herca_result}</td>
                </tr>
            <!-- END ErrorsList -->
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><a href="{GLOBAL:SITEURL}/hr/assessment/error_record/add/{id_employee}/{id_job}/{id_skill}" class="btn btn-info">{RES:AddError}</a></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div id="divLoading"></div>

<div class="modal fade" id="questionnaires" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{RES:QuestionnairesModalTitle}</h4>
            </div>
            <div class="modal-body">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active" id="twttp-tab"> <a href="#tab-twttp" data-toggle="tab">TWTTP</a></li>
                        <li id="herca-tab">                <a href="#tab-herca" data-toggle="tab">HERCA</a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="tab-twttp">
                            <br>
                            <div class="panel panel-primary">
                                <div class="panel-heading">TWTTP</div>
                                <div class="panel-body">
                                    {TWTTPQuestionnaire}
                                </div>
                                <div class="panel-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">{RES:Close}</button>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-herca">
                            <br>
                            <div class="panel panel-primary">
                                <div class="panel-heading">HERCA</div>
                                <div class="panel-body">
                                    {HERCAQuestionnaire}
                                </div>
                                <div class="panel-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">{RES:Close}</button>
                                </div>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function() {

    $("#twttp-quest-btn").click(function () {
        $('#twttp-tab').addClass("active");
        $('#herca-tab').removeClass("active");
        $('#tab-twttp').addClass("active");
        $('#tab-herca').removeClass("active");
    });

    $("#herca-quest-btn").click(function () {
        $('#twttp-tab').removeClass("active");
        $('#herca-tab').addClass("active");
        $('#tab-twttp').removeClass("active");
        $('#tab-herca').addClass("active");
    });

    // var element = document.getElementById('twttp_result');
    $('input[name=twttp_result][value="{twttp_result}"]').prop('checked', true);
    var herca = jQuery('select[name=herca_result]');
    var twttp_result = $('input[name=twttp_result]:radio:checked').val();

    $('.herca-link').click(function () {
        var herca_value = $(this).attr("data-link");
        herca.removeAttr("disabled");
        $('#herca_result').val(herca_value);
        $('input[name="twttp_result"][value="ko"]').prop('checked',false);
        $('input[name="twttp_result"][value="ok"]').prop('checked',true);
    });

    if (twttp_result == 'ok') {
        herca.removeAttr("disabled");
    } else {
        herca.attr('disabled', 'disabled');
        $('#herca_result').val("");
    }

    $('input:radio').click(function() {
        if ($(this).val() == 'ok') {
            herca.removeAttr("disabled");
        } else {
            herca.attr('disabled', 'disabled');
        }
    });

    var selects = $(".select-option");
    $.each(selects, function(key,value){
        currentSelect = $(value);
        defaultValue = currentSelect.attr("data-option-selected");
        currentSelect.val(defaultValue);
    });

    var dataTableAction = {ShowDataTable};
    if (dataTableAction) {
        $('#table_errors').dataTable({
            "responsive": true,
            "paging": true,
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

});
</script>

<script src="{GLOBAL:SITEURL}/js/spinner/spinner.js"></script>

</body>
</html>
