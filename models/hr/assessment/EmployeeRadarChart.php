<?php
/**
 * Class EmployeeRadarChart
 *
 * Provides data for rendering radar charts
 *
 * @package models\hr\assessment
 * @category Application Model
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace models\hr\assessment;

use framework\Model;

class EmployeeRadarChart extends Model
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
    * Autorun method. Put your code here for running it after object creation.
    * @param mixed|array|null $parameters Additional parameters to manage
    *
    */
    protected function autorun($parameters = null)
    {

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
          id_job,name
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
          id_job,name
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
     * Gets skills for the given Employee and Job.
     *
     * @param int $currentEmployee
     * @param int $currentEmployeeJob
     * @return bool|\mysqli_result
     */
    public function getCurrentEmployeeJobsSkills($currentEmployee,$currentEmployeeJob){
        $sql="SELECT * FROM all_assessments WHERE id_employee=$currentEmployee AND id_job=$currentEmployeeJob ORDER BY skill_name";
        $result = $this->query($sql);
        if ($result){
            $skills="";
            while($row = $result->fetch_object()){
                $skills .= '"'. $row->skill_name . '"' . ",";
            }
            $skills = substr($skills,0,-1);
        } else {
            $skills = "";
        }
        return $skills;
    }

    /**
     * Gets skills expected levels for the given Employee and Job.
     *
     * @param int $currentEmployee
     * @param int $currentEmployeeJob
     * @return bool|\mysqli_result
     */
    public function getExpectedLevels($currentEmployee,$currentEmployeeJob){
        $sql="SELECT * FROM all_assessments WHERE id_employee=$currentEmployee AND id_job=$currentEmployeeJob ORDER BY skill_name";
        $result = $this->query($sql);
        if ($result){
            $levels ="";
            while($row = $result->fetch_object()){
                $levels .=  $row->expected_level .  ",";
            }
            $levels = substr($levels,0,-1);
        } else {
            $levels = "";
        }
        return $levels;
    }

    /**
     * Gets skills assessment levels for the given Employee and Job.
     *
     * @param int $currentEmployee
     * @param int $currentEmployeeJob
     * @return bool|\mysqli_result
     */
    public function getAssessmentLevels($currentEmployee,$currentEmployeeJob){
        $sql="SELECT * FROM all_assessments WHERE id_employee=$currentEmployee AND id_job=$currentEmployeeJob ORDER BY skill_name";
        $result = $this->query($sql);
        if ($result){
            $levels ="";
            while($row = $result->fetch_object()){
                $levels .=  $row->assessed_level .  ",";
            }
            $levels = substr($levels,0,-1);
        } else {
            $levels = "";
        }
        return $levels;
    }


    /**
     * Gets skills previous assessment levels for the given Employee and Job.
     *
     * @param int $currentEmployee
     * @param int $currentEmployeeJob
     * @return bool|\mysqli_result
     */
    public function getPreviousLevels($currentEmployee,$currentEmployeeJob){
        $sql="SELECT * FROM all_assessments WHERE id_employee=$currentEmployee AND id_job=$currentEmployeeJob ORDER BY skill_name";
        $result = $this->query($sql);
        if ($result){
            $levels ="";
            while($row = $result->fetch_object()){
                $previous = empty($row->previous_level)?1:$row->previous_level;
                $levels .=  $previous .  ",";
            }
            $levels = substr($levels,0,-1);
        } else {
            $levels = "";
        }
        return $levels;
    }
}
