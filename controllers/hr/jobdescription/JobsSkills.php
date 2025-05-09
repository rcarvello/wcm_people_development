<?php
/**
 * Class JobsSkills
 *
 * Handles User Requests for Jobs Skills and interacts with its model and view
 *
 * @package controllers\hr\jobdescription
 * @category Application Controller
 * @author  Rosario Carvello - rosario.carvello@gmail.com
 */

namespace controllers\hr\jobdescription;


use classes\OperationManager;
use framework\Controller;
use framework\Model;
use framework\View;
use models\beans\BeanJob;
use models\hr\jobdescription\JobsSkills as JobsSkillsModel;
use views\hr\jobdescription\JobsSkills as JobsSkillsView;
use controllers\hr\common\NavigationBar;

class JobsSkills extends Controller
{
    protected $view;
    protected $model;

    private $currentJob;
    private $currentJobSkills;
    private $unassignedSkills;
    private $jobs;

    private $debugRequestes = false;

    /**
     * Object constructor.
     *
     * @param View $view
     * @param Model $mode
     */
    public function __construct(View $view = null, Model $model = null)
    {
        $this->restrictToAuthentication(null, "hr/jobdescription/jobs_skills", LoginAuthWarningMessage);
        $this->view = empty($view) ? $this->getView() : $view;
        $this->model = empty($model) ? $this->getModel() : $model;
        parent::__construct($this->view, $this->model);
        $nav = new NavigationBar();
        $this->bindController($nav);
    }

    /**
     * Autorun method. Put your code here for running it after object creation.
     *
     * @param mixed|null $parameters Parameters to manage
     *
     */
    protected function autorun($parameters = null)
    {
        if ($this->debugRequestes)
            var_dump($_REQUEST);
        $this->manageCurrents();
        $this->view->renderJobSkills($this->currentJob, $this->currentJobSkills);
        $this->view->renderUnassignedSkills($this->unassignedSkills);
        $this->view->renderCurrentJob($this->currentJob);
        $this->view->renderJobOptionList($this->jobs);

    }

    /**
     * Manages all submission requestes when a job is active
     */
    private function manageSubmitRequestes()
    {
        if (isset($_REQUEST["submit_update_jobs_skills"])) {
            if (isset($_REQUEST["removes_id_skill"])) {
                $this->model->updateJobsSkills($this->currentJob, $_REQUEST["expected_levels"], $_REQUEST["removes_id_skill"]);
            } else {
                $this->model->updateJobsSkills($this->currentJob, $_REQUEST["expected_levels"]);
            }
        }
        if (isset($_REQUEST["submit_create_skill"])) {
            $this->model->createSkill($this->currentJob, $_REQUEST["name"], $_REQUEST["description"], $_REQUEST["expected_level"]);
        }
        if (isset($_REQUEST["submit_select_skills"])) {
            $this->model->selectSkills($this->currentJob, $_REQUEST["skills"]);
        }
        if (isset($_REQUEST["submit_delete_skills"])) {
            $this->model->deleteSkills($_REQUEST["skills"]);
        }

        if (isset($_REQUEST["submit_edit_job"])) {
            $jobObj = new BeanJob($this->currentJob);
            $jobObj->setName($_REQUEST["name"]);
            $jobObj->setDescription($_REQUEST["description"]);
            $jobObj->updateCurrent();
            header("location: jobs_skills");
        }

        if (isset($_REQUEST["submit_delete_job"])) {
            $jobObj = new BeanJob($this->currentJob);
            $jobObj->delete($this->currentJob);
            $this->currentJob = null;
            unset($_SESSION["id_current_job"]);
            header("location: jobs_skills");
        }

    }

    /**
     *  Manages Job Addition
     */
    protected function manageAddJobRequest()
    {

        if (isset($_REQUEST["submit_add_job"])) {
            $jobObj = new BeanJob();
            $jobObj->setName($_REQUEST["name"]);
            $jobObj->setDescription($_REQUEST["description"]);
            $jobObj->setEnabled(1);
            $jobObj->insert();
            $this->currentJob = $jobObj->getIdJob();
            $_SESSION["id_current_job"] = $jobObj->getIdJob();
            $op = new OperationManager($this->currentJob, "job");
            $op->setOwnership();
        }
    }

    /**
     *  Computes the current job and skills.
     */
    private function manageCurrents()
    {
        $this->manageAddJobRequest();

        if(!empty($_REQUEST["find_job"])){
            $_REQUEST["id_job"] =  $_REQUEST["find_job"];
        }

        if (empty($_REQUEST["id_job"]))
            @$id_current_job = $_SESSION["id_current_job"];
        else {
            @$id_current_job = $_REQUEST["id_job"];
            @$_SESSION["id_current_job"] = $id_current_job;
        }

        $this->currentJob = (int)$id_current_job;
        $this->jobs = $this->model->getJobOptionList();

        if (!empty($id_current_job)) {
            $this->manageSubmitRequestes();
            $this->currentJobSkills = $this->model->getJobsSkills($id_current_job);
            $this->unassignedSkills = $this->model->getUnassignedSkills($id_current_job);
        }

    }

    /**
     * Inizialize the View by loading static design of /hr/jobdescription/jobs_skills.html.tpl
     * managed by views\hr\mansionario\Mansionario class.
     *
     */
    public function getView()
    {
        $view = new JobsSkillsView("/hr/jobdescription/jobs_skills");
        return $view;
    }

    /**
     * Inizialize the Model by loading models\hr\jobdescription\JobsSkills class
     *
     */
    public function getModel()
    {
        $model = new JobsSkillsModel();
        return $model;
    }
}
