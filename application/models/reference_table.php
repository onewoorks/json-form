<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reference_Table_Model  { //dari class sini 

    public function __construct() {
        $this->db = new Mysql_Driver();
    }
    
    public function Discipline() {
        $sql = "SELECT main_discipline_code, main_discipline_name "
                . " FROM ref_main_disciplines ORDER BY main_discipline_name ASC";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
    public function GeneralDiscipline() {
        $sql = "SELECT discipline_code, discipline_name "
                . " FROM ref_generaldisciplines ORDER BY discipline_name ASC";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
    public function MainDiscipline() {
        $sql = "SELECT main_discipline_code, main_discipline_name "
                . " FROM ref_main_disciplines WHERE module='cd' ORDER BY main_discipline_name ASC";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
    public function MainDisciplineGroup(){
        $sql = "SELECT main_discipline_code as code, main_discipline_name as label "
                . " FROM ref_main_disciplines ";
        if(PROJECT_PATH == 'cd'):
        $sql .= "WHERE module='cd' ORDER BY main_discipline_name ASC ";
        elseif (PROJECT_PATH == 'rispac'):
        $sql .= "WHERE main_discipline_code = '08' ";
        elseif ((PROJECT_PATH == 'prod' || PROJECT_PATH == 'uat' || PROJECT_PATH == 'stg')):
        $sql .= "WHERE module='cd' ORDER BY main_discipline_name ASC ";
        endif;
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
    public function SubDisciplineGroup(){
        $sql = "SELECT discipline_code as code, discipline_name as label "
                . " FROM ref_generaldisciplines ORDER BY discipline_name ASC";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
    public function DocumentMainGroup(){
        $sql = "SELECT doc_group_code as code, doc_group_desc as label"
                . " FROM ref_document_group";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    //zarith-8/3 
    public function DocumentGroup() {
        $sql = "SELECT doc_group_code as code, doc_group_desc as label "
                . " FROM ref_document_group ";
        if(PROJECT_PATH == 'cd'):
        $sql .= "WHERE doc_group_code IN ('CN','RL','PS','PDS') ";
        elseif(PROJECT_PATH == 'rispac'):
        $sql .= "WHERE doc_group_code IN ('RR') ";
        elseif ((PROJECT_PATH == 'prod' || PROJECT_PATH == 'uat' || PROJECT_PATH == 'stg')):
        $sql .= "WHERE doc_group_code IN ('CN','RL','PDS')"; 
        endif;
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
//    public function DocumentType($groupCode = null) {
//        $sql = "SELECT dc_type_code as code, dc_type_desc as label"
//                . " FROM ref_document_type "
//                . " WHERE doc_group_code ='$groupCode'";
//        $this->db->connect();
//        $this->db->prepare($sql);
//        $this->db->queryexecute();
//        $result = $this->db->fetchOut('array');
//        return ($result) ? $result : false;
//    }
    //zarith-23/3 
    public function DocumentType($groupCode = null) {
        $sql = "SELECT dc_type_code as code, dc_type_desc as label"
                . " FROM ref_document_type ";
		if($groupCode == 'CN'):
		$sql .= "WHERE doc_group_code ='CN'";
                elseif($groupCode == 'PDS'):
		$sql .= "WHERE doc_group_code ='PDS'";
		else:
		$sql .= "WHERE doc_group_code ='RL' AND dc_type_code IN('RFL','RPL') ";
                endif;
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }

    public function DocumentTypeFiltering($groupCode) {
        $sql = "SELECT dc_type_code as code, dc_type_desc as label"
                . " FROM ref_document_type "
                . " WHERE doc_group_code = '$groupCode'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
    public function DocumentDisFiltering($disCode = null) {
        $sql = "SELECT discipline_code as code, discipline_name as label"
                . " FROM ref_generaldisciplines ";
        if(PROJECT_PATH == 'cd'):
        $sql .= "WHERE main_discipline_code = '$disCode' AND module = 'CD' ";
        elseif(PROJECT_PATH == 'rispac'):
        $sql .= "WHERE main_discipline_code = '$disCode' ";
        elseif ((PROJECT_PATH == 'prod' || PROJECT_PATH == 'uat' || PROJECT_PATH == 'stg')):
        $sql .= "WHERE main_discipline_code = '$disCode' AND module = 'CD' ";    
        endif;
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
    public function NcpDiagnosisFiltering($disCode = null) {
        $sql = "SELECT rma.element_code as code, rde.element_desc as label "
                . "FROM ref_multiple_answer rma "
                . "INNER JOIN ref_document_element rde ON(rde.element_code = rma.element_code) "
                . "INNER JOIN document d ON (d.doc_name_id = rma.doc_name_id) "
                . "WHERE rma.doc_name_id = '$disCode'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
     public function MainNcpDiagnosis(){
        $sql = "SELECT rma.element_code, rde.element_desc "
                . "FROM ref_multiple_answer rma "
                . "INNER JOIN ref_document_element rde ON(rde.element_code = rma.element_code) "
                . "INNER JOIN ref_multiple_desc rmd ON(rmd.multiple_desc_code = rma.multiple_desc_code) "
                . "INNER JOIN document d ON (d.doc_name_id = rma.doc_name_id) "
                . "WHERE d.doc_name_desc LIKE '%NURSING CARE PLAN%'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
 
}
