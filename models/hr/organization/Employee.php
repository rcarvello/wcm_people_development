<?php
/**
 * Class Employee
 *
 * Manages Employee table actions
 *
 * @package models\hr\organization
 * @category Application Model
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace models\hr\organization;

use framework\Model;
use models\beans\BeanEmployee;

class Employee extends Model
{
    /**
    * Object constructor.
    *
    */
    public function __construct()
    {
        parent::__construct();
    }

    public function setBeanWithPostedData(BeanEmployee $bean)
    {
        // $bean->setIdEmployee($_POST["id_employee"]);
        $bean->setFirstName($_POST["first_name"]);
        $bean->setLastName($_POST["last_name"]);
        $bean->setGender($_POST["gender"]);
        $bean->setBirthDate($_POST["birth_date"]);
        $bean->setBirthPlace($_POST["birth_place"]);
        $bean->setTaxCode($_POST["tax_code"]);
        $bean->setPlant($_POST["plant"]);
    }
}
