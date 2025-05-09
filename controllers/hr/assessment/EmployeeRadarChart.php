<?php
/**
 * Class EmployeeRadarChart
 *
 * Manages Employee Rada Chart
 *
 * @package controllers\hr\assessment
 * @category Application Controller
 * @author  Rosario Carvello - rosario.carvello@gmail.com
 */

namespace controllers\hr\assessment;

use controllers\hr\common\NavigationBar;
use framework\Controller;
use framework\Model;
use framework\View;
use models\beans\BeanEmployee;
use models\hr\assessment\EmployeeRadarChart as EmployeeRadarChartModel;
use views\hr\assessment\EmployeeRadarChart as EmployeeRadarChartView;

class EmployeeRadarChart extends Controller
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
     * Comma separated values for Job Skills
     * @var string
     */
    private $jobSkills;

    /**
     * Comma separated vaules for skills expected levels
     * @var string
     */
    private $expectedLevels;

    /**
     * Comma separated values for skills assessment levels
     * @var string
     */
    private $assessmentsLeves;

    /**
     * Comma separated values for skills previous levels
     * @var string
     */
    private $previousLevels;

    /**
     * Object constructor.
     *
     * @param View $view
     * @param Model $mode
     */
    public function __construct(View $view = null, Model $model = null)
    {
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
    }

    /**
     * Computes all Employee assessment action depending on user request.
     * @param int $currentEmployee The Employee id
     *
     */
    private function manageRequest($currentEmployee)
    {

        // Do not performs any actions if no employee is selected
        if ($currentEmployee == 0)
            return;

        // Rendering Employee skills for active job
        $this->view->renderCurrentEmployeeJobsSkills($this->currentEmployee, $this->currentEmployeeJob, $this->assignedJobs);
        $this->view->setVar("SKILLS", $this->jobSkills);
        $this->view->setVar("EXPECTED_LEVELS", $this->expectedLevels);
        $this->view->setVar("ASSESSMENT_LEVELS", $this->assessmentsLeves);
        $this->view->setVar("PREVIOUS_LEVELS", $this->previousLevels);

        // Rendering chart
        if ($this->currentEmployeeJob != 0 && $this->currentEmployee != 0) {
            //TODO

        }

        if (empty($this->jobSkills)) {
            $this->view->setVar("ShowRadar", "false");
            $this->hide("RadarChart");
        } else {
            $this->view->setVar("ShowRadar", "true");
            $this->hide("NoRadarChart");
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
            $id_employee_current_job = $_SESSION["id_employee_current_job"];
        else {
            $id_employee_current_job = $_REQUEST["id_job"];
            $_SESSION["id_employee_current_job"] = $id_employee_current_job;
        }
        $this->currentEmployeeJob = (int)$id_employee_current_job;


        // Computes if user commit some requests on the active Employee
        if ($this->currentEmployee == 0) {
            header("location: " . SITEURL . "/hr/organization/employees");
        } else {
            $emp = new BeanEmployee($this->currentEmployee);
            $this->view->setVar("CurrentEmployeeFullName", $emp->getLastName() . " " . $emp->getFirstName());
            $this->assignedJobs = $this->model->getAssignedJobs($this->currentEmployee);
            $this->jobSkills = $this->model->getCurrentEmployeeJobsSkills($this->currentEmployee, $this->currentEmployeeJob);
            $this->expectedLevels = $this->model->getExpectedLevels($this->currentEmployee, $this->currentEmployeeJob);
            $this->assessmentsLeves = $this->model->getAssessmentLevels($this->currentEmployee, $this->currentEmployeeJob);
            $this->previousLevels = $this->model->getPreviousLevels($this->currentEmployee, $this->currentEmployeeJob);
            $this->manageRequest($this->currentEmployee);
        }

    }

    /**
     * Inizialize the View by loading static design of /hr/assessment/employee_radar_chart.html.tpl
     * managed by views\hr\assessment\EmployeeRadarChart class
     *
     */
    public function getView()
    {
        $view = new EmployeeRadarChartView("/hr/assessment/employee_radar_chart");
        return $view;
    }

    /**
     * Inizialize the Model by loading models\hr\assessment\EmployeeRadarChart class
     *
     */
    public function getModel()
    {
        $model = new EmployeeRadarChartModel();
        return $model;
    }
}
