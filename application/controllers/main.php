<?php

class Main_Controller extends Common_Controller {

    public $par = URL_ARRAY;

    public function __construct() {
        
    }

    public function main(array $getVars, array $params = null) {
        $theParams = isset($params[URL_ARRAY + 2]) ? $params[URL_ARRAY + 2] : false;
        $case = str_replace('?', '', $theParams);
        $ajax = false;
        $page = '';
        $result['header'] = false;
        $result['footer'] = false;
        switch ($case):
            case 'sync':
                $ajax = true;
                $compare = $this->DocumentChecking();
                print_r($compare);
                break;
            case 'filter':
                $ajax = true;
                $reference = new Reference_Table_Model();
                if($_REQUEST['group_code']!=NULL){
                $newOptions = $reference->DocumentTypeFiltering($_REQUEST['group_code']);
                echo $this->SelectOptionBuilder($newOptions);
                }
                break;
            case 'filter-discipline':
                $ajax = true;
                $reference = new Reference_Table_Model();
                $newOptions = $reference->DocumentDisFiltering($_REQUEST['dis_code']);
                echo $this->SelectOptionBuilder($newOptions);
                break;
            case 'generate-json-table':
                $ajax = true;
                $document = new Document_Template_Model();
                $values = $this->form_array($_REQUEST['documentValues']);
                $page = 'forms/generate_json_format';
                $reference = new Reference_Table_Model();
                $result['available_documents'] = $document->ReadElementExisted($values);
                $result['main_discipline'] = $this->RefMainDisciplineGroup();
                $result['general_discipline'] = $reference->DocumentDisFiltering($values['discipline']);
                $result['doc_group'] = $this->RefDocumentSelectedGroup();
                if($values['doc_group']!='0'){
                $result['doc_types'] = $this->RefDocumentType($values['doc_group']);
                }
                $type='0';
                if($values['doc_group']!='0'){
                    $type=$values['doc_type'];
                }
                $result['preset_select'] = array (
                    'active_discipline' => $values['discipline'],
                    'active_general' => $values['general_discipline'],
                    'active_group' => $values['doc_group'],
                    'active_type' => $type
                );
                $view = new View_Model($page);
                $view->assign('content', $result);
                break;          
            case 'search-by-filter':
                $ajax = true;
                $document = new Document_Template_Model();
                $values = $this->form_array($_REQUEST['documentValues']);
                $page = 'forms/list_of_document';
                $reference = new Reference_Table_Model();
                $result['list_of_documents'] = $document->GetFilterListByGroupType($values);               
                $result['main_discipline'] = $this->RefMainDisciplineGroup();               
                $result['general_discipline'] =  $reference->DocumentDisFiltering($values['discipline']);
                $result['doc_group'] = $this->RefDocumentSelectedGroup();
                if($values['doc_group']!='0'){
                $result['doc_types'] = $this->RefDocumentType($values['doc_group']);
                }
                $type='0';
                if($values['doc_group']!='0'){
                    $type=$values['doc_type'];
                }
                $result['preset_select'] = array(
                    'active_discipline' => $values['discipline'],
                    'active_general' => $values['general_discipline'],
                    'active_group' => $values['doc_group'],
                    'active_type' => $type
                );
                $view = new View_Model($page);
                $view->assign('content', $result);
                break;
            default:
                $page = 'forms/list_of_document';
                $document = new Document_Template_Model();
                $result['list_of_documents'] = $document->GetListAvailableDocument();
                $result['main_discipline'] = $this->RefMainDisciplineGroup();
                $result['general_discipline'] = $this->RefGeneralDiscipline();
                $result['doc_types'] = $this->RefDocumentType();
                $result['doc_group'] = $this->RefDocumentSelectedGroup();
                $result['preset_select'] = false;
                break;
        endswitch;

        if (!$ajax):
            $result['header'] = $this->RenderOutput('common/main', isset($result['link_style']) ? $result['link_style'] : false );
            $result['footer'] = $this->RenderOutput('common/footer');
            $view = new View_Model($page);
            $view->assign('content', $result);
        endif;
    }

    private function DocumentChecking() {
        $document = new Document_Template_Model();
        $foundInElement = $document->GetAvailableDocName();
        $foundInTemplate = $document->GetAvailableTemplate();
        $docElement = array();
        $docTemplate = array();
        foreach ($foundInElement as $element):
            $docElement[] = $element['doc_name_id'];
        endforeach;
        foreach ($foundInTemplate as $template):
            $docTemplate[] = $template['doc_name_id'];
        endforeach;
        $checking = array_diff($docElement, $docTemplate);
        $this->TemplateGeneratorSync($checking);
        return array_values($checking);
    }
    
    private function TemplateGeneratorSync(array $docNameId){
        $t = array();
        foreach($docNameId as $doc):
//            $this->GenerateJSONFormat($doc);
            $t[] = $doc;
        endforeach;
//        $this->GenerateJSONFormat(196);
        return $t;
    }

}
