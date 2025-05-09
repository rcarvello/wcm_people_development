<?php
/**
 * Class Home
 *
 * Application Home
 *
 * @package controllers\hr
 * @category Application Controller
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace controllers\hr;

use framework\Controller;
use framework\Model;
use framework\User;
use framework\View;
use models\hr\Home as HomeModel;
use views\hr\Home as HomeView;
use controllers\hr\common\NavigationBar;

class Home extends Controller
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
    }

    /**
    * Autorun method. Put your code here for running it after object creation.
    * @param mixed|null $parameters Parameters to manage
    *
    */
    protected function autorun($parameters = null)
    {
        $nav = new NavigationBar();
        $this->bindController($nav);
    }

    /**
    * Inizialize the View by loading static design of /common/home.html.tpl
    * managed by views\common\Home class
    *
    */
    public function getView()
    {
        $view = new HomeView("/hr/home");
        return $view;
    }

    /**
    * Inizialize the Model by loading models\common\Home class
    *
    */
    public function getModel()
    {
        $model = new HomeModel();
        return $model;
    }

    public function logout()
    {
        $user = new User();
        $user->logout();
        header("location:" . SITEURL. "/hr/home");
    }
}
