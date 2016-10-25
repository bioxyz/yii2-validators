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
 * Description of ProteinValidator
 *
 * @author Chance
 */
class ProteinValidator extends \yii\validators\Validator
{
    public $pattern_exclude = '/[^ABCDEFGHIKLMNPQRSTVWYZX]/i';
    
    public function init() {
        parent::init();
        
        if ($this->message === null) {
            $this->message = Yii::t('yii', '{attribute} is not a valid protein sequence (only digits, blank, ACDEFGHIKLMNPQRSTVWYBZX are allowed).');
        }
    }
    
    /**
     * @inheritdoc
     */
    protected function validateValue($value)
    {
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
