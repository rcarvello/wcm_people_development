<?php
/**
 * Class JobsSkills
 *
 * Performs all the necessary SQL operations for Jobs Skills management.
 *
 * @package models\hr\jobdescription
 * @category Application Model
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace models\hr\jobdescription;

use classes\OperationManager;
use framework\Model;
use models\beans\BeanJobsSkills;
use models\beans\BeanSkill;

class JobsSkills extends Model
{
    /**
    * Object constructor.
    *
    */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Gets job's skills of a given job
     *
     * @param int $idJob The job id to gets skills
     * @return bool|\mysqli_result
     */
    public function getJobsSkills($idJob)
    {
        $sql = <<<SQL
        SELECT
          `jobs_skills`.`id_skill` AS `id_skill`,
          `jobs_skills`.`id_job` AS `id_job`,
          `jobs_skills`.`expected_level` AS `expected_level`,
          `job`.`name` AS `job_name`,
          `skill`.`name` AS `skill_name`
        FROM
          ((`jobs_skills`
          LEFT JOIN `job` ON ((`job`.`id_job` = `jobs_skills`.`id_job`)))
          LEFT JOIN  `skill` ON ((`jobs_skills`.`id_skill` = `skill`.`id_skill`)))
        WHERE 
          job.id_job = $idJob
        ORDER BY
          `job`.`name`,
          `skill`.`name`
SQL;

        $result = $this->query($sql);
        return $result;
    }


    /**
     * Upadates and Deletes Skills of a given jobs.
     *
     * @param int $idJob The job id to uptdate and/or delete skills
     * @param array $skillsExpectedLeves Array of job skills to update
     * @param array null $skillsToRemove Array of job skills to delete
     */
    public function updateJobsSkills($idJob, $skillsExpectedLeves, $skillsToRemove = null)
    {
        foreach ($skillsExpectedLeves as $key=>$value){
            $beanJobsSkills = new BeanJobsSkills($key,$idJob);
            $beanJobsSkills->setExpectedLevel($value);
            $beanJobsSkills->updateCurrent();
        }

        if (!empty($skillsToRemove)){
            foreach ($skillsToRemove as $key=>$value){
                $beanJobsSkills = new BeanJobsSkills($key,$idJob);
                $beanJobsSkills->delete($key,$idJob);
                $baeanSkill = new BeanSkill($key);
                $baeanSkill->delete($key);
            }
        }

    }

    /**
     * Gets unassigned skill list of a given job.
     *
     * @param int $idJob The job id to gets unassigned skilli
     * @return bool|\mysqli_result
     */
    public function getUnassignedSkills($idJob)
    {
    $sql = <<<SQL
    SELECT
        `skill`.`id_skill` AS `id_skill`,
        `skill`.`name` AS `name`,
        `skill`.`description` AS `description`,
        `skill`.`enabled` AS `enabled`
    FROM
        `skill`
    WHERE
      ( NOT (`skill`.`id_skill` IN (
         SELECT
           `jobs_skills`.`id_skill`
         FROM
           `jobs_skills`
         WHERE
           (`jobs_skills`.`id_job` = $idJob)
    )))
    ORDER BY 
      `skill`.`name`
SQL;
        $result = $this->query($sql);
        return $result;
    }

    /**
     * Creates a skill and then assign it to the  given job.
     *
     * @param int $idJob
     * @param string $name
     * @param string $description
     * @param string $expectedLevel
     * @param int $enabled|1
     */
    public function createSkill($idJob, $name, $description, $expectedLevel, $enabled=1)
    {
        $skill = new BeanSkill();
        $skill->setName($name);
        $skill->setDescription($description);
        $skill->setEnabled($enabled);
        $skill->insert();
        $idSkill = $skill->getIdSkill();
        $op = new OperationManager($idSkill, "skill");
        $op->setOwnership();
        $jobsSkills = new BeanJobsSkills();
        $jobsSkills->setIdSkill($idSkill);
        $jobsSkills->setIdJob($idJob);
        $jobsSkills->setExpectedLevel($expectedLevel);
        $jobsSkills->insert();
        $idJobsSkills = $jobsSkills->getIdSkill() . "," . $jobsSkills->getIdJob();
        $op->setTable("jobs_skills");
        $op->setOwnership($idJobsSkills);

    }

    /**
     * Assigns selected and unassigned skills to a given job.
     *
     * @param int $idJob Job id
     * @param array $skills Array containing the selected unassigned skills
     */
    public function selectSkills($idJob,$skills)
    {
        if (!empty($skills)) {
            foreach ($skills as $key => $value) {
                $jobsSkills = new BeanJobsSkills();
                $jobsSkills->setIdSkill($key);
                $jobsSkills->setIdJob($idJob);
                $jobsSkills->setExpectedLevel(1);
                $jobsSkills->insert();
                $op=new OperationManager($key . "," .$idJob, "jobs_skills");
                $op->setOwnership();
            }
        }
    }

    /**
     * Deletes all skills contained into the given array of skills.
     *
     * @param array $skills
     */
    public function deleteSkills($skills)
    {
        if (!empty($skills)) {
            foreach ($skills as $key=>$value){
                $skill = new BeanSkill($key);
                $skill->delete($key);
            }
        }
    }

    /**
     * Gets job list
     * @return bool|\mysqli_result
     */
    public function getJobOptionList()
    {
        $sql = "SELECT * FROM job ORDER BY name";
        $result = $this->query($sql);
        return $result;
    }



}
