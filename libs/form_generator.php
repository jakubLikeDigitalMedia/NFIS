<?php
/**
 * Created by PhpStorm.
 * User: wizard
 * Date: 09/01/14
 * Time: 21:58
 */

class FormGenerator{

    private $name;
    private $action;
    private $method;
    private $class = '';

    private $elements = array();
    private $groups = array();

    // default element classes
    private $labelClass = 'label';
    private $TextFieldClass = 'text-field';

    //default form attributes
    private $textFieldSize = 40;


    public function __construct($name, $action, $method, $class = ''){
        $this->name = $name;
        $this->action = $action;
        $this->method = $method;
        $this->class = $class;
    }


    public function createElement($type, $label, $name, $value, $options = array()){
        return $this->renderElement(array(
                                        'type' => $type,
                                        'label' => $label,
                                        'name' => $name,
                                        'value' => $value,
                                        'options' => $options
                                        )
                                    );

    }

    private function renderElement($element){
        $error = $this->getOption($element, 'error');
        $class = $this->getOption($element, 'class');
        $wrapper = $this->getOption($element, 'wrapper');
        $size = (empty($this->getOption($element, 'size')))? $this->textFieldSize: $this->getOption($element, 'size');
        $id = "{$this->name}_{$element['name']}";
        $HTML = "<label for=\"$id\" class=\"{$this->labelClass}\">{$element['label']}</label>";
        $HTML .= (!empty($error))? "<div class=\"error\">$error</div>": '';
        switch($element['type']){
            case 'text':
                $el = "<input type=\"text\" id=\"$id\" class=\"$class\" name=\"{$element['name']}\" value=\"{$element['value']}\" size=\"$size\">";
                $HTML .= (!empty($wrapper))? "<$wrapper>$el</$wrapper>": $el;
                return $HTML;
                break;
            case 'select':
                $HTML .= "<select id=\"$id\" class=\"$class\" name=\"{$element['name']}\">{$element['value']}</select>";
                $options = $element['value']['values'];
                if (is_array($options)){
                    $initVal = (empty($options))? 'No options are available': 'Select value';
                    $selectOptions = '<option value="0">'.$initVal.'</option>';
                    $selected = $element['value']['selected'];
                    foreach($options as $key => $option){
                        $selectOptions .= (!empty($selected) && $selected == $key)? '<option value="'.$key.'" selected="selected">'.$option.'</option>': '<option value="'.$key.'">'.$option.'</option>';
                    }
                    return $HTML .= $selectOptions.'</select>';
                }
                else return $HTML.'</select>';
                break;
        }
    }
    /*
     * function create sub array containing grouped elements and add this to elements array
     * @elements array of created elements
     * @groupName name of group
     */
    public function addElementsToGroup($groupName, $elements){
        $this->groups[$groupName] = $elements;
        $this->elements[$groupName] = $this->groups[$groupName];


    }

    public function addElementsToSubgroup($parentGroup, $groupName, $elements){
        if (isset($this->groups[$parentGroup])){
            $this->groups[$parentGroup][$groupName] = $elements;
        }
        else return;
    }

    public function addElements($elements){
        foreach ($elements as $group => $elements) {
            $elementsInGroup = array();
            if (is_string($group)){

                if (is_string($element)){
                        foreach($elements[$group][$element] as $element){
                            $groupElements[$group][$element][] = $this->createElement($element['type'], $element['label'], $element['name'], $element['value'], $element['options']);
                        }
                }
                else{
                    $elementsInGroup[] = $this->createElementsInGroup($group, $elements);
                }
            }
            else{
                $this->addElement($this->createElement($element['type'], $element['label'], $element['name'], $element['value'], $element['options']));
            }
        }

        foreach ($groupElements as $group => $elements) {
            $this->createGroupElements($group, $elements);
        }

    }

    public function addElement($element){
        $this->elements[] = $element;
    }

    public function render($type = NULL){
        $class = (!empty($this->class))? "class=\"{$this->class}\"": '';
        $form = "<form id=\"{$this->name}\" $class action=\"$this->action\" method=\"{$this->method}\">";
        $form .= $this->renderElements($this->elements, $type);
        $form .= '</form>';
        return $form;

    }

    private function setTextFieldSize($size){
        $this->textFieldSize = $size;

    }

    private function createElementsInGroup($group, $elements){
        $elementsInGroup = array();
        foreach ($elements as $element) {
            $elementsInGroup[$group] = $this->createElement($element['type'], $element['label'], $element['name'], $element['value'], $element['options']);
        }

    }

    private function getOption($element, $option){
        switch($option){
            case 'class':
                return (isset($element['options']['class']))? $this->TextFieldClass.' '.$element['options']['class']: $this->defTextFieldClass;
                break;
            default:
                return (isset($element['options'][$option]))? $element['options'][$option]:'';
        }
    }



    private function renderFieldset($label, $elements, $type){
        $HTML = '<fieldset>';
        $HTML .= "<legend>$label</legend>";
        $HTML .= $this->renderElements($elements, $type);
        $HTML .= '</fieldset>';
        return $HTML;

    }

    private function renderElements($elements, $type){


        switch($type){
            case 'list':
                $HTML = '<ul>';
                foreach ($elements as $key => $value) {
                    $HTML .= (is_array($value))? "<li>{$this->renderFieldset($key, $value, $type)}</li>": "<li>$value</li>";
                }
                $HTML .= '</ul>';
                return $HTML;
                break;
            case 'div':
                $HTML = '';
                foreach ($elements as $key => $value) {
                    $HTML .= (is_array($value))? "<div>{$this->renderFieldset($key, $value, $type)}</div>": "<div>$value</div>";
                }
                return $HTML;
                break;
            default:
                $HTML = '';
                foreach ($elements as $key => $value) {
                    $HTML .= (is_array($value))? "{$this->renderFieldset($key, $value, $type)}": "$value";
                }
                return $HTML;


        }
    }








}
