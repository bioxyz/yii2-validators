<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace qdzsoft\validators;

use Yii;

/**
 * Description of EitherValidator
 *
 * @author qdzsoft
 */
class EitherValidator extends \yii\validators\Validator
{
    public function init() {
        parent::init();
        
        if ($this->message === null) {
            $this->message = Yii::t('yii', 'Either of the %s is required.');
        }
    }
    /**
     * @inheritdoc
     */
    public function validateAttributes($model, $attributes = null)
    {
        $labels = [];
        $values = [];
        $attributes = $this->attributes;
        foreach($attributes as $attribute) {
            $labels[] = $model->getAttributeLabel($attribute);
            if(!empty($model->$attribute)) {
                $values[] = $model->$attribute;
            }
        }

        if (empty($values)) {
            $labels = "<<" . implode('>>, <<', $labels) . ">>";
            foreach($attributes as $attribute) {
                $this->addError($model, $attribute, sprintf($this->message, $labels));
                break;;
            }
            return false;
        }
        return true;
    }
}
