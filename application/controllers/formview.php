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
                
                $sectionSorting = json_decode($documentTemplate['json_template']);
                $cleanSorting = $this->JsonWithSectionSorting($sectionSorting);
                
                $result['document_title'] = $documentTemplate['doc_name_desc'];
                $result['json_elements'] = $cleanSorting;
                $result['document_id'] = $documentTemplate['doc_name_id'];
                $result['template_id'] = $documentTemplate['template_id'];
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
                break;
            case 'form-template':
                $page = 'forms/document_view';
                $documentId = $params[URL_ARRAY + 3];
                $documentData = new Document_Template_Model();
                $documentTemplate = $documentData->ReadDocumentTemplate($documentId);
                $sectionSorting = json_decode($documentTemplate['json_template']);
                $cleanSorting = $this->JsonWithSectionSorting($sectionSorting);
                $result['document_title'] = $documentTemplate['doc_name_desc'];
                $result['main_discipline'] = $documentTemplate['main_discipline_name'];
                $result['sub_discipline'] = $documentTemplate['discipline_name'];
                $result['json_elements'] = $cleanSorting;
                $result['template_id']=$documentId;
                $result['rrr'] = 'pppp';
                $result['document_id'] = $documentTemplate['doc_name_id'];
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
                    $doc_id = $_REQUEST['documentId'];
                    $found = $document->GetElementDetail($key,$doc_id);
                    $section_id = $_REQUEST['sectionId'];
                    $grouping = $document->GetElementGrouping($section_id,$doc_id);
                    $page = 'forms/ajax_element_form_group';
                    $title = $found->element_desc;
                    $result['grouping'] = $grouping;
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
            case 'new-doc-element' :
                $ajax = true;
                $page = 'forms/add_new_document';
                $result['section_no'] = $_REQUEST['sectionNo'];
                $data = array(
                    'component' => 'Add Element',
                    'html' => $this->RenderOutput($page, $result));
                echo json_encode($data); 
                break;             
            case 'add-element':
                $ajax = true;
                $page = 'forms/add_element';
                $doc_id = $_REQUEST['documentId'];
                $section_id = $_REQUEST['sectionId'];
                $template_id = $_REQUEST['templateId'];
                $document = new Document_Template_Model();
                $section_sorting = $document->GetSectionSorting($section_id,$doc_id);
                $grouping = $document->GetElementGrouping($section_id,$doc_id);
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
                $last_element_sorting = $document->GetElementSorting($section_code,$document_id);
                $new_element_sorting = $last_element_sorting->newsorting + 1;  //wan is column name
                $ele = $document->GetMaxElementCode();
                $element_code = ($ele->maxcode)+1;
                if($values['element_group']==='-1'){
                    $level = 1;
                    $grouping = $element_code;
                }else{
                    $level = 2;
                    $grouping = $values['element_group'];
                }
                $data = array('documentId' => $document_id,
                              'elementCode' => $element_code,
                              'element_group' => $grouping,
                              'position' => $values['position'],
                              'element_properties' => $values['element_properties']);
                $document->InsertNewRefElement($element_desc,$element_code,$json_element,$grouping,$new_element_sorting,$level,$values);
                if($element_properties=='DECORATION'){
                    $data['setparent'] = $values['setparent'];
                    $data['deco_style'] = $values['deco_style'];
                    $data['deco_custom_style'] = $values['deco_custom_style'];
                    $this->CaseDecoration($data);
                    }
                elseif($element_properties=='BASIC'){
                    $data['input_type'] = $values['input_type'];
                    $this->CaseBasic($data);
                }
                elseif($element_properties=='METHOD'){
                    $data['method_name'] = $values['method_name'];
                    $data['method_params'] = $values['method_params'];
                    $this->CaseMethod($data);    
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
            $ajax=true;
            $values= $this->form_array($_REQUEST['values']);           
            $layout = array(
                'design'=>$values['selected_pattern'],
                'no_of_columns'=>$values['multiplecols']               
            );
             $document = new Document_Template_Model;
             $sections = $document->ReadDocumentSectionGroup($values['doc_id']);
             $newsection = array();           
             foreach ($sections as $section):
                    $data = array(
                        'section_code' => $section['section_code'],
                        'section_desc' => $section['section_desc'],
                        'layout' => json_encode($layout,true));
                    $document->UpdateSectionDetail($data);   
                    $newdata = array(
                        'json_section' => $section['json_section'],
                        'section_sorting' => $section['section_sorting'],
                        'section_code' => $section['section_code'],
                        'section_desc' => $section['section_desc'],
                        'elements' =>  $this->GetDocumentSectionElement($values['doc_id'], $section['section_code']),
//                         'elements' =>  $section['elements'],
                        'layout' => $layout);
                 $newsection[$section['json_section']]=$newdata;
            endforeach;
          //  print_r($newsection);
            $this->CreateJSONForm($values['doc_id'],$newsection, 'update');
            break;
            case 'edit-layout':
                $ajax = true;
                $values = $this->form_array($_REQUEST['values']);
                $document = new Document_Template_Model();
                $docId = $values['doc_id'];
                $layout = $values['selected_column'];               
                $sec_id = $document->GetSectionId($docId);
                foreach($sec_id as $key):
                    $document->UpdateDocLayout($key['section_code'],$layout);
                    echo $key['section_code']."<br>";
                endforeach;
                $this->GenerateJSONFormat($docId, 'update');
                break;
            case 'delete-element':
                $ajax = true;
                $docId = $_REQUEST['documentId'];
                $elementCode = $_REQUEST['elementId'];
                $sectionCode = $_REQUEST['sectionCode'];
                $document = new Document_Template_Model();
                $document->DeleteElementData($docId,$sectionCode,$elementCode);
                $this->GenerateJSONFormat($docId, 'update');
                //echo "doc-".$docId."<br>element-".$elementCode."<br>section".$sectionCode ;
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
                    'section_desc' => $values['section_desc'],
                    'layout' => $values['column']);
                $document->UpdateSectionDetail($data);
                $this->GenerateJSONFormat($values['document_id'], 'update');
                break;         
            case 'update-section-element':
                $ajax=true;
                $values = $this->form_array($_REQUEST['values']);
                echo '<pre>';
                print_r($values);
                echo '</pre>';
                $document_id = $values['documentId'];
                $element_code = $values['elementCode'];
                $element_name = $values['element_desc'];
                $element_properties = $values['element_properties'];
                if($element_properties=='DECORATION'){
                    $this->CaseDecoration($values);}
                elseif($element_properties=='BASIC'){
                    $this->CaseBasic($values);}
                elseif($element_properties=='METHOD'){
                    $this->CaseMethod($values);}
                $document = new Document_Template_Model();
                $document->UpdateElementName($element_code,$element_name);
                $this->GenerateJSONFormat($document_id, 'update');
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
            $documentId[] = $template;
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
    private function CaseDecoration(array $data){
        $document = new Document_Template_Model();
        $docID = $data['documentId'];
        $elementID = $data['elementCode'];
        $var1=$data['deco_style'];
        $var2=$data['deco_custom_style'];
        $deco_style= array('deco_style'=>$var1,'deco_custom_style'=>$var2);
        $additional_attr = json_encode($deco_style);
        $val = array (
            'doc_id' => $data['documentId'],
            'element_code' => $data['elementCode'],
            'element_group' => $data['element_group'],
            'element_position' => $data['position'],
            'element_properties' => $data['element_properties'],
            'input_type' => 'LABEL',
            'data_type' => $data['setparent'],
            'method' => '',
            'json' => $additional_attr
        );
        $childId = $document->GetChildDetail($docID,$elementID);
        foreach ($childId as $key){
            $document->CleanChild($docID, $key['parent_element_code']);
        }
        $document->CleanMultipleAnswer($data);
        $document->UpdateElementDetails($val);
        return true;
    }
    
    private function CaseBasic(array $data){
        $document = new Document_Template_Model();
        $docID = $data['documentId'];
        $elementID = $data['elementCode'];
        $data_type = '';
        $additional_attr = 'null';
        $input_type = $data['input_type'];
        $childId = $document->GetChildDetail($docID,$elementID);
        foreach ($childId as $key){
            $document->CleanChild($docID, $key['parent_element_code']);
        }
        $document->CleanMultipleAnswer($data);
        if($input_type=='FREETEXT'){
            $data_type = 'TEXT';}
          elseif ($input_type=='MULTIPLE ANSWER') {
                $basic = $this->form_array($_REQUEST['basic']);
                $data_type = 'REFERENCE';
                $z=1;
                for($x=1;$x<=$basic['total'];$x++){                    
                    $check = "validation".$x."";
                    if($basic[$check]==='parentonly'){
                    $set = "multi_ans_desc".$x."";
                    if($basic[$set]){
                    $label = $basic[$set];                 
                    $sorting = $z;                
                    $set = "multi_input_type".$x."";
                    $input = $basic[$set];                     
                    $document->InsertParentMultiAnswer($docID,$elementID,$label,$sorting,$input);
                    $z++;
                    }              
                    }elseif($basic[$check]==='childexist'){
                        $nextcode = "-".$elementID."".$x."";
                        $ct = "childtotal".$x."";
                        $z=1;
                    for($y=1;$y<=$basic[$ct];$y++){
                       $child = "child_multi_ans_desc".$x."".$y."";
                       if($basic[$child]){
                       $childlabel = $basic[$child];
                       $sort = $z;
                       $child = "child_multi_input_type".$x."".$y."";
                       $childtype = $basic[$child];
                       $document ->InsertChild($docID,$nextcode,$childlabel,$sort,$childtype);
                       $z++;
                       }
                    }
                     $set = "multi_ans_desc".$x."";
                     $label = $basic[$set];                 
                     $sorting = $x;                
                     $set = "multi_input_type".$x."";
                     $input = $basic[$set];                     
                     $document->InsertMultiAnswer($docID,$elementID,$label,$sorting,$input,$nextcode);     
                    }}                          
                }
            elseif ($input_type=='ROW') {
               $data_type = '';
               $rowinput = $this->form_array($_REQUEST['rowinput']);
                echo '<pre>';
                print_r($rowinput);
                echo '</pre>';
                $row_info = array();
                for($x=1;$x <=5;$x++){
                    $row_name = 'row_desc'.$x;
                    $row_type = 'row_type'.$x;
                    if($rowinput[$row_name]){
                        $row_desc = $rowinput[$row_name];
                        $row_typ = $rowinput[$row_type];
                           $row_info['row'.$x] = array('row_desc'=>$row_desc,'row_type'=>$row_typ);                          
                    }
                }
                $additional_attr = json_encode($row_info);
            }
           $val = array (
            'doc_id' => $data['documentId'],
            'element_code' => $data['elementCode'],
            'element_group' => $data['element_group'],
            'element_position' => $data['position'],
            'element_properties' => $data['element_properties'],
            'input_type' => $input_type,
            'data_type' => $data_type,
            'method' => '',
            'additional_attribute' => $additional_attr
        );
        $document->UpdateElementToBasic($val);
        return true;
    }
    
    private function CaseMethod(array $data){
        $document = new Document_Template_Model();
        $docID = $data['documentId'];
        $elementID = $data['elementCode'];
        if(isset($data['method_params'])){
            $json = $data['method_params'];
        }else{
            $json = 'null';
        }
        $val = array (
            'doc_id' => $data['documentId'],
            'element_code' => $data['elementCode'],
            'element_group' => $data['element_group'],
            'element_position' => $data['position'],
            'element_properties' => $data['element_properties'],
            'input_type' => 'METHOD',
            'data_type' => '',
            'method' => $data['method_name'],
            'json' => $json
        );
        $childId = $document->GetChildDetail($docID,$elementID);
        foreach ($childId as $key){
            $document->CleanChild($docID, $key['parent_element_code']);
        }
        $document->CleanMultipleAnswer($data);
        $document->UpdateElementDetails($val);
        return true;
    }
}