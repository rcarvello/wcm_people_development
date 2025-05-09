<!DOCTYPE html>
<html>
<head>
    <title>{RES:EmployeePageTitle}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Rosario Carvello - rosario.carvello@gmail.com">
    <meta name="generator" content="Powered by PHP WEB MVC Framework">
    <meta name="copyright" content="Rosario Carvello">
    <meta name="robots" content="all">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link href="{GLOBAL:SITEURL}/js/spinner/spinner.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>
<body>
{Controller:hr\common\NavigationBar}
<div class="container">
    <form name="employee_record_form" id="employee_record_form" method="post" class="form-horizontal">
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
                        <span id="campione_record_inccampioneErrorBlock">{RecordError}</span>
                        <!-- END RecordErrors -->
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <!-- END ValidationErrors -->

                <div class="form-group col-sm-12">
                    <div class="col-sm-4 control-label">
                        <label class="text-danger">{RES:LastName}</label>
                    </div>

                    <div class="col-sm-6 input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                        </div>
                        <input type="hidden" class="form-control" name="id_employee" value="{id_employee}">
                        <input type="text" class="form-control" placeholder="{RES:PlaceHolderLastName}" name="last_name" value="{last_name}" required>
                    </div>
                </div>

                <div class="form-group col-sm-12">
                    <div class="col-sm-4 control-label">
                        <label class="text-danger">{RES:FirstName}</label>
                    </div>
                    <div class="col-sm-6 input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                        </div>
                        <input type="text"   class="form-control" placeholder="{RES:PlaceHolderFirstName}" name="first_name" value="{first_name}" required>
                    </div>
                </div>

                <div class="form-group col-sm-12">
                    <div class="col-sm-4 control-label">
                        <label class="text-danger">{RES:TaxCode}</label>
                    </div>
                    <div class="col-sm-6 input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="{RES:PlaceHolderTaxCode}" name="tax_code" value="{tax_code}" required>
                    </div>
                </div>

                <div class="form-group row col-sm-12">
                    <div class="col-sm-4 control-label">
                        <label>{RES:Gender}</label>
                    </div>
                    <div class="col-sm-6 input-group">
                        <label class="radio-inline"><input type="radio" value="M" name="gender">M</label>
                        <label class="radio-inline"><input type="radio" value="F" name="gender">F</label>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <div class="col-sm-4 control-label">
                        <label>{RES:BirthDate}</label>
                    </div>
                    <div class="col-sm-6 input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                        </div>
                        <input type="date" class="form-control" placeholder="{RES:PlaceHolderBirthDate}" name="birth_date" value="{birth_date}">
                    </div>
                </div>

                <div class="form-group col-sm-12">
                    <div class="col-sm-4 control-label">
                        <label>{RES:BirthPlace}</label>
                    </div>
                    <div class="col-sm-6 input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="{RES:PlaceHolderBirthPlace}" name="birth_place" value="{birth_place}" >
                    </div>
                </div>

                <div class="form-group col-sm-12">
                    <div class="col-sm-4 control-label">
                        <label class="text-danger">Plant</label>
                    </div>
                    <div class="col-sm-2 col-md-2 input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="Plant" name="plant" value="{plant}" >
                    </div>
                </div>


            </div>
                
            <div class="panel-footer">
                <div class="form-group text-center">
                  <label class="col-sm-1 control-label"></label> 
                  <div class="col-sm-10">
                    {Record:EmployeeRecord}
                  </div>
                </div>
            </div>
        
        </div> 
    </form>
</div>
<div id="divLoading"></div>
<script type="text/javascript">
    var element = document.getElementById('gender');
    // element.value = '{gender}';
    $('input[name=gender][value="{gender}"]').prop('checked', true);
</script>

<script src="{GLOBAL:SITEURL}/js/spinner/spinner.js"></script>
</body>
</html>