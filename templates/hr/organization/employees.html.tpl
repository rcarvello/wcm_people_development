<!DOCTYPE html>
<html>
<head>
    <title>{RES:Employees}</title>
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
</head>
<body>
{Controller:hr\common\NavigationBar}
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <a href="{GLOBAL:SITEURL}/hr/organization/employee" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> {RES:Employees}</a>
        </div>
        <div class="panel-body">
            <div class="table table-responsive">
                <table class="table table-bordered table-hover" id="table_employees">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{RES:last_name}</th>
                            <th>{RES:first_name}</th>
                            <th>{RES:tax_code}</th>
                            <th>Plant</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- BEGIN Employees -->
                        <tr>
                            <td class="col-xs-1 text-center">
                                <a class="btn btn-success btn-xs" href="{GLOBAL:SITEURL}/hr/assessment/employee_assessment?id_employee={id_employee}"><span class="glyphicon glyphicon-saved" aria-hidden="true"></span></a>
                            </td>
                            <td><a href="{GLOBAL:SITEURL}/hr/organization/employee/open/{id_employee}">{last_name}</a></td>
                            <td>{first_name}</td>
                            <td>{tax_code}</td>
                            <td>{plant}</td>
                        </tr>
                    <!-- END Employees -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="divLoading"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<script type="text/javascript">

    $(document).ready(function() {

        var dataTableAction = true;
        if (dataTableAction) {
            $('#table_employees').dataTable({
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
                    "search": "{RES:BTD_SEARCH}",
                    "searchPlaceholder": "{RES:BTD_SEARCH_PLACEHOLDER}",
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

            $('#table_employees').DataTable();
        }


    });

</script>

<script src="{GLOBAL:SITEURL}/js/spinner/spinner.js"></script>
</body>
</html>