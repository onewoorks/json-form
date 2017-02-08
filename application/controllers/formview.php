<?php

class Formview_Controller extends Common_Controller {

    public function main(array $getVars, array $params = null) {
        $case = str_replace('?', '', $params[URL_ARRAY + 2]);
        $ajax = false;
        switch ($case):
            case 'document':
                $page = 'forms/document_view';
                $documentId = $params[URL_ARRAY + 3];
                $documentTemplate = new Document_Template_Model();
                $documentData = $documentTemplate->ReadDocumentSetup($documentId);
                $result['skeleton'] = $documentData;
                $result['document_title'] = $documentData[0]['doc_name_desc'];
                $sections = $documentTemplate->ReadDocumentSectionGroup($documentId);
                $documentArray = $this->GetDocumentSections($documentId, $sections);
                $result['json_elements'] = $documentArray;
                $this->CreateJSONForm($documentId, $documentArray);
                break;
            case 'new-form':
                $page = 'forms/new_form';
                $result['main_discipline'] = $this->RefMainDiscipline();
                $result['doc_types'] = $this->RefDocumentType();
                break;
            case 'load-ajax-method':
                $ajax = true;
                $page = 'form_methods/'.$_REQUEST['methodpage'];
                echo $this->RenderOutput($page);
                break;
            case 'edit-form':
                $page = 'forms/edit-form';
                $documentId = $params[URL_ARRAY + 3];
                $documentData = new Document_Template_Model();
                $documentTemplate = $documentData->ReadDocumentTemplate($documentId);
                $result['document_title'] = $documentTemplate['doc_name_desc'];
                $result['json_elements'] = json_decode($documentTemplate['json_template']);
                $result['document_id'] = $documentTemplate['doc_name_id'];
                $result['template_id'] = $documentTemplate['template_id'];
                break;
            case 'sql-raw-data':
                $page = 'forms/sql_raw_data';
                break;
            case 'generate-json-format';
                $result['available_documents'] = $this->CompareExistedJSON();
                $page = 'forms/generate_json_format';
                break;
            case 'insert-sql':
                $ajax = true;
                $values = $this->form_array($_REQUEST['values']);
                $insertLine = nl2br($values['insert_statement']);
                $insertSql = explode('<br />', $insertLine);
                $document = new Document_Template_Model();
                foreach ($insertSql as $insert):
                    $document->CreateNewInsertElement($insert);
                endforeach;
                break;
            case 'json-format':
                $page = 'forms/json_format';
                $documentId = $params[URL_ARRAY + 3];
                $documentData = new Document_Template_Model();
                $documentTemplate = $documentData->ReadDocumentTemplate($documentId);
                $result['document_title'] = $documentTemplate['doc_name_desc'];
                $result['json_elements'] = $documentTemplate['json_template'];
                break;
            case 'form-template':
                $page = 'forms/document_view';
                $documentId = $params[URL_ARRAY + 3];
                $documentData = new Document_Template_Model();
                $documentTemplate = $documentData->ReadDocumentTemplate($documentId);
                $sectionSorting = json_decode($documentTemplate['json_template']);
                $cleanSorting = $this->JsonWithSectionSorting($sectionSorting);
                $result['document_title'] = $documentTemplate['doc_name_desc'];
                $result['json_elements'] = $cleanSorting;
                $result['document_id'] = $documentId;
                $result['link_style'] = "<link href='".SITE_ROOT."/assets/css/hiskkm.css' rel='stylesheet' />";
                break;
            case 'load-selected-json':
                $ajax = true;
                $key = $_REQUEST['key'];
                $component = $_REQUEST['component'];
                $document = new Document_Template_Model();
                if ($component == 'section'):
                    $found = $document->GetSectionDetail($key);
                    $page = 'forms/ajax_form_group';
                    $title = $found->section_desc;
                endif;
                if ($component == 'element'):
                    $found = $document->GetElementDetail($key);
                    $page = 'forms/ajax_element_form_group';
                    $title = $found->element_desc;
                endif;
                $result['values'] = $found;
                $result['json_format'] = json_encode($found);
                $result['document_id'] = $_REQUEST['documentId'];
                $result['template_id'] = $_REQUEST['templateId'];
                $data = array(
                    'component' => $title,
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            case 'testing':
                $page = 'forms/test';
                $result['link_style'] = "<link href='".SITE_ROOT."assets/css/hiskkm.css' rel='stylesheet' />";
                break;
            case 'edit-attributes':
                $ajax = true;
                $values = $this->form_array($_REQUEST['values']);
                $document = new Document_Template_Model();
                $data = array(
                    'section_code' => $values['section_code'],
                    'section_desc' => $values['section_desc']);
                $document->UpdateSectionDetail($data);
                $this->GenerateJSONFormat($values['document_id'], 'update');
                break;
            default:
                $result['link_style'] = "<link href='localhost/FORMjson/assets/library/summernote/' rel='stylesheet' />";
                $result['form_element'] = $this->SessionCall('form_element');
                $result['json_form'] = json_encode($this->SessionCall('form_element'));
                break;
        endswitch;

        if (!$ajax):
            $result['header'] = $this->RenderOutput('common/main', isset($result['link_style']) ? $result['link_style']:false);
            $result['footer'] = $this->RenderOutput('common/footer');
            $view = new View_Model($page);
            $view->assign('content', $result);
        endif;
    }

    

    private function GetDocumentSectionElementGetDocumentElements(array $documentData, $elementSelection) {
        $grabSelection = array();
        foreach ($documentData as $elements):
            $grabSelection[] = $elements['json_section'];
        endforeach;
        $sections = array_values(array_unique($grabSelection));
        return $this->GetDocumentSectionElements($sections, $documentData);
    }

    private function GetDocumentSectionElements($sections, array $documentData) {
        $sectionElements = array();
        foreach ($documentData as $data):
            $sectionElements[$data['json_section']][] = $data;
        endforeach;
        return $sectionElements;
    }

    private function GetAvailableDocumentWithElement(){
        $document = new Document_Template_Model();
        $templates = $document->ReadDocumentElementExisted();
        $documentId = array();
        foreach($templates as $template):
            $documentId[] = $template['doc_name_id'];
        endforeach;
        return $documentId;
    }
    
    private function GetExistedDocumentTemplate(){
        $document = new Document_Template_Model();
        $templates = $document->GetExistedDocumentJSONTemplate();
        $documentId = array();
        foreach($templates as $template):
            $documentId[] = $template['doc_name_id'];
        endforeach;
        return $documentId;
    }
    
    private function CompareExistedJSON(){
        $documentElementOnly = $this->GetAvailableDocumentWithElement();
        $documentTemplate = $this->GetExistedDocumentTemplate();
        $test = array_diff($documentElementOnly, $documentTemplate);
        $mergeDocument = array_merge($documentElementOnly,$documentTemplate);
        print_r($mergeDocument);
        return $test;
    }
//    private function GenerateJSONFormat($documentId, $action = 'insert') {
//        $documentTemplate = new Document_Template_Model();
//        $documentData = $documentTemplate->ReadDocumentSetup($documentId);
//        $result['skeleton'] = $documentData;
//        $result['document_title'] = $documentData[0]['doc_name_desc'];
//        $sections = $documentTemplate->ReadDocumentSectionGroup($documentId);
//        $documentArray = $this->GetDocumentSections($documentId, $sections);
//        $result['json_elements'] = $documentArray;
//        $this->CreateJSONForm($documentId, $documentArray, $action);
//
//        re
//        
//        
//        
//        
//        
//        turn true;
//    }
}
