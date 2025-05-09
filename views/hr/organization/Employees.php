<?php
/**
 * Class Employees
 *
 * Renders Employees dynamic data.
 *
 * @package controllers\hr\organization
 * @category Application View
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace views\hr\organization;

use framework\View;

class Employees extends View
{

    /**
    * Object constructor.
    *
    * @param string|null $tplName The html template containing the static design.
    */
    public function __construct($tplName = null)
    {
        if (empty($tplName))
            $tplName = "/hr/organization/employees";
        parent::__construct($tplName);
    }
    
}
