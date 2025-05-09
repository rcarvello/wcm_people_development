<?php
/**
 * Class BeanEmployeesJobsSkills
 * Bean class for object oriented management of the MySQL table employees_jobs_skills
 *
 * Comment of the managed table employees_jobs_skills: Jobs assignment for each employees.
 *
 * Responsibility:
 *
 *  - provides instance constructors for both managing of a fetched table or for a new row
 *  - provides destructor to automatically close database connection
 *  - defines a set of attributes corresponding to the table fields
 *  - provides setter and getter methods for each attribute
 *  - provides OO methods for simplify DML select, insert, update and delete operations.
 *  - provides a facility for quickly updating a previously fetched row
 *  - provides useful methods to obtain table DDL and the last executed SQL statement
 *  - provides error handling of SQL statement
 *  - uses Camel/Pascal case naming convention for Attributes/Class used for mapping of Fields/Table
 *  - provides useful PHPDOC information about the table, fields, class, attributes and methods.
 *
 * @extends MySqlRecord
 * @implements none
 * @filesource BeanEmployeesJobsSkills.php
 * @category MySql Database Bean Class
 * @package models/bean
 * @author Rosario Carvello <rosario.carvello@gmail.com>
 * @version GIT:v1.0.0
 * @note  This is an auto generated PHP class builded with MVCMySqlReflection, a small code generation engine extracted from the author's personal MVC Framework.
 * @copyright (c) 2016 Rosario Carvello <rosario.carvello@gmail.com> - All rights reserved. See License.txt file
 * @license BSD
 * @license https://opensource.org/licenses/BSD-3-Clause This software is distributed under BSD Public License.
*/
namespace models\beans;
use framework\MySqlRecord;


class BeanEmployeesJobsSkills extends MySqlRecord 
{
    /**
     * A control attribute for the update operation.
     * @note An instance fetched from db is allowed to run the update operation.
     *       A new instance (not fetched from db) is allowed only to run the insert operation but,
     *       after running insertion, the instance is automatically allowed to run update operation.
     * @var bool
     */
    private $allowUpdate = false;

    /**
     * Class attribute for mapping table field id_employee
     *
     * Comment for field id_employee: Not specified.<br>
     * Field information:
     *  - Data type: int(11)
     *  - Null : NO
     *  - DB Index: PRI
     *  - Default: 
     *  - Extra:  
     * @var int $idEmployee
     */
    private $idEmployee;

    /**
     * Class attribute for mapping table field id_job
     *
     * Comment for field id_job: Not specified.<br>
     * Field information:
     *  - Data type: int(11)
     *  - Null : NO
     *  - DB Index: PRI
     *  - Default: 
     *  - Extra:  
     * @var int $idJob
     */
    private $idJob;

    /**
     * Class attribute for mapping table field id_skill
     *
     * Comment for field id_skill: Not specified.<br>
     * Field information:
     *  - Data type: int(11)
     *  - Null : NO
     *  - DB Index: PRI
     *  - Default: 
     *  - Extra:  
     * @var int $idSkill
     */
    private $idSkill;

    /**
     * Class attribute for storing the SQL DDL of table employees_jobs_skills
     * @var string base64 encoded $ddl
     */
    private $ddl = "Q1JFQVRFIFRBQkxFIGBlbXBsb3llZXNfam9ic19za2lsbHNgICgKICBgaWRfZW1wbG95ZWVgIGludCgxMSkgTk9UIE5VTEwsCiAgYGlkX2pvYmAgaW50KDExKSBOT1QgTlVMTCwKICBgaWRfc2tpbGxgIGludCgxMSkgTk9UIE5VTEwsCiAgUFJJTUFSWSBLRVkgKGBpZF9lbXBsb3llZWAsYGlkX2pvYmAsYGlkX3NraWxsYCksCiAgS0VZIGBpZHhfZW1wbG95ZWVzX2pvYnNfc2tpbGxzYCAoYGlkX3NraWxsYCxgaWRfam9iYCksCiAgQ09OU1RSQUlOVCBgZmtfZW1wbG95ZWVzYCBGT1JFSUdOIEtFWSAoYGlkX2VtcGxveWVlYCkgUkVGRVJFTkNFUyBgZW1wbG95ZWVgIChgaWRfZW1wbG95ZWVgKSBPTiBERUxFVEUgTk8gQUNUSU9OIE9OIFVQREFURSBOTyBBQ1RJT04sCiAgQ09OU1RSQUlOVCBgZmtfZW1wbG95ZWVzX2pvYnNfc2tpbGxzYCBGT1JFSUdOIEtFWSAoYGlkX3NraWxsYCwgYGlkX2pvYmApIFJFRkVSRU5DRVMgYGpvYnNfc2tpbGxzYCAoYGlkX3NraWxsYCwgYGlkX2pvYmApIE9OIERFTEVURSBOTyBBQ1RJT04gT04gVVBEQVRFIE5PIEFDVElPTgopIEVOR0lORT1Jbm5vREIgREVGQVVMVCBDSEFSU0VUPXV0ZjggQ09NTUVOVD0nSm9icyBhc3NpZ25tZW50IGZvciBlYWNoIGVtcGxveWVlcyc=";

    /**
     * setIdEmployee Sets the class attribute idEmployee with a given value
     *
     * The attribute idEmployee maps the field id_employee defined as int(11).<br>
     * Comment for field id_employee: Not specified.<br>
     * @param int $idEmployee
     * @category Modifier
     */
    public function setIdEmployee($idEmployee)
    {
        $this->idEmployee = (int)$idEmployee;
    }

    /**
     * setIdJob Sets the class attribute idJob with a given value
     *
     * The attribute idJob maps the field id_job defined as int(11).<br>
     * Comment for field id_job: Not specified.<br>
     * @param int $idJob
     * @category Modifier
     */
    public function setIdJob($idJob)
    {
        $this->idJob = (int)$idJob;
    }

    /**
     * setIdSkill Sets the class attribute idSkill with a given value
     *
     * The attribute idSkill maps the field id_skill defined as int(11).<br>
     * Comment for field id_skill: Not specified.<br>
     * @param int $idSkill
     * @category Modifier
     */
    public function setIdSkill($idSkill)
    {
        $this->idSkill = (int)$idSkill;
    }

    /**
     * getIdEmployee gets the class attribute idEmployee value
     *
     * The attribute idEmployee maps the field id_employee defined as int(11).<br>
     * Comment for field id_employee: Not specified.
     * @return int $idEmployee
     * @category Accessor of $idEmployee
     */
    public function getIdEmployee()
    {
        return $this->idEmployee;
    }

    /**
     * getIdJob gets the class attribute idJob value
     *
     * The attribute idJob maps the field id_job defined as int(11).<br>
     * Comment for field id_job: Not specified.
     * @return int $idJob
     * @category Accessor of $idJob
     */
    public function getIdJob()
    {
        return $this->idJob;
    }

    /**
     * getIdSkill gets the class attribute idSkill value
     *
     * The attribute idSkill maps the field id_skill defined as int(11).<br>
     * Comment for field id_skill: Not specified.
     * @return int $idSkill
     * @category Accessor of $idSkill
     */
    public function getIdSkill()
    {
        return $this->idSkill;
    }

    /**
     * Gets DDL SQL code of the table employees_jobs_skills
     * @return string
     * @category Accessor
     */
    public function getDdl()
    {
        return base64_decode($this->ddl);
    }

    /**
    * Gets the name of the managed table
    * @return string
    * @category Accessor
    */
    public function getTableName()
    {
        return "employees_jobs_skills";
    }

    /**
    * The BeanEmployeesJobsSkills constructor
    *
    * It creates and initializes an object in two way:
    *  - with null (not fetched) data if none ${ClassPkAttributeName} is given.
    *  - with a fetched data row from the table {TableName} having {TablePkName}=${ClassPkAttributeName}
	* @param int $idEmployee
	* @param int $idJob
	* @param int $idSkill
    * @return BeanEmployeesJobsSkills Object
    */
    public function __construct($idEmployee=NULL,$idJob=NULL,$idSkill=NULL)
    {
        // $this->connect(DBHOST,DBUSER,DBPASSWORD,DBNAME,DBPORT);
        parent::__construct();
        if (!empty($idEmployee) && !empty($idJob) && !empty($idSkill)) {
            $this->select($idEmployee,$idJob,$idSkill);
        }
    }

    /**
    * The implicit destructor
    */
    public function __destruct()
    {
        $this->close();
    }

    /**
    * Explicit destructor. It calls the implicit destructor automatically.
    */
    public function close()
    {
        // unset($this);
    }

    /**
    * Fetchs a table row of employees_jobs_skills into the object.
    *
    * Fetched table fields values are assigned to class attributes and they can be managed by using
    * the accessors/modifiers methods of the class.
	* @param int $idEmployee
	* @param int $idJob
	* @param int $idSkill
    * @return int affected selected row
    * @category DML
    */
    public function select($idEmployee,$idJob,$idSkill)
    {
        $sql =  "SELECT * FROM employees_jobs_skills WHERE id_employee={$this->parseValue($idEmployee,'int')} AND id_job={$this->parseValue($idJob,'int')} AND id_skill={$this->parseValue($idSkill,'int')}";
        $this->resetLastSqlError();
        $result =  $this->query($sql);
        $this->resultSet=$result;
        $this->lastSql = $sql;
        if ($result){
            $rowObject = $result->fetch_object();
            @$this->idEmployee = (integer)$rowObject->id_employee;
            @$this->idJob = (integer)$rowObject->id_job;
            @$this->idSkill = (integer)$rowObject->id_skill;
            $this->allowUpdate = true;
        } else {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        }
    return $this->affected_rows;
    }

    /**
    * Deletes a specific row from the table employees_jobs_skills
	* @param int $idEmployee
	* @param int $idJob
	* @param int $idSkill
    * @return int affected deleted row
    * @category DML
    */
    public function delete($idEmployee,$idJob,$idSkill)
    {
        $sql = "DELETE FROM employees_jobs_skills WHERE id_employee={$this->parseValue($idEmployee,'int')} AND id_job={$this->parseValue($idJob,'int')} AND id_skill={$this->parseValue($idSkill,'int')}";
        $this->resetLastSqlError();
        $result = $this->query($sql);
        $this->lastSql = $sql;
        if (!$result) {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        }
        return $this->affected_rows;
    }

    /**
    * Insert the current object into a new table row of employees_jobs_skills
    *
    * All class attributes values defined for mapping all table fields are automatically used during inserting
    * @return mixed MySQL insert result
    * @category DML
    */
    public function insert()
    {
        // $constants = get_defined_constants();
        $sql = <<< SQL
        INSERT INTO employees_jobs_skills
        (id_employee,id_job,id_skill)
        VALUES({$this->parseValue($this->idEmployee)},
			{$this->parseValue($this->idJob)},
			{$this->parseValue($this->idSkill)})
SQL;
        $this->resetLastSqlError();
        $result = $this->query($sql);
        $this->lastSql = $sql;
        if (!$result) {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        } else {
            $this->allowUpdate = true;
        }
        return $result;
    }

    /**
    * Updates a specific row from the table employees_jobs_skills with the values of the current object.
    *
    * All class attribute values defined for mapping all table fields are automatically used during updating of selected row.<br>
    * Null values are used for all attributes not previously setted.
	* @param int $idEmployee
	* @param int $idJob
	* @param int $idSkill
    * @return mixed MySQL update result
    * @category DML
    */
    public function update($idEmployee,$idJob,$idSkill)
    {
        // $constants = get_defined_constants();
        if ($this->allowUpdate) {
            $sql = <<< SQL
            UPDATE
                employees_jobs_skills
                SET 
            WHERE
                id_employee={$this->parseValue($idEmployee,'int')} AND id_job={$this->parseValue($idJob,'int')} AND id_skill={$this->parseValue($idSkill,'int')}
SQL;
            $this->resetLastSqlError();
            $result = $this->query($sql);
            if (!$result) {
                $this->lastSqlError = $this->sqlstate . " - ". $this->error;
            }   else {
                $this->select($idEmployee,$idJob,$idSkill);
                $this->lastSql = $sql;
                return $result;
            }
        } else {
            return false;
        }
    }

    /**
    * Facility for updating a row of employees_jobs_skills previously loaded.
    *
    * All class attribute values defined for mapping all table fields are automatically used during updating.
    * @category DML Helper
    * @return mixed MySQLi update result
    */
    public function updateCurrent()
    {
        if (!empty($this->idEmployee) && !empty($this->idJob) && !empty($this->idSkill)) {
           return $this->update($this->idEmployee,$this->idJob,$this->idSkill);
        } else {
            return false;
        }
    }

}
?>
