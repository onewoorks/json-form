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
                if ($_REQUEST['group_code'] != '0') {
                    $newOptions = $reference->DocumentTypeFiltering($_REQUEST['group_code']);
                    echo $this->SelectOptionBuilder($newOptions);
                }
                break;
            case 'filter-discipline':
                $ajax = true;
                $reference = new Reference_Table_Model();
                if ($_REQUEST['dis_code'] != '0') {
                    $newOptions = $reference->DocumentDisFiltering($_REQUEST['dis_code']);
                    echo $this->SelectOptionBuilder($newOptions);
                }
                break;
            case 'filter-ncp-discipline':
                $ajax = true;
                $reference = new Reference_Table_Model();
                if ($_REQUEST['dis_code'] != '0') {
                    $newOptions = $reference->NcpDiagnosisFiltering($_REQUEST['dis_code']);
                    echo $this->SelectOptionBuilder($newOptions);
                }
                break;
            case 'filter-pds-discipline':
            $ajax = true;
            $reference = new Reference_Table_Model();
            if ($_REQUEST['dis_code'] != '0') {
                $newOptions = $reference->PdsFiltering($_REQUEST['dis_code']);
                echo $this->SelectOptionBuilder($newOptions);
            }
            break;
            
            case 'filter-pds-type':
            $ajax = true;
            $reference = new Reference_Table_Model();
            if ($_REQUEST['dis_code'] != '0') {
                $newOptions = $reference->GetPDSType($_REQUEST['dis_code']);
                echo $this->SelectOptionBuilder($newOptions);
            }
                break;
                
            //30OKT
            case 'filter-form-clone':
                $ajax = true;
                $document = new Document_Template_Model();
                $values = $this->form_array($_REQUEST['documentValues']);
                $page = 'forms/clone_view';
                $reference = new Reference_Table_Model();
                $result['sections'] = $document->GetAllSecDesc();
                $result['elements'] = $document->GetAllElementDesc();
                $result['list_of_documents'] = $document->GetFilterListByGroupType($values);
                $result['main_discipline'] = $this->RefMainDisciplineGroup();
                if ($values['discipline'] != '0'):
                    $result['general_discipline'] = $reference->DocumentDisFiltering($values['discipline']);
                endif;
                $types = '0';
                if ($values['discipline'] != '0'):
                    $types = $values['general_discipline'];
                endif;

                $result['doc_group'] = $this->RefDocumentSelectedGroup();
                if ($values['doc_group'] != '0') {
                    $result['doc_types'] = $this->RefDocumentType($values['doc_group']);
                }
                $type = '0';
                if ($values['doc_group'] != '0') {
                    $type = $values['doc_type'];
                }

                $result['preset_select'] = array(
                    'active_discipline' => $values['discipline'],
                    'active_general' => $types,
                    'active_group' => $values['doc_group'],
                    'active_type' => $type
                );
                $view = new View_Model($page);
                $view->assign('content', $result);
                break;
            case 'generate-json-table':
                $ajax = true;
                $document = new Document_Template_Model();
                $values = $this->form_array($_REQUEST['documentValues']);
                $page = 'forms/generate_json_format';
                $reference = new Reference_Table_Model();
                $result['available_documents'] = $document->ReadElementExisted($values);
                $result['main_discipline'] = $this->RefMainDisciplineGroup();
                if ($values['discipline'] != '0'):
                    $result['general_discipline'] = $reference->DocumentDisFiltering($values['discipline']);
                endif;
                $types = '0';
                if ($values['discipline'] != '0'):
                    $types = $values['general_discipline'];
                endif;

                $result['doc_group'] = $this->RefDocumentSelectedGroup();
                if ($values['doc_group'] != '0') {
                    $result['doc_types'] = $this->RefDocumentType($values['doc_group']);
                }
                $type = '0';
                if ($values['doc_group'] != '0') {
                    $type = $values['doc_type'];
                }
                $result['preset_select'] = array(
                    'active_discipline' => $values['discipline'],
                    'active_general' => $types,
                    'active_group' => $values['doc_group'],
                    'active_type' => $type
                );
                $view = new View_Model($page);
                $view->assign('content', $result);
                break;
                case 'create-filter-diagnosis':
                $ajax = true;
                $document = new Document_Template_Model();
                $values = $this->form_array($_REQUEST['documentValues']);
                $page = 'forms/new_ncp_method';
                $reference = new Reference_Table_Model();
                $result['list_of_ncp'] = $document->GetAllNcpDocuments();
                $result['list_of_diagnosis'] = $document->GetAllNcpDocumentsGroup($values);
                if ($values['discipline'] != '0'):
                    $result['ncp_diagnosis'] = $reference->NcpDiagnosisFiltering($values['discipline']);
                endif;
                $types = '0';
                if ($values['discipline'] != '0'):
                    $types = $values['doc_group'];
                endif;
                $result['preset_select'] = array(
                    'active_discipline' => $values['discipline'],
                    'active_group' => $types
                );
                $view = new View_Model($page);
                $view->assign('content', $result);
                break;
                //21/7/21 : Add pds filter
                case 'create-filter-pds':
                $ajax = true;
                $document = new Document_Template_Model();
                $values = $this->form_array($_REQUEST['documentValues']);
                $page = 'forms/new_pds_method';
                $reference = new Reference_Table_Model();
                $result['main_discipline'] = $this->RefMainDisciplineGroup();
                $result['list_of_pds'] = $document->GetAllPdsDocumentsGroup($values);
                
                if ($values['main_discipline'] != '0'):
                    $result['pds_group'] = $reference->GetPDSType($values['main_discipline']);
                endif;
                
                if ($values['discipline'] != '0'):
                    $result['pds_document'] = $reference->PDSFiltering($values['discipline']);
                endif;
                $types = '0';
                if ($values['discipline'] != '0'):
                    $types = $values['doc_group'];
                endif;
                $result['preset_select'] = array(
                    'active_maindiscipline' => $values['main_discipline'],
                    'active_discipline' => $values['discipline'],
                    'active_group' => $types
                );
                $view = new View_Model($page);
                $view->assign('content', $result);
                break;
            //zarith-8/3 
            case 'create-filter':
                $ajax = true;
                $document = new Document_Template_Model();
                $values = $this->form_array($_REQUEST['documentValues']);
                $page = 'forms/document_list';
                $reference = new Reference_Table_Model();
                $result['list_of_documents'] = $document->GetFilterListByGroupType($values);
                $result['main_discipline'] = $this->RefMainDisciplineGroup();
                if ($values['discipline'] != '0'):
                    $result['general_discipline'] = $reference->DocumentDisFiltering($values['discipline']);
                endif;
                $types = '0';
                if ($values['discipline'] != '0'):
                    $types = $values['general_discipline'];
                endif;

                $result['doc_group'] = $this->RefDocumentSelectedGroup();
                if ($values['doc_group'] != '0') {
                    $result['doc_types'] = $this->RefDocumentType($values['doc_group']);
                }
                $type = '0';
                if ($values['doc_group'] != '0') {
                    $type = $values['doc_type'];
                }

                $result['preset_select'] = array(
                    'active_discipline' => $values['discipline'],
                    'active_general' => $types,
                    'active_group' => $values['doc_group'],
                    'active_type' => $type
                );
                $result['list_of_titles'] = $document->GetAllTitle();
               // $result['available_documents'] = $document->GetDocStatus();
                $view = new View_Model($page);
                $view->assign('content', $result);
                break;
            //12julai    
            case 'form-builder':
                $ajax = true;
                $document = new Document_Template_Model();
                $values = $this->form_array($_REQUEST['documentValues']);
                $page = 'forms/new_form';
                $reference = new Reference_Table_Model();
                $result['main_discipline'] = $this->RefMainDisciplineGroup();
                $result['general_discipline'] = $reference->DocumentDisFiltering($values['discipline']);
                $result['doc_group'] = $this->RefDocumentSelectedGroup();
                if ($values['doc_group'] != '0') {
                    $result['doc_types'] = $this->RefDocumentType($values['doc_group']);
                }
                $type = '0';
                if ($values['doc_group'] != '0') {
                    $type = $values['doc_type'];
                }
                $result['preset_select'] = array(
                    'active_discipline' => $values['discipline'],
                    'active_general' => $values['general_discipline'],
                    'active_group' => $values['doc_group'],
                    'active_type' => $type
                );
                $result['list_of_titles'] = $document->GetAllTitle();
                $view = new View_Model($page);
                $view->assign('content', $result);
                break;
            //5OKT
            case 'search-title':
                $ajax = true;
                $document = new Document_Template_Model();
                $values = $this->form_array($_REQUEST['values']);
                $page = 'forms/new_form';
                $search = $values['search'];
                $result['list_of_titles'] = $document->searchTitleDesc($search);
                $view = new View_Model($page);
                $view->assign('content', $result);
                break;
            //20JULAI
            case 'search-section':
                $ajax = true;
                $document = new Document_Template_Model();
                $values = $this->form_array($_REQUEST['values']);
                $page = 'forms/new_section';
                $search = $values['search'];
                $result['list_of_sections'] = $document->searchSecDesc($search);
                $view = new View_Model($page);
                $view->assign('content', $result);
                break;
            //23JULAI
            case 'search-element':
                $ajax = true;
                $document = new Document_Template_Model();
                $values = $this->form_array($_REQUEST['values']);
                $page = 'forms/new_element';
                $search = $values['search'];
                $result['list_of_elements'] = $document->searchElement($search);
                $view = new View_Model($page);
                $view->assign('content', $result);
                break;
            case 'clone_view';
                $page = 'forms/clone_view';
                $doc_desc = $params[URL_ARRAY + 4];
                $document = new Document_Template_Model();
                $result['main_discipline'] = $this->RefMainDisciplineGroup();
                $result['general_discipline'] = $this->RefGeneralDiscipline();
                $result['doc_types'] = $this->RefDocumentType();
                $result['doc_group'] = $this->RefDocumentSelectedGroup();
                $result['preset_select'] = false;
                break;
            default:
                if (PROJECT_PATH == 'cd' || PROJECT_PATH == 'rispac'):
                    $result['available_documents'] = $this->CompareExistedJSON();
                    $page = 'forms/generate_json_format';
                    $document = new Document_Template_Model();
                    $result['list_of_documents'] = $document->GetListAvailableDocument();
                    $result['main_discipline'] = $this->RefMainDisciplineGroup();
                    $result['general_discipline'] = $this->RefGeneralDiscipline();
                    $result['doc_types'] = $this->RefDocumentType();
                    $result['doc_group'] = $this->RefDocumentGroup();
                    $result['preset_select'] = false;
                else:
                    $page = 'forms/document_list';
                    $document = new Document_Template_Model();
                    $result['list_of_documents'] = $document->GetListAvailableDocument();
                    $result['main_discipline'] = $this->RefMainDisciplineGroup();
                    $result['general_discipline'] = $this->RefGeneralDiscipline();
                    $result['doc_types'] = $this->RefDocumentType();
                    $result['doc_group'] = $this->RefDocumentSelectedGroup();
                    $result['preset_select'] = false;
                endif;
                break;
        endswitch;

        if (!$ajax):
            $result['header'] = $this->RenderOutput('common/main', isset($result['link_style']) ? $result['link_style'] : false );
            $result['footer'] = $this->RenderOutput('common/footer');
            $result['config'] = $this->RenderOutput('common/header', isset($result['link_style']) ? $result['link_style'] : false);
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

    private function TemplateGeneratorSync(array $docNameId) {
        $t = array();
        foreach ($docNameId as $doc):
//            $this->GenerateJSONFormat($doc);
            $t[] = $doc;
        endforeach;
//        $this->GenerateJSONFormat(196);
        return $t;
    }

    private function CompareExistedJSON() {
        $documentElementOnly = $this->GetAvailableDocumentWithElement();
//         $documentTemplate = $this->GetExistedDocumentTemplate();
//         print_r($documentTemplate);
//         $test = array_diff($documentElementOnly, $documentTemplate);
//         $mergeDocument = array_merge($documentElementOnly,$documentTemplate);
        return $documentElementOnly;
    }

    private function GetAvailableDocumentWithElement() {
        $document = new Document_Template_Model();
        $templates = $document->ReadDocumentElementExisted();
        if ($templates != null):
            $documentId = array();
            foreach ($templates as $template):
                $documentId[] = $template;
            endforeach;
            return $documentId;
        endif;
    }

}
