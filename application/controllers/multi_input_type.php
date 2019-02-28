<?php

class Multi_Input_Type_Controller extends Input_Type_Controller {

    public $childDetail;
    public $ref_element_code;

    public function MultiVerifyMethod($methodName) {
        $check = method_exists($this, $methodName);
        return $check;
    }

    public function CheckboxMulti() {
//        echo 'SAMPAI DI CheckboxMulti';
        $child = $this->childDetail;
        $ref_code = $this->ref_element_code;
//        echo '<pre>';
//        print_r($ref_code);
//        echo '</pre>';

        $html = "";

        if ($child):
            $html .= "<div class='col-sm-12 hidden' style='margin-left:16px' id='" . $ref_code . "'>";
            $html .= "<label class='control-label col-md-3 text-uppercase' style='font-weight:normal'></label>";
            $html .= "<div class='col-md-8'>";
            foreach ($child as $ref):
                $optionValue = $ref['multiple_desc'];
                $html .= "<div class='row'>";
                $html .= "<div class='col-md-12'>";
                $html .= "<div class='checkbox' >"
                        . "<label class='col-sm-4' style='margin-right:8px'>"
                        . "<input type='checkbox' "
                        . "value='$optionValue' data-ref='" . $ref['ref_element_code'] . "'/>" . $ref['multiple_desc']
                        . "</label>";
                if ($ref['ref_element_code'] !== NULL):
                    $html .= $this->checkC($ref['ref_element_code'], $ref['doc_name_id']);
                endif;
                $html .= "</div>";
                $html .= "</div>";
                $html .= "</div>";
            endforeach;
            $html .= "</div>";
            $html .= "</div>";
        endif;

        return $html;
    }

    public function RadiobuttonMulti() {
//        echo 'SAMPAI DI RadiobuttonMulti';
        $child = $this->childDetail;
        $ref_code = $this->ref_element_code;
//        echo '<pre>';
//        print_r($child);
//        echo '</pre>';
        $html = "";

        if ($child):
            $html .= "<div class='col-sm-12 hidden' style='margin-left:17px' id='" . $ref_code . "'>";
            $html .= "<div class='form-group form-group-sm' >";
            $html .= "<label class='control-label col-md-2 text-uppercase' style='font-weight:normal;'></label>";
            $html .= "<div class='radio col-sm-9' style='padding-bottom:5px'>";
            foreach ($child as $ref):
                $html .= "<label class='control-label' style='width:auto;padding-right:30px'><input type='radio' class='custom-control-input' data-ref='" . $ref['ref_element_code'] . "'>" . $ref['multiple_desc'] . "</label>";
            endforeach;
            if ($ref['ref_element_code'] !== NULL):
                $html .= $this->checkC($ref['ref_element_code'], $ref['doc_name_id']);
            endif;
            $html .= "</div>";
            $html .= "</div>";
            $html .= "</div>";
        endif;

        return $html;
    }

    public function DropdownMulti() {
//        echo 'SAMPAI DI DropdownMulti';
        $child = $this->childDetail;
        $ref_code = $this->ref_element_code;
//        echo '<pre>';
//        print_r($child);
//        echo '</pre>';
        $html = "";
        $output = "";

        if ($child):
            $html .= "<div class='col-sm-12 hidden' style='margin-left:17px;margin-top:5px' id='$ref_code'>";
            $html .= "<div class='form-group form-group-sm'>";
            $html .= "<label class='control-label col-md-2 text-uppercase' style='padding-bottom:5px;font-weight:normal'></label>";
            $html .= "<div class='col-md-3'>";
            $html .= "<div class='dropdown'>";
            $html .= "<select class='form-control selectList'>";
            $html .= "<option value='0'>Please Select</option>";
            foreach ($child as $ref):
                $refValue = $ref['ref_element_code'];
                $html .= "<option value='$refValue'>" . $ref['multiple_desc'] . "</option>";
                if ($ref['ref_element_code'] !== NULL):
                    $output = $this->checkC($ref['ref_element_code'], $ref['doc_name_id']);
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
        endif;

        return $html;
    }

    public function TextboxMulti() {
//        echo 'SAMPAI DI TextboxMulti';
        $child = $this->childDetail;
        $ref_code = $this->ref_element_code;
//        echo '<pre>';
//        print_r($child);
//        echo '</pre>';
        $html = "";

        if ($child):
            $html .= "<div class='col-sm-12 hidden' style='margin-left:2px' id='" . $ref_code . "'>";
            $html .= "<div class='form-group form-group-sm' >";
            foreach ($child as $ref):
                $html .= "<label class='control-label col-md-2 text-uppercase' style='font-weight:normal'>" . $ref['element_desc'] . "</label>";
            endforeach;
            $html .= "<div class='col-md-8' style='margin-left:7px'>"
                    . "<input type ='text' class='form-control' style='width:450px'>"
                    . "</div>"
                    . "</div>";
            $html .= "</div>";
        endif;

        return $html;
    }

    public function FreetextMulti() {
//        echo 'SAMPAI DI FreetextMulti';
        $child = $this->childDetail;
        $ref_code = $this->ref_element_code;
//        echo '<pre>';
//        print_r($child);
//        echo '</pre>';
        $html = "";

        if ($child):
            $html .= "<div class='col-sm-12 hidden' style='margin-left:1px' id='" . $ref_code . "'>";
            $html .= "<div class='form-group form-group-sm' >";
            $html .= "<label class='control-label col-md-2 text-uppercase' style='font-weight:normal'></label>";
            $html .= "<div class='col-md-8' style='margin-left:8px'>"
                    . "<textarea class='form-control' style='height: 50px;width:560px'></textarea>"
                    . "</div>"
                    . "</div>";
            $html .= "</div>";

            return $html;
        endif;
    }

}
