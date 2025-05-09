<?php
/**
 * Class EmployeeAssessment
 *
 * Handles Employee assessment requests
 *
 * @package controllers\hr\assessment
 * @category Application Controller
 * @author  Rosario Carvello - rosario.carvello@gmail.com
 */

namespace controllers\hr\assessment;

use controllers\hr\common\NavigationBar;
use framework\Controller;
use framework\Model;
use framework\User;
use framework\View;
use models\beans\BeanAssessment;
use models\beans\BeanEmployee;

use models\hr\assessment\EmployeeAssessment as EmployeeAssessmentModel;
use views\hr\assessment\EmployeeAssessment as EmployeeAssessmentView;

class EmployeeAssessment extends Controller
{
    protected $view;
    protected $model;

    private $debugMode = false;

    /**
     * Stores current selected Employee
     * @var int
     */
    private $currentEmployee;

    /**
     * Stores current select jop for the active Employee
     * @var int
     */
    private $currentEmployeeJob;

    /**
     * Stores assigned jobs for the current Employee
     * @var array
     */
    private $assignedJobs;

    /**
     * Stores available jobs to assign to the current Employee
     * @var array
     */
    private $unassignedJobs;

    /**
     * Object constructor.
     *
     * @param View $view
     * @param Model $mode
     */
    public function __construct(View $view = null, Model $model = null)
    {
        $this->restrictToAuthentication(null, "hr/organization/employees", LoginAuthWarningMessage);
        $this->view = empty($view) ? $this->getView() : $view;
        $this->model = empty($model) ? $this->getModel() : $model;
        parent::__construct($this->view, $this->model);
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
        $this->manageCurrents();
        $this->view->renderUnAssignedJobs($this->unassignedJobs);
        $this->view->renderAssignedJobs($this->assignedJobs);
        $this->view->showNotifyMessage();
    }

    /**
     * Computes all Employee assessment action depending on user request.
     * @param int $currentEmployee The Employee id
     *
     */
    private function manageRequest($currentEmployee)
    {

        // Close Request
        if (isset($_REQUEST["close_assessment"])) {
            unset($_SESSION["id_current_employee"]);
            unset($_SESSION["id_employee_current_job"]);
            header("location: " . SITEURL . "/hr/home");
        }

        // Do not performs any actions if no employee is selected
        if ($currentEmployee == 0)
            return;

        // Jobs assignment request
        if (isset($_REQUEST["submit_assign_jobs"])) {
            if (isset($_REQUEST["unassigned_jobs"]) && !empty($_REQUEST["unassigned_jobs"])) {
                $jobsToAssign = $_REQUEST["unassigned_jobs"];
                $this->model->assignJobs($currentEmployee, $jobsToAssign);
                $this->currentEmployeeJob = 0;
            }
        }

        // Jobs un assignment request
        if (isset($_REQUEST["submit_unassign_jobs"])) {
            if (isset($_REQUEST["assigned_jobs"]) && !empty($_REQUEST["assigned_jobs"])) {
                $jobsToUnAssign = $_REQUEST["assigned_jobs"];
                $this->model->unAssignJobs($currentEmployee, $jobsToUnAssign);
                $this->currentEmployeeJob = 0;
                unset($_SESSION["id_employee_current_job"]);
            }
        }

        // Assessment request
        if (isset($_REQUEST["submit_assessment"])) {
            $assessments = $_REQUEST["assessed_levels"];
            foreach ($assessments as $key => $val) {
                $bean = new BeanAssessment($this->currentEmployee, $key);
                $user = new User();
                $currentDate = date('Y-m-d h:i:s', time());
                $previous = $bean->getAssessedLevel();
                if ($val != $bean->getAssessedLevel())
                    $bean->setPreviousLevel($previous);
                $bean->setAssessedBy($user->getId());
                $bean->setAssessmentDate($currentDate);
                $bean->setAssessedLevel($val);
                $bean->updateCurrent();
            }
        }

        // Rendering Employee skills for active job
        $this->view->renderCurrentEmployeeJobsSkills($this->currentEmployee, $this->currentEmployeeJob);

        // Rendering Employee assessment for active job
        if ($this->currentEmployeeJob != 0 && $this->currentEmployee != 0) {
            $currentEmployeeJobsSkill = $this->model->getCurrentEmployeeJobsSkills($this->currentEmployee, $this->currentEmployeeJob);
            $this->view->renderCurrentEmployeeAssessment($currentEmployeeJobsSkill);
        }
    }

    /**
     *  Computes for the currents Employee, job and skills.
     */
    private function manageCurrents()
    {
        // Shows debug mode (if is required)
        if ($this->debugMode) {
            var_dump($_REQUEST);
            var_dump($_SESSION);
        }

        // Manages if is an active employee
        if (empty($_REQUEST["id_employee"]))
            $id_current_employee = $_SESSION["id_current_employee"];

        else {
            $id_current_employee = $_REQUEST["id_employee"];
            if ($id_current_employee != $_SESSION["id_current_employee"]) {
                unset($_SESSION["id_employee_current_job"]);
                $this->currentEmployeeJob = 0;
            }
            $_SESSION["id_current_employee"] = $id_current_employee;
        }
        $this->currentEmployee = (int)$id_current_employee;

        // Manages if is an active employee job
        if (empty($_REQUEST["id_job"]))
            @$id_employee_current_job = $_SESSION["id_employee_current_job"];
        else {
            $id_employee_current_job = $_REQUEST["id_job"];
            $_SESSION["id_employee_current_job"] = $id_employee_current_job;
        }
        $this->currentEmployeeJob = (int)$id_employee_current_job;


        // Computes if user commit some requests on the active Employee
        if ($this->currentEmployee == 0) {
            header("location: " . SITEURL . "/hr/organization/employees");
        } else {
            $this->manageRequest($this->currentEmployee);
            $emp = new BeanEmployee($this->currentEmployee);
            $this->view->setVar("CurrentEmployeeFullName", $emp->getLastName() . " " . $emp->getFirstName());
            $this->assignedJobs = $this->model->getAssignedJobs($this->currentEmployee);
            $this->unassignedJobs = $this->model->getUnassignedJobs($this->currentEmployee);
        }

    }

    /**
     * Inizialize the View by loading static design of /hr/assessment/employee_assessment.html.tpl
     * managed by views\hr\assessment\EmployeeAssessment class
     *
     */
    public function getView()
    {
        $view = new EmployeeAssessmentView("/hr/assessment/employee_assessment");
        return $view;
    }

    /**
     * Inizialize the Model by loading models\hr\assessment\EmployeeAssessment class
     *
     */
    public function getModel()
    {
        $model = new EmployeeAssessmentModel();
        return $model;
    }
}
