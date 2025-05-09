<?php
/**
 * application.config.php
 *
 * Main application configuration parameters.
 * You can change those values according to your application environment.
 *
 * @filesource application.config.php
 * @author Rosario Carvello <rosario.carvello@gmail.com>
 * @version GIT:v1.0.0
 * @copyright (c) 2016 Rosario Carvello <rosario.carvello@gmail.com> - All rights reserved. See License.txt file
 * @license BSD Clause 3 License
 * @license https://opensource.org/licenses/BSD-3-Clause This software is distributed under BSD-3-Clause Public License
 */

/**
 * Defines the constants for MySQL database connection parameters.
 */


/**
 *  MySQL Host
 */
define("DBHOST","localhost");

/**
 *  MySQL User
 */
define("DBUSER","root");

/**
 * MySQL Password
 */
define("DBPASSWORD","letmysql");

/**
 *  MySQL Database
 */
define("DBNAME","people_development");

/**
 *  MySQL Port
 */
define('DBPORT', '3306');

/**
 * Defines a constant for site URL
 * @note without the ending slash
 */
define("SITEURL","http://localhost:8082");


/**
 * Defines a constant for the default controller
 * @note use URL like notation for mapping a Controller named with a PascalCase notation
 */
define("DEFAULT_CONTROLLER", "index");

/**
 * Defines a constant for the default login page
 * @note use url notation for PascalCase Controllers
 */
define("DEFAULT_LOGIN_PAGE", "common/login");

/**
 * Date formats:
 * @note HTML5 date format is like 2016/01/20 - aaaa/mm/dd
 */

/**
 * Defines a constant for the transformation of the date format of all
 * date fields fetched from mysql tables
 * You may change this value according to your language format.
 * For more information read the MySQL specifications for date format
 * Most used  format: define("FETCHED_DATE_FORMAT","d/m/Y");
 */
define("FETCHED_DATE_FORMAT","Y-m-d");

/**
 * Defines a constant for the transformation of the datetime format of all
 * datetime fields fetched from mysql tables.
 * You may change this value according to your language format.
 * For more information read the MySQL specifications for date format
 * Most used format: define("FETCHED_DATETIME_FORMAT","d/m/Y H:i:s");
 *
 */
define("FETCHED_DATETIME_FORMAT","Y-m-d H:i:s");

/**
 * Defines a constant for interpreting of dates format used into all the
 * SQL statements for inserting or updating mysql date fields.
 * You may change this value according to your language format.
 * For more information read the MySQL specifications for date format
 * Most used format: define("STORED_DATE_FORMAT","%d/%m/%Y");
 */
define("STORED_DATE_FORMAT","%Y-%m-%d");

/**
 * Defines a constant for interpreting of datetime format used into all the
 * SQL statements for inserting or updating mysql datetime fields.
 * You may change this value according to your language format.
 * For more information read the MySQL specifications for date format
 * Most used format: define("STORED_DATETIME_FORMAT","%d/%m/%Y %H:%i:%s");
 */
define("STORED_DATETIME_FORMAT","%Y-%m-%d %H:%i:%s");

/**
 * Defines mail from used in Notifier class calling PHP mail function
 * Note: PHP Mailer must be active in your host php configuration
 */
define("MAIL_FROM", "postmaster@webmvcframework.com");

include_once ("globals.config.php");