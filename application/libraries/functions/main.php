<?php
function MethodCaller($formName, $methodName, $params = null) {
    $class = $formName . '_Method';
    $method = new $class;
    return $method->$methodName($params);
}

function ReferenceCaller($elementCode, $docNameId, $tree = 'parent') {
    $result = Reference_List_Controller::GetReferenceList($elementCode, $docNameId, $tree);
    $typeOfMultipleAnswer = $result[0]['input_type'];
    $output = array('type' => $typeOfMultipleAnswer, 'data' => $result,);
    return (object) $output;
}

function InputTypeCaller($element, $name, $documentTitle,$documentId,$layout=1) {
    $input = ucwords(strtolower($element->input_type));
    $inputType = str_replace(' ', '', $input);
    $elementDetail = array(
        'name' => $name,
        'label' => $element->element_desc,
        'additional_attribute' => $element->additional_attribute,
        'element_code' => $element->element_code,
        'method' => $element->method,
        'doc_method_code' => $element->doc_method_code,
        'json_element'=>$element->json_element,
        'show_label'=>$element->show_label,
        'section_tooltips'=>$element->section_tooltips,
        'element_tooltips'=>$element->element_tooltips,
        'element_hint'=>$element->element_hint,
        'sec_file_type_code'=>$element->sec_file_type_code,
        'file_type_code'=>$element->file_type_code,
        'image_name_id'=>$element->image_name_id,
        'mandatory_flag'=>$element->mandatory_flag,
        'document_title' => $documentTitle,
        'doc_name_id'=>$documentId,
        'layout' =>$layout,
        'element_properties' =>$element->element_properties
    );
    $methodName = $inputType;
    
    if($methodName!='Method'){
    $class = new Input_Type_Controller();
    $class->elementDetail = (object) $elementDetail;
    $methodCheck = $class->VerifyMethod($methodName);
    $result = ($methodCheck) ? $class->$methodName (): false;
    return $result;
       
   }else{    
        $html = '';
        $input =  ucwords(strtoupper($element->element_desc));
        $inputType=  str_replace('', '', $input);
        $class = new Input_Type_Controller();
        $methodName=$class->Method($element, $name, $documentTitle,$documentId,$layout=1);  
        switch ($inputType):
            case '':
                $html .= '<table class="methodcolumn" style="font-size:12px;">'.'<tr>'.'<td style="padding-left:4px; padding-bottom:5px; ">'.$methodName.'</td>'.'</tr>'.'</table>';
                return $html;
            default:
                $html .= '<table class="methodcolumn" style="font-size:12px;">'.'<col width="250px"/>'.'<tr>'.'<td style="padding-left:4px;  padding-bottom:5px; vertical-align:top;">'.'<b>'.$inputType.'</b>'.'</td>'.'<td style="padding-left:5px;  padding-bottom:5px;">'.$methodName.'</td>'.'</tr>'.'</table>';
                return $html; 
        endswitch;    
}}

function UpdateInput($element){
    $methodName = 'UpdateMultiAns';
    $class = new Input_Type_Controller();
    $class->elementDetail = (object) $element;
    $methodCheck = $class->VerifyMethod($methodName);
    $result = ($methodCheck) ? $class->$methodName (): false;
    return $result;
}

//14AUG
function UpdateMethod($element){
    $methodName = 'UpdateMethodInput';
    $class = new Input_Type_Controller();
    $class->elementDetail = (object) $element;
    $methodCheck = $class->VerifyMethod($methodName);
    $result = ($methodCheck) ? $class->$methodName (): false;
    return $result;
}

//16AUG
function ListMethod(){
    $methodName = 'ListMethodInput';
    $class = new Input_Type_Controller();
    $methodCheck = $class->VerifyMethod($methodName);
    $result = ($methodCheck) ? $class->$methodName (): false;
    return $result;
}

function ListMultipleAnswer(){
    $methodName = 'ListMultipleAnswerInput';
    $class = new Input_Type_Controller();
    $methodCheck = $class->VerifyMethod($methodName);
    $result = ($methodCheck) ? $class->$methodName (): false;
    return $result;
}

function ListMultiElementDesc(){
    $methodName = 'ListMultiDescInput';
    $class = new Input_Type_Controller();
    $methodCheck = $class->VerifyMethod($methodName);
    $result = ($methodCheck) ? $class->$methodName (): false;
    return $result;
}

function ListElementDesc(){
    $methodName = 'ListElementDesc';
    $class = new Input_Type_Controller();
    $methodCheck = $class->VerifyMethod($methodName);
    $result = ($methodCheck) ? $class->$methodName (): false;
    return $result;
}

function form_array($arrays) {
        $val = array();
        foreach ($arrays as $v):
            $val[$v['name']] = $v['value'];
        endforeach;
        return $val;
    }

function ColumnRender($data, $noOfColumn,$document_title, $document_id, $column){
    $builder = new Column_Render_Method();
    return $builder->panel_render($data, $noOfColumn,$document_title, $document_id, $column);
}


