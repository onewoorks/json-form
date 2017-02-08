<?php

class Reference_List_Model {

    public function __construct() {
        $this->db = new Mysql_Driver();
    }

    public function GetReferenceList($elementCode) {
        $sql = "SELECT rde.element_desc,rma.multi_answer_desc,rma.input_type, rma.method, rma.parent_element_code"
                . " FROM document_element de"
                . " INNER JOIN ref_multiple_answer rma ON(de.parent_element_code=rma.element_code)"
                . " INNER JOIN ref_document_element rde ON(rde.element_code=de.parent_element_code)"
                . " WHERE rma.element_code = '" . (int) $elementCode . "'"
                . " GROUP BY rma.multi_answer_desc"
                . " ORDER BY rde.element_desc,rma.sorting";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
    public function GetReferenceListInMultipleAnswer($elementCode) {
        $sql = "SELECT rma.multi_answer_desc,rma.input_type, rma.method"
                . " FROM ref_multiple_answer rma"
                . " WHERE rma.element_code = '" . (int) $elementCode . "'"
                . " GROUP BY rma.multi_answer_desc"
                . " ORDER BY rma.sorting";
        echo $sql;
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
    public function GetChildMultipleAnswerList($elementCode){
        $sql = "SELECT rma.multi_answer_desc,rma.input_type, rma.method"
                . " FROM ref_multiple_answer rma"
                . " WHERE rma.element_code = '" . (int) $elementCode . "'"
                . " GROUP BY rma.multi_answer_desc"
                . " ORDER BY rma.sorting";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }


}
