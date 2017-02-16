<?php

class Reference_List_Model {
    
    public function __construct() {
        $this->db = new Mysql_Driver();
    }

    public function GetReferenceList($elementCode,$docNameId) {
        $sql = "SELECT rde.element_desc,rma.multi_answer_desc,rma.input_type, rma.method, rma.parent_element_code, rma.doc_name_id "
                . " FROM document_element de"
                . " INNER JOIN ref_multiple_answer rma ON(de.parent_element_code=rma.element_code)"
                . " INNER JOIN ref_document_element rde ON(rde.element_code=de.parent_element_code)"
                . " WHERE rma.element_code = '" . (int) $elementCode . "' AND rma.doc_name_id = '$docNameId' "
                . " GROUP BY rma.multi_answer_desc"
                . " ORDER BY rde.element_desc,rma.sorting";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
    public function GetReferenceListInMultipleAnswer($elementCode,$docNameId) {
        $sql = "SELECT rma.multi_answer_desc,rma.input_type, rma.method, rma.doc_name_id "
                . " FROM ref_multiple_answer rma"
                . " WHERE rma.element_code = '" . (int) $elementCode . "'  AND rma.doc_name_id = '$docNameId' "
                . " GROUP BY rma.multi_answer_desc"
                . " ORDER BY rma.sorting";
        echo $sql;
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
    public function GetChildMultipleAnswerList($elementCode,$docNameId){
        $sql = "SELECT rma.multi_answer_desc,rma.input_type, rma.method, rma.doc_name_id "
                . " FROM ref_multiple_answer rma"
                . " WHERE rma.element_code = '" . (int) $elementCode . "'  AND rma.doc_name_id = '$docNameId' "
                . " GROUP BY rma.multi_answer_desc"
                . " ORDER BY rma.sorting";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }


}
