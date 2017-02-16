<?php

class Input_Type_Controller extends Common_Controller {

    public $elementDetail;
    private $is_parent = true;
    public $is_multiple_textbox = 1;
    public $checkje = false;

    public function VerifyMethod($methodName) {
        $check = method_exists($this, $methodName);
        return $check;
    }

    public function Textbox() {
        $element = $this->elementDetail;
        $totalTextBox = $this->is_multiple_textbox;
        $html = "<div class='form-group form-group-sm'>"
                . "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>";

        for ($i = 0; $i < $totalTextBox; $i++):
            $colSize = ($totalTextBox > 1) ? 'col-sm-2' : 'col-sm-4';
            $method = ($totalTextBox > 1) ? json_decode($element->listing[$i]['method']) : false;
            $html .= "<div class='$colSize'>";
            if (isset($method->form_group->input_group)):
                $html .= "<div class='input-group input-group-sm'>";
            endif;
            $html .= "<input type='text' name='" . $element->name . "' class='form-control' />";
            if (isset($method->form_group->input_group)):
                if (isset($method->form_group->input_group->group_type)):
                    if ($method->form_group->input_group->group_type == 'addon'):
                        $html .= "<span class='input-group-addon'>" . $method->form_group->input_group->addon_text . "</span>";
                    endif;
                endif;
                $html .= "</div>";
            endif;
            $html .= "</div>";
        endfor;
        $html .= "</div>";
        return $html;
    }

    public function MultipleAnswer() {
        $element = $this->elementDetail;

        $referal = ReferenceCaller($element->element_code, $element->doc_name_id);
        $gotChild = (isset($referal->data[0]['parent_element_code'])) ? true : false;

        $multipleAnswerData = array(
            'is_parent' => $gotChild,
            'label' => $element->label,
            'element_code' => (isset($referal->data['parent_element_code'])) ? $referal->data['parent_element_code'] : $element->element_code,
            'name' => '',
            'listing' => $referal->data,
            'json_element' => $element->json_element,
            'additional_attribute' => $element->additional_attribute,
            'doc_name_id' => $element->doc_name_id
        );

        $class = new Input_Type_Controller();
        $this->is_parent = $gotChild;
        $class->elementDetail = (object) $multipleAnswerData;
        $input = ucwords(strtolower($referal->type));
        $inputType = str_replace(' ', '', $input);
        $class->is_multiple_textbox = ($inputType == 'Textbox') ? count($referal->data) : 1;

        $methodName = ($inputType == 'List') ? 'Listdown' : ucfirst($inputType);

        if ($methodName):
            return $class->$methodName();
        endif;
    }

    public function Calender() {
        $element = $this->elementDetail;
        $html = '';
        $html .= "<div class='form-group form-group-sm'>"
                . "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>"
                . "<div class='col-md-3'>"
                . "<div class='input-group'>"
                . "<input name='" . $element->name . "' class='form-control datepicker' />"
                . "<span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span>"
                . "</div>"
                . "</div>"
                . "</div>";
        return $html;
    }

    public function Checkbox() {

        $element = $this->elementDetail;
        if ($this->is_parent):
            $referral = ReferenceCaller($element->element_code, $element->doc_name_id);
        else:
            $referral = ReferenceCaller($element->element_code, $element->doc_name_id, 'child');
        endif;

        $otherSpecify = true;
        $position = 'below';

        $html = "<div class='form-group form-group-sm'>"
                . "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>"
                . "<div class='col-md-9'>";
        if (isset($element->additional_attribute->styling)):
            $noOfColumn = 12 / $element->additional_attribute->styling->number_of_column;
            $listOfOption = $referral->data;
            $perColumn = ceil(count($listOfOption) / $element->additional_attribute->styling->number_of_column);
            $listNo = 1;
            for ($i = 1; $i <= $element->additional_attribute->styling->number_of_column; $i++):
                $html .= "<div class='col-sm-" . $noOfColumn . "'>";
                while ($listNo <= $perColumn * $i and $listNo <= count($listOfOption)):
                    $optionName = $listOfOption[($listNo - 1)]['multi_answer_desc'];
                    $optionValue = $listOfOption[($listNo - 1)]['multi_answer_desc'];
                    $optionLabel = $listOfOption[($listNo - 1)]['multi_answer_desc'];
                    $html .= "<div class='checkbox'"
                            . " style='margin-left:-15px;'>"
                            . "<label>"
                            . "<input type='checkbox' "
                            . " name='$element->json_element'"
                            . " class='$element->json_element'"
                            . "data-parentname='$element->json_element'"
                            . "data-optionname='$optionName'"
                            . "value='$optionValue'"
                            . "/> $optionLabel"
                            . "</label>"
                            . "</div>";
                    if (strtolower($optionValue) == 'others, specify'):
                        $html .= "<input type='text'"
                                . " name='other_specify_$element->json_element' "
                                . " class='form-control hidden' placeholder='Please Specify' />";
                    endif;
                    $listNo++;
                endwhile;
                $html .= "</div>";
            endfor;
        else:

            foreach ($referral->data as $ref):
                $optionValue = $ref['multi_answer_desc'];
                $html .= "<div class='row'>";
                $html .= "<div class='col-sm-5'>";
                $html .= "<div class='checkbox' >"
                        . "<label>"
                        . "<input type='checkbox' "
                        . "data-parentcode='$element->json_element" . '_' . $ref['parent_element_code'] . "'"
                        . "name='$element->json_element'"
                        . " value='$optionValue'/>" . $ref['multi_answer_desc']
                        . "</label>"
                        . "</div>";
                $html .= '</div>';
                if (isset($ref['parent_element_code'])):

                    $referal = ReferenceCaller($ref['parent_element_code'], $ref['doc_name_id'], 'child');
                    foreach ($referal->data as $key => $r):
                        if (strtolower($r['input_type']) == 'checkbox'):
                            $html .= "<div class='clearfix'></div>";
                            $html .= "<div style='margin-left:80px;' class='checkbox hidden multicheckbox_" . $element->json_element . '_' . $ref['parent_element_code'] . "' >"
                                    . "<input type='checkbox' />" . $r['multi_answer_desc']
                                    . "</div>";
                        endif;
                        if (strtolower($r['input_type']) == 'freetext'):
                            $otherSpecify = false;
                            $position = 'right';
                            if ($key == 0):
                                $html .= "<div class='col-sm-6' style='margin-bottom:10px'>"
                                        . "<textarea placeholder='Comments'"
                                        . "data-parentcode='$element->json_element" . '_' . $ref['parent_element_code'] . "'"
                                        . "name='" . $element->json_element . '_' . str_replace(' ', '_', strtolower($ref['multi_answer_desc'])) . "'"
                                        . "rows='4' class='form-control freetext_enable_disable_" . $ref['parent_element_code'] . "' "
                                        . "style='height:100px' disabled></textarea>"
                                        . " </div>";
                            endif;
                        endif;
                    endforeach;

                endif;
                if (strtolower($ref['multi_answer_desc']) == 'others, specify' && $otherSpecify == true):
                    $html .= "<div class='col-sm-4' style='padding-left:0;'>"
                            . "<input type='text' "
                            . "name='other_specify_$element->json_element' "
                            . "class='form-control hidden' placeholder='Please specify' /></div>";
                endif;
                $html .= '</div>';
            endforeach;
        endif;

        $html .= "</div>"
                . "</div>";
        return $html;
    }

    public function Freetext() {
        $element = $this->elementDetail;
        $html = "<div class='form-group form-group-sm'>"
                . "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>"
                . "<div class='col-md-6'>"
                . "<textarea name='" . $element->name . "' class='form-control' style='height: 80px;'></textarea>"
                . "</div>"
                . "</div>";
        return $html;
    }

    public function Label() {
        $element = $this->elementDetail;
        $html = "<h5 class='text-uppercase'>" . $element->label . "</h5>";
        if (strlen($element->label) > 0):
            $html .= "<hr>";
        endif;
        return $html;
    }

    public function Method() {
        $element = $this->elementDetail;
        $title = ucwords(strtolower($element->document_title));
        $formName = str_replace(' ', '_', $title);
        if (isset($element->additional_attribute->method)):
            $class = $element->additional_attribute->method->page . '_Method';
        else:
            $class = $formName . '_Method';
        endif;
        $method = new $class;
        $methodName = $element->method;
        $params = array();
        $html = $method->$methodName($params);
        return $html;
    }

    public function Richtext() {
        $element = $this->elementDetail;
        $html = "<div class='form-group form-group-sm'>"
                . "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>"
                . "<div class='col-md-9'>"
                . "<div class='summernote'></div>"
                . "</div>"
                . "</div>";
        return $html;
    }

    public function Dropdown() {
        $element = $this->elementDetail;
        if ($this->is_parent):
            $referral = ReferenceCaller($element->element_code, $element->doc_name_id);
        else:
            //$referral = ReferenceCaller($element->element_code, $element->doc_name_id);
            $listData = array('data' => $element->data);
            $referral = (object) $listData;
        endif;
        
        $inputColumn = ($this->is_parent) ? 'col-sm-4' : 'col-sm-4';
        $html = "<div class='form-group form-group-sm'>"
                . "<label class='control-label col-md-3 text-uppercase'";
        $html .= ($this->is_parent) ? '' : 'style="font-weight:normal;"';
        $html .= ">" . $element->label . "</label>"
                . "<div class='$inputColumn'>"
                . "<select name='" . $element->name . "' class='form-control'>"
                . "<option value='0' >Please Select</option>";
        foreach ($referral->data as $ref):
            $html .= "<option>" . $ref['multi_answer_desc'] . "</option>";
        endforeach;
        $html .= "</select>"
                . "</div>"
                . "</div>";
        return $html;
    }

    public function Listdown() {
        $element = $this->elementDetail;
        if ($this->is_parent):
            $referral = ReferenceCaller($element->element_code, $element->doc_name_id);
        else:
            $referral = ReferenceCaller($element->element_code, $element->doc_name_id, 'child');
        endif;

        $html = "<div class='form-group form-group-sm'>"
                . "<div class='col-sm-3 text-uppercase'>" . $element->label . "</div>";
        $html .= "<div class='col-sm-9'>";

        foreach ($referral->data as $ref):
            $referal = ReferenceCaller($ref['parent_element_code'], $ref['doc_name_id'], 'child');

            $input = ucwords(strtolower($ref['input_type']));
            $inputType = str_replace(' ', '', $input);
            $method = (strtolower($inputType) == 'list') ? 'Dropdown' : $inputType;
            $multipleAnswerData = array(
                'is_parent' => false,
                'label' => $ref['multi_answer_desc'],
                'element_code' => (isset($ref['parent_element_code'])) ? $ref['parent_element_code'] : false,
                'name' => '',
                'type' => $inputType,
                'data' => $referal->data
            );

            $class = new Input_Type_Controller();
            $class->elementDetail = (object) $multipleAnswerData;
            $class->is_parent = false;
            $class->checkje = true;
            $html .= $class->$method();
        endforeach;
        $html .= "</div></div>";
        return $html;
    }

    public function RadioButton() {
        $element = $this->elementDetail;
        if ($this->is_parent):
            $referral = ReferenceCaller($element->element_code, $element->doc_name_id);
        else:
            $referral = ReferenceCaller($element->element_code, $element->doc_name_id);
        endif;

        $html = "<div class='form-group form-group-sm'>"
                . "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>"
                . "<div class='col-md-9'>";
        foreach ($referral->data as $ref):
            $html .= "<div class='radio'>"
                    . "<label>"
                    . "<input type='radio' />" . $ref['multi_answer_desc']
                    . "</label>"
                    . "</div>";
        endforeach;
        $html .= "</div>"
                . "</div>";
        return $html;
    }

}
