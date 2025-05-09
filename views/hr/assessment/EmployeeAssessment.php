<?php
/**
 * Class EmployeeAssessment
 *
 * Manages Assessment View and its related HTML template.
 *
 * @package controllers\hr\assessment
 * @category Application View
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace views\hr\assessment;

use classes\AssessmentErrorManager;
use framework\View;

class EmployeeAssessment extends View
{

    /**
    * Object constructor.
    *
    * @param string|null $tplName The html template containing the static design.
    */
    public function __construct($tplName = null)
    {
        if (empty($tplName))
            $tplName = "/hr/assessment/employee_assessment";
        parent::__construct($tplName);
    }


    public function showNotifyMessage(){
        if (isset($_SESSION["notify_status"])){
            $status= $_SESSION["notify_status"];
            unset($_SESSION["notify_status"]);
            $this->setVar("NotifyStatus", $status);
        } else {
            $this->hide("Notify");
        }

    }
    /**
     * Helper for rendering Employee unassigned jobs
     * @param \mysqli_result $unAssignedJobs
     */
    private function populateUnAssignedJobs(\mysqli_result $unAssignedJobs)
    {
        $this->openBlock("UnassignedJobs");
        while ($job = $unAssignedJobs->fetch_object()){
            $this->setVar("unassigned_id_job", $job->id_job);
            $this->setVar("unassigned_job_name", $job->name);
            $this->parseCurrentBlock();
        }
        $this->setBlock();
    }

    /**
     * Renders Employee unassigned jobs
     * @param \mysqli_result $unAssignedJobs
     */
    public function renderUnAssignedJobs(\mysqli_result $unAssignedJobs)
    {
        if ($unAssignedJobs->num_rows==0) {
            $this->hide("UnassignedJobs");
            $this->setVar("hide_assign","hide");
            $this->setVar("data_table_action","false");
        } else {
            $this->hide("NoUnassignedJobs");
            $this->setVar("hide_assign","");
            $this->setVar("data_table_action","true");
            $this->populateUnAssignedJobs($unAssignedJobs);
        }

    }

    /**
     * Helper for rendering Employee assigned jobs
     * @param \mysqli_result $AssignedJobs
     */
    private function populateAssignedJobs(\mysqli_result $AssignedJobs)
    {
        $this->openBlock("AssignedJobs");
        while ($job = $AssignedJobs->fetch_object()){
            $this->setVar("assigned_id_job", $job->id_job);
            $this->setVar("assigned_job_name", $job->name);
            $this->parseCurrentBlock();
        }
        $this->setBlock();

        // Set the pointer back to the beginning fo a new loop
        $AssignedJobs->data_seek(0);

        $this->openBlock("JobOptionList");
        while ($job = $AssignedJobs->fetch_object()){
            $this->setVar("option_id_job", $job->id_job);
            $this->setVar("option_job_name", $job->name);
            $this->parseCurrentBlock();
        }
        $this->setBlock();

    }

    /**
     * Renders Employee assigned job
     * @param \mysqli_result $AssignedJobs
     */
    public function renderAssignedJobs(\mysqli_result $AssignedJobs)
    {
        if ($AssignedJobs->num_rows==0) {
            $this->hide("AssignedJobs");
            $this->hide("JobOptionList");
            $this->setVar("hide_unassign","hide");
        }else {
            $this->hide("NoAssignedJobs");
            $this->setVar("hide_unassign","");
            $this->populateAssignedJobs($AssignedJobs);
        }

    }

    /**
     * Renders Employee jobs skills assessment
     *
     * @param \mysqli_result $employeeJobsSkills
     */
    public function renderCurrentEmployeeAssessment(\mysqli_result $employeeJobsSkills)
    {
        $this->openBlock("EmployeeAssessment");
        while ($row = $employeeJobsSkills->fetch_object()){
            $this->setVar("skill_name", $row->skill_name);
            $this->setVar("expected_level", $row->expected_level);
            $this->setVar("id_skill", $row->id_skill);
            $this->setVar("assessed_level", $row->assessed_level);
            $this->setVar("previous_level", $row->previous_level);

            // Computes for delta
            $delta = (int) $row->delta;
            $this->setVar("delta", $delta);
            if ($delta<0){
                $deltaClass="danger";
            } elseif($delta==0) {
                $deltaClass="success";
            } else {
                $deltaClass="info";
            }
            $this->setVar("delta_alert_class", $deltaClass);

            // Computes for human error by using AssessmentErrorManager
            $idEmployee = $row->id_employee;
            $idJob = $row->id_job;
            $idSkill = $row->id_skill;

            $error = new AssessmentErrorManager($idEmployee,$idJob,$idSkill);
            $this->setVar("error_class", $error->getErrorCSSClass());
            $this->setVar("error_caption",$error->getErrorCaption());
            $this->setVar("errror_link",$error->getErrorLink());

            $this->parseCurrentBlock();
        }
        $this->setBlock();
    }

    /**
     * Renders skills of given Employee and Job
     * @param int $currentEmployee
     * @param int $currentEmployeeJob
     */
    public function renderCurrentEmployeeJobsSkills($currentEmployee,$currentEmployeeJob)
    {
        $this->setVar("id_current_job",$currentEmployeeJob );
        if ($currentEmployeeJob==0 || $currentEmployee == 0){
            $this->hide("EmployeeAssessment");
        } else {
            $this->hide("NoEmployeeAssessment");
        }
    }





}
