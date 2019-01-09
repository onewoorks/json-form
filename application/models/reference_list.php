<?php

class Reference_List_Model {
    
    public function __construct() {
        $this->db = new Mysql_Driver();
    }

    public function GetReferenceList($elementCode,$docNameId) {
        $sql = "SELECT rma.element_code, rde.element_desc,rma.multiple_desc_code, rma.multi_answer_desc, rma.input_type, rma.sorting, rma.parent_element_code,rma.child_element_code, rma.show_label, rmi.ref_element_code "
                . " FROM ref_multiple_answer rma "
                . " LEFT JOIN ref_document_element rde ON(rde.element_code = rma.element_code) "
                . " LEFT JOIN ref_multiple_item rmi ON(rmi.element_code=rma.element_code AND rmi.multi_answer_desc=rma.multi_answer_desc) "
                . " WHERE rma.element_code='" . (int) $elementCode . "' AND rma.doc_name_id='$docNameId' "
                . " GROUP BY rma.multi_answer_desc "
                . " ORDER BY rde.element_desc,rma.sorting ";
//         $sql = "SELECT rma.element_code,rde.element_desc,rma.multi_answer_desc,rma.input_type, rma.doc_name_id, rma.sorting, rma.parent_element_code, rmi.ref_element_code "
//                    ."FROM document_element de "
//                    ."INNER JOIN ref_multiple_answer rma ON(de.parent_element_code=rma.element_code) "
//                    ."INNER JOIN ref_document_element rde ON(rde.element_code=de.parent_element_code) "
//                    ."LEFT JOIN ref_multiple_item rmi ON(rmi.element_code=rma.element_code AND rmi.multi_answer_desc=rma.multi_answer_desc) "
//                    ."WHERE rma.element_code = '" . (int) $elementCode . "' AND rma.doc_name_id = '$docNameId' "
//                    ."GROUP BY rma.multi_answer_desc "
//                    ."ORDER BY rde.element_desc,rma.sorting ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
//    public function GetReferenceListInMultipleAnswer($elementCode,$docNameId) {
//        $sql = "SELECT rma.multi_answer_desc,rma.input_type, rma.method, rma.doc_name_id, rma.sorting "
//                . " FROM ref_multiple_answer rma"
//                . " WHERE rma.element_code = '" . (int) $elementCode . "'  AND rma.doc_name_id = '$docNameId' "
//                . " GROUP BY rma.multi_answer_desc"
//                . " ORDER BY rma.sorting";
////        echo $sql;
////        echo 'parent-id';
//        $this->db->connect();
//        $this->db->prepare($sql);
//        $this->db->queryexecute();
//        $result = $this->db->fetchOut('array');
//        return ($result) ? $result : false;
//    }
    
    public function GetReferenceListInMultipleAnswer($elementCode) {
        $sql = "SELECT element_code,element_desc FROM ref_document_element WHERE element_code = '" . (int) $elementCode . "' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
    public function GetChildMultipleAnswerList($elementCode,$docNameId){
        $sql= "SELECT a.element_code,a.ref_element_code,a.doc_name_id,c.element_desc,a.show_label,b.multiple_desc_code,b.multi_answer_desc,b.input_type,b.sorting,b.parent_element_code "  
                ."FROM ref_multiple_item a "
                ."LEFT JOIN ref_multiple_answer b ON(a.doc_name_id=b.doc_name_id AND a.element_code=b.element_code AND a.multi_answer_desc=b.multi_answer_desc) "
                ."LEFT JOIN ref_document_element c ON(c.element_code=a.ref_element_code) "
                ."WHERE a.element_code='" . (int) $elementCode . "' AND a.doc_name_id = '$docNameId' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }


}
