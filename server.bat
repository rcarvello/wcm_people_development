REM Bootstrap file for PD App on WebMVC Framework
REM  
REM Assuming you have many PHP releases extracted into many different sub folders of current .bat file.
REM For example: 
REM
 
REM c:\php_apps\php56     folder where are located PHP version 5.6 files
REM c:\php_apps\php74     folder where are located PHP version 7.4 files
REM c:\php_apps\php80     folder where are located PHP version 8.0 files
REM c:\php_apps\php82     folder where are located PHP version 8.2 files
REM c:\php_apps\php84     folder where are located PHP version 8.4 files
REM
REM Note: On each PHP folder you need to configure php.ini according to framework requirements
@echo off
cls
echo Bootstrapping of APP builded on PHP WEB MVC Framework
echo.
REM ********************************
REM Set configuration variables here
REM ********************************
REM
REM Set PHP distributions PATH 
set PHP_ROOT_PATH=C:\Users\Saro\Desktop\Applicazioni PHP Desktop\phpapp
REM
REM Set PHP version SUFFIX PATH
set PHP_VERSION=84
REM
REM Set APP path builded on WEB MVC Framework PATH
set FRAMEWORK_PATH=C:\Users\Saro\Desktop\Applicazioni PHP Desktop\phpapp\peopledevelopment
REM
REM ********************************
REM End configuration variables 
REM ********************************
start http://localhost:8082
start "php" /B "%PHP_ROOT_PATH%\php%PHP_VERSION%\php.exe" -c "%PHP_ROOT_PATH%\php%PHP_VERSION%\php.ini" -S localhost:8082 "%FRAMEWORK_PATH%\route.php" -t "%FRAMEWORK_PATH%\"  

