<?php
/**
 * @package ImpressPages
 *
 */

namespace Ip\Form\Field;


class Range extends Field{
    
    public function render($doctype) {
        $attributesStr = '';

        return '<input '.$this->getAttributesStr($doctype).' class="form-control '.implode(' ',$this->getClasses()).'" name="'.htmlspecialchars($this->getName()).'" '.$this->getValidationAttributesStr($doctype).' type="range" value="'.htmlspecialchars($this->getDefaultValue()).'" />';
    }
    
    /**
    * CSS class that should be applied to surrounding element of this field. By default empty. Extending classes should specify their value.
    */
    public function getTypeClass() {
        return 'text';
    }
    
}