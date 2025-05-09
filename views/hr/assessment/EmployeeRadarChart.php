<?php
/**
 * Class EmployeeRadarChart
 *
 * Manages Views and template
 *
 * @package controllers\hr\assessment
 * @category Application View
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace views\hr\assessment;

use framework\View;

class EmployeeRadarChart extends View
{

    /**
    * Object constructor.
    *
    * @param string|null $tplName The html template containing the static design.
    */
    public function __construct($tplName = null)
    {
        if (empty($tplName))
            $tplName = "/hr/assessment/employee_radar_chart";
        parent::__construct($tplName);
    }

    /**
     * Renders skills of given Employee and Job
     * @param int $currentEmployee
     * @param int $currentEmployeeJob
     */
    public function renderCurrentEmployeeJobsSkills($currentEmployee,$currentEmployeeJob, \mysqli_result $assignedJobs)
    {
        $this->setVar("id_current_job",$currentEmployeeJob );

        if ($assignedJobs->num_rows==0) {
            $this->hide("JobOptionList");
        } else {
            $this->openBlock("JobOptionList");
            while ($job = $assignedJobs->fetch_object()) {
                $this->setVar("option_id_job", $job->id_job);
                $this->setVar("option_job_name", $job->name);
                $this->parseCurrentBlock();
            }
            $this->setBlock();
        }
    }

}
