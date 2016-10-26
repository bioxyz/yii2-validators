<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace qdzsoft\validators;

use Yii;

/**
 * Description of OrfValidator
 *
 * @author Chance
 */
class OrfValidator extends GeneValidator
{
    public function init() {
        parent::init();
        
        if ($this->message === null) {
            $this->message = Yii::t('yii', '{attribute} is not a valid ORF clone (only digits, blank, ATGC are allowed).');
        }
    }
    
    /**
     * @inheritdoc
     */
    protected function validateValue($value)
    {
        if (is_null(parent::validateValue($value))) {
            $value2 = preg_replace('/[\d\s\n\r]+/i', '', $value);
            if (strlen($value2) % 3 == 0) {
                $valid = true;
            } else {
                $valid = false;
            }
        } else {
            $valid = false;
        }
        
        return $valid ? null : [$this->message, []];
    }
}
