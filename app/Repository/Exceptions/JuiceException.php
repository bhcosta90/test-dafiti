<?php

namespace App\Repository\Exceptions;

use Exception;

class JuiceException extends Exception
{
    protected $code = 400;
}
