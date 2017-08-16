<?php

namespace rc\system\Exceptions;

class NotFoundException extends RcException
{
    public function __construct($file, $mail = false)
    {
        $file = $file . " not found";
        parent::__construct($file, $mail);
    }
}
