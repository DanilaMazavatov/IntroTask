<?php

namespace app\components\exceptions;

use yii\web\HttpException;

class SearchBadRequestHttpException extends HttpException
{
    public function __construct($status, $messages = null)
    {
        $this->statusCode = $status;

        parent::__construct($status, implode($messages), $code = 0, $previous = null);
    }
}