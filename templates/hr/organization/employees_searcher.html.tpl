<form class="form-horizontal" method="post" name="{search_form}">
    <div id="search-panel" class="panel panel-primary collapse in" aria-expanded="true">
        <div class="panel-heading">
            <h3 class="panel-title">{RES:EmployeesSearchFormTitle}</h3>
        </div>
        <div class="panel-body">
            <div class="form-group row">
                <label class="col-sm-2 control-label text-right">{RES:NameLabel}</label>
                <div class="col-sm-10">
                    <input type="text" value="{s_first_name}" name="s_first_name" id="s_first_name" placeholder="{RES:FirstNamePlaceholder}" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label text-right">{RES:FirstNameLabel}</label>
                <div class="col-sm-10">
                    <input type="text" value="{s_last_name}" name="s_last_name" id="s_last_name" placeholder="{RES:LastNamePlaceholder}" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label text-right">{RES:TaxCode}</label>
                <div class="col-sm-10">
                    <input type="text" value="{s_tax_code}" name="s_tax_code" id="s_tax_code" placeholder="{RES:TaxCodePlaceholder}" class="form-control">
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="form-group row">
                <label class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-10">
                    <input class = "btn btn-primary"  type="submit" name="{search_submit}" value="{RES:SearchSubmitCaption}"> &nbsp;
                    <input class = "btn btn-success"  type="submit" name="{search_reset}"  value="{RES:SearchResetCaption}">
                </div>
            </div>
        </div>
    </div>
</form>