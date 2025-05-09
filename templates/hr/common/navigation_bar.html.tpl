<style>
    div.background{
        background: url('http://www.cmsapps.it/peopledev/imgs/main.jpg');
        border: 0px solid black;
    }

    div.transparent {
        margin: 30px;
        background-color: #ffffff;
        border: 1px solid black;
        opacity: 0.7;
        filter: alpha(opacity=60); /* For IE8 and earlier */
    }

    div.transparent h3 {
        margin: 5%;
        font-weight: bold;
        color: #000000;
    }
    div.transparent h4 {
        margin: 5%;
        font-weight: bold;
        color: #000000;
    }
    div.transparent h5 {
        margin: 5%;
        font-weight: bold;
        color: #000000;
    }
    div.transparent p {
        margin: 5%;
        font-weight: bold;
        color: #000000;
    }
</style>
<nav class="navbar navbar-default navbar-fluid-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand loading" href="{GLOBAL:SITEURL}/hr/home">People Development</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="loading" id="li_home"><a href="{GLOBAL:SITEURL}/hr/home">Home</a></li>
                <li class="loading" id="li_jobs"><a href="{GLOBAL:SITEURL}/hr/jobdescription/jobs_skills">{RES:JobListManager}</a></li>
                <li class="loading" id="li_assessment"><a href="{GLOBAL:SITEURL}/hr/assessment/employee_assessment">{RES:Assessment}</a></li>
                <li class="loading" id="li_graphs"><a href="{GLOBAL:SITEURL}/hr/assessment/employee_radar_chart">{RES:Graphs}</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">{RES:Administration} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header">{RES:AccessControl}</li>
                        <li class="loading" id="li_users"><a href="{GLOBAL:SITEURL}/common/user_accounts">{RES:UserManager}</a></li>
                        <li class="dropdown-header">{RES:Organizzation}</li>
                        <li class="loading" id="li_employee"><a href="{GLOBAL:SITEURL}/hr/organization/employees">{RES:Employees}</a></li>
                        <li class="dropdown-header">{RES:LanguageSettings}</li>
                        <li class="loading" id="li_it"><a href="?locale=it">{RES:Italian}</a></li>
                        <li class="loading" id="li_en"><a href="?locale=en">{RES:English}</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#about" data-toggle="modal"><span class="glyphicon glyphicon glyphicon-question-sign"></span>&nbsp; {RES:Credits}</a></li>
                
                <!-- BEGIN LogoutAction -->
                <li class="loading"><a href="{GLOBAL:SITEURL}/hr/home/logout"><span class="glyphicon glyphicon-log-out"></span> {RES:Logout}</a></li>
                <li class="active loading"><a href="{GLOBAL:SITEURL}/common/user_account?id_user={LoggedIdUser}"><span class="glyphicon glyphicon-user"></span> {LoggedUserName}</a></li>
                <!-- END LogoutAction -->

                <!-- BEGIN LoginAction -->
                <li class="loading"><a href="{GLOBAL:SITEURL}/common/login?return_link=hr/home"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <!-- END LoginAction -->

            </ul>
        </div>
    </div>
</nav>

<div id="about" class="modal fade bs-example-modal-lg" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">About</h2>
            </div>
            <div class="modal-body background">

                <div class="transparent text-center">
                    <h3>People Development</h3>       
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
            </div>

        </div>
    </div>
</div>
