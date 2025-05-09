<?php
/**
 * Class ErrorRecord
 *
 * Manages Error Assignments table operations
 *
 * @package models\hr\assessment
 * @category Application Model
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace models\hr\assessment;

use framework\Model;
use models\beans\BeanErrorsAssignment;

class ErrorRecord extends Model
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
     * Sets BeanErrorsAssignment attributes with data from $_POST
     * @param BeanErrorsAssignment $bean
     */
    public function setBeanWithPostedData(BeanErrorsAssignment $bean)
    {
        $bean->setIdEmployee($_POST["id_employee"]);
        $bean->setIdSkill($_POST["id_skill"]);
        $bean->setDescription($_POST["description"]);
        $bean->setAssignedBy($_POST["assigned_by"]);
        $bean->setAssignmentDate($_POST["assignment_date"]);
        $bean->setTwttpResult($_POST["twttp_result"]);
        $bean->setHercaResult($_POST["herca_result"]);
    }

    /**
     * Gets errors list of the given employee skil.
     *
     * @param $idEmployee
     * @param $idSkill
     * @return bool|\mysqli_result
     */
    public function getErrorsHistory($idEmployee,$idSkill)
    {
        $sql = "SELECT * FROM errors_assignment WHERE id_employee=$idEmployee AND id_skill=$idSkill";
        $result = $this->query($sql);
        return $result;
    }
}
