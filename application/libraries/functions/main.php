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
        'json_element'=>$element->json_element,
        'document_title' => $documentTitle,
        'doc_name_id'=>$documentId,
        'layout' =>$layout
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
        $input =  ucwords(strtolower($element->element_desc));
        $inputType=  str_replace('', '', $input);
        $html .= '<table class="methodcolumn">'.'<col width="230px"/>'.'<tr>'.'<td>'.'<b>'.$inputType.'</b>'.'</td>'.'<td>'.$methodName.'</td>'.'</tr>'.'</table>';
        return $html;
}}

/*function InputTypeCaller2($element, $name) {
    $input = ucwords(strtolower($element->input_type));
    $inputType = str_replace(' ', '', $input);
    $elementDetail = array(
        'name' => $name,
        'label' => $element->element_desc,
        'additional_attribute' => $element->additional_attribute,
        'element_code' => $element->element_code,
        'method' => $element->method,
        'json_element'=>$element->json_element
    );
    $methodName = $inputType;
    $class = new Input_Type_Controller();
    $class->elementDetail = (object) $elementDetail;
    $methodCheck = $class->VerifyMethod($methodName);
    $result = ($methodCheck) ? $class->$methodName (): false;
    return $result;
}*/

function UpdateInput($element){
    $methodName = 'UpdateMultiAns';
    $class = new Input_Type_Controller();
    $class->elementDetail = (object) $element;
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
//    return $builder->panel_column2($data, $noOfColumn,$document_title, $document_id, $column);
    return $builder->panel_render($data, $noOfColumn,$document_title, $document_id, $column);
}
?>


