<?php

class Input_Type_Controller extends Common_Controller {

    public $elementDetail;
//    private $is_parent = true;
    public $is_multiple_textbox = 1;
    public $checkje = false;

    public function VerifyMethod($methodName) {
        $check = method_exists($this, $methodName);
        return $check;
    }

    public function Label() {
        $element = $this->elementDetail;
        $level = check_level($element->element_code, $element->doc_name_id, $element);
        #NEW ELEMENT
        if ($level):
            $element->{'element_level'} = $level->element_level;
        else:
            $element->{'element_level'} = '1';
        endif;

        $html = "";

        if ($element->element_properties === 'SUBSECTION'):
            $html .= "<div class='col-sm-12' style='margin-left:-32px'>";
            $html .= "<div class='panel-heading text-uppercase col-md-6' style='border: 1px solid #778899;outline-width: thin;background-color: #D3D3D3; color: black;margin-bottom:10px;'><b style='font-size:11.5px'><b>" . $element->label . "</b></div>";
            $html .= "</div>";
        else:
            $html .= "<div class='col-sm-12' style='margin-left:3px'>";
            $html .= "<b><label class='control-label col-md-12 text-uppercase' style='margin-left:" . $element->element_level . "0px'>" . $element->label . "</label></b>";
            $html .= "</div>";
        endif;

        return $html;
    }

    public function Richtext() {
        $element = $this->elementDetail;
        $level = check_level($element->element_code, $element->doc_name_id, $element);
        #NEW ELEMENT
        $element->{'element_level'} = $level->element_level;

        $html = "";

        $html .= "<div class='col-sm-12' style='margin-left:1px'>";
        $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
        if ($element->element_level == '1'):
            $html .= "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>";
        else:
            $html .= "<label class='control-label col-md-3 text-uppercase' style='font-weight:normal'>" . $element->label . "</label>";
        endif;
        $html .= "<div class='col-md-8' style='margin-left:-6px'>"
                . "<div class='summernote'></div>"
                . "</div>"
                . "</div>";
        $html .= "</div>";


        return $html;
    }

    public function Freetext() {
        $element = $this->elementDetail;
        
         $document = new Document_Template_Model();
         if (isset($element->element_code, $element->doc_name_id)):
         $icon = $document->checkShowHyperlink($element->element_code, $element->doc_name_id);
            if(isset($icon[0])):
                $images = $icon[0]['icon_path'];
                $code = $icon[0]['hyperlink_code'];
            endif;
         endif;
        
        $html = "";
        
        if ($element):
        $level = check_level($element->element_code, $element->doc_name_id, $element);
        #NEW ELEMENT
        $element->{'element_level'} = $level->element_level;
        
        if (isset($images)):
        $html .= "<div class='col-sm-12' style='margin-left:1px'>";
        $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
        if ($element->element_level == '1'):
            $html .= "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>";
        else:
            $html .= "<label class='control-label col-md-3 text-uppercase' style='font-weight:normal'>" . $element->label . "</label>";
        endif;
        $html .= "<div class='col-md-8' style='margin-left:8px'>"
                . "<textarea name='" . $element->name . "' class='form-control' style='height: 100px;width:700px'></textarea>"
                . "</div>"
                ."<div style='margin-top:1px'>"
                . "<img id=" . $code . " src='../../../" . $images . "' style='width:25px; height:25px'>"
                . "</div>"
                . "</div>";
        $html .= "</div>";
        else :
            $html .= "<div class='col-sm-12' style='margin-left:1px'>";
        $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
        if ($element->element_level == '1'):
            $html .= "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>";
        else:
            $html .= "<label class='control-label col-md-3 text-uppercase' style='font-weight:normal'>" . $element->label . "</label>";
        endif;
        $html .= "<div class='col-md-8' style='margin-left:8px'>"
                . "<textarea name='" . $element->name . "' class='form-control' style='height: 100px;width:700px'></textarea>"
                . "</div>"
                . "</div>";
        $html .= "</div>";

        endif;
       endif;
       
       return $html;
    }

    public function Textbox() {
        $element = $this->elementDetail;
        $level = check_level($element->element_code, $element->doc_name_id, $element);
        #NEW ELEMENT
        $element->{'element_level'} = $level->element_level;

        $html = "";

        $html .= "<div class='col-sm-12' style='margin-left:2px'>";
        $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
        if ($element->element_level == '1'):
            $html .= "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>";
        else:
            $html .= "<label class='control-label col-md-3 text-uppercase' style='font-weight:normal'>" . $element->label . "</label>";
        endif;
        $html .= "<div class='col-md-8' style='margin-left:7px'>"
                . "<input type ='text' class='form-control' style='width:450px'>"
                . "</div>"
                . "</div>";
        $html .= "</div>";

        return $html;
    }

    public function Date() {
        $element = $this->elementDetail;
        $level = check_level($element->element_code, $element->doc_name_id, $element);
        #NEW ELEMENT
        $element->{'element_level'} = $level->element_level;

        $html = "";

        $html .= "<div class='col-sm-12' style='margin-left:3px'>";
        $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
        if ($element->element_level == '1'):
            $html .= "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>";
        else:
            $html .= "<label class='control-label col-md-3 text-uppercase' style='font-weight:normal'>" . $element->label . "</label>";
        endif;
        $html .= "<div class='col-md-3' style='margin-left:6px'>"
                . "<div class='input-group'>"
                . "<input name='" . $element->name . "' type = 'text' class='form-control datepicker' />"
                . "<span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span>"
                . "</div>"
                . "</div>"
                . "</div>";
        $html .= "</div>";

        return $html;
    }

    public function Calender() {
        $element = $this->elementDetail;

        $level = check_level($element->element_code, $element->doc_name_id, $element);
        #NEW ELEMENT
        $element->{'element_level'} = $level->element_level;

        $html = "";

        $html .= "<div class='col-sm-12' style='margin-left:3px'>";
        $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
        if ($element->element_level == '1'):
            $html .= "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>";
        else:
            $html .= "<label class='control-label col-md-3 text-uppercase' style='font-weight:normal'>" . $element->label . "</label>";
        endif;
        $html .= "<div class='col-md-3' style='margin-left:6px'>"
                . "<div class='input-group'>"
                . "<input name='" . $element->name . "' class='form-control datetimepicker' />"
                . "<span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span>"
                . "</div>"
                . "</div>"
                . "</div>";
        $html .= "</div>";

        return $html;
    }

    public function Time() {
        $element = $this->elementDetail;
        $level = check_level($element->element_code, $element->doc_name_id, $element);
        #NEW ELEMENT
        $element->{'element_level'} = $level->element_level;

        $html = "";

        $html .= "<div class='col-sm-12' style='margin-left:3px'>";
        $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
        if ($element->element_level == '1'):
            $html .= "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>";
        else:
            $html .= "<label class='control-label col-md-3 text-uppercase' style='font-weight:normal'>" . $element->label . "</label>";
        endif;
        $html .= "<div class='col-md-3' style='margin-left:6px'>"
                . "<div class='input-group'>"
                . "<input name='" . $element->name . "' class='form-control' timepicker/>"
                . "<span class='input-group-addon'><i class='glyphicon glyphicon-time'></i></span>"
                . "</div>"
                . "</div>"
                . "</div>";
        $html .= "</div>";

        return $html;
    }

    public function Number() {
        $element = $this->elementDetail;
        $level = check_level($element->element_code, $element->doc_name_id, $element);
        #NEW ELEMENT
        $element->{'element_level'} = $level->element_level;

        $html = "";

        $html .= "<div class='col-sm-12' style='margin-left:3px'>";
        $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
        if ($element->element_level == '1'):
            $html .= "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>";
        else:
            $html .= "<label class='control-label col-md-3 text-uppercase' style='font-weight:normal'>" . $element->label . "</label>";
        endif;
        $html .= "<div class='col-md-4' style='margin-left:6px'>"
                . "<input type ='number' class='form-control'>"
                . "</div>"
                . "</div>";
        $html .= "</div>";

        return $html;
    }

    public function Numeric() {
        $element = $this->elementDetail;

        $result = $this->checkP($element->element_code, $element->doc_name_id);

        $level = check_level($element->element_code, $element->doc_name_id, $element);
        #NEW ELEMENT
        $element->{'element_level'} = $level->element_level;

        $html = "";

        $html .= "<div class='col-sm-12' style='margin-left:17px'>";
        $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
        if ($element->element_level == '1'):
            $html .= "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>";
        else:
            $html .= "<label class='control-label col-md-3 text-uppercase' style='font-weight:normal'>" . $element->label . "</label>";
        endif;

        if ($result->data):
            $html .= "<div class='col-md-2' style='margin-left:0px'>";
            $html .= "<div class='group' style='display: flex'>";
            foreach ($result->data as $ref):
                $html .= "<input type ='text' class='form-control' style='width:100px' />&nbsp<span style='margin-top: 5px;font-size:12px;margin-right:0px'>" . $ref['multiple_desc'] . "</span>&nbsp";
            endforeach;
            $html .= "</div>";
            $html .= "</div>";
        else:
            $html .= "<div class='col-md-1' style='margin-left:0px'>";
            $html .= "<input type ='text' class='form-control'>";
            $html .= "</div>";

        endif;
        $html .= "</div>";
        $html .= "</div>";

        return $html;
    }

    public function Alphanumeric() {
        $element = $this->elementDetail;
        $level = check_level($element->element_code, $element->doc_name_id, $element);
        #NEW ELEMENT
        $element->{'element_level'} = $level->element_level;

        $html = "";

        $html .= "<div class='col-sm-12' style='margin-left:17px'>";
        $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
        if ($element->element_level == '1'):
            $html .= "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>";
        else:
            $html .= "<label class='control-label col-md-3 text-uppercase' style='font-weight:normal'>" . $element->label . "</label>";
        endif;
        $html .= "<div class='col-md-4' style='margin-left:6px'>"
                . "<input type ='text' class='form-control'>"
                . "</div>"
                . "</div>";
        $html .= "</div>";

        return $html;
    }

    public function MultipleAnswer() {
        $element = $this->elementDetail;
        $level = check_level($element->element_code, $element->doc_name_id, $element);
        #NEW ELEMENT
        if ($level):
            $element->{'element_level'} = $level->element_level;
        else:
            $element->{'element_level'} = '1';
        endif;

        #CARI INPUT TYPE
        $result = ReferenceCaller($element->element_code, $element->doc_name_id);
        $input = ucwords(strtolower($result->type));
        $inputType = str_replace(' ', '', $input);

        $multipleAnswerData = array(
            'name' => '',
            'label' => $element->label,
            'element_code' => (isset($result->data['parent_element_code'])) ? $result->data['parent_element_code'] : $element->element_code,
            'listing' => $result->data,
            'json_element' => $element->json_element,
            'additional_attribute' => $element->additional_attribute,
            'doc_name_id' => $element->doc_name_id,
            'layout' => $element->layout,
            'element_level' => $element->element_level
        );

        if ($inputType !== 'Method') {
            $class = new Input_Type_Controller();
            $class->elementDetail = (object) $multipleAnswerData;
            $methodCheck = $class->VerifyMethod($inputType);
            $checking = ($methodCheck) ? $class->$inputType() : false;
            return $checking;
        } else {
            $inputType = 'MethodMulti';
            $class = new Input_Type_Controller();
            $class->elementDetail = (object) $multipleAnswerData;
            $methodCheck = $class->VerifyMethod($inputType);
            $checking = ($methodCheck) ? $class->$inputType() : false;
            return $checking;
        }
    }

    public function checkP($element_code, $doc_name_id) {
        $result = ReferenceCaller($element_code, $doc_name_id);

        return $result;
    }

    public function checkC($ref_element_code, $doc_name_id, $child_show_label, $child_element_desc) {

        $html = "";

        switch ($ref_element_code):
            case '9137':
                $html .= "<div class='form-group hidden' id='9137'>";
                if ($child_show_label !== '0'):
                    $html .= "<label class='control-label col-md-2 text-uppercase' style='font-weight:normal'>$child_element_desc</label>";
                endif;
                $html .= "<div class='col-sm-4'>";
                $html .= "<input type ='text' name = '9137' id = '9137' class='form-control' style ='margin-bottom:5px'>";
                $html .= "</div>";
                $html .= "</div>";
                break;
            case '9144':
                $html .= "<div class='form-group form-group-sm hidden' id = '9144'>";
                if ($child_show_label !== '0'):
                    $html .= "<label class='control-label col-md-3 text-uppercase'>$child_element_desc</label>";
                endif;
                $html .= "<div class='col-md-3' style='padding-left:30px'>"
                        . "<div class='input-group'>"
                        . "<input class='form-control datetimepicker' />"
                        . "<span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span>"
                        . "</div>"
                        . "</div>"
                        . "</div>";
                break;
            case '11960':
                $html .= "<div class='form-group form-group-sm hidden' id = '11960'>";
                if ($child_show_label !== '0'):
                    $html .= "<label class='control-label col-md-3 text-uppercase'>$child_element_desc</label>";
                endif;
                $html .= "<div class='col-md-4' style='padding-left:30px'>"
                        . "<input type ='text' class='form-control'>"
                        . "</div>"
                        . "</div>";
                break;
            case '12747':
                $html .= "<div class='form-group form-group-sm hidden' id = '12747'>";
                if ($child_show_label !== '0'):
                    $html .= "<label class='control-label col-md-3 text-uppercase'>$child_element_desc</label>";
                endif;
                $html .= "<div class='col-md-4' style='padding-left:30px'>"
                        . "<input type ='text' class='form-control'>"
                        . "</div>"
                        . "</div>";
                break;
            case '13151':
                $html .= "<div class='form-group form-group-sm hidden' id = '13151'>";
                if ($child_show_label !== '0'):
                    $html .= "<label class='control-label col-md-3 text-uppercase'>$child_element_desc</label>";
                endif;
                $html .= "<div class='col-md-3' style='padding-left:30px'>"
                        . "<div class='input-group'>"
                        . "<input type = 'text' class='form-control datepicker' />"
                        . "<span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span>"
                        . "</div>"
                        . "</div>"
                        . "</div>";
                break;
            default:
                $result = $this->checkP($ref_element_code, $doc_name_id);

//                echo '<pre>';
//                print_r($result);
//                echo '</pre>';

                $inputType = $result->type . 'Multi';
                $class = new Multi_Input_Type_Controller();
                $class->childDetail = (object) $result->data;
                $class->ref_element_code = $ref_element_code;
                $class->child_show_label = $child_show_label;
                $class->child_element_desc = $child_element_desc;
                $methodCheck = $class->MultiVerifyMethod($inputType);
                $checking = ($methodCheck) ? $class->$inputType() : false;
                return $checking;
        endswitch;

        return $html;
    }

    public function Method() {
        $element = $this->elementDetail;

        $document = new Document_Template_Model();
        if (isset($element->doc_method_code)):
            $result = $document->searchMethod($element->doc_method_code);
            $image = $result[0]['image_path'];
        endif;

        $html = "";

        if ($element):
            $level = check_level($element->element_code, $element->doc_name_id, $element);
            #NEW ELEMENT
            $element->{'element_level'} = $level->element_level;

            if (isset($image)):
                $html .= "<div class='col-sm-12' style='margin-left:2px'>";
                $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
                if ($element->element_level == '0'):
                elseif ($element->element_level == '1'):
                    $html .= "<label class='control-label col-md-12 text-uppercase' style='padding-bottom:5px;'>" . $element->label . "</label>";
                else:
                    $html .= "<label class='control-label col-md-12 text-uppercase' style='padding-bottom:5px;font-weight:normal'>" . $element->label . "</label>";
                endif;
                $html .= "<div class='col-md-12'>"
                        . "<div><img id=" . $element->doc_method_code . " src='../../../" . $image . "' style='border: solid 1px #DCDCDC'></div>"
                        . "</div>"
                        . "</div>";
                $html .= "</div>";
            else:
                $html .= "<div class='col-sm-12' style='margin-left:2px'>";
                $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
                if ($element->element_level == '0'):
                elseif ($element->element_level == '1'):
                    $html .= "<label class='control-label col-md-12 text-uppercase' style='padding-bottom:5px;'>" . $element->label . "</label>";
                else:
                    $html .= "<label class='control-label col-md-12 text-uppercase' style='padding-bottom:5px;font-weight:normal'>" . $element->label . "</label>";
                endif;
                $html .= "<div class='col-md-12'>"
                        . "<div><span><i>Please Update Method</i></span></div>"
                        . "</div>"
                        . "</div>";
                $html .= "</div>";
            endif;
        endif;

        return $html;
    }

    public function MethodMulti() {
        $element = $this->elementDetail;

        $document = new Document_Template_Model();
        if (isset($element->doc_method_code)):
            $result = $document->searchMethod($element->doc_method_code);
            $image = $result[0]['image_path'];
        endif;

        $html = "";

        if ($element):
            $level = check_level($element->element_code, $element->doc_name_id, $element);
            #NEW ELEMENT
            $element->{'element_level'} = $level->element_level;

            if (isset($image)):
                $html .= "<div class='col-sm-12' style='margin-left:16px'>";
                $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
                if ($element->element_level == '0'):
                elseif ($element->element_level == '1'):
                    $html .= "<label class='control-label col-md-3 text-uppercase' style='padding-bottom:5px;'>" . $element->label . "</label>";
                else:
                    $html .= "<label class='control-label col-md-3 text-uppercase' style='padding-bottom:5px;font-weight:normal'>" . $element->label . "</label>";
                endif;
                $html .= "<div class='col-md-3'>"
                        . "<div><img id=" . $element->doc_method_code . " src='../../../" . $image . "' style='border: solid 1px #DCDCDC'></div>"
                        . "</div>"
                        . "</div>";
                $html .= "</div>";
            else:
                $html .= "<div class='col-sm-12' style='margin-left:16px'>";
                $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
                if ($element->element_level == '0'):
                elseif ($element->element_level == '1'):
                    $html .= "<label class='control-label col-md-3 text-uppercase' style='padding-bottom:5px;'>" . $element->label . "</label>";
                else:
                    $html .= "<label class='control-label col-md-3 text-uppercase' style='padding-bottom:5px;font-weight:normal'>" . $element->label . "</label>";
                endif;
                $html .= "<div class='col-md-3'>"
                        . "<div><span><i>Please Update Method</i></span></div>"
                        . "</div>"
                        . "</div>";
                $html .= "</div>";
            endif;
        endif;

        return $html;
    }

    public function Radiobutton() {
        $element = $this->elementDetail;

        $result = $this->checkP($element->element_code, $element->doc_name_id);

        $html = "";
        $output = "";

        $html .= "<div class='col-sm-12' style='margin-left:17px'>";
        $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
        if ($element->element_level == '1'):
            $html .= "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>";
        else:
            $html .= "<label class='control-label col-md-3 text-uppercase' style='font-weight:normal;'>" . $element->label . "</label>";
        endif;
        $html .= "<div class='radio col-sm-9'>";
        foreach ($result->data as $ref):
            $html .= "<label class='control-label' style='width:auto;padding-right:30px;padding-bottom:5px'>";
            $html .= "<input type='radio' class='custom-control-input' name='" . $element->json_element . "' data-parentcodes='" . $element->json_element . "_" . $element->element_code . "' data-ref='" . $ref['ref_element_code'] . "'>" . $ref['multiple_desc'] . "</label>";
            if ($ref['ref_element_code'] !== NULL):
                $output = $this->checkC($ref['ref_element_code'], $element->doc_name_id, $ref['child_show_label'], $ref['child_element_desc']);
            endif;
        endforeach;
        if ($output):
            $html .= $output;
        endif;
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";

        return $html;
    }

    public function Checkbox() {
        $element = $this->elementDetail;

        $result = $this->checkP($element->element_code, $element->doc_name_id);

        $html = "";

        $html .= "<div class='col-sm-12' style='margin-left:16px'>";
        $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
        if ($element->element_level == '1'):
            $html .= "<label class='control-label col-md-3 text-uppercase' style='padding-bottom:5px'>" . $element->label . "</label>";
        else:
            $html .= "<label class='control-label col-md-3 text-uppercase' style='padding-bottom:5px;font-weight:normal'>" . $element->label . "</label>";
        endif;
        $html .= "<div class='col-md-8'>";
        foreach ($result->data as $ref):
            $optionValue = $ref['multiple_desc'];
            $html .= "<div class='row'>";
            $html .= "<div class='col-sm-12'>";
            $html .= "<div class='checkbox' >"
                    . "<label class='col-sm-4' style='margin-right:8px'>"
                    . "<input type='checkbox' "
                    . "data-parentcode='$element->json_element" . '_' . $ref['parent_element_code'] . "' data-ref='" . $ref['ref_element_code'] . "' "
                    . "name='$element->json_element'"
                    . "value='$optionValue'/>" . $ref['multiple_desc']
                    . "</label>";
            if ($ref['ref_element_code'] !== NULL):
                $html .= $this->checkC($ref['ref_element_code'], $element->doc_name_id, $ref['child_show_label'], $ref['child_element_desc']);
            endif;
            $html .= "</div>";
            $html .= "</div>";
            $html .= "</div>";
        endforeach;
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";

        return $html;
    }

    public function Dropdown() {
        $element = $this->elementDetail;

        $result = $this->checkP($element->element_code, $element->doc_name_id);

        $output = "";
        $html = "";

        $html .= "<div class='col-sm-12' style='margin-left:16px'>";
        $html .= "<div class='form-group form-group-sm' style='margin-left:" . $element->element_level . "0px'>";
        if ($element->element_level == '1'):
            $html .= "<label class='control-label col-md-3 text-uppercase' style='padding-bottom:5px'>" . $element->label . "</label>";
        else:
            $html .= "<label class='control-label col-md-3 text-uppercase' style='padding-bottom:5px;font-weight:normal'>" . $element->label . "</label>";
        endif;
        $html .= "<div class='col-md-3'>";
        $html .= "<div class='dropdown'>";
        $html .= "<select name='selectList' id='selectList' class='form-control selectList' style='margin-bottom:5px'>";
        $html .= "<option value='0'>Please Select</option>";
        foreach ($result->data as $ref):
            $refValue = $ref['ref_element_code'];
            $html .= "<option value='$refValue' >" . $ref['multiple_desc'] . "</option>";
            if ($ref['ref_element_code'] !== NULL):
                $output = $this->checkC($ref['ref_element_code'], $element->doc_name_id, $ref['child_show_label'], $ref['child_element_desc']);
            endif;
        endforeach;
        $html .= "</select>";
        if ($output):
            $html .= $output;
        endif;
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";

        return $html;
    }

    public function listP($elementCode, $docCode) {
        $refP = ReferenceCaller($elementCode, $docCode);
        $resultP = form_foreach($refP);

        if (is_array($resultP)):
            #IF ADA LAGI
            if ($resultP->ref_element_code != NULL):
                $html = "";
                $html .= $this->listC($resultP->element_code, $docCode);
            endif;
        endif;
    }

    public function listC($elementCode, $docCode) {
        $refC = ReferenceCaller($elementCode, $docCode, 'child');
        $resultC = form_foreach2($refC);

        if (is_array($resultC)):
            if ($resultC->ref_element_code != NULL):
                $html = "";
                $html .= $this->listP($resultC->ref_element_code, $docCode);
            endif;
        endif;
    }

    public function UpdateMethodInput() {
        $element = $this->elementDetail;
        $data = $element->method;
        $method = json_decode(json_encode($data), true);
        //DISPLAY PRE-SELECTED METHOD
        $document = new Document_Template_Model();
        $result = $document->ListMethodInfo();

        $html = "<div class='form-group form-group-sm input-list'>"
                . "<label class='control-label col-sm-2'>Predefined Method </label>";
        //predefined text field
        $html .= "<div class='col-sm-4 list-padding-right'>"
                . "<select name='methodList' class='form-control'>";

        foreach ($result as $meth):
            if ($method === $meth['method_info']):
                $html .= "<option id='" . $method . "' value='" . $meth['doc_method_code'] . "' selected>" . $meth['doc_method_desc'] . "</option>";
            endif;
            $html .= "<option value='" . $meth['doc_method_code'] . "' >" . $meth['doc_method_desc'] . "</option>";
        endforeach;
        $html .= "</select>"
                . "</div></div>";

        return $html;
    }

    public function ListMethodInput() {
        $document = new Document_Template_Model();
        $result = $document->ListMethodInfo();

        $html = "<div class='form-group form-group-sm input-list'>"
                . "<label class='control-label col-sm-2'>Predefined Method </label>";
        $html .= "<div class='col-sm-4 list-padding-right'>"
                . "<select name='methodList' class='form-control'>";

        foreach ($result as $meth):
            $html .= "<option value='" . $meth['doc_method_code'] . "' >" . $meth['doc_method_desc'] . "</option>";
        endforeach;
        $html .= "</select>"
                . "</div></div>";

        return $html;
    }

    //zarith-31/3
    public function ListMultipleAnswerInput() {
        $document = new Document_Template_Model();
        $result = $document->ListMultAns();
        $html = '';

        foreach ($result as $multi):
            if ($multi['input_type']==='CALENDER'):
            $html .= '<option value="' . $multi['input_type'] . '">CALENDAR</option>';
            elseif ($multi['input_type']==='FUTURE CALENDER'):
            $html .= '<option value="' . $multi['input_type'] . '">FUTURE CALENDAR</option>';
            elseif ($multi['input_type']==='FUTURE CALENDER ONLY'):
            $html .= '<option value="' . $multi['input_type'] . '">FUTURE CALENDAR ONLY</option>';
            else:
            $html .= '<option value="' . $multi['input_type'] . '">' . $multi['input_type'] . '</option>';
            endif;
        endforeach;

        return $html;
    }

    public function ListMultiDescInput() {
        $document = new Document_Template_Model();
        $result = $document->ListMultAnsDesc();
        $html = '';

        foreach ($result as $multi):
             $html .= '<option value="' . $multi['multiple_desc'] . '">' . $multi['multiple_desc'] . '</option>';
        endforeach;

        return $html;
    }

    public function ListElementDesc() {
        $document = new Document_Template_Model();
        $result = $document->ListElementDesc();
        $html = '';
 
        foreach ($result as $multi):
            $html .= '<option value="' . $multi['element_desc'] . '">' . $multi['element_desc'] . '</option>';
        endforeach;

        return $html;
    }

    public function CheckParent($elementCode, $docCode) {
        $document = new Document_Template_Model();
        $result = $document->ListMultAns();
        $resultP = $document->ListMultAnsDesc();
        $html = "";

        #PARENT NEW
        $referP = ReferenceCaller($elementCode, $docCode);
        $noP = 1;
        $noL = '';
        $noC = '';

        foreach ($referP->data as $refP):
            $html .= "<div class='prelist$noP' style='background-color: #f5f5f5'>"
                    . "<p class='text-box' value='$noP'>"
                    . "<div class='form-group form-group-sm input-list'>"
                    . "<label class='control-label col-sm-2'>Predefined Value<span class='box-number'>$noP</span></label>"
                    . "<div class='col-sm-5 list-padding'>"
                    . "<div class='checkbox' style='margin-left:20px'>";
            if ($refP['show_label'] === '1'):
                $html .= "<input type='hidden' id='show_label' name='show_label$noP' value='0' style='margin-top:6px' />";
                $html .= "<input type='checkbox' id='show_label' name='show_label$noP' value='1' style='margin-top:6px' checked/>";
            else:
                $html .= "<input type='hidden' id='show_label' name='show_label$noP' value='0' style='margin-top:6px' />";
                $html .= "<input type='checkbox' id='show_label' name='show_label$noP' value='1' style='margin-top:6px'/>";
            endif;
            $html .= "<input type='hidden' value='$noP' id='sorting' class='sorting' name='SortParent' />";
            $html .= "<input class='form-control' name='multi_ans_desc$noP' id='multi_ans_desc' list='multiList' value='" . $refP['multi_answer_desc'] . "' />"
                    . "<datalist id='multiList'>";
            foreach ($resultP as $multiP):
                $html .= "<option value='" . $multiP["multiple_desc"] . "'>" . $multiP["multiple_desc_code"] . "</option>";
            endforeach;
            $html .= "</datalist>"
                    . "</div>"
                    . "</div>"
                    . "<div class='col-sm-3 list-padding'>"
                    . "<select id='multi_input_type' name='multi_input_type$noP' class='form-control'>"
                    . "<option value='" . $refP['input_type'] . "'>" . $refP['input_type'] . "</option>";
            foreach ($result as $multi):
               // $html .= "<option value='" . $multi["input_type"] . "'>" . $multi["input_type"] . "</option>";
                 if ($multi['input_type']==='CALENDER'):
                $html .= '<option value="' . $multi['input_type'] . '">CALENDAR</option>';
                elseif ($multi['input_type']==='FUTURE CALENDER'):
                $html .= '<option value="' . $multi['input_type'] . '">FUTURE CALENDAR</option>';
                elseif ($multi['input_type']==='FUTURE CALENDER ONLY'):
                $html .= '<option value="' . $multi['input_type'] . '">FUTURE CALENDAR ONLY</option>';
                else:
                $html .= '<option value="' . $multi['input_type'] . '">' . $multi['input_type'] . '</option>';
                endif;
            endforeach;
            $html .= "</select>"
                    . "</div>";
            if ($noP === 1):
                $html .= "<div class='col-sm-2 predefinedActionButton' data-action='prelist$noP'>"
                        . "<div class='btn btn-default btn-sm addPredefined'style='padding:3px'><i class='glyphicon glyphicon-plus'></i> Parent</div>&nbsp"
                        . "<div class='btn btn-default btn-sm addLayer' data-layer='prelist$noP'  style='padding:5px' ><i class='fas fa-layer-group'></i></div>"
                        . "</div>";
            else:
                $html .= "<div class='col-sm-2 predefinedActionButton' data-action='prelist$noP'>"
                        . "<div class='btn btn-default btn-sm addLayer' data-layer='prelist$noP'  style='padding:5px' ><i class='fas fa-layer-group'></i></div>&nbsp"
                        . "<div class='btn btn-default btn-sm deletePredefined' style='padding:5px' id='" . $refP['multi_answer_desc'] . "'><i class='glyphicon glyphicon-trash'></i></div>"
                        . "</div>";
            endif;
            $html .= "</div>"
                    . "</p>";
            if ($refP['ref_element_code'] != NULL):
                $html .= $this->CheckLabel($refP, $docCode, $noP, $noL, $noC);
            endif;
            $html .= "</div>";
            $noP++;
        endforeach;

        return $html;
    }

    public function CheckLabel($elementCode, $docCode, $noP, $noL, $mixC) {
        $document = new Document_Template_Model();
        $resultC = $document->ListElementDesc();
        $html = "";
        #LABEL NEW
        $referL = ReferenceCaller($elementCode['element_code'], $docCode, "child");

        if ($referL->data):
            $count = 1;
            $count++;
            if ($count > 1):
                $noP .= $mixC;
            endif;
            foreach ($referL->data as $refL):
                if ($elementCode["multiple_desc_code"] === $refL["multiple_desc_code"]):
                    $noL = 1;
                    $noP .= '-' . $noL;
                    $html .= "<div class='prelist$noP'>"
                            . "<div class='form-group form-group-sm input-list'>"
                            . "<label class='control-label col-sm-3'></label>"
                            . "<div class='checkbox'>"
                            . "<div class='col-sm-4 list-padding'>";
                    if ($refL['show_label'] === '1'):
                        $html .= "<input type='hidden' id='show_label_child' name='show_label_child$noP' value='0' style='margin-top:6px' />";
                        $html .= "<input type='checkbox' id='show_label_child' name='show_label_child$noP' value='1' style='margin-top:6px' checked/>";
                    else:
                        $html .= "<input type='hidden' id='show_label_child' name='show_label_child$noP' value='0' style='margin-top:6px' />";
                        $html .= "<input type='checkbox' id='show_label_child' name='show_label_child$noP' value='1' style='margin-top:6px'/>";
                    endif;
                    $html .= "<input name='ref_desc$noP' id='ref_desc' class='form-control' value='" . $refL['element_desc'] . "' list='refList'/>"
                            . "<datalist id='refList'>";
                    foreach ($resultC as $multiC):
                        $html .= "<option value='" . $multiC["element_desc"] . "'>" . $multiC["element_code"] . "</option>";
                    endforeach;
                    $html .= "</datalist>"
                            . "</div>"
                            . "<div class='col-sm-2 predefinedActionButton' data-action='prelist$noP'>"
                            . "<div class='btn btn-default btn-sm deleteLabel' style='padding:5px' id='" . $refL['element_desc'] . "'><i class='glyphicon glyphicon-trash'></i></div>&nbsp"
                            . "<div class='btn btn-default btn-sm addDivChild' data-child='prelist$noP' style='padding:3px'><i class='glyphicon glyphicon-chevron-down'></i> Child</div>"
                            . "</div>"
                            . "</div>"
                            . "</div>";
                    if ($refL['ref_element_code'] != NULL):
                        $html .= $this->CheckChild($refL, $docCode, $noP, $noL, $mixC);
                    endif;
                    $html .= "</div>";
                    $noL++;
                endif;
            endforeach;
        endif;

        return $html;
    }

    public function CheckChild($elementCode, $docCode, $noP, $noL, $mixC) {
        $document = new Document_Template_Model();
        $result = $document->ListMultAns();
        $resultP = $document->ListMultAnsDesc();
        $html = "";

        #CHILD NEW
        $referC = ReferenceCaller($elementCode['ref_element_code'], $docCode);
        $noC = 1;

        if ($referC->data):
            foreach ($referC->data as $refC):
                $mixC = '-' . $noC;

                $html .= "<div class='text-box$noP'>"
                        . "<input type='hidden' id='sorting_child$noP' class='sorting_child$noP' name='SortChild$noP' />"
                        . "<div class='prelist$noP$mixC'>"
                        . "<div class='form-group form-group-sm input-list'>"
                        . "<label class='control-label col-sm-3'>Child<span class='box-number$noP'>" . $refC['sorting'] . "</span></label>"
                        . "<div class='col-sm-4 list-padding'>"
                        . "<div class= 'checkbox'>";
                if ($refC['show_label'] === '1'):
                    $html .= "<input type='hidden' id='show_label' name='show_label$noP$mixC' value='0' style='margin-top:6px' />";
                    $html .= "<input type='checkbox' id='show_label' name='show_label$noP$mixC' value='1' style='margin-top:6px' checked/>";
                else:
                    $html .= "<input type='hidden' id='show_label' name='show_label$noP$mixC' value='0' style='margin-top:6px' />";
                    $html .= "<input type='checkbox' id='show_label' name='show_label$noP$mixC' value='1' style='margin-top:6px'/>";
                endif;
                $html .= "<input class='form-control' name='multi_child_ans_desc$noP$mixC' id='multi_child_ans_desc' list='multiList' value='" . $refC['multi_answer_desc'] . "' />"
                        . "<datalist id='multiList'>";
                foreach ($resultP as $multiP):
                    $html .= "<option value='" . $multiP["multiple_desc"] . "'>" . $multiP["multiple_desc_code"] . "</option>";
                endforeach;
                $html .= "</datalist>"
                        . "</div>"
                        . "</div>"
                        . "<div class='col-sm-3 list-padding'>"
                        . "<select id='multi_child_input_type' name='multi_child_input_type$noP$mixC' class='form-control'>"
                        . "<option value='" . $refC['input_type'] . "'>" . $refC['input_type'] . "</option>";
                foreach ($result as $multi):
                    //$html .= "<option value='" . $multi["input_type"] . "'>" . $multi["input_type"] . "</option>";
                     if ($multi['input_type']==='CALENDER'):
                    $html .= '<option value="' . $multi['input_type'] . '">CALENDAR</option>';
                    elseif ($multi['input_type']==='FUTURE CALENDER'):
                    $html .= '<option value="' . $multi['input_type'] . '">FUTURE CALENDAR</option>';
                    elseif ($multi['input_type']==='FUTURE CALENDER ONLY'):
                    $html .= '<option value="' . $multi['input_type'] . '">FUTURE CALENDAR ONLY</option>';
                    else:
                    $html .= '<option value="' . $multi['input_type'] . '">' . $multi['input_type'] . '</option>';
                    endif;
                endforeach;
                $html .= "</select>"
                        . "</div>"
                        . "<div class='col-sm-2 predefinedActionButton' data-action='prelist$noP$mixC'>"
                        . "<div class='btn btn-default btn-sm deletePredefinedChild' style='padding:5px' id='" . $refC['multi_answer_desc'] . "'><i class='glyphicon glyphicon-trash'></i></div>&nbsp"
                        . "<div class='btn btn-default btn-sm addLayer' data-layer='prelist$noP$mixC' style='padding:5px'><i class='fas fa-layer-group'></i></div>"
                        . "</div>"
                        . "</div>";
                if ($refC['ref_element_code'] != NULL):
                    $html .= $this->CheckLabel($refC, $docCode, $noP, $noL, $mixC);
                endif;
                $html .= "</div></div>";
                $noC++;
            endforeach;
        endif;

        return $html;
    }

    public function UpdateMultiAns() {
        $element = $this->elementDetail;

        $html = $this->CheckParent($element->element_code, $element->doc_name_id);
        return $html;
    }

}
