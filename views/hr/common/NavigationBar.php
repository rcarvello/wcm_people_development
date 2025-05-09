<?php
/**
 * Class NavigationBar
 *
 * Manages Navigation Bars Dynamic Content
 *
 * @package controllers\hr\common
 * @category Application View
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace views\hr\common;

use framework\User;
use framework\View;
use models\beans\BeanUser;

class NavigationBar extends View
{

    /**
    * Object constructor.
    *
    * @param string|null $tplName The html template containing the static design.
    */
    public function __construct($tplName = null)
    {
        if (empty($tplName))
            $tplName = "/hr/common/navigation_bar";
        parent::__construct($tplName);
        $this->setVarLoggedUserName();
    }
    
    /**
    * Sets value for LoggedUserName placeholder
    *
    * @param mixed $value
    */
    private function setVarLoggedUserName()
    {
        $loggedUser = new User();
        $loggedUser->autoLoginFromCookies();
        if (!$loggedUser->isLogged()){
            $value = "Guest";
        } else {
            $user = new BeanUser($loggedUser->getId());
            $value = $user->getFullName();
        }
        $this->setVar("LoggedUserName",$value);
        $this->setVar("LoggedIdUser",$loggedUser->getId());
    }

}
