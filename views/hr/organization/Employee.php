<?php
/**
 * Class Employee
 *
 * Manages Employee record GUI
 *
 * @package controllers\hr\organization
 * @category Application View
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace views\hr\organization;

use framework\View;
use models\beans\BeanEmployee;

class Employee extends View
{

    /**
    * Object constructor.
    *
    * @param string|null $tplName The html template containing the static design.
    */
    public function __construct($tplName = null)
    {
        if (empty($tplName))
            $tplName = "/hr/organization/employee";
        parent::__construct($tplName);
    }
    
    /**
    * Sets value for FormTitle placeholder
    *
    * @param mixed $value
    */
    public function setVarFormTitle($value)
    {
        $this->setVar("FormTitle",$value);
    }

    /**
    * Sets value for birth_date placeholder
    *
    * @param mixed $value
    */
    public function setVarbirth_date($value)
    {
        $this->setVar("birth_date",$value);
    }

    /**
    * Sets value for birth_place placeholder
    *
    * @param mixed $value
    */
    public function setVarbirth_place($value)
    {
        $this->setVar("birth_place",$value);
    }

    /**
    * Sets value for first_name placeholder
    *
    * @param mixed $value
    */
    public function setVarfirst_name($value)
    {
        $this->setVar("first_name",$value);
    }

    /**
    * Sets value for id_employee placeholder
    *
    * @param mixed $value
    */
    public function setVarid_employee($value)
    {
        $this->setVar("id_employee",$value);
    }

    /**
    * Sets value for last_name placeholder
    *
    * @param mixed $value
    */
    public function setVarlast_name($value)
    {
        $this->setVar("last_name",$value);
    }

    /**
    * Sets value for readonly placeholder
    *
    * @param mixed $value
    */
    public function setVarreadonly($value)
    {
        $this->setVar("readonly",$value);
    }

    /**
    * Sets value for tax_code placeholder
    *
    * @param mixed $value
    */
    public function setVartax_code($value)
    {
        $this->setVar("tax_code",$value);
    }

    /**
     * Sets value for plant placeholder
     *
     * @param mixed $value
     */
    public function setVarPlant($value)
    {
        $this->setVar("plant",$value);
    }


    /**
     * Sets value for gender placeholder
     *
     * @param mixed $value
     */
    public function setVargender($value)
    {
        $this->setVar("gender",$value);
    }

    /**
    * Opens block ValidationErrors
    *
    */
    public function openBlockValidationErrors()
    {
        $this->openBlock("ValidationErrors");
    }

    /**
    * Sets value for Error inside the block ValidationErrors
    *
    * @param mixed $value
    */
    public function setBlockVarValidationErrorsError($value)
    {
        $this->setVar("Error",$value);
    }


    public function setFieldsWithBeanData(BeanEmployee $bean)
    {
        // Switch form mode
        if ($bean->getIdEmployee() == null) {
            $this->setVarFormTitle("{RES:AddNewEmployee}");
            // $this->setVarreadonly("");
        }else  {
            $this->setVarFormTitle("{RES:EditEmployee} ". $bean->getFirstName() . " ". $bean->getLastName());
            // $this->setVarreadonly("readonly");
        }
        $this->setVarid_employee($bean->getIdEmployee());
        $this->setVarfirst_name($bean->getFirstName());
        $this->setVarlast_name($bean->getLastName());
        $this->setVartax_code($bean->getTaxCode());
        $this->setVargender($bean->getGender());
        $this->setVarbirth_date($bean->getBirthDate());
        $this->setVarbirth_place($bean->getBirthPlace());
        $this->setVarPlant($bean->getPlant());
    }

}
