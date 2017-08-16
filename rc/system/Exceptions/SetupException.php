<?php

namespace rc\system\Exceptions;

class SetupException extends RcException
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
