<?php

namespace rc\system\Libraries;

/**
 * PHPMailer exception handler
 * @package PHPMailer
 */
class phpmailerException extends \Exception
{
    /**
     * Prettify error message output
     * @return string
     */
    public function errorMessage()
    {
        $errorMsg = '<strong>' . htmlspecialchars($this->getMessage()) . "</strong><br />\n";
        return $errorMsg;
    }
}
