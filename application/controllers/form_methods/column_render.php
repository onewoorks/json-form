<?php

class Column_Render_Method {

    private $itemRows = array();

    function panel_column($data, $noOfColumn, $document_title, $document_id, $column) {
        $totalElement = 0;
        $classColumn = '';
        $elements = array();
        $columnArray = array();
        foreach ($data as $key => $element):
            $elements[] = $element;
            $totalElement++;
        endforeach;
        $eachElementColumn = $totalElement / $noOfColumn;
        $storeKey = 0;
        for ($i = 0; $i < $noOfColumn; $i++):
            $arr = '';
            for ($j = 0; $j < $eachElementColumn; $j++):
                $arr[] = $elements[$storeKey];
                $storeKey++;
            endfor;
            $columnArray[] = $arr;
        endfor;

        switch ($noOfColumn):
            case '1':
                $classColumn = 'col-md-12';
                break;
            case '2':
                $classColumn = 'col-md-6';
                break;
            case '3':
                $classColumn = 'col-md-4';
                break;
        endswitch;

        $html = '';
        $html .= '<div class="row">';
        for ($i = 0; $i < $noOfColumn; $i++):
            $html .= '<div class="' . $classColumn . '">' . self::Column_Element2($columnArray[$i], $document_title, $document_id, $column) . '</div>';
        endfor;

        $html .= '</div>';
        return $html;
    }

    function panel_render($data, $noOfColumn, $document_title, $document_id, $column) {
        #$data : apa yg ad dlm JSON ([input_type] => FREETEXT)
        #$noOfColumn : layout section (table ref_doc_sect)
        #$document_title :title doc
        #$document_id :title id
        #$column : sama mcm no of column

        $numrow = 0;
        $row_items = array();
        $cols = array();
        $classColumn = '';

        foreach ($data as $elem => $element):
            $cols[] = $elem;
            $row_items['row_' . $numrow][] = $element;
            $numrow++;
        endforeach;

        $render_result = array();

        foreach ($row_items as $y => $item):
            $rows = array();
            if (count($item) >= $noOfColumn):
                $rows = $this->column_data($item, $noOfColumn);
            else:
                $rows['column_0'] = $item;
            endif;

            $render_result[$y] = $rows;
        endforeach;

        $html = '';
        $html .= '<div class="row">';
        for ($i = 0; $i < $numrow; $i++):
            $html .= '<div class="">' . self::Column_Element($render_result['row_'.$i], $document_title, $document_id, $column) . '</div>';

        endfor;

        $html .= '</div>';
        return $html;
    }

    function panel_column2($data, $noOfColumn, $document_title, $document_id, $column) {

        $totalElement = 0;
        $classColumn = '';
        $elements = array();
        $item1 = array();

        foreach ($data as $key => $element):
            $elements[] = $element;
            $totalElement++;
        endforeach;

//        $meitem = array();
//        for ($i = 0; $i < $totalElement; $i++):
//            
//            if ($this->check_input_type($elements[$i])) {
//                $meitem['row_' . $numrow] = $this->column_data($elements, $noOfColumn);
//                $numrow++;
//            } else {
//                $meitem['row_' . $numrow] = $this->column_data($elements, $noOfColumn);
//            }
//        endfor;

        for ($i = 0; $i < $totalElement; $i++):
            if ($i % 2 == 0) {
                $item1[0][$i] = $elements[$i];
            } else {
                $item1[1][$i] = $elements[$i];
            }
        endfor;

        for ($r = 0; $r < $noOfColumn; $r++):
            $item1[$r];
        endfor;

        switch ($noOfColumn):
            case '1':
                $classColumn = 'col-md-12';
                break;
            case '2':
                $classColumn = 'col-md-6';
                break;
            case '3':
                $classColumn = 'col-md-4';
                break;
        endswitch;

        $html = '';

        for ($i = 0; $i < $noOfColumn; $i++):
            $html .= '<div class="' . $classColumn . '">' . self::Column_Element2($item1[$i], $document_title, $document_id, $column) . '</div>';
        endfor;

        return $html;
    }

    function Column_Element($data, $document_title, $document_id, $column) {

        $classColumn = '';
        $html = '';
        $element = $data['column_0'][0];

        if($this->check_input_type($element)):
            $classColumn = 'col-md-12';
//        else :
//            $colnum = 12/$column;
//            $classColumn = 'col-md-'. $colnum;
        endif;

//        echo '<pre>';
//        print_r($element);
//        echo '</pre>';

        #$element (list dlm json) eg:[input_type] => METHOD
        #$element->json_element (nama element)
        #$document_title
        #$document_id
        #$column (ambik dri ats)

        $html .= '<div class="' . $classColumn . '">';
        $html.= InputTypeCaller($element, $element->json_element, $document_title, $document_id, $column);
        $html .= "</div>";

        return $html;
    }

    function Column_Element2($data, $document_title, $document_id, $column) {
        $html = '';
        foreach ($data as $element):
            $html.= InputTypeCaller($element, $element->json_element, $document_title, $document_id, $column);
            $html .= '<br />';

        endforeach;
        return $html;
    }

    function column_data($data, $no_of_columns) {
        //multiplecolumns
        $items = array();
        $col_items = 0;
        $col = array();

        foreach ($data as $index => $element):
            $items[] = $element;
            $col_items++;
        endforeach;

        for ($i = 0; $i < $col_items; $i++):
         $col['column_'.$i][] = $items[$i];
        endfor;

        return $col;
    }

    function check_input_type($data) {
        $input_type = $data->input_type;
        $result = false;
        switch ($input_type):
            case 'RICHTEXT':
            case 'FREETEXT':
            case 'NUMBER':
                $result = true;
                break;
            case 'RADIOBUTTON':
                $result = true;
                break;
            case 'NUMERIC':
                $result = true;
                break;
            case 'ALPHANUMERIC':
                $result = true;
                break;
            case 'TEXTBOX':
                $result = true;
                break;
            case 'LABEL':
                $result = true;
                break;
            case 'CALENDER':
                $result = true;
                break;
            case 'DATE':
                $result = true;
                break;
            case 'TIME':
                $result = true;
                break;
            case 'METHOD':
                $result = true;
                break;
            default:
                $result = false;
        endswitch;

        return $result;
    }

}
