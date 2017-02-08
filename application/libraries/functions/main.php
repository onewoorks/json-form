<?php

function MethodCaller($formName, $methodName, $params = null) {
    $class = $formName . '_Method';
    $method = new $class;
    return $method->$methodName($params);
}

function ReferenceCaller($elementCode, $tree = 'parent') {
    $result = Reference_List_Controller::GetReferenceList($elementCode, $tree);
    $typeOfMultipleAnswer = $result[0]['input_type'];
    $output = array('type' => $typeOfMultipleAnswer, 'data' => $result,);
    return (object) $output;
}

function InputTypeCaller($element, $name, $documentTitle) {
    $input = ucwords(strtolower($element->input_type));
    $inputType = str_replace(' ', '', $input);
//    [method] => 
//    [sorting] => 19
//    [data_type] => DATETIME
//    [input_type] => CALENDER
//    [element_code] => 8084
//    [element_desc] => Date of 1st Booking
//    [json_element] => date_of_1st_booking
//    [element_properties] => BASIC
    $elementDetail = array(
        'name' => $name,
        'label' => $element->element_desc,
        'additional_attribute' => $element->additional_attribute,
        'element_code' => $element->element_code,
        'method' => $element->method,
        'json_element'=>$element->json_element,
        'document_title' => $documentTitle
    );
    $methodName = $inputType;
    $class = new Input_Type_Controller();
    $class->elementDetail = (object) $elementDetail;
    $methodCheck = $class->VerifyMethod($methodName);
    $result = ($methodCheck) ? $class->$methodName (): false;
    return $result;
}
