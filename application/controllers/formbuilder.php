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
            case 'formelement'://dri ajax_element_form_group
                $ajax = true;
                $values = strtolower($_REQUEST['value']);//basic@decoration
                $vars = isset($_REQUEST['params']) ? form_array($_REQUEST['params']) : null;//formValue
                echo $this->RenderOutput('formbuilder/' . $values, $vars);//basic
                break;
            case 'createform':
                $ajax = true;
                $this->SessionUnset('form_element');
                echo $this->ConstructJSONFormTemplate($this->formElementArray);
                break;
//            case 'basic-form':
//                $page = 'formbuilder/basic';
//                $document = new Document_Template_Model();
//                $result['method_list'] = $document->ListMethod();
//                $view = new View_Model($page);
//                $view->assign('content', $result);
//                break;
//            case 'create-document':
//                $ajax = true;
//                $testinput = form_array($_REQUEST['values']);
//                
//                $output = array (
//                    $testinput ['section_desc'] => array (
//                        "section_desc" => $testinput['section_desc'],
//                        "layout" => $testinput['column'],
//                    )
//                );
//                print_r($output);
//           
//                echo json_encode($output);
//                break;
            case 'generate-json':
                $ajax = true;
             //   $documentId = $_REQUEST['documents'];
                print_r($_REQUEST['documents']);//print array
                $documentInfo = $_REQUEST['documents'];
                $actionType = $_REQUEST['type'];
                foreach($documentInfo as $doc):
                        $documentTemplate = new Document_Template_Model();
                        $sections = $documentTemplate->ReadDocumentSectionGroup($doc['doc_name_id']);
                        $documentArray = $this->GetDocumentSections($doc['doc_name_id'], $sections);
                        $this->CreateJSONForm($doc, $documentArray,$actionType);
                endforeach;                
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
