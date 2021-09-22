<?php

namespace App\Commons\Contents;

class Content
{
    public $done;
    public $data;
    public $message;
    public $extra;
    public $errorCode;
    public $errors;

    public function __construct($done = true, $data = null, $message = null, $extra = null, $errorCode = null, $errors = null){

        $this->done      = $done;
        $this->data      = $data;
        $this->message   = is_array($message) ? implode(', ', $message) : $message;            
        $this->extra     = $extra;
        $this->errorCode = $errorCode;
        $this->errors    = is_array($errors) ? implode(', ', $errors) : $errors;            
    }
}