<?php

/**
 * Description of FriendlyException
 *
 * @author fosales
 */
class FriendlyException extends CException {
    const EXC_EXAMPLE_ONE = 1;

    function __construct($code, $paramsMessage = array()) {
        parent::__construct(Yii::t('exception', $code, $paramsMessage), $code);

    }

}