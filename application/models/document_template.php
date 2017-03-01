<?php

class Document_Template_Model {

    public $jsonForm;
    public $documentId;

    public function __construct() {
        $this->db = new Mysql_Driver();
    }

    public function ReadDocumentElementExisted() {
        $sql = "SELECT d.doc_name_id, d.doc_name_desc, gd.discipline_name,rdt.dc_type_desc,md.main_discipline_name, "
                . " (case when ((SELECT doc_name_id FROM document_template WHERE doc_name_id = d.doc_name_id) IS NULL) then false else true end) as available "
                . "FROM document_element de INNER JOIN document d ON(d.doc_name_id=de.doc_name_id) "
                . "INNER JOIN ref_document_section rds ON(rds.section_code=de.section_code) "
                . "INNER JOIN ref_document_element rde ON (rde.element_code=de.parent_element_code) "
                . "INNER JOIN discipline_document dd ON(d.doc_name_id=dd.doc_name_id) "
                . "INNER JOIN ref_document_element rdee ON (rdee.element_code=de.child_element_code) "
                . "LEFT JOIN ref_generaldisciplines gd ON(dd.discipline_code=gd.discipline_code) "
                . "LEFT JOIN ref_main_disciplines md ON(gd.main_discipline_code=md.main_discipline_code)"
                . "INNER JOIN ref_document_type rdt ON(rdt.dc_type_code=d.dc_type_code) GROUP BY de.doc_name_id ORDER BY gd.main_discipline_code,gd.discipline_name ASC";

        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }

    public function ReadDocumentTemplate($documentId) {
        $sql = "SELECT o.doc_name_desc, d.json_template, d.doc_name_id, d.template_id, gd.discipline_name, md.main_discipline_name"
                . " FROM document_template d"
                . " LEFT JOIN document o ON o.doc_name_id=d.doc_name_id"
                . " INNER JOIN discipline_document dd ON dd.doc_name_id=d.doc_name_id"
                . " LEFT JOIN ref_generaldisciplines gd ON gd.discipline_code=dd.discipline_code"
                . " LEFT JOIN ref_main_disciplines md ON md.main_discipline_code=gd.main_discipline_code"
                . " WHERE d.template_id='" . (int) $documentId . "' "
                . " AND d.active = 1";
//        echo $sql;
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result[0] : false;
    }

    public function ReadDocumentSetup($documentId) {
        $sql = "SELECT d.doc_name_desc,rds.section_desc,rdee.element_desc,rde.element_desc,de.input_type,de.data_type, "
                . " rds.json_section"
                . " FROM document_element de INNER JOIN document d ON(d.doc_name_id=de.doc_name_id) "
                . " INNER JOIN ref_document_section rds ON(rds.section_code=de.section_code)"
                . " INNER JOIN ref_document_element rde ON (rde.element_code=de.parent_element_code) "
                . " INNER JOIN ref_document_element rdee ON (rdee.element_code=de.child_element_code) "
                . " WHERE de.doc_name_id='" . (int) $documentId . "' "
                . " ORDER BY rds.section_desc,rdee.element_desc";
//        echo $sql;
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }

    public function ReadDocumentSectionGroup($documentId) {
        $sql = "SELECT d.doc_name_desc,rds.section_desc, rds.json_section, rds.section_code, rds.created_by, de.section_sorting"
                . " FROM document_element de "
                . " INNER JOIN document d ON(d.doc_name_id=de.doc_name_id)"
                . " INNER JOIN ref_document_section rds ON(rds.section_code=de.section_code)"
                . " INNER JOIN ref_document_element rde ON (rde.element_code=de.parent_element_code)"
                . " INNER JOIN ref_document_element rdee ON (rdee.element_code=de.child_element_code)"
                . " WHERE de.doc_name_id='" . (int) $documentId . "'"
                . " GROUP BY de.section_code"
                . " ORDER BY de.section_sorting";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }

    public function ReadDocumentSectionElements($documentId, $sectionId) {
        $sql = "SELECT  rde.element_code, rde.json_element,rde.element_desc,de.data_type,de.sorting,de.input_type, de.method, de.element_properties, de.additional_attribute"
                . " FROM document_element de"
                . " INNER JOIN document d ON(d.doc_name_id=de.doc_name_id)"
                . " INNER JOIN ref_document_section rds ON(rds.section_code=de.section_code)"
                . " INNER JOIN ref_document_element rde ON (rde.element_code=de.parent_element_code)"
                . " INNER JOIN ref_document_element rdee ON (rdee.element_code=de.child_element_code)"
                . " WHERE de.doc_name_id='" . (int) $documentId . "' and de.section_code='" . (int) $sectionId . "'"
                . " ORDER BY de.sorting";
//        echo $sql;
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }

    public function CreateDocumentJSONFormat() {
        $documentId = $this->documentId;
        $jsonForm = $this->jsonForm;
        $sql = "INSERT INTO document_template (doc_name_id,json_template,created_date) VALUES ('" . (int) $documentId . "','" . $jsonForm . "',now())";
        echo $sql;
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        
    }

    public function UpdateDocumentJSONFormat() {
        $documentId = $this->documentId;
        $jsonForm = $this->jsonForm;
        echo $jsonForm;
        $sql = "UPDATE document_template SET json_template = '$jsonForm' WHERE doc_name_id='" . (int) $documentId . "' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
    }

    public function GetListAvailableDocument() {
        $sql = "SELECT dt.template_id, dt.doc_name_id,rmd.main_discipline_name,rdt.dc_type_desc,d.doc_name_desc,gd.discipline_name,rdg.doc_group_desc "
                . "FROM document_template dt "
                . "INNER JOIN document d ON(dt.doc_name_id=d.doc_name_id) "
                . "INNER JOIN discipline_document dd ON(d.doc_name_id=dd.doc_name_id) "
                . "LEFT JOIN ref_generaldisciplines gd ON(dd.discipline_code=gd.discipline_code) "
                . "LEFT JOIN ref_main_disciplines rmd ON(rmd.main_discipline_code=gd.main_discipline_code) "
                . "INNER JOIN ref_document_type rdt ON(rdt.dc_type_code=d.dc_type_code)"
                . "INNER JOIN ref_document_group rdg ON(rdg.doc_group_code=rdt.doc_group_code)";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

        public function GetFilterListByGroupType($documentArray) {
        $discipline = $documentArray['discipline'];
        $subDiscipline = $documentArray['general_discipline'];
        $docGroup = $documentArray['doc_group'];
        if(isset($documentArray['doc_type'])){
        $docType = $documentArray['doc_type'];}else{ $docType =0; } 
        $sql = "SELECT dt.template_id, dt.doc_name_id,rmd.main_discipline_name,rdt.dc_type_desc,d.doc_name_desc,gd.discipline_name,rdg.doc_group_desc "
                . "FROM document_template dt "
                . "INNER JOIN document d ON(dt.doc_name_id=d.doc_name_id) "
                . "INNER JOIN discipline_document dd ON(d.doc_name_id=dd.doc_name_id) "
                . "LEFT JOIN ref_generaldisciplines gd ON(dd.discipline_code=gd.discipline_code) "
                . "LEFT JOIN ref_main_disciplines rmd ON(rmd.main_discipline_code=gd.main_discipline_code) "
                . "INNER JOIN ref_document_type rdt ON(rdt.dc_type_code=d.dc_type_code) "
                . "INNER JOIN ref_document_group rdg ON(rdg.doc_group_code=rdt.doc_group_code)"
                . "WHERE rmd.main_discipline_code = '$discipline' ";
                if($subDiscipline!="0"){
                    $sql.="AND gd.discipline_code = '$subDiscipline' ";
                }
                if($docType!="0"){
                    $sql.="AND d.dc_type_code = '$docType' ";
                }
                if($docGroup!="0"){
                    $sql.="AND d.doc_group_code = '$docGroup'";
                }
                $sql.="ORDER BY gd.main_discipline_code,gd.discipline_name ASC";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function GetSectionDetail($sectionCode) {
        $sql = "SELECT * FROM ref_document_section WHERE section_code='" . (int) $sectionCode . "' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }

    public function GetExistedDocumentJSONTemplate() {
        $sql = "SELECT doc_name_id FROM document_template";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function GetElementDetail($elementCode) {
        $sql = "SELECT rde.element_code, rde.json_element,rde.element_desc,de.data_type,de.sorting,de.input_type, de.method, de.element_properties, de.additional_attribute "
                . " FROM document_element de INNER JOIN document d ON(d.doc_name_id=de.doc_name_id) "
                . " INNER JOIN ref_document_section rds ON(rds.section_code=de.section_code) "
                . " INNER JOIN ref_document_element rde ON (rde.element_code=de.parent_element_code) "
                . " INNER JOIN ref_document_element rdee ON (rdee.element_code=de.child_element_code) "
                . " WHERE de.doc_name_id='1' and rde.element_code='" . (int) $elementCode . "'";     
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }

    public function UpdateSectionDetail(array $section) {
        $sql = "UPDATE ref_document_section SET section_desc='" . $section['section_desc'] . "' WHERE section_code='" . (int) $section['section_code'] . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
//    public function UpdateElementDetail($code, $name) {
//        $sql = "UPDATE ref_document_element SET element_desc='" . $name . "' WHERE element_code='" . (int) $code . "'";
//        $this->db->connect();
//        $this->db->prepare($sql);
//        $this->db->queryexecute();
//        return true;
//    }
//    
//    public function UpdateElementType($doc,$eid,$ep,$it,$dt) {
//        $sql = "UPDATE document_element SET element_properties='" . $ep . "',input_type='".$it."',data_type='".$dt."' WHERE doc_name_id='".(int) $doc."' AND parent_element_code='" . (int) $eid . "'";
//        $this->db->connect();
//        $this->db->prepare($sql);
//        $this->db->queryexecute();
//        return true;
//    }
    
    public function CreateNewInsertElement($insertSql) {
        $sql = $insertSql;
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function GetAvailableDocName() {
        $sql = "SELECT dd.doc_name_id"
                . " FROM document_element de"
                . " INNER JOIN document d ON(d.doc_name_id=de.doc_name_id)"
                . " INNER JOIN discipline_document dd ON(dd.doc_name_id=d.doc_name_id)"
                . " LEFT JOIN ref_generaldisciplines gd ON(gd.discipline_code=dd.discipline_code)"
                . " INNER JOIN ref_main_disciplines md ON(md.main_discipline_code=gd.main_discipline_code)"
                . " INNER JOIN ref_document_type rdt ON(rdt.dc_type_code=d.dc_type_code)"
                . " GROUP BY de.doc_name_id";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function GetAvailableTemplate() {
        $sql = "SELECT doc_name_id"
                . " FROM document_template"
                . " GROUP BY doc_name_id";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function InsertTestingData($na,$va){
        $sql = "INSERT INTO `test`(`name`, `value`)"
                ." VALUES ('" . $na . "','" . $va . "')";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    public function ViewTestingData(){
        $sql = "SELECT * FROM `test`";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;  
    }
    
    public function DeleteTestingData($id){
        $sql = "DELETE FROM `test`"
                ." WHERE `id`='" . $id . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    public function GetTestingData($id){
        $sql = "SELECT * FROM `test`"
                ."WHERE `id`='".$id."'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }
    
    public function UpdateTestingData(array $id){
        $sql = "UPDATE test SET name='" . $id['name'] . "', value='".$id['value']."' WHERE id='" . (int) $id['id'] . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true; 
    }

    public function DeleteTemplate($docNameId) {
        $sql = "DELETE FROM document_template WHERE doc_name_id = '$docNameId'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
}
