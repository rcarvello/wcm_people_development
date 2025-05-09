<?php
/**
 * Class EmployeeAssessment
 *
 * Manages Assessment View
 *
 * @package models\hr\assessment
 * @category Application Model
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace models\hr\assessment;

use framework\Model;
use framework\User;
use models\beans\BeanAssessment;

class EmployeeAssessment extends Model
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
     * Gets all available jobs to assign for the
     * given Employee.
     *
     * @param int $idEmployee
     * @return bool|\mysqli_result
     */
    public function getUnassignedJobs($idEmployee){
        $sql=<<<SQL
        SELECT 
          id_job, 
          CONCAT(name,REPLACE( CONCAT(' (',description,')'),'(.)','') ) as name
        FROM
          job
        WHERE
          enabled = 1
        AND 
          id_job NOT IN 
          (SELECT id_job 
            FROM employees_jobs_skills 
            WHERE id_employee = $idEmployee)
        ORDER BY 
          name
SQL;
        $result = $this->query($sql);
        return $result;
    }

    /**
     * Gets all assigned jobs for the given Employee.
     *
     * @param int $idEmployee
     * @return bool|\mysqli_result
     */
    public function getAssignedJobs($idEmployee){
        $sql=<<<SQL
        SELECT 
          id_job, 
          CONCAT(name,REPLACE( CONCAT(' (',description,')'),'(.)','') ) as name
        FROM
          job
        WHERE
          enabled = 1
        AND 
          id_job IN 
          (SELECT id_job 
            FROM employees_jobs_skills 
            WHERE id_employee = $idEmployee)
        ORDER BY 
          name
SQL;
        $result = $this->query($sql);
        return $result;
    }

    /**
     * Performs db opertaion for assigning the given Jobs to the
     * given Employee.
     *
     * @param int $idEmplooyee
     * @param array $jobsToAssign
     */
    public function assignJobs($idEmplooyee, $jobsToAssign){
        foreach ($jobsToAssign as $key=>$value){
            $idJob = $key;
            $sql = "SELECT * FROM jobs_skills WHERE id_job=$idJob";
            $result = $this->query($sql);
            if ($result){
                while ($jobSkill = $result->fetch_object()){
                    $idSkill = $jobSkill->id_skill;
                    $sql = "INSERT INTO employees_jobs_skills (id_employee, id_job, id_skill) VALUES ($idEmplooyee,$idJob,$idSkill)";
                    $this->query($sql);
                    $user = new User();
                    $currentDate = date('Y-m-d h:i:s', time());
                    $bean = new BeanAssessment();
                    $bean->setIdEmployee($idEmplooyee);
                    $bean->setIdSkill($idSkill);
                    $bean->setAssessedBy($user->getId());
                    $bean->setAssessmentDate($currentDate);
                    $bean->setAssessedLevel(1);
                    $bean->insert();
                }
            }
        }
    }

    /**
     * Performs db operations for unassigning the given Jobs to
     * the given Employee.
     *
     * @param int $idEmplooyee
     * @param array $jobsToAssign
     */
    public function unAssignJobs($idEmplooyee, $jobsToUnAssign){
        foreach ($jobsToUnAssign as $key=>$value){
            $idJob = $key;
            // Deleting related but unshared skill errors
            $sql = "DELETE FROM errors_assignment WHERE id_employee=$idEmplooyee and id_skill NOT IN (SELECT id_skill FROM employees_jobs_skills WHERE id_job!=$idJob AND id_employee=$idEmplooyee)";

            $this->query($sql);
            // Deleting related but unshared skill assessments
            $sql = "DELETE FROM assessment WHERE id_employee=$idEmplooyee and id_skill NOT IN (SELECT id_skill FROM employees_jobs_skills WHERE id_job!=$idJob AND id_employee=$idEmplooyee)";
            $this->query($sql);
            // Unassigns job and its relaed skills
            $sql = "DELETE FROM employees_jobs_skills WHERE id_employee=$idEmplooyee AND id_job=$idJob";
            $this->query($sql);
        }
    }

    /**
     * Gets skills for the given Employee and Job.
     *
     * @param int $currentEmployee
     * @param int $currentEmployeeJob
     * @return bool|\mysqli_result
     */
    public function getCurrentEmployeeJobsSkills($currentEmployee,$currentEmployeeJob){
        $sql="SELECT * FROM all_assessments WHERE id_employee=$currentEmployee AND id_job=$currentEmployeeJob ORDER BY id_job,skill_name";
        $result = $this->query($sql);
        return $result;
    }
}
