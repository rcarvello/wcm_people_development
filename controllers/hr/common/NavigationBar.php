<?php
/**
 * Class NavigationBar
 *
 * Navigation bars
 *
 * @package controllers\hr\common
 * @category Application Controller
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace controllers\hr\common;

use framework\Controller;
use framework\Model;
use framework\User;
use framework\View;
use models\hr\common\NavigationBar as NavigationBarModel;
use views\hr\common\NavigationBar as NavigationBarView;

class NavigationBar extends Controller
{
    protected $view;
    protected $model;

    /**
    * Object constructor.
    *
    * @param View $view
    * @param Model $mode
    */
    public function __construct(View $view=null, Model $model=null)
    {
        $this->view = empty($view) ? $this->getView() : $view;
        $this->model = empty($model) ? $this->getModel() : $model;
        parent::__construct($this->view,$this->model);
        $user = new User();
        if ($user->isLogged()){
            $this->view->hide("LoginAction");
        } else {
            $this->view->hide("LogoutAction");
        }
    }

    /**
    * Autorun method. Put your code here for running it after object creation.
    * @param mixed|null $parameters Parameters to manage
    *
    */
    protected function autorun($parameters = null)
    {

    }

    /**
    * Inizialize the View by loading static design of /common/navigation_bar.html.tpl
    * managed by views\common\NavigationBar class
    *
    */
    public function getView()
    {
        $view = new NavigationBarView("/hr/common/navigation_bar");
        return $view;
    }

    /**
    * Inizialize the Model by loading models\common\NavigationBar class
    *
    */
    public function getModel()
    {
        $model = new NavigationBarModel();
        return $model;
    }
}
