<?php

class Formconstructor_Functions {
    
    public $jsonForm;
    
    public function FormBuilder(){
        $this->CleanFormBuilder();
    }
    
    private function CleanFormBuilder($element){
        $formElement = $this->jsonForm;
        foreach($formElement as $form_element):
            $element = $form_element['element'];
            
        endforeach;
    }
    
    private function TextField(array $value){
        $element = array(
            'name'=>$value['identifier']);
    }
    
    public static function FormElement($type, array $elements){
        $output = '';
        switch(strtolower($type)):
            case 'text':
                $output .= '';
                break;
        endswitch;
        return $output;
    }
    
}
