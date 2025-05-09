<?php
/**
 * Class Employees
 *
 * Manages Employees Data
 *
 * @package models\hr\organization
 * @category Application Model
 * @author  Rosario Carvello - rosario.carvello@gmail.com
*/
namespace models\hr\organization;

use framework\Model;

class Employees extends Model
{
    /**
    * Object constructor.
    *
    */
    public function __construct()
    {
        parent::__construct();
    }

    public function getEmployess()
    {
        parent::__construct();
        $this->sql =<<<SQL
        SELECT  
              id_employee,
              first_name, 
              last_name, 
              tax_code,
              CONCAT("(",plant,")") as plant
            FROM 
              employee
            ORDER BY
              last_name,first_name ASC
SQL;
        $this->updateResultSet();
    }
}
