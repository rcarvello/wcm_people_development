<?php
/**
 * Class Employees
 *
 * Manages Employees
 *
 * @package controllers\hr\orhanization
 * @category Application Controller
 * @author  Rosario Carvello - rosario.carvello@gmail.com
 */
namespace controllers\hr\organization;

use framework\Controller;
use framework\Model;
use framework\User;
use framework\View;
use framework\components\DataRepeater;
use models\hr\organization\Employees as EmployeesModel;
use views\hr\organization\Employees as EmployeesView;
use controllers\hr\common\NavigationBar;

class Employees extends Controller
{
    protected $view;
    protected $model;

    /**
    * Object constructor.
    *
    * @param View $view
    * @param Model $mode
    */
    public function __construct(View $view=null, Model $model=null)
    {
        // $this->grantRole(100);
        $this->restrictToAuthentication(null,"hr/organization/employees",LoginAuthWarningMessage);
        // $this->restrictToRBAC(null,"hr/organization/employees",LoginRBACWarningMessage);

        $this->view = empty($view) ? $this->getView() : $view;
        $this->model = empty($model) ? $this->getModel() : $model;
        $this->model->getEmployess();
        parent::__construct($this->view,$this->model);

        $nav = new NavigationBar();
        $this->bindController($nav);
    }

    /**
    * Autorun method. Put your code here for running it after object creation.
    * @param mixed|null $parameters Parameters to manage
    *
    */
    protected function autorun($parameters = null)
    {
        if ($this->model->getResultSet()->num_rows !=0) {
            $employees = new  DataRepeater($this->view, $this->model, "Employees", null);
            $this->bindComponent($employees);
        } else {
            $this->hide("Employees");
        }
    }

    /**
    * Inizialize the View by loading static design of /hr/organization/employees.html.tpl
    * managed by views\hr\organization\Employees class
    *
    */
    public function getView()
    {
        $view = new EmployeesView("/hr/organization/employees");
        return $view;
    }

    /**
    * Inizialize the Model by loading models\hr\organization\Employees class
    *
    */
    public function getModel()
    {
        $model = new EmployeesModel();
        return $model;
    }
}
