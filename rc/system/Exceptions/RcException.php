<?php

namespace rc\system\Exceptions;

/*
    Based on the application's enviroment, different type of error handling is ment to occur.
    error() method is designed to trigger error handling
    checkEnv() looks for enviroment type and calls either showError() or logError()
    showError() displays error in browser (DEVELOPMENT enviroment)
    logError() saves error inside log file (PRODUCTION enviroment)
*/

abstract class RcException extends \Exception
{
    private $env = ENV;
    protected $mail = false;

    public function __construct($message, $mail = false)
    {
        $this->message = $message;
        $this->mail = $mail;
        $this->file = parent::getTrace()[0]['file'];
        $this->line = parent::getTrace()[0]['line'];
    }

    public function error()
    {
        $this->checkEnv();
    }

    private function checkEnv()
    {
        if (!$this->env) {
            $this->showError();
        } else {
            $this->logError();
        }
    }
    private function showError()
    {
        $exData = array(
            'exType' => get_class($this),
            'exMessage' => $this->message,
            'exFile' => $this->file,
            'exLine' => $this->line,
            'exTrace' => parent::getTrace()
        );
        extract($exData);
        require_once rootDir() . "rc/system/Errors/Exception.php";
        error_log("An Error has occured : {$this->message}. Page: {$this->file}. Line: {$this->line}.");
        die;
    }
    private function logError()
    {
        $log = "An Error has occured : {$this->message}. Page: {$this->file}. Line: {$this->line}.";
        error_log($log);
        if ($this->mail) {
            $this->mailError($log);
        }
        require_once ERR_PAGE;
        die;
    }

    private function mailError($log)
    {
        mail(ADMIN_MAIL, APP_NAME . " error", $log);
    }
}
