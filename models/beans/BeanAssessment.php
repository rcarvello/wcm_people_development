<?php
/**
 * Class BeanAssessment
 * Bean class for object oriented management of the MySQL table assessment
 *
 * Comment of the managed table assessment: Skills evaluation for each eployee job's skills.
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
 * @filesource BeanAssessment.php
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


class BeanAssessment extends MySqlRecord 
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
     * Class attribute for mapping table field assessment_date
     *
     * Comment for field assessment_date: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $assessmentDate
     */
    private $assessmentDate;

    /**
     * Class attribute for mapping table field assessed_by
     *
     * Comment for field assessed_by: Not specified.<br>
     * Field information:
     *  - Data type: int(11)
     *  - Null : YES
     *  - DB Index: MUL
     *  - Default: 
     *  - Extra:  
     * @var int $assessedBy
     */
    private $assessedBy;

    /**
     * Class attribute for mapping table field assessed_level
     *
     * Comment for field assessed_level: Not specified.<br>
     * Field information:
     *  - Data type: int(11)
     *  - Null : NO
     *  - DB Index: 
     *  - Default: 0
     *  - Extra:  
     * @var int $assessedLevel
     */
    private $assessedLevel;

    /**
     * Class attribute for mapping table field previous_level
     *
     * Comment for field previous_level: Not specified.<br>
     * Field information:
     *  - Data type: int(11)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var int $previousLevel
     */
    private $previousLevel;

    /**
     * Class attribute for storing the SQL DDL of table assessment
     * @var string base64 encoded $ddl
     */
    private $ddl = "Q1JFQVRFIFRBQkxFIGBhc3Nlc3NtZW50YCAoCiAgYGlkX2VtcGxveWVlYCBpbnQoMTEpIE5PVCBOVUxMLAogIGBpZF9za2lsbGAgaW50KDExKSBOT1QgTlVMTCwKICBgYXNzZXNzbWVudF9kYXRlYCB2YXJjaGFyKDQ1KSBERUZBVUxUIE5VTEwsCiAgYGFzc2Vzc2VkX2J5YCBpbnQoMTEpIERFRkFVTFQgTlVMTCwKICBgYXNzZXNzZWRfbGV2ZWxgIGludCgxMSkgTk9UIE5VTEwgREVGQVVMVCAnMCcsCiAgYHByZXZpb3VzX2xldmVsYCBpbnQoMTEpIERFRkFVTFQgTlVMTCwKICBQUklNQVJZIEtFWSAoYGlkX2VtcGxveWVlYCxgaWRfc2tpbGxgKSwKICBLRVkgYGZrX3NraWxsc19lcGxveWVzc19pZHhgIChgaWRfc2tpbGxgKSwKICBLRVkgYGZrX2VwbG95ZXNzX3NraWxsc19pZHhgIChgaWRfZW1wbG95ZWVgKSwKICBLRVkgYGZrX3VzZXJfZXZhbHVhdG9yc19pZHhgIChgYXNzZXNzZWRfYnlgKSwKICBDT05TVFJBSU5UIGBma19lbXBsb3llZXNfc2tpbGxzYCBGT1JFSUdOIEtFWSAoYGlkX2VtcGxveWVlYCkgUkVGRVJFTkNFUyBgZW1wbG95ZWVgIChgaWRfZW1wbG95ZWVgKSBPTiBERUxFVEUgTk8gQUNUSU9OIE9OIFVQREFURSBOTyBBQ1RJT04sCiAgQ09OU1RSQUlOVCBgZmtfZXZlbHVhdG9yc191c2VyYCBGT1JFSUdOIEtFWSAoYGFzc2Vzc2VkX2J5YCkgUkVGRVJFTkNFUyBgdXNlcmAgKGBpZF91c2VyYCkgT04gREVMRVRFIE5PIEFDVElPTiBPTiBVUERBVEUgTk8gQUNUSU9OLAogIENPTlNUUkFJTlQgYGZrX3NraWxsc19lbXBsb3llZXNgIEZPUkVJR04gS0VZIChgaWRfc2tpbGxgKSBSRUZFUkVOQ0VTIGBza2lsbGAgKGBpZF9za2lsbGApIE9OIERFTEVURSBOTyBBQ1RJT04gT04gVVBEQVRFIE5PIEFDVElPTgopIEVOR0lORT1Jbm5vREIgREVGQVVMVCBDSEFSU0VUPXV0ZjggQ09NTUVOVD0nU2tpbGxzIGV2YWx1YXRpb24gZm9yIGVhY2ggZXBsb3llZSBqb2InJ3Mgc2tpbGxzJw==";

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
     * setAssessmentDate Sets the class attribute assessmentDate with a given value
     *
     * The attribute assessmentDate maps the field assessment_date defined as varchar(45).<br>
     * Comment for field assessment_date: Not specified.<br>
     * @param string $assessmentDate
     * @category Modifier
     */
    public function setAssessmentDate($assessmentDate)
    {
        $this->assessmentDate = (string)$assessmentDate;
    }

    /**
     * setAssessedBy Sets the class attribute assessedBy with a given value
     *
     * The attribute assessedBy maps the field assessed_by defined as int(11).<br>
     * Comment for field assessed_by: Not specified.<br>
     * @param int $assessedBy
     * @category Modifier
     */
    public function setAssessedBy($assessedBy)
    {
        $this->assessedBy = (int)$assessedBy;
    }

    /**
     * setAssessedLevel Sets the class attribute assessedLevel with a given value
     *
     * The attribute assessedLevel maps the field assessed_level defined as int(11).<br>
     * Comment for field assessed_level: Not specified.<br>
     * @param int $assessedLevel
     * @category Modifier
     */
    public function setAssessedLevel($assessedLevel)
    {
        $this->assessedLevel = (int)$assessedLevel;
    }

    /**
     * setPreviousLevel Sets the class attribute previousLevel with a given value
     *
     * The attribute previousLevel maps the field previous_level defined as int(11).<br>
     * Comment for field previous_level: Not specified.<br>
     * @param int $previousLevel
     * @category Modifier
     */
    public function setPreviousLevel($previousLevel)
    {
        $this->previousLevel = (int)$previousLevel;
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
     * getAssessmentDate gets the class attribute assessmentDate value
     *
     * The attribute assessmentDate maps the field assessment_date defined as varchar(45).<br>
     * Comment for field assessment_date: Not specified.
     * @return string $assessmentDate
     * @category Accessor of $assessmentDate
     */
    public function getAssessmentDate()
    {
        return $this->assessmentDate;
    }

    /**
     * getAssessedBy gets the class attribute assessedBy value
     *
     * The attribute assessedBy maps the field assessed_by defined as int(11).<br>
     * Comment for field assessed_by: Not specified.
     * @return int $assessedBy
     * @category Accessor of $assessedBy
     */
    public function getAssessedBy()
    {
        return $this->assessedBy;
    }

    /**
     * getAssessedLevel gets the class attribute assessedLevel value
     *
     * The attribute assessedLevel maps the field assessed_level defined as int(11).<br>
     * Comment for field assessed_level: Not specified.
     * @return int $assessedLevel
     * @category Accessor of $assessedLevel
     */
    public function getAssessedLevel()
    {
        return $this->assessedLevel;
    }

    /**
     * getPreviousLevel gets the class attribute previousLevel value
     *
     * The attribute previousLevel maps the field previous_level defined as int(11).<br>
     * Comment for field previous_level: Not specified.
     * @return int $previousLevel
     * @category Accessor of $previousLevel
     */
    public function getPreviousLevel()
    {
        return $this->previousLevel;
    }

    /**
     * Gets DDL SQL code of the table assessment
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
        return "assessment";
    }

    /**
    * The BeanAssessment constructor
    *
    * It creates and initializes an object in two way:
    *  - with null (not fetched) data if none ${ClassPkAttributeName} is given.
    *  - with a fetched data row from the table {TableName} having {TablePkName}=${ClassPkAttributeName}
	* @param int $idEmployee
	* @param int $idSkill
    * @return BeanAssessment Object
    */
    public function __construct($idEmployee=NULL,$idSkill=NULL)
    {
        // $this->connect(DBHOST,DBUSER,DBPASSWORD,DBNAME,DBPORT);
        parent::__construct();
        if (!empty($idEmployee) && !empty($idSkill)) {
            $this->select($idEmployee,$idSkill);
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
    * Fetchs a table row of assessment into the object.
    *
    * Fetched table fields values are assigned to class attributes and they can be managed by using
    * the accessors/modifiers methods of the class.
	* @param int $idEmployee
	* @param int $idSkill
    * @return int affected selected row
    * @category DML
    */
    public function select($idEmployee,$idSkill)
    {
        $sql =  "SELECT * FROM assessment WHERE id_employee={$this->parseValue($idEmployee,'int')} AND id_skill={$this->parseValue($idSkill,'int')}";
        $this->resetLastSqlError();
        $result =  $this->query($sql);
        $this->resultSet=$result;
        $this->lastSql = $sql;
        if ($result){
            $rowObject = $result->fetch_object();
            @$this->idEmployee = (integer)$rowObject->id_employee;
            @$this->idSkill = (integer)$rowObject->id_skill;
            @$this->assessmentDate = $this->replaceAposBackSlash($rowObject->assessment_date);
            @$this->assessedBy = (integer)$rowObject->assessed_by;
            @$this->assessedLevel = (integer)$rowObject->assessed_level;
            @$this->previousLevel = (integer)$rowObject->previous_level;
            $this->allowUpdate = true;
        } else {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        }
    return $this->affected_rows;
    }

    /**
    * Deletes a specific row from the table assessment
	* @param int $idEmployee
	* @param int $idSkill
    * @return int affected deleted row
    * @category DML
    */
    public function delete($idEmployee,$idSkill)
    {
        $sql = "DELETE FROM assessment WHERE id_employee={$this->parseValue($idEmployee,'int')} AND id_skill={$this->parseValue($idSkill,'int')}";
        $this->resetLastSqlError();
        $result = $this->query($sql);
        $this->lastSql = $sql;
        if (!$result) {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        }
        return $this->affected_rows;
    }

    /**
    * Insert the current object into a new table row of assessment
    *
    * All class attributes values defined for mapping all table fields are automatically used during inserting
    * @return mixed MySQL insert result
    * @category DML
    */
    public function insert()
    {
        // $constants = get_defined_constants();
        $sql = <<< SQL
        INSERT INTO assessment
        (id_employee,id_skill,assessment_date,assessed_by,assessed_level,previous_level)
        VALUES({$this->parseValue($this->idEmployee)},
			{$this->parseValue($this->idSkill)},
			{$this->parseValue($this->assessmentDate,'notNumber')},
			{$this->parseValue($this->assessedBy)},
			{$this->parseValue($this->assessedLevel)},
			{$this->parseValue($this->previousLevel)})
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
    * Updates a specific row from the table assessment with the values of the current object.
    *
    * All class attribute values defined for mapping all table fields are automatically used during updating of selected row.<br>
    * Null values are used for all attributes not previously setted.
	* @param int $idEmployee
	* @param int $idSkill
    * @return mixed MySQL update result
    * @category DML
    */
    public function update($idEmployee,$idSkill)
    {
        // $constants = get_defined_constants();
        if ($this->allowUpdate) {
            $sql = <<< SQL
            UPDATE
                assessment
                SET 
				assessment_date={$this->parseValue($this->assessmentDate,'notNumber')},
				assessed_by={$this->parseValue($this->assessedBy)},
				assessed_level={$this->parseValue($this->assessedLevel)},
				previous_level={$this->parseValue($this->previousLevel)}
            WHERE
                id_employee={$this->parseValue($idEmployee,'int')} AND id_skill={$this->parseValue($idSkill,'int')}
SQL;
            $this->resetLastSqlError();
            $result = $this->query($sql);
            if (!$result) {
                $this->lastSqlError = $this->sqlstate . " - ". $this->error;
            }   else {
                $this->select($idEmployee,$idSkill);
                $this->lastSql = $sql;
                return $result;
            }
        } else {
            return false;
        }
    }

    /**
    * Facility for updating a row of assessment previously loaded.
    *
    * All class attribute values defined for mapping all table fields are automatically used during updating.
    * @category DML Helper
    * @return mixed MySQLi update result
    */
    public function updateCurrent()
    {
        if (!empty($this->idEmployee) && !empty($this->idSkill)) {
           return $this->update($this->idEmployee,$this->idSkill);
        } else {
            return false;
        }
    }

}
?>
