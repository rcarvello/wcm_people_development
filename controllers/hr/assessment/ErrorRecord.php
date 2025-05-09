<?php
/**
 * Class ErrorRecord
 *
 * Manage Error Assignments
 *
 * @package controllers\hr\assessment
 * @category Application Controller
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace controllers\hr\assessment;

use classes\Notifier;
use controllers\hr\common\NavigationBar;
use framework\BeanAdapter;
use framework\components\Record;
use framework\Controller;
use framework\Model;
use framework\View;
use models\beans\BeanAssessment;
use models\beans\BeanErrorsAssignment;
use models\hr\assessment\ErrorRecord as ErrorRecordModel;
use views\hr\assessment\ErrorRecord as ErrorRecordView;

class ErrorRecord extends Controller
{
    protected $view;
    protected $model;

    private $currentAssignment;
    private $currentEmployee;
    private $currentJob;
    private $currentSkill;
    private $openMode;

    /**
    * Object constructor.
    *
    * @param View $view
    * @param Model $mode
    */
    public function __construct(View $view=null, Model $model=null)
    {
        $this->restrictToAuthentication(null,"hr/organization/employees",LoginAuthWarningMessage);
        $this->view = empty($view) ? $this->getView() : $view;
        $this->model = empty($model) ? $this->getModel() : $model;
        parent::__construct($this->view,$this->model);
        $nav = new NavigationBar();
        $this->bindController($nav);
    }

    /**
    * Autorun method. Put your code here for running it after object creation.
    * @param mixed|null $parameters Parameters to manage
    *
    */
    protected function autorun($parameters = null)
    {
      if (empty($_GET["id_employee"]) || empty($_GET["id_job"]) ||  empty($_GET["id_skill"]) ){
         header("location: " . SITEURL . "/hr/assessment/employee_assessment");
      }
    }

    /**
     * Builds record component for managing error record
     */
    protected function buildRecord()
    {
        $record = new Record();

        // Customizes the record components
        $record->setName("ErrorAssignment");
        $record->registerPkUrlParameter("id_assignment");

        // Gets current record
        $currentRecord = $record->getCurrentRecord();

        // Sets history back for button close and delete
        $historyBack = $record->getControllerHistoryBack("employee_assessment");
        $record->redirectAfterClose = SITEURL . "/hr/assessment/employee_assessment";
        $record->redirectAfterDelete = $historyBack;
        $record->redirectAfterAdd = SITEURL . "/hr/assessment/employee_assessment";

        // Sets disallow mode
        $record->disallowMode = $record::DISALLOW_MODE_WITH_HIDE;
        $record->allowReset = false;

        $bean = new BeanErrorsAssignment();
        $beanAdapter = new BeanAdapter($bean);
        $beanAdapter->select($currentRecord);

        if ($record->isSubmitted()) {
            $customValidationErrors = $this->customValidation($record);
            $this->model->setBeanWithPostedData($bean);
            if ($customValidationErrors==false) {
                $this->verifyForResetAssessment();
            }
        } else {
            $customValidationErrors = false;
            $record->redirectOnEmpyEdit($bean);
        }

        // Initializes record component with its BeanAdapter and (automatically) with its managed Bean
        $record->init($beanAdapter,null,$customValidationErrors);

        // Notifies error
        if (isset($_POST["record_add"]) && $customValidationErrors==false){
            $this->notifyError($bean->getIdAssignment());
        }

        // Binding Record Component to the view (without rendering)
        $this->bindComponent($record,false);

        // Set others view fields values with bean data
        $this->view->setFieldsWithBeanData($bean);

        // Processes record errors
        $this->view->parseErrors($record->getErrors());

    }

    /**
     * Custom server side validations.
     *
     * @param Record $record
     * @return bool return true if error cccurs else false
     */
    private function customValidation(Record $record)
    {
        $isError = false;
        if ($record->isSubmitted()){
            if (empty($_POST["description"])){
                $record->addError("{RES:EmpyDescriptionErrorMessage}");
                $isError= true;
            }
            if (empty($_POST["twttp_result"])){
                $record->addError("{RES:EmpyTwttpResultErrorMessage}");
                $isError= true;
            } else {
                if ( $_POST["twttp_result"]=="ok" && empty($_POST["herca_result"])){
                    $record->addError("{RES:EmpyHercaResultErrorMessage}");
                    $isError= true;
                }
            }

        }
        return $isError;
    }

    /**
     * Assign an error related to the given Employee/Job/Skill.
     *
     * @param int $idEmployee
     * @param int $idJob
     * @param int $idSkill
     */
    public function add($idEmployee,$idJob,$idSkill)
    {
        $_GET["id_employee"]=$idEmployee;
        $_GET["id_job"]=$idJob;
        $_GET["id_skill"]=$idSkill;
        $this->currentEmployee = $idEmployee;
        $this->currentJob = $idJob;
        $this->currentSkill = $idSkill;
        $this->openMode = "ADD";
        $this->buildRecord();
        $this->buildErrorsHistory($idEmployee,$idSkill);
        $this->render();
    }
    /**
     * Open an error related to the given Id and Employee/Job/Skill
     * @param int $idAssignment
     * @param int $idEmployee
     * @param int $idJob
     * @param int $idSkill
     */
    public function open($idAssignment,$idEmployee,$idJob,$idSkill)
    {
        $_GET["id_assignment"]=$idAssignment;
        $_GET["id_employee"]=$idEmployee;
        $_GET["id_job"]=$idJob;
        $_GET["id_skill"]=$idSkill;
        $this->openMode = "EDIT";
        $this->currentAssignment = $idAssignment;
        $this->currentEmployee = $idEmployee;
        $this->currentJob = $idJob;
        $this->currentSkill = $idSkill;
        $this->buildRecord();
        $this->buildErrorsHistory($idEmployee,$idSkill);
        $this->render();
    }

    /**
     * Builds errors list of the given employee skill.
     *
     * @param int $idEmployee
     * @param int $idSkill
     */
    public function buildErrorsHistory($idEmployee,$idSkill)
    {
      $errorHistory = $this->model->getErrorsHistory($idEmployee,$idSkill);
      $this->view->renderErrorHistory($errorHistory);
    }

    /**
    * Inizialize the View by loading static design of /hr/assessment/error_record.html.tpl
    * managed by views\hr\assessment\ErrorRecord class.
     *
    */
    public function getView()
    {
        $view = new ErrorRecordView("/hr/assessment/error_record");
        return $view;
    }

    /**
    * Inizialize the Model by loading models\hr\assessment\ErrorRecord class
    *
    */
    public function getModel()
    {
        $model = new ErrorRecordModel();
        return $model;
    }

    /**
     * Resets assessments to level 1
     */
    private function verifyForResetAssessment()
    {
        if (!(empty($_POST["twttp_result"])) && $_POST["twttp_result"]=="ko")
        {
            $beanAss= new BeanAssessment($this->currentEmployee,$this->currentSkill);
            if ($beanAss->getAssessedLevel() != 1){
                $beanAss->setPreviousLevel($beanAss->getAssessedLevel());
                $beanAss->setAssessedLevel(1);
                $beanAss->updateCurrent();
            }
        }
    }

    private function notifyError($idAssignment)
    {
      $notify = new Notifier();
      $notify->debug = false;
      $notify->loadAssignment($idAssignment,$this->currentJob);
      $notify->notifyError();
      $_SESSION["notify_status"] = $notify->getNotifyStatus();
    }


}
