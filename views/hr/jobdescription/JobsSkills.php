<?php
/**
 * Class Mansionario
 *
 * Manage Jobs Skill HTML Template by providing methods for rendering dynamic data.
 *
 * @package views\hr\jobdescription
 * @category Application View
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace views\hr\jobdescription;

use classes\OperationManager;
use framework\View;
use models\beans\BeanJob;


class JobsSkills extends View
{

    /**
    * Object constructor.
    *
    * @param string|null $tplName The html template containing the static design.
    */
    public function __construct($tplName = null)
    {
        if (empty($tplName))
            $tplName = "/hr/jobdescription/jobs_skills";
        parent::__construct($tplName);
    }

    /**
     * Populates block of skills for the active job.
     *
     * @param \mysqli_result $jobsSkills
     */
    private function populateJobSkills(\mysqli_result $jobsSkills)
    {
        $this->openBlock("JobsSkills");
        while ($skill = $jobsSkills->fetch_object()){
           $this->setVar("skill_name", $skill->skill_name);
           $this->setVar("id_skill", $skill->id_skill);
           $this->setVar("expected_level", $skill->expected_level);
           $currentJobsSkillsId = $skill->id_skill . "," . $skill->id_job;
           $op = new OperationManager($currentJobsSkillsId,"jobs_skills");
           if($op->isOwner()){
               $this->setVar("hide_remove_jobs_skills", "");
           } else {
               $this->setVar("hide_remove_jobs_skills", "hide");
           }
           $this->parseCurrentBlock();
        }
        $this->setBlock();
    }

    /**
     * Populates block of unassigned skills for the active job.
     *
     * @param \mysqli_result $unassignedSkills
     */
    private function populateUnassignedSkills(\mysqli_result $unassignedSkills)
    {
        $this->openBlock("UnassignedSkills");
        while ($skill = $unassignedSkills->fetch_object()){
            $this->setVar("unassigned_skill_name", $skill->name);
            $this->setVar("unassigned_id_skill", $skill->id_skill);
            $this->parseCurrentBlock();
        }
        $this->setBlock();
    }

    /**
     * Renders job skills GUI of a given job.
     *
     * @param int $idCurrentJob
     * @param \mysqli_result $jobsSkills
     */
    public function renderJobSkills($idCurrentJob=null, $jobsSkills = null){
        if (!empty($idCurrentJob)) {
            $this->setVar("id_current_job", $idCurrentJob);
        } else {
            $this->setVar("id_current_job", "0");
        }
        if (empty($idCurrentJob)){
            $this->hide("JobsSkills");
            $this->setVar("jobs_skills_action_hide","hide");
        } else {
            if ($jobsSkills->num_rows == 0){
                $this->hide("JobsSkills");
                $this->setVar("jobs_skills_action_hide","hide");
            } else {
                $this->hide("NoJobsSkills");
                $this->setVar("jobs_skills_action_hide","");
                $this->populateJobSkills($jobsSkills);
            }
        }
    }

    /**
     * Renders unassignet skill of the current active job.
     *
     * @param \mysqli_result|null $unassignedSkills
     */
    public function renderUnassignedSkills($unassignedSkills = null)
    {
        if (@$unassignedSkills->num_rows == 0) {
            $this->hide("UnassignedSkills");
            $this->setVar("data_table_action","false");
            $this->setVar("unassigned_skills_actions_hide","hide");
        } else {
            $this->populateUnassignedSkills($unassignedSkills);
            $this->hide("NoUnassignedSkills");
            $this->setVar("data_table_action","true");
            $this->setVar("unassigned_skills_actions_hide","");
        }
    }

    public function renderJobOptionList($jobList){
        if ($jobList->num_rows != 0) {
            $this->openBlock("JobOptionList");
            while ($job = $jobList->fetch_object()) {
                $this->setVar("option_job_id", $job->id_job);
                $this->setVar("option_job_name", $job->name);
                $this->parseCurrentBlock();
            }
            $this->setBlock();
        } else {
            $this->hide("JobOptionList");
        }
    }

    public function renderCurrentJob($idCurrentJob=null)
    {
        if (!empty($idCurrentJob)){
            $job = new BeanJob($idCurrentJob);
            $this->setvar("job_description",$job->getDescription());
            $this->setvar("job_name",$job->getName());
            $op = new OperationManager($idCurrentJob,"job");
            if ($op->isOwner()) {
                $this->setvar("hide_when_no_job", "");
            } else {
                $this->setvar("hide_when_no_job","hide");
            }
        } else {
            $this->setvar("hide_when_no_job","hide");
            $this->setvar("job_description","");

        }
    }

}
