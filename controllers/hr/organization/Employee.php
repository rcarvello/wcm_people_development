<?php
/**
 * Class Employee
 *
 * Manages Employee record
 *
 * @package controllers\hr\organization
 * @category Application Controller
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace controllers\hr\organization;

use classes\OperationManager;
use framework\Bean;
use framework\BeanAdapter;
use framework\Controller;
use framework\Model;
use framework\View;
use models\beans\BeanEmployee;
use models\hr\organization\Employee as EmployeeModel;
use views\hr\organization\Employee as EmployeeView;
use controllers\hr\common\NavigationBar;
use framework\components\Record;

class Employee extends Controller
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
        // $this->restrictToAuthentication(null,"hr/organization/employee/open/" . $_GET["id_employee"]);
        $this->buildRecord();
    }

    protected function buildRecord()
    {
        $record = new Record();

        // Customizes the record components
        $record->setName("EmployeeRecord");
        $record->registerPkUrlParameter("id_employee");

        /* Optionals setting
        $record->registerActionName($record::ADD, "aggiungi");
        $record->registerActionName($record::UPDATE, "modifica");
        $record->registerActionName($record::DELETE, "elimina");
        $record->registerActionName($record::CLOSE, "chiudi");
        */

        // Gets current record
        $currentRecord = $record->getCurrentRecord();

        // Sets history back for button close and delete
        $historyBack = $record->getControllerHistoryBack("employees");
        $record->redirectAfterClose = $historyBack;
        $record->redirectAfterDelete = $historyBack;
        $record->redirectAfterAdd =$historyBack;
        $record->redirectAfterUpdate=$historyBack;

        // Sets disallow mode
        $record->disallowMode = $record::DISALLOW_MODE_WITH_HIDE;

        // Instantiates Bean and BeanAdpter for handling Record actions
        $bean = new BeanEmployee();
        $beanAdapter = new BeanAdapter($bean);
        $beanAdapter->select($currentRecord);

        // Creates operation manager by passing it pk value and table name
        $operation = new OperationManager($bean->getIdEmployee(),$bean->getTableName());

        // Disables from updating and deleting when user is not the row owner
        if (!$operation->isOwner()) {
            $record->allowDelete = false;
            $record->allowUpdate = false;
        }

        // Handles form submission and updates the bean attributes
        // with posted data
        // Note Put your business data validation rules here before.
        // If  there were Business Validation Errors use : init($beanAdapter,null,true);
        if ($record->isSubmitted()) {
            $customValidationErrors = $this->customValidation($record);
            $this->model->setBeanWithPostedData($bean);
        } else {
            $customValidationErrors = false;
            $record->redirectOnEmpyEdit($bean);
        }

        // Initializes record component with BeanAdapter
        // (and automatically with its managed Bean BeanPart)
        // Old version
        /*
        try {

            if (isset($_GET["id_employee"])) {
                $record->disallowAction(Record::ADD);
            } else {
                $record->disallowAction(Record::UPDATE);
                $record->disallowAction(Record::DELETE);
            }
            $record->init($beanAdapter);
       } catch (\Exception $e){
            $record->addError("{RES:FixErrors}");
       }
       */

        // Initializes record component with its BeanAdapter and (automatically) with its managed Bean
        // Note Put your business data validation rules here before.
        // If  there were Business Validation Errors use : init($beanAdapter,null,true);
        $record->init($beanAdapter,null,$customValidationErrors);

        // Assigns ownership whe adding record
        if (isset($_REQUEST[$record::ADD]) && !$customValidationErrors) {
            $operation->setOwnership($bean->getIdEmployee());
        }

        // Binding Record Component to the view (without rendering)
        $this->bindComponent($record,false);

        // Set others view fields values with bean data
        $this->view->setFieldsWithBeanData($bean);

        // Pocesses record errors
        $this->view->parseErrors($record->getErrors());

    }



    /**
     * Funzione open: Apre la schermata relativa al record dei dati anagrafici associato all'id dipendente selezionato dall'utente.
     */
    public function open($pk=null)
    {
        $_GET["id_employee"] = $pk;
        $this->autorun();
        $this->render();
    }

    /**
     * Funzione add: Viene invocata quando l'utente vuole inserire un nuovo dipendente.
     */
    public function add($dummy)
    {
        $this->autorun();
        $this->render();
    }
    /**
    * Inizialize the View by loading static design of /hr/organization/employee.html.tpl
    * managed by views\hr\organization\Employee class
    *
    */
    public function getView()
    {
        $view = new EmployeeView("/hr/organization/employee");
        return $view;
    }

    /**
    * Inizialize the Model by loading models\hr\organization\Employee class
    *
    */
    public function getModel()
    {
        $model = new EmployeeModel();
        return $model;
    }

    private function customValidation(Record $record)
    {
        $isError = false;
        // Custom validations here
        return $isError;
    }
}
