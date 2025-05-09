<?php
/**
 * Class ErrorRecord
 *
 * Manages Error Assignments View and HTML Template
 *
 * @package controllers\hr\assessment
 * @category Application View
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace views\hr\assessment;

use framework\User;
use framework\View;
use models\beans\BeanEmployee;
use models\beans\BeanErrorsAssignment;
use models\beans\BeanJob;
use models\beans\BeanSkill;
use models\beans\BeanUser;

class ErrorRecord extends View
{

    /**
    * Object constructor.
    *
    * @param string|null $tplName The html template containing the static design.
    */
    public function __construct($tplName = null)
    {
        if (empty($tplName))
            $tplName = "/hr/assessment/error_record";
        parent::__construct($tplName);
        $twttpQuestionnaire = file_get_contents("templates/hr/assessment/QuestionnarieTWTTP.html");
        $this->setVar("TWTTPQuestionnaire",$twttpQuestionnaire);
        $hercaQuestionnaire = file_get_contents("templates/hr/assessment/QuestionnarieHERCA.html");
        $this->setVar("HERCAQuestionnaire",$hercaQuestionnaire);
    }

    /**
     * Sets view placeholders with data from BeanErrorsAssignment
     * @param BeanErrorsAssignment $bean
     */
    public function setFieldsWithBeanData(BeanErrorsAssignment $bean)
    {
        $assignedBy = $bean->getAssignedBy();
        if (!empty($assignedBy)) {
            $user = new BeanUser($bean->getAssignedBy());
        } else {
            $currentUser = new User();
            $user = new BeanUser($currentUser->getId());
        }
        $emp = new BeanEmployee($_GET["id_employee"]);
        $job = new BeanJob($_GET["id_job"]);
        $skill = new BeanSkill($_GET["id_skill"]);
        $this->setVar("id_employee",$emp->getIdEmployee() );
        $this->setVar("id_job", $job->getIdJob());
        $this->setVar("id_skill", $skill->getIdSkill());
        $this->setVar("assigned_by", $user->getIdUser());
        $this->setVar("AssessorName", $user->getFullName());

        $timestamp = strtotime($bean->getAssignmentDate());
        if (empty($timestamp))
            $timestamp = time();
        $this->setVar("AsssmentDate", date("d-m-Y",$timestamp));
        $this->setVar("assignment_date", date("Y-m-d",$timestamp));

        $this->setVar("CurrentEmployeeFullName", $emp->getLastName() . " " . $emp->getFirstName());
        $this->setVar("CurrentJobName", $job->getName());
        $this->setVar("CurrentSkillName", $skill->getName());
        $this->setVar("description", $bean->getDescription());
        $this->setVar("twttp_result", $bean->getTwttpResult());
        $this->setVar("herca_result", $bean->getHercaResult());

        if ($bean->getIdAssignment()>0) {
            $this->setVar("FormTitle", "{RES:EditErrorAssigment}");
        } else {
            $this->setVar("FormTitle", "{RES:AddErrorAssignment}");
        }
    }

    /**
     * Renders errors list
     * @param \mysqli_result $result
     */
    public function renderErrorHistory(\mysqli_result $result)
    {
        if ($result->num_rows>1){
            $this->setVar("ShowDataTable","true");
            $this->hide("AddError");
            $this->openBlock("ErrorsList");
            while ($row = $result->fetch_object()){
                $this->setVar("id_assignment",$row->id_assignment);
                $timestamp = strtotime($row->assignment_date);
                $this->setVar("l_assignment_date",date("d-m-Y",$timestamp));
                $this->setVar("l_twttp_result",$row->twttp_result);
                $this->setVar("l_herca_result",$row->herca_result);
                $this->parseCurrentBlock();
            }
            $this->setBlock();
        } else {
            $this->setVar("hide_when_noerrors","hide");
            $this->setVar("ShowDataTable","false");
            if ($result->num_rows==0){
                $this->hide("AddError");
            }
        }
    }
}
