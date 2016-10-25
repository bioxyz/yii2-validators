<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace qdzsoft\validators;

use Yii;
use yii\base\InvalidConfigException;

/**
 * Description of GeneValidator
 *
 * @author Chance
 */
class GeneValidator extends \yii\validators\Validator
{
    public $pattern_exclude = '/[^ATGC]/i';
    
    public function init() {
        parent::init();
    }
    
    /**
     * @inheritdoc
     */
    protected function validateValue($value)
    {
        if ($this->message === null) {
            $this->message = Yii::t('yii', '{attribute} is not a valid gene sequence (only digits, blank, ATGC are allowed).');
        }
        
        if (!is_string($value)) {
            $valid = false;
        } else {
            // remove blank, digitals
            $value2 = preg_replace('/[\d\s\n\r]+/i', '', $value);
            if (preg_match($this->pattern_exclude, $value2)) {
                $valid = false;
            } else {
                $valid = true;
            }
        } 

        return $valid ? null : [$this->message, []];
    }
}
