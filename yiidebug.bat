@echo off

rem -------------------------------------------------------------
rem  Yii command line bootstrap script for Windows.
rem
rem  @author Qiang Xue <qiang.xue@gmail.com>
rem  @link http://www.yiiframework.com/
rem  @copyright Copyright &copy; 2012 Yii Software LLC
rem  @license http://www.yiiframework.com/license/
rem -------------------------------------------------------------

@setlocal

set YII_PATH=%~dp0

if "%PHP_COMMAND%" == "" set PHP_COMMAND=php.exe
if "%DEBUG_FLAGS%" == "" set DEBUG_FLAGS=-d xdebug.remote_enable=1 -d xdebug.remote_autostart=1 -d xdebug.remote_host=localhost -d xdebug.remote_port=10017 -d xdebug.remote_handler=dbgp -d xdebug.idekey=PHPSTORM

"%PHP_COMMAND%" %DEBUG_FLAGS% "%YII_PATH%yii" %*

@endlocal
