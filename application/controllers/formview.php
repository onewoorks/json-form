<?php

class Formview_Controller extends Common_Controller {

    public function main(array $getVars, array $params = null) {
        $case = str_replace('?', '', $params[URL_ARRAY + 2]);
        $ajax = false;
        switch ($case):
            case 'sandbox':
                $page = 'forms/mockup';
                break;
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

                $dt = $documentTemplate->ReadDocumentTemplate($documentId);

                $result['document_title'] = $dt['doc_name_desc'];
                $result['main_discipline'] = $dt['main_discipline_name'];
                $result['sub_discipline'] = $dt['discipline_name'];
                break;
            case 'new-diagnosis':
                $page = 'forms/new_diagnosis';
                //$documentId = $params[URL_ARRAY + 3];
                $document = new Document_Template_Model();
                $result['list_of_diagnosis'] = $document->GetAllDiagnosis();
                //$result['doc_id'] = $documentId;
                break;
//            case 'new-procedure':
//                $page = 'forms/new_procedure';
//                //$documentId = $params[URL_ARRAY + 3];
//                $document = new Document_Template_Model();
//                $result['list_of_procedure'] = $document->GetAllDiagnosis();
//                //$result['doc_id'] = $documentId;
//                break;
            //12julai    
            case 'new-form':
                $page = 'forms/new_form';
                $document = new Document_Template_Model();
                $result['main_discipline'] = $this->RefMainDisciplineGroup();
                $result['general_discipline'] = $this->RefGeneralDiscipline();
                $result['doc_types'] = $this->RefDocumentType();
                $result['doc_group'] = $this->RefDocumentGroup();
                $result['preset_select'] = false;
                $result['list_of_titles'] = $document->GetAllTitle();
                break;
            //28feb
            case 'new-method':
                $page = 'forms/new_method';
                $document = new Document_Template_Model();
                $result['list_of_method'] = $document->GetAllmethodDesc();
                break;
            //19julai    
            case 'new-section':
                $page = 'forms/new_section';
                $document = new Document_Template_Model();
//              $result['section_desc'] = $document->GetSecDesc();
                $result['list_of_sections'] = $document->GetAllSecDesc();
                break;
            //19julai  
            case 'new-element':
                $page = 'forms/new_element';
                $document = new Document_Template_Model();
                $result['list_of_elements'] = $document->GetAllElementDesc();
                break;
            //zarith-8/3   
            case 'build-form':
                 $page = 'forms/build_form'; 
                $documentId = $params[URL_ARRAY + 3];
                $documentData = new Document_Template_Model();
                $documentTemplate = $documentData->ReadDocumentTemplate($documentId);
                $result['document_id'] = $documentTemplate['doc_name_id'];
                $result['template_id'] = $documentTemplate['template_id'];
                $result['document_title'] = $documentTemplate['doc_name_desc'];
                $result['sections'] = $documentData->GetAllSecDesc();
                $result['elements'] = $documentData->GetAllElementDesc();
                break;
            //23julai    
            case 'form-builder':
                $page = 'forms/form_builder';
                $document = new Document_Template_Model();
                $result['list_of_documents'] = $document->GetListAvailableDocument();
                $result['main_discipline'] = $this->RefMainDisciplineGroup();
                $result['general_discipline'] = $this->RefGeneralDiscipline();
                $result['doc_types'] = $this->RefDocumentType();
                $result['doc_group'] = $this->RefDocumentGroup();
                $result['preset_select'] = false;
                break;
            //6MAC
            case 'json-method':
                $page = 'forms/json_method';
                break;
            //14OGOS
            case 'basic-form':
                $page = 'formbuilder/basic';
                $document = new Document_Template_Model();
                $result['method_list'] = $document->ListMethod();
                $view = new View_Model($page);
                $view->assign('content', $result);
                break;
            //2OGOS
            case 'generate-new-form-json':
                $ajax = true;
                $documentId = $_REQUEST['documents'];
//                $templateId = $REQUEST['documents'];
                print_r($_REQUEST['documents']); //print array
                $documentInfo = $_REQUEST['documents'];
                $actionType = $_REQUEST['type'];
                foreach ($documentInfo as $doc):
                    $documentTemplate = new Document_Template_Model();
                    $sections = $documentTemplate->ReadDocumentSectionGroup($doc['doc_name_id']);
                    $documentArray = $this->GetDocumentSections($doc['doc_name_id'], $sections);
                    $this->CreateJSONForm($doc, $documentArray, $actionType);
                endforeach;
                break;
            //30julai    
//            case 'form-element':
//                $page = 'forms/ajax_element_form_group';
//                $document = new Document_Template_Model();
//                $result['elements'] = $document->ListElementDesc();
//                break;
            case 'load-ajax-method':
                $ajax = true;
                $page = 'form_methods/' . $_REQUEST['methodpage'];
                echo $this->RenderOutput($page);
                break;
            case 'edit-form':
                $page = 'forms/edit-form';
                $documentId = $params[URL_ARRAY + 3];
                $documentData = new Document_Template_Model();
                $documentTemplate = $documentData->ReadDocumentTemplate($documentId);

                $sectionSorting = json_decode($documentTemplate['json_template']);
                $cleanSorting = $this->JsonWithSectionSorting($sectionSorting); //sort kedudukan element

                $result['document_title'] = $documentTemplate['doc_name_desc'];
                $result['json_elements'] = $cleanSorting;
                $result['document_id'] = $documentTemplate['doc_name_id'];
                $result['template_id'] = $documentTemplate['template_id'];
                $result['list_of_titles'] = $documentData->GetAllTitle();
                break;
            //zarith-8/3 
            case 'edit-form-new':
                $page = 'forms/edit-form-new';
                $documentId = $params[URL_ARRAY + 3];
               // print_r ($documentId);
                $documentData = new Document_Template_Model();
                $documentTemplate = $documentData->ReadDocumentTemplate($documentId);

                $sectionSorting = json_decode($documentTemplate['json_template']);
                $cleanSorting = $this->JsonWithSectionSorting($sectionSorting); //sort kedudukan element

                $result['document_title'] = $documentTemplate['doc_name_desc'];
                $result['json_elements'] = $cleanSorting;
                $result['document_id'] = $documentTemplate['doc_name_id'];
                $result['template_id'] = $documentTemplate['template_id'];
                $result['list_of_titles'] = $documentData->GetAllTitle();
                $result['sections'] = $documentData->GetAllSecDesc();
                $result['elements'] = $documentData->GetAllElementDesc();
                break;
            case 'sql-raw-data':
                $page = 'forms/sql_raw_data';
                break;
            case 'generate-json-format';
                $result['available_documents'] = $this->CompareExistedJSON();
                $page = 'forms/generate_json_format';
                $document = new Document_Template_Model();
                $result['list_of_documents'] = $document->GetListAvailableDocument();
                $result['main_discipline'] = $this->RefMainDisciplineGroup();
                $result['general_discipline'] = $this->RefGeneralDiscipline();
                $result['doc_types'] = $this->RefDocumentType();
                $result['doc_group'] = $this->RefDocumentGroup();
                $result['preset_select'] = false;
                break;
            case 'insert-sql':
                $ajax = true;
                $insertLine = nl2br($_REQUEST['values']);
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
                $documentTemplate = $documentData->NakTengokJson($documentId);
                $result['discipline'] = $documentTemplate['main_discipline_name'];
                $result['sub_discipline'] = $documentTemplate['discipline_name'];
                $result['document_title'] = $documentTemplate['doc_name_desc'];
                $result['json_elements'] = $documentTemplate['json_template'];
                $result['template_id'] = $documentTemplate['template_id'];
                break;
            case 'form-template':
                $page = 'forms/document_view';
                $documentId = $params[URL_ARRAY + 3];
                $documentData = new Document_Template_Model();
                $documentTemplate = $documentData->ReadDocumentTemplate($documentId);
                $sectionSorting = json_decode($documentTemplate['json_template']);
//                echo '<pre>';
//                print_r($sectionSorting);
//                echo '</pre>';
                $cleanSorting = $this->JsonWithSectionSorting($sectionSorting);
                $result['document_title'] = $documentTemplate['doc_name_desc'];
                $result['main_discipline'] = $documentTemplate['main_discipline_name'];
                $result['sub_discipline'] = $documentTemplate['discipline_name'];
                $result['doc_group'] = $documentTemplate['doc_group_code'];
                $result['json_elements'] = $cleanSorting;
//                echo '<pre>';
//                print_r($result['json_elements']);
//                echo '</pre>';
                $result['template_id'] = $documentId;
                $result['rrr'] = 'pppp';
                $result['document_id'] = $documentTemplate['doc_name_id'];
                $result['link_style'] = "<link href='" . SITE_ASSET . "/assets/css/hiskkm.css' rel='stylesheet' />";
                break;
            //zarith-8/3 
            case 'form-template-preview':
                $page = 'forms/document_preview';
                $documentId = $params[URL_ARRAY + 3];
                $documentData = new Document_Template_Model();
                $documentTemplate = $documentData->ReadDocumentTemplate($documentId);
                $sectionSorting = json_decode($documentTemplate['json_template']);
//                echo '<pre>';
//                print_r($sectionSorting);
//                echo '</pre>';
                $cleanSorting = $this->JsonWithSectionSorting($sectionSorting);
                $result['document_title'] = $documentTemplate['doc_name_desc'];
                $result['main_discipline'] = $documentTemplate['main_discipline_name'];
                $result['sub_discipline'] = $documentTemplate['discipline_name'];
                $result['doc_group'] = $documentTemplate['doc_group_code'];
                $result['json_elements'] = $cleanSorting;
//                echo '<pre>';
//                print_r($result['json_elements']);
//                echo '</pre>';
                $result['template_id'] = $documentId;
                $result['rrr'] = 'pppp';
                $result['document_id'] = $documentTemplate['doc_name_id'];
                $result['link_style'] = "<link href='" . SITE_ASSET . "/assets/css/hiskkm.css' rel='stylesheet' />";
                break;
            //zarith-8/3 
             case 'form-template-view':
                $page = 'forms/document_view_build';
                $documentId = $params[URL_ARRAY + 3];
                $documentData = new Document_Template_Model();
                $documentTemplate = $documentData->ReadDocumentTemplate($documentId);
                $sectionSorting = json_decode($documentTemplate['json_template']);
//                echo '<pre>';
//                print_r($sectionSorting);
//                echo '</pre>';
                $cleanSorting = $this->JsonWithSectionSorting($sectionSorting);
                $result['document_title'] = $documentTemplate['doc_name_desc'];
                $result['main_discipline'] = $documentTemplate['main_discipline_name'];
                $result['sub_discipline'] = $documentTemplate['discipline_name'];
                $result['doc_group'] = $documentTemplate['doc_group_code'];
                $result['json_elements'] = $cleanSorting;
//                echo '<pre>';
//                print_r($result['json_elements']);
//                echo '</pre>';
                $result['template_id'] = $documentId;
                $result['rrr'] = 'pppp';
                $result['document_id'] = $documentTemplate['doc_name_id'];
                $result['link_style'] = "<link href='" . SITE_ASSET . "/assets/css/hiskkm.css' rel='stylesheet' />";
                break;
            case 'duplicate-form':
                $ajax = true;
                $doc = $_REQUEST['desc'];
                $curName = $_REQUEST['docid'];
                $docName = $_REQUEST['docDesc'];
                $document = new Document_Template_Model();
                $copyForm = $document->copyBaru($docName, $curName, $subdis, $type, $group);
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
                    $result['sections'] = $document->GetAllSecDesc();
                endif;
                if ($component == 'element'):
                    #DISPLAY DETAIL POPUP EDIT FORM
                    $doc_id = $_REQUEST['documentId'];
                    $section_id = $_REQUEST['sectionId'];
                    $found = $document->GetElementDetail($key, $doc_id, $section_id);
                    $grouping = $document->GetElementGrouping($section_id, $doc_id);
                    $page = 'forms/ajax_element_form_group';
                    $title = $found->element_desc;
                    $result['grouping'] = $grouping;
                    $result['elements'] = $document->ListElementDesc(); //utk search
//                    $result['methods'] = $document->ListMethod();
                endif;
                $result['values'] = $found; //bawa section_desc @ element_desc
                $result['json_format'] = json_encode($found);
                $result['document_id'] = $_REQUEST['documentId']; //1
                $result['template_id'] = $_REQUEST['templateId'];
                $data = array(
                    'component' => $title, //bawa section_desc @ element_desc
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            //30OKT
            case 'new-doc-element' :
                $document = new Document_Template_Model();
                $ajax = true;
                $page = 'forms/add_new_document';
                $result['doc_id'] = $_REQUEST['docId'];
                $result['elemCode'] = $_REQUEST['elemCode'];
                $result['sectCode'] = $_REQUEST['sectCode'];
                $result['elements'] = $document->ListElementDesc(); //List of ref_document_element
                $element = $_REQUEST['div']; //Panel Header (Element)
                $result['element'] = $_REQUEST['div']; //TextField (Element)
                $data = array(
                    'component' => $element, //bawa section_desc @ element_desc
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            //zarith-8/3 
            case 'add-element':
                $ajax = true;
                $page = 'forms/add_element';
                $doc_id = $_REQUEST['documentId'];
                $section_id = $_REQUEST['sectionId'];
                $template_id = $_REQUEST['templateId'];
                $document = new Document_Template_Model();
                $section_sorting = $document->GetSectionSorting($section_id, $doc_id);
                $grouping = $document->GetElementGrouping($section_id, $doc_id);
                $result['elements'] = $document->GetAllElementDesc();
                $result['section_sorting'] = $section_sorting;
                $result['grouping'] = $grouping;
                $result['doc_id'] = $doc_id;
                $result['section_id'] = $section_id;
                $data = array(
                    'component' => 'Add Element',
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            case 'pass-element':
                $page = 'forms/new_form';
                $value = $_REQUEST['values'];
                echo '<pre>';
                print_r($value);
                echo '</pre>';
                $result['test'] = $value;
                break;
            case 'add-new-element':
                $ajax = true;
                $document = new Document_Template_Model();
                $values = $this->form_array($_REQUEST['values']);
                $section_code = $values['section_code'];
                $document_id = $values['doc_id'];
                $element_desc = $values['element_desc'];
                $element_properties = $values['element_properties'];
                $new = strtolower($element_desc);
                $json_element = str_replace(' ', '_', $new);
                $last_element_sorting = $document->GetElementSorting($section_code, $document_id);
                $new_element_sorting = $last_element_sorting->newsorting + 1;  //wan is column name
                $ele = $document->GetMaxElementCode();
                $element_code = ($ele->maxcode) + 1;
                if ($values['element_group'] === '-1') {
                    $level = 1;
                    $grouping = $element_code;
                } else {
                    $level = 2;
                    $grouping = $values['element_group'];
                }
                $data = array('documentId' => $document_id,
                    'elementCode' => $element_code,
                    'element_group' => $grouping,
                    'position' => $values['position'],
                    'element_properties' => $values['element_properties']);
                $document->InsertNewRefElement($element_desc, $element_code, $json_element, $grouping, $new_element_sorting, $level, $values);
                if ($element_properties == 'DECORATION') {
                    $data['setparent'] = $values['setparent'];
                    $data['deco_style'] = $values['deco_style'];
                    $data['deco_custom_style'] = $values['deco_custom_style'];
                    $this->CaseDecoration($data);
                } elseif ($element_properties == 'BASIC') {
                    $data['input_type'] = $values['input_type'];
//                    $data['method_name'] = $values['method_name'];
//                    $data['method_params'] = $values['method_params'];
                    $this->CaseBasic($data);
                } elseif ($element_properties == 'SUBSECTION') {
//                    $data['method_name'] = $values['method_name'];
//                    $data['method_params'] = $values['method_params'];
                    $this->CaseSubsection($data);
                }
                $this->GenerateJSONFormat($document_id, 'update');
                break;
            case 'change-layout':
                $ajax = true;
                $document = new Document_Template_Model();
                $doc_id = $_REQUEST['documentId'];
                $val = $document->GetLayoutDetail($doc_id);
                $page = 'forms/change_document_layout';
                $result['layout'] = $val;
                $result['doc_id'] = $doc_id;
                $data = array(
                    'component' => 'Change Layout',
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            //zarith-8/3 
            case 'change-title-new':
                $ajax = true;
                $document = new Document_Template_Model();
                $doc_id = $_REQUEST['documentId'];
                $val = $document->GetTitleDetail($doc_id);
                $page = 'forms/change_document_title_new';
                $result['list_of_titles'] = $document->GetAllTitle();
                $result['title'] = $val;
                $result['doc_id'] = $doc_id;
                $data = array(
                    'component' => 'Document Title',
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            //zarith-10/3
            case 'change-status':
                $ajax = true;
                $document = new Document_Template_Model();
                $document_id = $_REQUEST['documentId'];
                $val = $_REQUEST['value'];
                $document->UpdateDocumentStatus($document_id, $val);
//                $data = array(
//                    'component' => 'Document Title',
//                    'html' => $this->RenderOutput($page, $result));
//                echo json_encode($data);
                break;
            case 'edit-title-new':
                $ajax = true;
                $values = $this->form_array($_REQUEST['values']);
                $document = new Document_Template_Model();
                $docId = $values['doc_id'];
                $title = $values['selected_title'];
                $title_id = $document->GetTitleId($docId);
                foreach ($title_id as $key):
                    $document->UpdateDocTitle($key['doc_name_id'], $title);
                    echo $key['doc_name_id'] . "<br>";
                endforeach;
                $this->GenerateJSONFormat($docId, 'update');
                break;
            case 'change-title':
                $ajax = true;
                $document = new Document_Template_Model();
                $doc_id = $_REQUEST['documentId'];
                $val = $document->GetTitleDetail($doc_id);
                $page = 'forms/change_document_title';
                $result['title'] = $val;
                $result['doc_id'] = $doc_id;
                $result['list_of_titles'] = $document->GetAllTitle();
                $data = array(
                    'component' => 'Document Title',
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            //22OCT19
            case 'change-method':
                $ajax = true;
                $document = new Document_Template_Model();
                $doc_id = $_REQUEST['documentId'];
                $val = $document->GetMethodDetail($doc_id);
                $page = 'forms/change_method_detail';
                $result['methods'] = $val;
                $result['doc_id'] = $doc_id;
                $result['list_of_method'] = $document->GetAllmethodDesc();
                $data = array(
                    'component' => 'Method Detail',
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            case 'change-section':
                $ajax = true;
                $document = new Document_Template_Model();
                $doc_id = $_REQUEST['documentId'];
                $val = $document->GetSectionsDetail($doc_id);
                $page = 'forms/change_section_detail';
                $result['section'] = $val;
                $result['doc_id']=$doc_id;
                $result['list_of_sections'] = $document->GetAllSecDesc();
                $data = array(
                    'component' => 'Section Title',
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            case 'change-element':
                $ajax = true;
                $document = new Document_Template_Model();
                $doc_id = $_REQUEST['documentId'];
                $val = $document->GetElementsDetail($doc_id);
                $page = 'forms/change_element_detail';
                $result['element'] = $val;
                $result['doc_id'] = $doc_id;
                $result['list_of_elements'] = $document->GetAllElementDesc();
                $data = array(
                    'component' => 'Element Name',
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            case 'delete-element':
                $ajax = true;
                $document = new Document_Template_Model();
                $doc_id = $_REQUEST['documentId'];
                $element_id = $_REQUEST['elementId'];
                $section_id = $_REQUEST['sectionCode'];
                $page = 'forms/delete_element';
                $result['doc_id'] = $doc_id;
                $result['element_id'] = $element_id;
                $result['section_id'] = $section_id;
                $data = array(
                    'component' => 'Delete Element',
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            case 'delete-document':
                $ajax = true;
                $document = new Document_Template_Model();
                $doc_id = $_REQUEST['documentId'];
                $val = $document->GetTitleDetail($doc_id);
                $page = 'forms/delete_document';
                $result['doc_id'] = $doc_id;
                $result['title'] = $val;
                $data = array(
                    'component' => 'Delete Document',
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            //22OCT19
            case 'delete-method':
                $ajax = true;
                $document = new Document_Template_Model();
                $doc_id = $_REQUEST['documentId'];
                $val = $document->GetMethodDetail($doc_id);
                $page = 'forms/delete_method';
                $result['doc_id'] = $doc_id;
                $result['title'] = $val;
                $data = array(
                    'component' => 'Delete Method',
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            case 'delete-section':
                $ajax = true;
                $document = new Document_Template_Model();
                $doc_id = $_REQUEST['documentId'];
                $val = $document->GetSectionsDetail($doc_id);
                $page = 'forms/delete_section';
                $result['doc_id'] = $doc_id;
                $result['section'] = $val;
                $data = array(
                    'component' => 'Delete Section',
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            case 'delete-elements':
                $ajax = true;
                $document = new Document_Template_Model();
                $doc_id = $_REQUEST['documentId'];
                $val = $document->GetElementsDetail($doc_id);
                $page = 'forms/delete_element_new';
                $result['doc_id'] = $doc_id;
                $result['element'] = $val;
                $data = array(
                    'component' => 'Delete Element',
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            case 'update-layout':
                $ajax = true;
                $document = new Document_Template_Model();
                $doc_id = $_REQUEST['documentId'];
                $val = $document->GetLayoutDetail($doc_id);
                $page = 'forms/update';
                $result['layout'] = $val;
                $result['doc_id'] = $doc_id;
                $data = array(
                    'component' => 'Change Layout',
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data);
                break;
            case 'add-attributes':
                $ajax = true;
                $values = $this->form_array($_REQUEST['values']);
                $layout = array(
                    'design' => $values['selected_pattern'],
                    'no_of_columns' => $values['multiplecols']
                );
                $document = new Document_Template_Model;
                $sections = $document->ReadDocumentSectionGroup($values['doc_id']);
                $newsection = array();
                foreach ($sections as $section):
                    $data = array(
                        'section_code' => $section['section_code'],
                        'section_desc' => $section['section_desc'],
                        'layout' => json_encode($layout, true));
                    $document->UpdateSectionDetail($data);
                    $newdata = array(
                        'json_section' => $section['json_section'],
                        'section_sorting' => $section['section_sorting'],
                        'section_code' => $section['section_code'],
                        'section_desc' => $section['section_desc'],
                        'elements' => $this->GetDocumentSectionElement($values['doc_id'], $section['section_code']),
//                         'elements' =>  $section['elements'],
                        'layout' => $layout);
                    $newsection[$section['json_section']] = $newdata;
                endforeach;
                $this->CreateJSONForm($values['doc_id'], $newsection, 'update');
                break;
            case 'edit-layout':
                $ajax = true;
                $values = $this->form_array($_REQUEST['values']);
                $document = new Document_Template_Model();
                $docId = $values['doc_id'];
                $layout = $values['selected_column'];
                $sec_id = $document->GetSectionId($docId);
                foreach ($sec_id as $key):
                    $document->UpdateDocLayout($key['section_code'], $layout);
                    echo $key['section_code'] . "<br>";
                endforeach;
                $this->GenerateJSONFormat($docId, 'update');
                break;
            case 'edit-title':
                $ajax = true;
                $values = $this->form_array($_REQUEST['values']);
                $document = new Document_Template_Model();
                $docId = $values['doc_id'];
                $title = $values['selected_title'];
                $title_id = $document->GetTitleId($docId);
                foreach ($title_id as $key):
                    $document->UpdateDocTitle($key['doc_name_id'], $title);
                    echo $key['doc_name_id'] . "<br>";
                endforeach;
                $this->GenerateJSONFormat($docId, 'update');
                break;
            //22OCT19
            case 'edit-method':
                $ajax = true;
                $values = $this->form_array($_REQUEST['values']);
                $document = new Document_Template_Model();
                $docId = $values['doc_id'];
                $title = $values['method_descs'];
                $info = $values['json_method'];
                $method_id = $document->GetMethodId($docId);
                foreach ($method_id as $key):
                    $document->UpdateMethodInfo($key['doc_method_code'], ucwords($title) , $info);
                    echo $key['doc_method_code'] . "<br>";
                endforeach;
                $this->GenerateJSONFormat($docId, 'update');
                break;
            case 'edit-section':
                $ajax = true;
                $values = $this->form_array($_REQUEST['values']);
                $document = new Document_Template_Model();
                $docId = $values['doc_id'];
                $title = $values['section_descs'];
                $info = $values['json_section'];
                $section_id = $document->GetSectionsId($docId);
                foreach ($section_id as $key):
                    $document->UpdateSectionInfo($key['section_code'], $title , $info);
                    echo $key['section_code'] . "<br>";
                endforeach;
                $this->GenerateJSONFormat($docId, 'update');
                break;
            case 'edit-element':
                $ajax = true;
                $values = $this->form_array($_REQUEST['values']);
                $document = new Document_Template_Model();
                $docId = $values['doc_id'];
                $title = $values['element_descs'];
                $info = $values['json_element'];
                $element_id = $document->GetElementId($docId);
                foreach ($element_id as $key):
                    $document->UpdateElementInfo($key['element_code'], $title, $info);
                    echo $key['element_code'] . "<br>";
                endforeach;
                $this->GenerateJSONFormat($docId, 'update');
                break;
            case 'copy-form':
                $ajax = true;
                $document = new Document_Template_Model();
                $values = $this->form_array($_REQUEST['values']);
                $curName = $_REQUEST['docId'];
                $docName = $values['doc_name_desc'];
                $subdis = $values['general_discipline'];
                $type = $values['doc_type'];
                $group = $values['doc_group'];
                $copyForm = $document->copyBaru($docName, $curName, $subdis, $type, $group);
                break;
            //zarith-8/3 
            case 'add-title':
                $ajax = true;
                $document = new Document_Template_Model();
                $values = $this->form_array($_REQUEST['values']);
                $page = 'forms/list_of_document';
//                $dis = $values['discipline'];
                $subDis = $values['general_discipline'];
                $docType = $values['doc_type'];
                $docGroup = $values['doc_group'];
                $titleDesc = $values['doc_name_desc'];
                $docForm = $document->InsertDocId($subDis, $docGroup, $docType, strtoupper($titleDesc));
//                print_r($docForm);
                break;
            //19JULAI
//            case 'create-section':
//                $ajax = true;
//                $document = new Document_Template_Model();
//                $values = $this->form_array($_REQUEST['values']);
//                $page = 'forms/new_section';
//                $layout = $values['layout'];
//                $secDesc = $values['section_desc'];
//                $secForm = $document->InsertSecId($layout, $secDesc);
//                print_r($secForm);
//                break;
            case 'create-method':
                $ajax = true;
                $document = new Document_Template_Model();
                $page = 'forms/new_method';
                $json = file_get_contents('php://input');
                $array = explode('values=', urldecode($json));
                $data = json_decode($array[1], true);

                $new_data = array();
                foreach ($data as $datas):
                    $new_data[$datas['name']] = $datas['value'];
                endforeach;



                foreach ($new_data as $key => $value):
                    $new_key = preg_replace("/[0-9]+/", "", $key);
                    if ($new_key == 'method_desc'):
                        $method_desc = $value;
                    elseif ($new_key == 'method_info'):
                        $method_info = $value;

////                    
                        $output = array(
                            'method_desc' => $method_desc,
                            'method_info' => $method_info,
                        );
                        $document->InsertMethodId($output);


                    endif;
                endforeach;
                break;


            case 'create-section':
                $ajax = true;
                $document = new Document_Template_Model();
                $page = 'forms/new_section';
                $json = file_get_contents('php://input');
                $array = explode('values=', urldecode($json));
                $data = json_decode($array[1], true);

                $new_data = array();
                foreach ($data as $datas):
                    $new_data[$datas['name']] = $datas['value'];
                endforeach;



                foreach ($new_data as $key => $value):
                    $new_key = preg_replace("/[0-9]+/", "", $key);
                    if ($new_key == 'section_desc'):
                        $section_desc = $value;
                    elseif ($new_key == 'json_desc'):
                        $json_desc = $value;
                    elseif ($new_key == 'layout'):
                        $layout = $value;

////                    
                        $output = array(
                            'section_desc' => $section_desc,
                            'json_section' => $json_desc,
                            'layout' => $layout
                        );
                        $document->InsertSecId($output);


                    endif;
                endforeach;
                break;
            //23JULAI
//            case 'create-element':
//                $ajax = true;
//                $document = new Document_Template_Model();
//                $values = $this->form_array($_REQUEST['values']);
//                $page = 'forms/new_element';
//                $elementDesc = $values['element_desc'];
//                $elementForm = $document->InsertElementId($elementDesc);
////                print_r($elementForm);
//                break;
            case 'create-element':
                $ajax = true;
                $document = new Document_Template_Model();
                $page = 'forms/new_element';
                $json = file_get_contents('php://input');
                $array = explode('values=', urldecode($json));
                $data = json_decode($array[1], true);

                $new_data = array();
                foreach ($data as $datas):
                    $new_data[$datas['name']] = $datas['value'];
                endforeach;

                foreach ($new_data as $key => $value):
                    $new_key = preg_replace("/[0-9]+/", "", $key);
                    if ($new_key == 'element_desc'):
                        $element_desc = $value;
                    elseif ($new_key == 'json_desc'):
                        $json_desc = $value;

                        $output = array(
                            'element_desc' => $element_desc,
                            'json_element' => $json_desc
                        );
                        $document->InsertElementId($output);
                    endif;
                endforeach;
                break;
            case 'delete-current-element':
                $ajax = true;
                $values = $this->form_array($_REQUEST['values']);
                $document = new Document_Template_Model();
                $docId = $values['doc_id'];
                $elementCode = $values['element_id'];
                $sectionCode = $values['section_id'];
                $document->DeleteElementData($docId, $sectionCode, $elementCode);
                $this->GenerateJSONFormat($docId, 'update');
                break;
            case 'delete-current-document':
                $ajax = true;
                $values = $this->form_array($_REQUEST['values']);
                $document = new Document_Template_Model();
                $docId = $values['doc_id'];
                $document->DeleteDocumentData($docId);
                $this->GenerateJSONFormat($docId, 'update');
                break;
            case 'delete-current-method':
                $ajax = true;
                $values = $this->form_array($_REQUEST['values']);
                $document = new Document_Template_Model();
                $docId = $values['doc_id'];
                $document->DeleteMethodData($docId);
                $this->GenerateJSONFormat($docId, 'update');
                break;
            case 'delete-current-section':
                $ajax = true;
                $values = $this->form_array($_REQUEST['values']);
                $document = new Document_Template_Model();
                $docId = $values['doc_id'];
                $document->DeleteSectionData($docId);
                $this->GenerateJSONFormat($docId, 'update');
                break;
            case 'delete-new-element':
                $ajax = true;
                $values = $this->form_array($_REQUEST['values']);
                $document = new Document_Template_Model();
                $docId = $values['doc_id'];
                $document->DeleteElementsData($docId);
                $this->GenerateJSONFormat($docId, 'update');
                break;
            case 'testing':
                $page = 'forms/test';
                $result['link_style'] = "<link href='" . SITE_ASSET . "assets/css/hiskkm.css' rel='stylesheet' />";
                break;
            case 'update-attributes':
                $ajax = true;
                $document = new Document_Template_Model();
                $docId = $_REQUEST['docId'];
                $x = 1;
                foreach ($_REQUEST['section'] AS $key => $item):
                    $sorting = $x;
                    $data = array(
                        'section_code' => $item,
                        'section_sorting' => $sorting,
                        'doc_name_id' => $docId);
                    $x++;
                    $document->UpdateSectionSorting($data);
                endforeach;
                break;
            case 'update-attributes2':
                $ajax = true;
                $document = new Document_Template_Model();

                $json = file_get_contents('php://input');
                $json_a = explode('data_array=', urldecode($json));
                $data = json_decode($json_a[1], true);

                foreach ($data as $item):
                    if (isset($item['docId'])):
                        $docId = $item['docId'];
                    endif;
                endforeach;

                $result = array();
                foreach ($data as $value):
                    if (isset($value['section'], $value['element'])):
                        $result[$value['section']][][$value['element']] = $value['current'];
                    endif;
                endforeach;

                $output = array();
                foreach ($result as $section => $values):
                    foreach ($values as $sort => $current):
                        foreach ($current as $element => $value):
                            $x = $sort + 1;
                            $output = array(
                                'section_code' => $section,
                                'element_code' => $element,
                                'doc_name_id' => $docId,
                                'current' => $value,
                                'sorting' => $x);
                            $document->UpdateElementSorting($output);
                        endforeach;
                    endforeach;
                endforeach;

                break;
            //EDIT SECTION NAME
            case 'edit-attributes':
                $ajax = true;
                $document = new Document_Template_Model();
                $section = $_REQUEST['section'];
                $section_code = $_REQUEST['section_code'];
                $docId = $_REQUEST['doc_name_id'];
                $document->UpdateSectionDetail($section, $section_code, $docId);
                break;
            //EDIT ELEMENT NAME
            case 'update-section-element':
                $ajax = true;
                $json = file_get_contents('php://input');
                $array = explode('&', urldecode($json));
                $new_data = array();
                foreach ($array as $a):
                    $ex = explode('=', $a);
                    $new_data[$ex[0]] = $ex[1];
                endforeach;

                $mapper_data = json_decode($new_data['values'], true); //dri basic->ajax_element_form_group
                $new_mapper = $this->mapper($mapper_data);

                $document_id = $new_mapper['documentId'];
                $element_code = $new_mapper['elementCode'];
                $element_name = $new_mapper['new_element'];
                $element_properties = $new_mapper['element_properties'];

                if ($element_properties == 'DECORATION') {
                    $this->CaseDecoration($new_mapper, $new_data);
                } elseif ($element_properties == 'BASIC') {
                    $this->CaseBasic($new_mapper, $new_data);
                } else {
                    $this->CaseSubsection($new_mapper, $new_data);
                }

                //update element_desc
                $document = new Document_Template_Model();
                $document->UpdateElementName($element_code, $element_name, $document_id);
                $this->GenerateJSONFormat($document_id, 'update');
                break;
            case 'update-section-element-new':
                $ajax = true;
                $json = file_get_contents('php://input');
                $array = explode('&', urldecode($json));
                $new_data = array();
                foreach ($array as $a):
                    $ex = explode('=', $a);
                    $new_data[$ex[0]] = $ex[1];
                endforeach;

                $mapper_data = json_decode($new_data['values'], true); //dri basic->ajax_element_form_group
                $new_mapper = $this->mapper($mapper_data);

                $document_id = $new_mapper['document_id'];
                $element_code = $new_mapper['element_code'];
                $element_name = $new_mapper['new_element'];
                $element_properties = str_replace('_NEW', '', $new_mapper['element_properties']);

                if ($element_properties == 'DECORATION') {
                    $this->CaseDecorationNew($new_mapper, $new_data);
                } elseif ($element_properties == 'BASIC') {
                    $this->CaseBasicNew($new_mapper, $new_data);
                } else {
                    $this->CaseSubsectionNew($new_mapper, $new_data);
                }
                $document = new Document_Template_Model();
                $document->UpdateElementName($element_code, $element_name, $document_id);
                $this->GenerateJSONFormat($document_id, 'update');
                break;
            case 'update-new-form':
                $document = new Document_Template_Model();
                $ajax = true;
                $json = file_get_contents('php://input');
                $array = explode('&', urldecode($json));
                $new_data = array();
                foreach ($array as $a):
                    $ex = explode('=', $a);
                    $new_data[$ex[0]] = $ex[1];
                endforeach;

                #documentDesc
                $documentD = json_decode($new_data['docDetail'], true); //dri basic->ajax_element_form_group
                $resultD = (object) $this->mapper($documentD);
                print_r($resultD);

                #sectionDesc
                $section = json_decode($new_data['secDetail'], true); //dri basic->ajax_element_form_group
                $resultS = $this->mapper($section);

                #elementDesc
                $element = json_decode($new_data['elemDetail'], true); //dri basic->ajax_element_form_group
                $resultE = $this->mapper($element);
                
                $x = 1;
                $y = 1;
                if ($resultS):
                    foreach ($resultS as $keyS => $valueS):
                        foreach ($resultE as $keyE => $valueE):
                            $filteredNumbers = array_filter(preg_split("/\D+/", $keyE));
                            $firstOccurence = reset($filteredNumbers);
                            if ($firstOccurence == $x):
                                $outputS = array(
                                    'section_sorting' => $x, //1
                                    'section_code' => $valueS, //additional test
                                    'parent_element_code' => $valueE, //discharge
                                    'sorting' => $y, //1
                                    'doc_name_id' => $resultD->doc_name_desc //diet note 11
                                );
                                $y++;
//                            echo '<pre>';
//                            print_r($outputS);
//                            echo '</pre>';
                                $document->InsertNewForm($outputS);
                            endif;
                        endforeach;
                        $y = 1;
                        $x++;
                    endforeach;
                endif;

                break;
                
            default:
                $result['link_style'] = "<link href='localhost/FORMjson/assets/library/summernote/' rel='stylesheet' />";
                $result['form_element'] = $this->SessionCall('form_element');
                $result['json_form'] = json_encode($this->SessionCall('form_element'));
                break;
        endswitch;

        if (!$ajax):
            $result['header'] = $this->RenderOutput('common/main', isset($result['link_style']) ? $result['link_style'] : false);
            $result['footer'] = $this->RenderOutput('common/footer');
            $result['config'] = $this->RenderOutput('common/header', isset($result['link_style']) ? $result['link_style'] : false);
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

    private function GetExistedDocumentTemplate() {
        $document = new Document_Template_Model();
        $templates = $document->GetExistedDocumentJSONTemplate();
        $documentId = array();
        foreach ($templates as $template):
            $documentId[] = $template['doc_name_id'];
        endforeach;
        return $documentId;
    }

    private function CompareExistedJSON() {
        $documentElementOnly = $this->GetAvailableDocumentWithElement();
//         $documentTemplate = $this->GetExistedDocumentTemplate();
//         print_r($documentTemplate);
//         $test = array_diff($documentElementOnly, $documentTemplate);
//         $mergeDocument = array_merge($documentElementOnly,$documentTemplate);
        return $documentElementOnly;
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
//        return true;
//    }
//    $result = array();
//            $out = array();
//            foreach($basic as $key=>$value):
//                $filteredNumbers = array_filter(preg_split("/\D+/", $key));
//                $firstOccurence = reset($filteredNumbers);
//                if($firstOccurence):
//                    $hyphen = substr_count($key, '-');
//                    if($hyphen == 0 || $hyphen == 1):
//                        $result[$firstOccurence][$key] = $value;
//                    else:
//                        substr_count($key,'SortChild')
//                        $result[$firstOccurence]['childElement'][$key] = $value;
//                    endif;
//                endif;
//            endforeach; 
    //12MAC
    private function YJSON(array $data) {

        $result = array();
        foreach ($data as $key => $value):
            $numberOnly = preg_replace("/[^0-9-]/i", '', $key);
            $filteredNumbers = array_filter(preg_split("/\D+/", $key));
            $firstOccurence = reset($filteredNumbers);
            if ($firstOccurence):
                $hyphen = substr_count($key, '-');
                if ($hyphen > 1):
                    $result[$firstOccurence][$key] = $value;
                    if ($key === 'multi_ans_desc1-1-1'):
                        $result[$firstOccurence]['ref'][$key] = $value;
                    endif;
                else:
                    $result[$firstOccurence][$key] = $value;
                endif;
            endif;
        endforeach;

        echo '<pre>';
        print_r(json_encode($result));
        echo '</pre>';
    }

    private function CaseDecoration(array $data) {
        $document = new Document_Template_Model();
        $docID = $data['documentId'];
        $elementID = $data['elementCode'];
        $sectionId = $data['section_code'];
        
        $document->CleanMultipleAnswer($data);
        $document->CleanMultipleItem($data);

        $val = array(
            'doc_name_id' => $docID,
            'element_code' => $elementID,
            'child_element_code' => $data['element_group'],
            'element_position' => $data['position'],
            'element_properties' => str_replace('_NEW', '', $data['element_properties']),
            'input_type' => 'LABEL',
            'element_level' => $data['element_level'],
            'section_code' => $sectionId
        );
        echo '<pre>';
        print_r($val);
        echo '</pre>';
        $document->UpdateElementToDecoSUb($val);
        return true;
    }

    private function CaseBasic(array $data, $new_data) {
        $document = new Document_Template_Model();
        $docID = $data['documentId'];
        $elementID = $data['elementCode'];
        $input_type = $data['input_type']; //method
        $sectionId = $data['section_code'];
        $dataType = '(NULL)';

        $document->CleanMultipleAnswer($data);
        $document->CleanMultipleItem($data);

        if ($input_type == 'METHOD') {

            $mapper_data = json_decode($new_data['basicMethod'], true); //dri basic->ajax_element_form_group
            $method = $this->mapper($mapper_data);
            $methodCode = $method['methodList'];
        } else if ($input_type == 'MULTIPLE ANSWER') {

            $methodCode = '(NULL)';
            $mapper_data = json_decode($new_data['basicMultAns'], true); //dri basic->ajax_element_form_group
            $basic = (object) $this->mapper($mapper_data);

            $this->CaseBasicParent($basic, $docID, $elementID);
            $this->CaseBasicChild($basic, $docID);
        } else {

            $methodCode = '(NULL)';
        }

        $val = array(
            'doc_name_id' => $docID,
            'element_code' => $elementID,
            'child_element_code' => $data['element_group'],
            'element_position' => $data['position'],
            'element_properties' => $data['element_properties'],
            'input_type' => $input_type,
            'element_level' => $data['element_level'],
            'data_type' => $dataType,
            'doc_method_code' => $methodCode,
            'section_code' => $sectionId
        );
        echo '<pre>';
        print_r($val);
        echo '</pre>';
        $document->UpdateElementToBasic($val);
        return true;
    }

    private function CaseBasicParent($basic, $docID, $elementID) {
        $document = new Document_Template_Model();

        #PARENT
        $array = array();

        foreach ($basic as $key => $value):

            if (strpos($key, 'SortParent') !== FALSE):
                $check = $value;
            else:
                if (strpos($key, 'show_label_child') !== FALSE):
                    $new_key = preg_replace('/-[^-]*$/', '', $key);
                    $array[$new_key] = $value;
                elseif (strpos($key, 'ref_desc') !== FALSE):
                    $new_key = preg_replace('/-[^-]*$/', '', $key);
                    $array[$new_key] = $value;
                endif;
            endif;

        endforeach;

        $result = (object) $array;

        for ($i = 1; $i <= $check; $i++):
            $multi = array(
                'doc_name_id' => $docID,
                'element_code' => $elementID,
                'multi_ans_code' => $basic->{"multi_ans_desc$i"},
                'multi_input_type' => $basic->{"multi_input_type$i"},
                'show_label' => $basic->{"show_label$i"},
                'sorting' => $i,
                'show_label_child' => isset($result->{"show_label_child$i"}) ? $result->{"show_label_child$i"} : "(NULL)",
                'ref_element_code' => isset($result->{"ref_desc$i"}) ? $result->{"ref_desc$i"} : "(NULL)"
            );
            echo '<pre>';
            print_r($multi);
            echo '</pre>';
            $document->InsertParentMultiAnswer($docID, $elementID, $multi);
        endfor;
    }

    private function CaseBasicChild($basic, $docID) {
        $document = new Document_Template_Model();

        #CHILD
        $output = array();
        $new_array = array();

        foreach ($basic as $keys => $values):

            $count = substr_count($keys, '-');
            if ($count > 0):
                if (strpos($keys, 'SortChild') !== FALSE):
                    $new_keys = preg_replace("/[^0-9-]/", "", $keys);
                    $x = $values;
                    $output[$new_keys] = $x;
                else:
                    if (strpos($keys, 'show_label_child') !== FALSE):
                        $Ckey = preg_replace('/-[^-]*$/', '', $keys);
                        $new_array[$Ckey] = $values;
                    elseif (strpos($keys, 'ref_desc') !== FALSE):
                        $Ckey = preg_replace('/-[^-]*$/', '', $keys);
                        $new_array[$Ckey] = $values;
                    endif;
                endif;
            endif;

        endforeach;

        $new_result = (object) $new_array;

        foreach ($output as $a => $b):
            for ($j = 1; $j <= $b; $j++):
                $child = array(
                    'doc_name_id' => $docID,
                    'element_code' => $basic->{"ref_desc$a"},
                    'multi_ans_code' => $basic->{"multi_child_ans_desc$a-$j"},
                    'multi_input_type' => $basic->{"multi_child_input_type$a-$j"},
                    'show_label' => $basic->{"show_label$a-$j"},
                    'sorting' => $j,
                    'show_label_child' => isset($new_result->{"show_label_child$a-$j"}) ? $new_result->{"show_label_child$a-$j"} : "(NULL)",
                    'ref_element_code' => isset($new_result->{"ref_desc$a-$j"}) ? $new_result->{"ref_desc$a-$j"} : "(NULL)"
                );
                echo '<pre>';
                print_r($child);
                echo '</pre>';
                $document->InsertChildMultiAnswer($docID, $child);
            endfor;
        endforeach;
    }

    private function CaseSubsection(array $data, $new_data) {
        $document = new Document_Template_Model();
        $docID = $data['documentId'];
        $elementID = $data['elementCode'];
        $sectionId = $data['section_code'];
        
        $document->CleanMultipleAnswer($data);
        $document->CleanMultipleItem($data);
        
        $val = array(
            'doc_name_id' => $docID,
            'element_code' => $elementID,
            'child_element_code' => $data['element_group'],
            'element_position' => $data['position'],
            'element_properties' => str_replace('_NEW', '', $data['element_properties']),
            'input_type' => 'LABEL',
            'element_level' => $data['element_level'],
            'section_code' => $sectionId
        );
        echo '<pre>';
        print_r($val);
        echo '</pre>';
        $document->UpdateElementToDecoSUb($val);
        return true;
    }
    
    private function CaseSubsectionNew(array $data, $new_data) {
        $document = new Document_Template_Model();
        $docID = $data['documentId'];
        $elementID = $data['elementCode'];
        $sectionId = $data['section_code'];
        
        $val = array(
            'doc_name_id' => $docID,
            'element_code' => $elementID,
            'child_element_code' => $data['element_group'],
            'element_position' => $data['position'],
            'element_properties' => str_replace('_NEW', '', $data['element_properties']),
            'input_type' => 'LABEL',
            'element_level' => $data['element_level'],
            'section_code' => $sectionId
        );
        echo '<pre>';
        print_r($val);
        echo '</pre>';
        $document->UpdateElementToDecoSUb($val);
        return true;
    }

    //zarith-12/3
    private function CaseDecorationNew(array $data) {
        $document = new Document_Template_Model();
        $docID = $data['documentId'];
        $elementID = $data['elementCode'];
        $sectionId = $data['section_code'];

        $val = array(
            'doc_name_id' => $docID,
            'element_code' => $elementID,
            'child_element_code' => $data['element_group'],
            'element_position' => $data['position'],
            'element_properties' => str_replace('_NEW', '', $data['element_properties']),
            'input_type' => 'LABEL',
            'element_level' => $data['element_level'],
            'section_code' => $sectionId
        );
        echo '<pre>';
        print_r($val);
        echo '</pre>';
        $document->UpdateElementToDecoSUb($val);
        return true;
    }

    private function CaseBasicNew(array $data, $new_data) {
        $document = new Document_Template_Model();
        $docID = $data['documentId'];
        $elementID = $data['elementCode'];
        $input_type = $data['input_type']; //method
        $sectionId = $data['section_code'];
        $dataType = '(NULL)';

        $document->CleanMultipleAnswer($data);
        $document->CleanMultipleItem($data);

        if ($input_type == 'METHOD') {

            $mapper_data = json_decode($new_data['basicMethod'], true); //dri basic->ajax_element_form_group
            $method = $this->mapper($mapper_data);
            $methodCode = $method['methodList'];
        } else if ($input_type == 'MULTIPLE ANSWER') {

            $methodCode = '(NULL)';
            $mapper_data = json_decode($new_data['basicMultAns'], true); //dri basic->ajax_element_form_group
            $basic = (object) $this->mapper($mapper_data);

            $this->CaseBasicParentNew($basic, $docID, $elementID);
            $this->CaseBasicChildNew($basic, $docID);
        } else {
            $methodCode = '(NULL)';
        }

        $val = array(
            'doc_name_id' => $docID,
            'element_code' => $elementID,
            'child_element_code' => $data['element_group'],
            'element_position' => $data['position'],
            'element_properties' => str_replace('_NEW', '', $data['element_properties']),
            'input_type' => $input_type,
            'element_level' => $data['element_level'],
            'data_type' => $dataType,
            'doc_method_code' => $methodCode,
            'section_code' => $sectionId
        );
        echo '<pre>';
        print_r($val);
        echo '</pre>';
        $document->UpdateElementToBasic($val);
        return true;
    }

    private function CaseBasicParentNew($basic, $docID, $elementID) {
        $document = new Document_Template_Model();

        #PARENT
        $array = array();

        foreach ($basic as $key => $value):

            if (strpos($key, 'SortParent') !== FALSE):
                $check = $value;
            else:
                if (strpos($key, 'show_label_child') !== FALSE):
                    $new_key = preg_replace('/-[^-]*$/', '', $key);
                    $array[$new_key] = $value;
                elseif (strpos($key, 'ref_desc') !== FALSE):
                    $new_key = preg_replace('/-[^-]*$/', '', $key);
                    $array[$new_key] = $value;
                endif;
            endif;

        endforeach;

        $result = (object) $array;

        for ($i = 1; $i <= $check; $i++):
            $multi = array(
                'doc_name_id' => $docID,
                'element_code' => $elementID,
                'multi_ans_code' => $basic->{"multi_ans_desc$i"},
                'multi_input_type' => $basic->{"multi_input_type$i"},
                'show_label' => $basic->{"show_label$i"},
                'sorting' => $i,
                'show_label_child' => isset($result->{"show_label_child$i"}) ? $result->{"show_label_child$i"} : "(NULL)",
                'ref_element_code' => isset($result->{"ref_desc$i"}) ? $result->{"ref_desc$i"} : "(NULL)"
            );
            echo '<pre>';
            print_r($multi);
            echo '</pre>';
            $document->InsertParentMultiAnswer($docID, $elementID, $multi);
        endfor;
    }

    private function CaseBasicChildNew($basic, $docID) {
        $document = new Document_Template_Model();

        #CHILD
        $output = array();
        $new_array = array();

        foreach ($basic as $keys => $values):

            $count = substr_count($keys, '-');
            if ($count > 0):
                if (strpos($keys, 'SortChild') !== FALSE):
                    $new_keys = preg_replace("/[^0-9-]/", "", $keys);
                    $x = $values;
                    $output[$new_keys] = $x;
                else:
                    if (strpos($keys, 'show_label_child') !== FALSE):
                        $Ckey = preg_replace('/-[^-]*$/', '', $keys);
                        $new_array[$Ckey] = $values;
                    elseif (strpos($keys, 'ref_desc') !== FALSE):
                        $Ckey = preg_replace('/-[^-]*$/', '', $keys);
                        $new_array[$Ckey] = $values;
                    endif;
                endif;
            endif;

        endforeach;

        $new_result = (object) $new_array;

        foreach ($output as $a => $b):
            for ($j = 1; $j <= $b; $j++):
                $child = array(
                    'doc_name_id' => $docID,
                    'element_code' => $basic->{"ref_desc$a"},
                    'multi_ans_code' => $basic->{"multi_child_ans_desc$a-$j"},
                    'multi_input_type' => $basic->{"multi_child_input_type$a-$j"},
                    'show_label' => $basic->{"show_label$a-$j"},
                    'sorting' => $j,
                    'show_label_child' => isset($new_result->{"show_label_child$a-$j"}) ? $new_result->{"show_label_child$a-$j"} : "(NULL)",
                    'ref_element_code' => isset($new_result->{"ref_desc$a-$j"}) ? $new_result->{"ref_desc$a-$j"} : "(NULL)"
                );
                echo '<pre>';
                print_r($child);
                echo '</pre>';
                $document->InsertChildMultiAnswer($docID, $child);
            endfor;
        endforeach;
    }

}
