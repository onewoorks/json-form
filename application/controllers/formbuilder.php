<?php

class Formbuilder_Controller extends Common_Controller {

    public $par = URL_ARRAY;
    private $formElementArray = array();

    public function main(array $getVars, array $params = null) {
        $case = str_replace('?', '', $params[URL_ARRAY + 2]);
        $ajax = false;
        switch ($case):
            case 'insertelement':
                $ajax = true;
                $values = $_REQUEST['values'];
                $field['index'] = $this->RandomNumber();
                $field['element'] = $_REQUEST['form_type'];
                $field['component'] = $this->form_array($values);
                $this->formElementArray = $this->SessionCheck('form_element', $field);
                echo $this->ConstructJSONFormTemplate($this->formElementArray);
                break;
            case 'insertsection':
                $ajax = true;
                $values = $_REQUEST['values'];
                $field['index'] = $this->RandomNumber();
//                $field['element'] = $_REQUEST['form_type'];
                $field['component'] = $this->form_array($values);
                $this->formElementArray = $this->SessionCheck('form_element', $field);
                echo $this->ConstructJSONFormTemplate($this->formElementArray);
                break;
            case 'formelement':
                $ajax = true;
                $values = $_REQUEST['value'];               
                $vars = isset($_REQUEST['params']) ? form_array($_REQUEST['params']) : null;
//                echo '<pre>';
//                print_r($vars);
//                echo '</pre>';
                echo $this->RenderOutput('formbuilder/' . $values, $vars);
                break;
            case 'createform':
                $ajax = true;
                $this->SessionUnset('form_element');
                echo $this->ConstructJSONFormTemplate($this->formElementArray);
                break;
            case 'generate-json':
                $ajax = true;
                $documentNameId = $_REQUEST['documents'];
                print_r($documentNameId);
//                $actionType = $_REQUEST['type'];
//                foreach ($documentNameId as $doc):
//                    $documentTemplate = new Document_Template_Model();
//                    if($actionType=='regenerate'):
//                        $documentTemplate->DeleteTemplate($doc);
//                    endif;
//                    $sections = $documentTemplate->ReadDocumentSectionGroup($doc);
//                    $documentArray = $this->GetDocumentSections($doc, $sections);
//                    $this->CreateJSONForm($doc, $documentArray);
//                endforeach;
                break;
            default:
                break;
        endswitch;

        if (!$ajax):
            $result['header'] = $this->RenderOutput('main');
            $result['footer'] = $this->RenderOutput('footer');
            $view = new View_Model('formbuilder');
            $view->assign('content', $result);
        endif;
    }

    private function ConstructJSONFormTemplate(array $formElement) {
        return json_encode($formElement);
    }

}
