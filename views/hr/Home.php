<?php
/**
 * Class Home
 *
 * Home View
 *
 * @package controllers\hr
 * @category Application View
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace views\hr;

use framework\View;

class Home extends View
{

    /**
    * Object constructor.
    *
    * @param string|null $tplName The html template containing the static design.
    */
    public function __construct($tplName = null)
    {
        if (empty($tplName))
            $tplName = "/hr/home";
        parent::__construct($tplName);
    }
    
}
