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
        $layout = (isset($element->layout)) ? $element->layout : 1;
        if ($layout) {
            $html = "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-6 text-uppercase'>" . $element->label . "</label>";

            for ($i = 0; $i < $totalTextBox; $i++):
                $colSize = ($totalTextBox > 1) ? 'col-sm-1' : 'col-sm-5';
                $method = ($totalTextBox > 1) ? json_decode($element->listing[$i]['method']) : false;
                $html .= "<div class='$colSize'>";
                if (isset($method->form_group->input_group)):
                    $html .= "<div class='input-group input-group-sm'>";
                endif;
                $html .= "<input type='text' name='" . $element->name . "' class='form-control' style='margin-left:15px;'/>";
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
        }else {
            $html = "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-12 text-uppercase'>" . $element->label . "</label>"
                    . "</div>"
                    . "<div class='form-group form-group-sm'>";

            for ($i = 0; $i < $totalTextBox; $i++):
                $colSize = ($totalTextBox > 1) ? 'col-sm-4' : 'col-sm-8';
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
        }
        return $html;
    }

    //edited by Fatin Adilah 2/4
    public function MultipleAnswer() {
        $element = $this->elementDetail;
        $referal = ReferenceCaller($element->element_code, $element->doc_name_id);
        $gotChild = (isset($referal->data[0]['parent_element_code'])) ? true : false;
        $input = ucwords(strtolower($referal->type));
        $inputType = str_replace(' ', '', $input);
        $multipleAnswerData = array(
            'name' => '',
            'is_parent' => $gotChild,
            'label' => $element->label,
            'element_code' => (isset($referal->data['parent_element_code'])) ? $referal->data['parent_element_code'] : $element->element_code,
            'listing' => $referal->data,
            'json_element' => $element->json_element,
            'additional_attribute' => $element->additional_attribute,
            'doc_name_id' => $element->doc_name_id,
            'layout' => $element->layout,
        );
     
//        $class->is_multiple_textbox = ($inputType == 'Textbox') ? count($referal->data) :true;
//        $methodName = ($inputType == 'List') ? 'Listdown' : ucfirst($inputType);

        $methodName=$inputType;
        if ($methodName){
            $class = new Input_Type_Controller();
            $this->is_parent = $gotChild;
            $class->elementDetail = (object) $multipleAnswerData;
            $methodCheck = $class->VerifyMethod($methodName);
            $result= ($methodCheck)? $class->$methodName():false;
            return $result;
        }
//        edited by Fatin Adilah (TEST ELEMENT)        
//        else{
//        $input =  ucwords(strtoupper($element->label));
//        $inputType=  str_replace('', '', $input);
//        return '<b style="font-size:12px; padding-left:4px;">' . $inputType . '</b>'.$methodName;
//        }
    }

    public function Calender() {
        $element = $this->elementDetail;
        if ($element->layout == 1) {
            $html = '';
            $html .= "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-3 text-uppercase' style='margin-right:15px;'>" . $element->label . "</label>"
                    . "<div class='col-md-3'>"
                    . "<div class='input-group'>"
                    . "<input name='" . $element->name . "' class='form-control datepicker' />"
                    . "<span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span>"
                    . "</div>"
                    . "</div>"
                    . "</div>";
        } else {
            $html = '';
            $html .= "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-6 text-uppercase' style='margin-right:15px;'>" . $element->label . "</label>"
//                    . "</div>"
                    . "<div class='form-group form-group-sm'>"
                    . "<div class='col-md-4'>"
                    . "<div class='input-group'>"
                    . "<input name='" . $element->name . "' class='form-control datepicker' />"
                    . "<span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span>"
                    . "</div>"
                    . "</div>"
                    . "</div>"
                    . "</div>";
        }
        return $html;
    }
    
    public function Time() {
        $element = $this->elementDetail;
        if ($element->layout == 1) {
            $html = '';
            $html .= "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-3 text-uppercase' style='margin-right:15px;'>" . $element->label . "</label>"
                    . "<div class='col-md-3'>"
                    . "<div class='input-group'>"
                    . "<input name='" . $element->name . "' class='form-control' type='time' />"
//                    . "<span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span>"
                    . "</div>"
                    . "</div>"
                    . "</div>";
        } else {
            $html = '';
            $html .= "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-6 text-uppercase' style='margin-right:15px;'>" . $element->label . "</label>"
//                    . "</div>"
                    . "<div class='form-group form-group-sm'>"
                    . "<div class='col-md-4'>"
                    . "<div class='input-group'>"
                    . "<input name='" . $element->name . "' class='form-control' type='time' />"
//                    . "<span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span>"
                    . "</div>"
                    . "</div>"
                    . "</div>"
                    . "</div>";
        }
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

        if ($element->layout == 1) {
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

                        $referal = ReferenceCaller($ref['parent_element_code'], 'child');
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
        }
        else {
            $html = "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-12 text-uppercase'>" . $element->label . "</label>"
                    . "</div>"
                    . "<div class='form-group form-group-sm'>"
                    . "<div class='col-md-12'>";
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
                        if($referal->data):
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
        }
        return $html;
    }

    public function Freetext() {
        $element = $this->elementDetail;
        $layout = (isset($element->layout)) ? $element->layout : 1;
        if ($layout) {
            $html = "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>"
                    . "<div class='col-md-7'>"
                    . "<textarea name='" . $element->name . "' class='form-control' style='height: 80px; margin-left:15px;'></textarea>"
                    . "</div>"
                    . "</div>";
        } else {
            $html = "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-12 text-uppercase'>" . $element->label . "</label>"
                    . "</div>"
                    . "<div class='form-group form-group-sm'>"
                    . "<div class='col-md-9'>"
                    . "<textarea name='" . $element->name . "' class='form-control' style='height: 80px;'></textarea>"
                    . "</div>"
                    . "</div>";
        }
        return $html;
    }

    public function Label() {
        $element = $this->elementDetail;
        if (isset($element->additional_attribute->deco_style)):
            $style = $element->additional_attribute->deco_style;
            switch ($style):
                case 'panel-header':
                    $html = "<br><div class='panel-heading col-md-12' style='background-color: #0088cc; color: white;'>" . $element->label . "</div><br><br><br><br>";
                    break;
                case 'heading-h1':
                    $html = "<strong><h1 class='text-uppercase'>" . $element->label . "</h1></strong><hr>";
                    break;
                case 'heading-h2':
                    $html = "<strong><h2 class='text-uppercase'>" . $element->label . "</h2></strong><hr>";
                    break;
                case 'heading-h3':
                    $html = "<strong><h3 class='text-uppercase'>" . $element->label . "</h3></strong><hr>";
                    break;
                case 'default':
                    $html = "<strong><h4 class='text-uppercase'>" . $element->label . "</h4></strong><hr>";
                    break;
                default :
                    $html = "<strong><h4 class='text-uppercase'>" . $element->label . "</h4></strong><hr>";
                    break;
            endswitch;
        else :
            $html = "<h4 class='text-uppercase'>" . $element->label . "</h4>";
        endif;
//        if (strlen($element->label) > 0):
//            $html .= "<hr>";
//        endif;
        return $html;
    }
    
    public function Method($element) {
    $elementDetail = array(
//        'label' => $element->element_desc,
        'element_code' => $element->element_code,
        'method' => $element->method,
        'doc_method_code' => $element->doc_method_code,
        'json_element'=>$element->json_element,
    );
    
    $class = new Input_Type_Controller();
    $class->elementDetail = (object) $elementDetail;
    $class2 = new Document_Template_Model();
    $result = $class2->MainMethod();
    $html = '';
//    $html .= '<input type=hidden value="'.$element->doc_method_code.'">';
 
        $html .= "<div class='form-group form-group-sm' style='margin-left:2px;width:280px;'>" 
                ."<select id='method' class='form-control'>"
                .'<option value="0">Please Select Method</option>';
        if($result){
        foreach($result as $method){
//        $html .= '<option value="'.$method['code'].'">'.$method['label'].'</option>';
        if(($element->doc_method_code) == $method['code']){
        $html .= '<option id="'.$element->doc_method_code.'" value="'.$method['code'].'" selected >'.$method['label'].'</option>'
                ."</select>"
                ."</div>"; 
        $html .= '<div><img id="'.$element->doc_method_code.'"src="../../../'.$method['image_path'].'"></div>';
        $methodName=$html;
        return $methodName;}
        elseif(($element->doc_method_code) == null){
            $methodName="Please Update Method";
            return $methodName;}
        }
        }
        elseif($result== '0'){
            $msg= 'All Method Not Yet Defined';
            $methodName=$msg;
            return $methodName;
        }
    }

    public function Richtext() {
        $element = $this->elementDetail;
        $layout = (isset($element->layout)) ? $element->layout : 1;
        if ($layout) {
            $html = "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>"
                    . "<div class='col-md-7'>"
                    . "<div class='summernote'></div>"
                    . "</div>"
                    . "</div>";
        } else {
            $html = "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-6 text-uppercase'>" . $element->label . "</label>"
                    . "</div>"
                    . "<div class='form-group form-group-sm'>"
                    . "<div class='col-md-8'>"
                    . "<div class='summernote'></div>"
                    . "</div>"
                    . "</div>";
        }
        return $html;
    }

    public function Numeric() {
        $element = $this->elementDetail;
        if ($element->layout == 1) {
            $html = "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>"
                    . "<div class='col-md-3'>"
                    . "<input class='form-control' type='number'  style='margin-left:15px;' name='" . $element->name . "' />"
                    . "</div>"
                    . "</div>";
        } else {
            $html = "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-6 text-uppercase'>" . $element->label . "</label>"
                    . "</div>"
                    . "<div class='form-group form-group-sm'>"
                    . "<div class='col-md-4'>"
                    . "<input class='form-control' type='number' name='" . $element->name . "' />"
                    . "</div>"
                    . "</div>";
        }
        return $html;
    }
    
    public function Alphanumeric() {
        $element = $this->elementDetail;
        $totalTextBox = $this->is_multiple_textbox;
        $layout = (isset($element->layout)) ? $element->layout : 1;
        if ($layout) {
            $html = "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-6 text-uppercase'>" . $element->label . "</label>";

            for ($i = 0; $i < $totalTextBox; $i++):
                $colSize = ($totalTextBox > 1) ? 'col-sm-1' : 'col-sm-5';
                $method = ($totalTextBox > 1) ? json_decode($element->listing[$i]['method']) : false;
                $html .= "<div class='$colSize'>";
                if (isset($method->form_group->input_group)):
                    $html .= "<div class='input-group input-group-sm'>";
                endif;
                $html .= "<input type='text' name='" . $element->name . "' class='form-control' style='margin-left:15px;'/>";
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
        }else {
            $html = "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-12 text-uppercase'>" . $element->label . "</label>"
                    . "</div>"
                    . "<div class='form-group form-group-sm'>";

            for ($i = 0; $i < $totalTextBox; $i++):
                $colSize = ($totalTextBox > 1) ? 'col-sm-4' : 'col-sm-8';
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
        }
        return $html;
    }

    public function Dropdown() {
        $element = $this->elementDetail;
        if ($this->is_parent):
            $referral = ReferenceCaller($element->element_code, $element->doc_name_id);
        else:
            $listData = array('data' => $element->data);
            $referral = (object) $listData;
        endif;

        if ($element->layout == 1) {
            $inputColumn = ($this->is_parent) ? 'col-sm-4' : 'col-sm-4';
            $html = "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-3 text-uppercase'";
            $html .= ($this->is_parent) ? '' : 'style="font-weight:normal;"';
            $html .= ">" . $element->label . "</label>"
                    . "<div class='$inputColumn'>"
                    . "<select name='" . $element->name . "' class='form-control' style='margin-left:15px;'>"
                    . "<option value='0' >Please Select</option>";
            foreach ($referral->data as $ref):
                $html .= "<option>" . $ref['multi_answer_desc'] . "</option>";
            endforeach;
            $html .= "</select>"
                    . "</div>"
                    . "</div>";
        }else {
            $inputColumn = ($this->is_parent) ? 'col-sm-6' : 'col-sm-6';
            $html = "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-12 text-uppercase' style='padding-bottom:5px;'";
            $html .= ($this->is_parent) ? '' : 'style="font-weight:normal;"';    
            switch ($element->label):
            //if label is empty (no space)
            case '':
                $html .= ">" . $element->label . "</label>"
                    . "<div class='$inputColumn'>"
                    . "<select name='" . $element->name . "' class='form-control'>"
                    . "<option value='0' >Please Select</option>";
                break;
            default:
                $html .= ">" . $element->label . "</label>"
                    . "<div class='$inputColumn'>"
                    . "<select name='" . $element->name . "' class='form-control'>"
                    . "<option value='0' >Please Select</option>";
            endswitch;
            foreach ($referral->data as $ref):
                $html .= "<option>" . $ref['multi_answer_desc'] . "</option>";
            endforeach;
            $html .= "</select>"
                    . "</div>"
                    . "</div>";
        }
        return $html;
    }
    
    //edited by Fatin Adilah 9/4
    public function RadioButton() {
        $element = $this->elementDetail;
        if ($this->is_parent):
            $referral = ReferenceCaller($element->element_code, $element->doc_name_id);
//        else:
//            $referral = ReferenceCaller($element->element_code, $element->doc_name_id);
        endif;
        
        if ($element->layout == 1) {
            $html = "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-3 text-uppercase'>" . $element->label . "</label>"
                    . "<div class='col-md-9'>"
                    . "<div class='radio'>";
            foreach ($referral->data as $ref):
//                print_r($ref);
                $html .= "<label class='col-md-3'>"
                        . "<input type='radio' name='" . $element->json_element . "' data-parentcodes='" . $element->json_element . "_" . $element->element_code . "' />" . $ref['multi_answer_desc']
                        . "</label>";
            endforeach;
            $html .= "</div><br>";

            $html .="<div class='form-group form-group-sm'>";
            foreach ($referral->data as $ref):
                if (isset($ref['parent_element_code'])):
                    $referal = ReferenceCaller($ref['parent_element_code'], $ref['doc_name_id'], 'child');
                    foreach ($referal->data as $key => $r):
                        if (strtolower($r['input_type']) == 'calender'):
                            $html .= "<div class='col-md-3'><div class='input-group'>"
                                    . "<input type='date' id='rdio_" . $element->json_element . "_" . $ref['parent_element_code'] . "' name='" . $element->json_element . "' class='form-control ' />"
                                    . "</div></div>";
                        endif;
                        if (strtolower($r['input_type']) == 'textbox'):
                            $html .= "<div class='col-md-3' ><input id='rdio_" . $element->json_element . "_" . $ref['parent_element_code'] . "' type='text' name='" . $element->json_element . "' class='form-control' /></div>";
                        endif;
                    endforeach;
                endif;
            endforeach;
            $html .= "</div></div>"
                    . "</div>";
        }
        
        
        
        
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
       else {
            $html = "<div class='form-group form-group-sm'>"
                    . "<label class='control-label col-md-6 text-uppercase'>" . $element->label . "</label>"
                    . "</div>"
                    . "<div class='form-group form-group-sm'>"
                    . "<div class='col-md-9'>"
                    . "<div class='radio'>";
            
            //display radiobutton
            foreach ($referral->data as $ref):
            $html .= "<label class='col-md-6'>"
                . "<input type='radio' id='" . $element->element_code . "' value='".$ref['ref_element_code']."' name='" . $element->json_element . "' data-refcodes='" . $element->json_element . "_" . $ref['ref_element_code'] . "' />" . $ref['multi_answer_desc']
                . "</label>";
            
            if($ref['ref_element_code'] === '9137'):
                $html .= "<div class='col-md-5' style='padding-left:0;'>"
                                . "<input type='text' id='textbox' "
                                . "name='textbox_$element->json_element' "
                                . "class='form-control hidden' placeholder='Enter Reason..' /></div>";
                
            elseif ($ref['ref_element_code'] === '9144'):
                $html .= "<div name='calendar_$element->json_element'  class='col-md-5 hidden'>"
                                . "<div id='calendar' data-refcodes='" . $ref['ref_element_code'] . "' class='input-group'>"
                                . "<input class='form-control datepicker' />"
                                . "<span class='input-group-addon' ><i class='glyphicon glyphicon-calendar'></i></span>"
                                . "</div>"
                                . "</div>";
            
            elseif ($ref['ref_element_code'] === '1427'):
                $html .= "<div class='form-group form-group-sm'>"
                                . "<div class='col-md-7'>"
                                . "<textarea id='freetext_' name='freetext_$element->json_element' class='form-control hidden' style='height: 80px; margin-left:15px;'></textarea>"
                                . "</div>"
                                . "</div>";    
            endif;

            
            endforeach;
            
            $html .= "</div></div></div>";
        }
           
        return $html;
    }

    public function Row() {
        $element = $this->elementDetail;
        $data = $element->additional_attribute;
        $array = json_decode(json_encode($data), true);

        $html = "<div class='form-group form-group-sm'>";
        foreach ($array as $key => $in):
            $html .= "<label class='control-label col-md-3 text-uppercase'>" . $in['row_desc'] . "</label>";
        endforeach;
        $html .="</div>";

        $html .="<div class='form-group form-group-sm'>";
        foreach ($array as $key => $in):
            switch ($in['row_type']):
                case 'TEXTBOX' : $html .= "<div class='col-md-3'>"
                            . "<input type='text' name='" . $element->name . "' class='form-control' />"
                            . "</div>";
                    break;
                case 'FREETEXT' : $html .="<div class='col-md-3'>"
                            . "<textarea name='" . $element->name . "' class='form-control' style='height: 80px;'></textarea>"
                            . "</div>";
                    break;
                case 'NUMBER'   : $html .="<div class='col-md-3'>"
                            . "<input class='form-control' type='number' name='" . $element->name . "' />"
                            . "</div>";
                    break;
                case 'CALENDER' : $html .="<div class='col-md-3'>"
                            . "<div class='input-group'>"
                            . "<input name='" . $element->name . "' class='form-control datepicker' />"
                            . "<span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span>"
                            . "</div>"
                            . "</div>";
                    break;
            endswitch;

        endforeach;
        $html .="</div>";

        return $html;
    }
    
    public function UpdateMethodInput(){
        $element = $this->elementDetail;
        $data = $element->method;
        $method = json_decode(json_encode($data), true);
        //DISPLAY PRE-SELECTED METHOD
        $document = new Document_Template_Model();
        $result = $document->ListMethodInfo();
        
            $html = "<div class='form-group form-group-sm input-list'>"
                    . "<label class='control-label col-sm-4'>Predefined Method </label>";
            //predefined text field
            $html .= "<div class='col-sm-4 list-padding-right'>"
                    . "<select name='methodList' class='form-control'>";
            
                foreach ($result as $meth):
                    if($method === $meth['method_info']):
                        $html .= "<option id='".$method."' value='".$meth['doc_method_code']."' selected>".$meth['doc_method_desc']."</option>";
                    endif;
                        $html .= "<option value='".$meth['doc_method_code']."' >".$meth['doc_method_desc']."</option>";
                endforeach;
            $html .= "</select>"
                    . "</div></div>";
            
            
            
        return $html;
    }
    
    //16AUG
    public function ListMethodInput(){
        $document = new Document_Template_Model();
        $result = $document->ListMethodInfo();
        
            $html = "<div class='form-group form-group-sm input-list'>"
                    . "<label class='control-label col-sm-4'>Predefined Method </label>";
            $html .= "<div class='col-sm-4 list-padding-right'>"
                    . "<select name='methodList' class='form-control'>";
            
                foreach ($result as $meth):
                        $html .= "<option value='".$meth['doc_method_code']."' >".$meth['doc_method_desc']."</option>";
                endforeach;
            $html .= "</select>"
                    . "</div></div>";
            
        return $html;
    }
    
    public function ListMultipleAnswerInput(){
        $document = new Document_Template_Model();
        $result = $document->ListMultAns();
        $html = '';
        
        foreach ($result as $multi):
        $html .= '<option value="'.$multi['input_type'].'">'.$multi['input_type'].'</option>';
        endforeach;
            
        return $html;
    }

    public function UpdateMultiAns() {
        $document = new Document_Template_Model();
        $result = $document->ListMultAns();
        $element = $this->elementDetail;
        $this->is_parent;
        $referral = ReferenceCaller($element->element_code, $element->doc_name_id);

        $html = "<div class='form-group form-group-sm input-list'>"
                . "<label class='control-label col-sm-4'>Predefined Value </label>";
        $no = 1;
        $childno = 1;
        if($referral->data):
        $len = count($referral->data);
//        endif;
        
        if($referral->data):
        foreach ($referral->data as $ref):
            $listname = $ref['multi_answer_desc'];
            $type = ucwords(strtolower($ref['input_type']));
            $html .= "<div class='prelist" . $no . "'>"
                    . "<div class='col-sm-3 list-padding-right'>"
                    . "<input type='text' name='multi_ans_desc" . $no . "' class='form-control' value='" . $listname . "' />";

            $re = ReferenceCaller($ref['parent_element_code'], $ref['doc_name_id'], 'child');
            if ($re->data == null) {
                $validate = 'parentonly';
            } else {
                $validate = 'childexist';
            }

            $html .="<input type='hidden' name='validation" . $no . "' id='validation" . $no . "' value='" . $validate . "' />"
                    . "<input type='hidden' name='sorting' value='" . $no . "' />"
                    . "</div>"
                    . "<div class='col-sm-3 list-padding-left' >"
                    . "<select name='multi_input_type" . $no . "' class='form-control'>"
                    . "<option value='" . $ref['input_type'] . "'>" . $type . "</option>";
            foreach ($result as $multi):
            $html .= '<option value="'.$multi['input_type'].'">'.$multi['input_type'].'</option>';
            endforeach;
            $html .= "</select>"
                    . "</div>"
                    . "<div class='col-sm-2 predefinedActionButton' data-listid='" . $no . "' >";
            if ($no == ($len)) {
                $html .= "<div class='btn btn-default btn-sm addPredefined' style='padding:4px' data-listid='" . $no . "' ><i class='glyphicon glyphicon-plus'></i></div>";
            } else {
                $html .= "<div class='btn btn-default btn-sm deletePredefined' style='padding:4px' data-delid='" . $no . "' data-childno='" . $childno . "'><i class='glyphicon glyphicon-trash'></i></div>";
            }

            $referal = ReferenceCaller($ref['parent_element_code'], $ref['doc_name_id'], 'child');
            $nn = 1;
            if ($referal->data != null) {
                foreach ($referal->data as $r):
                    $nn++;
                endforeach;
            }
            $html .= "<div class='btn btn-default btn-sm addChild' style='padding:4px' data-childlistid='" . $no . "' data-childno='" . $nn . "' ><i class='fas fa-layer-group'></i></div>"
                    . "</div><br>"
                    . "<div class='form-group form-group-sm input-list' id='child" . $no . "'><br>";


            $referal = ReferenceCaller($ref['parent_element_code'], $ref['doc_name_id'], 'child');
            if ($referal->data != null) {
                $input = ucwords(strtolower($ref['input_type']));
                $inputType = str_replace(' ', '', $input);
                $multipleAnswerData = array(
                    'is_parent' => false,
                    'label' => $ref['multi_answer_desc'],
                    'element_code' => (isset($ref['parent_element_code'])) ? $ref['parent_element_code'] : false,
                    'name' => '',
                    'type' => $inputType,
                    'data' => $referal->data
                );
                $listData = $multipleAnswerData;
                $referral = (object) $listData;

                $childno = 1;
                foreach ($referral->data as $ref):
                    $type = ucwords(strtolower($ref['input_type']));
                    $html .= "<div class='childno" . $no . "" . $childno . "'>"
                            . "<div class='form-group form-group-sm input-list'>"
                            . "<label class='control-label col-sm-5'></label>"
                            . "<div class='col-sm-3 list-padding-right'>"
                            . "<input type='hidden' name='childtotal" . $no . "' class='form-control' value='" . $childno . "' />"
                            . "<input type='text' name='child_multi_ans_desc" . $no . "" . $childno . "' class='form-control' value='" . $ref['multi_answer_desc'] . "' /></div>"
                            . "<div class='col-sm-3 list-padding-left' >"
                            . "<select name='child_multi_input_type" . $no . "" . $childno . "' class='form-control'>"
                            . "<option value='" . $ref['input_type'] . "'>" . $type . "</option>";
                    foreach ($result as $multi):
                    $html .= '<option value="'.$multi['input_type'].'">'.$multi['input_type'].'</option>';
                    endforeach;
                    $html .="</select></div>"
                            . "<div class='col-sm-1 childPredefinedActionButton' data-childlistid='" . $no . "" . $childno . "' >"
                            . "<div class='btn btn-default btn-sm childDeletePredefined' style='padding:4px' data-delid='" . $no . "" . $childno . "' data-num='" . $childno . "' data-parent='" . $no . "'  ><i class='glyphicon glyphicon-trash'></i></div>"
                            . "</div></div></div>";
                    $childno++;
                endforeach;
            }
            $html .= "</div></div></div><div class='form-group form-group-sm input-list'>"
                    . "<label class='control-label col-sm-4'></label>";

            $no++;
        endforeach;
    endif;
        $html .= "</div>";
        return $html;
    endif;
    }

}
