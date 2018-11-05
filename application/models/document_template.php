<?php

class Document_Template_Model {

    public $jsonForm;
    public $documentId;

    public function __construct() {
        $this->db = new Mysql_Driver();
    }

    public function ReadDocumentElementExisted() {
       $sql = "SELECT d.doc_name_id, d.doc_name_desc, gd.discipline_name,rdt.dc_type_desc,md.main_discipline_name, "
               . "(case when (SELECT doc_name_id FROM document_template WHERE doc_name_id = d.doc_name_id IS NULL) then false else true end) as available "
               // . "(case when ((SELECT doc_name_id FROM document_template WHERE doc_name_id = d.doc_name_id) IS NULL) then false else true end) as available "
                . "FROM document_element de INNER JOIN document d ON(d.doc_name_id=de.doc_name_id) "
                . "INNER JOIN ref_document_section rds ON(rds.section_code=de.section_code) "
                . "INNER JOIN ref_document_element rde ON (rde.element_code=de.parent_element_code) "
                . "INNER JOIN discipline_document dd ON(d.doc_name_id=dd.doc_name_id) "
                . "INNER JOIN ref_document_element rdee ON (rdee.element_code=de.child_element_code) "
                . "LEFT JOIN ref_generaldisciplines gd ON(dd.discipline_code=gd.discipline_code) "
                . "LEFT JOIN ref_main_disciplines md ON(gd.main_discipline_code=md.main_discipline_code)"
                . "INNER JOIN ref_document_type rdt ON(rdt.dc_type_code=d.dc_type_code)" 
                . "INNER JOIN ref_document_group rdg ON(rdg.doc_group_code=rdt.doc_group_code)"
                . "GROUP BY de.doc_name_id ORDER BY gd.main_discipline_code,gd.discipline_name ASC"; 
              
//          $sql = "SELECT  dt.doc_name_id,rmd.main_discipline_name,rdt.dc_type_desc,d.doc_name_desc,gd.discipline_name,rdg.doc_group_desc "
//             . " (case when ((SELECT doc_name_id FROM document_template WHERE doc_name_id = dt.doc_name_id) IS NULL) then false else true end) as available "
//             . " FROM document_element dt"
//             . " LEFT JOIN document d ON(dt.doc_name_id=d.doc_name_id)"
//             . " LEFT JOIN discipline_document dd ON(d.doc_name_id=dd.doc_name_id)"
//             . " LEFT JOIN ref_generaldisciplines gd ON(dd.discipline_code=gd.discipline_code)"
//             . " LEFT JOIN ref_main_disciplines rmd ON(rmd.main_discipline_code=gd.main_discipline_code)"
//             . " LEFT JOIN ref_document_type rdt ON(rdt.dc_type_code=d.dc_type_code)"
//             . " LEFT JOIN ref_document_group rdg ON(rdg.doc_group_code=rdt.doc_group_code)"
//             . " WHERE rmd.main_discipline_code = '50'"
//             . " GROUP BY 1";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    public function ReadElementExisted($generateArray) {
       $discipline = $generateArray['discipline'];
       if(isset($generateArray['general_discipline'])){
       $subDiscipline = $generateArray['general_discipline'];}else{ $subDiscipline =0; } 
       $docGroup = $generateArray['doc_group'];
       if(isset($generateArray['doc_type'])){
       $docType = $generateArray['doc_type'];} else { $docType =0;}
       $sql = "SELECT d.doc_name_id, d.doc_name_desc, gd.discipline_name,rdt.dc_type_desc,md.main_discipline_name, "
                . "(CASE WHEN ((SELECT DISTINCT doc_name_id FROM document_template WHERE doc_name_id = d.doc_name_id) IS NULL) THEN FALSE ELSE TRUE END) as available "
                . "FROM document_element de INNER JOIN document d ON(d.doc_name_id=de.doc_name_id) "
                . "INNER JOIN ref_document_section rds ON(rds.section_code=de.section_code) "
                . "INNER JOIN ref_document_element rde ON (rde.element_code=de.parent_element_code) "
                . "INNER JOIN discipline_document dd ON(d.doc_name_id=dd.doc_name_id) "
                . "INNER JOIN ref_document_element rdee ON (rdee.element_code=de.child_element_code) "
                . "LEFT JOIN ref_generaldisciplines gd ON(dd.discipline_code=gd.discipline_code) "
                . "LEFT JOIN ref_main_disciplines md ON(gd.main_discipline_code=md.main_discipline_code)"
                . "INNER JOIN ref_document_type rdt ON(rdt.dc_type_code=d.dc_type_code)" 
                . "INNER JOIN ref_document_group rdg ON(rdg.doc_group_code=rdt.doc_group_code)"
                . "WHERE gd.main_discipline_code = '$discipline' AND rdg.doc_group_code IN ('CN','PS','RL') ";
                    if($discipline!="0"){
                         $sql.="AND gd.main_discipline_code = '$discipline' ";
                     }
                    if($subDiscipline!="0"){
                        $sql.="AND gd.discipline_code = '$subDiscipline'";
                    }
                    if($docType!="0"){
                        $sql.="AND d.dc_type_code = '$docType' ";
                    }
                    if($docGroup!="0"){
                        $sql.="AND rdt.doc_group_code = '$docGroup' ";
                    }
                    $sql.="GROUP BY de.doc_name_id ORDER BY gd.main_discipline_code,gd.discipline_name ASC"; 
                    
//        $sql = "SELECT d.doc_name_id, dt.template_id, d.doc_name_desc, gd.discipline_name,rdt.dc_type_desc,md.main_discipline_name, "
//                . "(case when ((SELECT doc_name_id FROM document_template WHERE doc_name_id = d.doc_name_id ) IS NULL) then false else true end) as available "
//                . "FROM document_element de INNER JOIN document d ON(d.doc_name_id=de.doc_name_id) "
//                . "INNER JOIN document_template dt ON (dt.doc_name_id=d.doc_name_id) "
//                . "INNER JOIN ref_document_section rds ON(rds.section_code=de.section_code) "
//                . "INNER JOIN ref_document_element rde ON (rde.element_code=de.parent_element_code) "
//                . "INNER JOIN discipline_document dd ON(d.doc_name_id=dd.doc_name_id) "
//                . "INNER JOIN ref_document_element rdee ON (rdee.element_code=de.child_element_code) "
//                . "LEFT JOIN ref_generaldisciplines gd ON(dd.discipline_code=gd.discipline_code) "
//                . "LEFT JOIN ref_main_disciplines md ON(gd.main_discipline_code=md.main_discipline_code)"
//                . "INNER JOIN ref_document_type rdt ON(rdt.dc_type_code=d.dc_type_code)" 
//                . "INNER JOIN ref_document_group rdg ON(rdg.doc_group_code=rdt.doc_group_code)"
//                . "WHERE gd.main_discipline_code = '$discipline' ";
//                    if($subDiscipline!="0"){
//                        $sql.="AND gd.discipline_code = '$subDiscipline'";
//                    }
//                    if($docType!="0"){
//                        $sql.="AND d.dc_type_code = '$docType' ";
//                    }
//                    if($docGroup!="0"){
//                        $sql.="AND rdt.doc_group_code = '$docGroup' ";
//                    }
//                    $sql.="GROUP BY de.doc_name_id ORDER BY gd.main_discipline_code,gd.discipline_name ASC";             
                    
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    public function NakTengokJson($documentId){
        $sql = "SELECT o.doc_name_desc, d.json_template, d.doc_name_id, d.template_id, gd.discipline_name, md.main_discipline_name"
                . " FROM document_template d"
                . " LEFT JOIN document o ON o.doc_name_id=d.doc_name_id"
                . " INNER JOIN discipline_document dd ON dd.doc_name_id=d.doc_name_id"
                . " LEFT JOIN ref_generaldisciplines gd ON gd.discipline_code=dd.discipline_code"
                . " LEFT JOIN ref_main_disciplines md ON md.main_discipline_code=gd.main_discipline_code"
                . " WHERE d.doc_name_id='" . (int) $documentId . "' "
                . " AND d.active = 1";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result[0] : false;    
    }
    
    public function GetElementSorting($section_code,$document_id){
        $sql = "SELECT MAX(sorting) AS newsorting FROM document_element WHERE section_code=".(int)$section_code." AND doc_name_id=".(int)$document_id." ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }

    public function ReadDocumentTemplate($templateId) {
        $sql = "SELECT o.doc_name_desc, d.json_template, d.doc_name_id, d.template_id, gd.discipline_name, md.main_discipline_name, rdg.doc_group_code"
                . " FROM document_template d"
                . " LEFT JOIN document o ON o.doc_name_id=d.doc_name_id"
                . " INNER JOIN discipline_document dd ON dd.doc_name_id=d.doc_name_id"
                . " LEFT JOIN ref_generaldisciplines gd ON gd.discipline_code=dd.discipline_code"
                . " LEFT JOIN ref_main_disciplines md ON md.main_discipline_code=gd.main_discipline_code"
                . " INNER JOIN ref_document_group rdg ON rdg.doc_group_code=o.doc_group_code "
                . " WHERE d.template_id='" . (int) $templateId . "' "
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
        $sql = "SELECT d.doc_name_desc,rds.section_desc, rds.json_section,rds.layout, rds.section_code, rds.created_by, de.section_sorting"
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
        $sql = "SELECT  rde.element_code, rde.json_element,rde.element_desc,de.child_element_code,de.element_level,de.data_type,de.sorting,de.input_type, de.method, de.doc_method_code, de.element_position, de.element_properties, de.additional_attribute, de.show_label, de.element_tooltips, de.element_hint, de.file_type_code, de.section_tooltips, de.sec_file_type_code, de.image_name_id, de.mandatory_flag "
                . " FROM document_element de"
                . " INNER JOIN document d ON(d.doc_name_id=de.doc_name_id)"
                . " INNER JOIN ref_document_section rds ON(rds.section_code=de.section_code)"
                . " INNER JOIN ref_document_element rde ON (rde.element_code=de.parent_element_code)"
                . " INNER JOIN ref_document_element rdee ON (rdee.element_code=de.child_element_code)"
                . " WHERE de.doc_name_id='" . (int) $documentId . "' AND de.section_code='" . (int) $sectionId . "' AND de.active = 1 "
                . " ORDER BY de.sorting";
//        echo $sql;
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }

    public function CreateDocumentJSONFormat($documents) {
        $jsonForm = $this->jsonForm;
        $docNameId = $documents['doc_name_id'];        
        $newLine = array('\r\n', '\n', '\r');
        $replace = '<br />';
        $json = str_replace($newLine, $replace, $jsonForm);
        $jsonDoc = addslashes($json);
            echo '<pre>';
            print_r($jsonDoc);
            echo '</pre>';
        $sql = "INSERT INTO document_template SET "
                . "doc_name_id = '".(int)$docNameId."',"
                . "json_template = '$jsonDoc', "
                . "created_date = now(), "
                . "created_by = 'ADMIN' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
        
    }

    public function GetListAvailableDocument() {
        $sql = "SELECT dt.template_id, dt.doc_name_id,rmd.main_discipline_name,rdt.dc_type_desc,d.doc_name_desc,gd.discipline_name,rdg.doc_group_desc "
                . "FROM document_template dt "
                . "INNER JOIN document d ON(dt.doc_name_id=d.doc_name_id) "
                . "INNER JOIN discipline_document dd ON(d.doc_name_id=dd.doc_name_id) "
                . "LEFT JOIN ref_generaldisciplines gd ON(dd.discipline_code=gd.discipline_code) "
                . "LEFT JOIN ref_main_disciplines rmd ON(rmd.main_discipline_code=gd.main_discipline_code) "
                . "INNER JOIN ref_document_type rdt ON(rdt.dc_type_code=d.dc_type_code)"
                . "INNER JOIN ref_document_group rdg ON(rdg.doc_group_code=rdt.doc_group_code)"
                . "WHERE rmd.module='cd' AND rdg.doc_group_code IN ('CN','RL','PS')";
        
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

        public function GetFilterListByGroupType($documentArray) {
        $discipline = $documentArray['discipline'];
//        $subDiscipline = $documentArray['general_discipline'];
        if(isset($documentArray['general_discipline'])){
        $subDiscipline = $documentArray['general_discipline'];}else{ $subDiscipline =0; } 
        $docGroup = $documentArray['doc_group'];
        if(isset($documentArray['doc_type'])){
        $docType = $documentArray['doc_type'];}else{ $docType =0; } 
        $sql = "SELECT dt.template_id, d.active_status, dt.doc_name_id,rmd.main_discipline_name,rdt.dc_type_desc,d.doc_name_desc,gd.discipline_name,rdg.doc_group_desc,rdg.doc_group_code "
                . "FROM document_template dt "
                . "INNER JOIN document d ON(dt.doc_name_id=d.doc_name_id) "
                . "INNER JOIN discipline_document dd ON(d.doc_name_id=dd.doc_name_id) "
                . "LEFT JOIN ref_generaldisciplines gd ON(dd.discipline_code=gd.discipline_code) "
                . "LEFT JOIN ref_main_disciplines rmd ON(rmd.main_discipline_code=gd.main_discipline_code) "
                . "INNER JOIN ref_document_type rdt ON(rdt.dc_type_code=d.dc_type_code) "
                . "INNER JOIN ref_document_group rdg ON(rdg.doc_group_code=rdt.doc_group_code)"
                . "WHERE rmd.main_discipline_code = '$discipline' AND rdg.doc_group_code IN ('CN','RL','PS')" ;
                if($discipline!="0"){
                    $sql.="AND gd.main_discipline_code = '$discipline' ";
                }
                if($subDiscipline!="0"){
                    $sql.="AND gd.discipline_code = '$subDiscipline' ";
                }
                if($docType!="0"){
                    $sql.="AND d.dc_type_code = '$docType' ";
                }
                if($docGroup!="0"){
                    $sql.="AND d.doc_group_code = '$docGroup'";
                }
                $sql.="AND d.active_status='1' ORDER BY COALESCE(dt.updated_date,dt.created_date) DESC";
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
    
    public function GetSectionSorting($section,$doc){
        $sql = "SELECT section_sorting FROM document_element WHERE section_code='" . (int) $section . "' AND doc_name_id='" . (int) $doc . "' GROUP BY section_code ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];       
    }
    
    public function GetMaxElementCode(){
        $sql = "SELECT MAX(element_code) AS maxcode FROM ref_document_element";
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

    public function GetElementDetail($elementCode,$documentId) {
        $sql = "SELECT rde.element_code, rde.json_element,rde.element_desc,de.child_element_code,de.data_type,de.sorting,de.input_type, de.method,de.doc_method_code,de.element_position, de.element_properties, de.additional_attribute "
                . " FROM document_element de INNER JOIN document d ON(d.doc_name_id=de.doc_name_id) "
                . " INNER JOIN ref_document_section rds ON(rds.section_code=de.section_code) "
                . " INNER JOIN ref_document_element rde ON (rde.element_code=de.parent_element_code) "
                . " INNER JOIN ref_document_element rdee ON (rdee.element_code=de.child_element_code) "
//                . " LEFT JOIN ref_document_method rdm ON (rdm.doc_method_code=de.doc_method_code) "
                . " WHERE de.doc_name_id='" . (int) $documentId . "' and rde.element_code='" . (int) $elementCode . "'";     
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }
    
    public function GetElementGrouping($sectionCode, $documentId){
        $sql = "SELECT rde.element_code, rde.element_desc "
                . " FROM document_element de INNER JOIN document d ON(d.doc_name_id=de.doc_name_id) "
                . " INNER JOIN ref_document_section rds ON(rds.section_code=de.section_code) "
                . " INNER JOIN ref_document_element rde ON (rde.element_code=de.parent_element_code) "
                . " INNER JOIN ref_document_element rdee ON (rdee.element_code=de.child_element_code) "
                . " WHERE rds.section_code='".(int) $sectionCode ."' AND de.doc_name_id='".(int) $documentId."' AND de.parent_element_code=de.child_element_code";     
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function GetLayoutDetail($docId){
        $sql = "SELECT DISTINCT rds.layout"
                . " FROM ref_document_section rds INNER JOIN document_element de ON (rds.section_code=de.section_code)"
                . " WHERE de.doc_name_id='" . (int) $docId . "'"; 
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0]; 
    }
    
    public function GetTitleDetail($docId){
        $sql = "SELECT doc_name_id, doc_name_desc"
                . " FROM document"
                . " WHERE doc_name_id='" . (int) $docId . "'"; 
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0]; 
    }
    
    public function GetTitleId($docId){
        $sql = "SELECT DISTINCT doc_name_id, doc_name_desc FROM document WHERE doc_name_id='" . (int) $docId . "'"; 
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result; 
    }
    //18JULAI
    public function InsertDocId($subDis,$docGroup,$docType,$titleDesc){
        if(is_string($subDis)):
        $sql = " INSERT INTO document (doc_group_code, dc_type_code, doc_name_desc, created_by, created_date) "
                . " VALUES ('".(string)$docGroup."', '".(string)$docType."', '$titleDesc', 'ADMIN', now()) ;"
                . " INSERT INTO discipline_document (discipline_code, doc_name_id, favourite, status, created_by, created_date) "
                . " VALUES ('".(string)$subDis."', (SELECT MAX(doc_name_id) FROM document AS doc_name_id), (NULL), '1', 'ADMIN', now())";    
        else:
        $sql = " INSERT INTO document (doc_group_code, dc_type_code, doc_name_desc, created_by, created_date) "
                . " VALUES ('".(string)$docGroup."', '".(string)$docType."', '$titleDesc', 'ADMIN', now()) ;"
                . " INSERT INTO discipline_document (discipline_code, doc_name_id, favourite, status, created_by, created_date) "
                . " VALUES ('".(int)$subDis."', (SELECT MAX(doc_name_id) FROM document AS doc_name_id), (NULL), '1', 'ADMIN', now())";
        endif;
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true; 
    }
     //19JULAI
     public function InsertSecId($layout, $secDesc){
        $sectionDesc = strtoupper($secDesc);
        $replace = str_replace(' ', '_', $sectionDesc);
        $str = strtolower(preg_replace('/[^a-zA-Z0-9_]/','',$replace));
        $jsonSection = preg_replace('/_+/', '_', $str);
//        $sql = " SELECT COUNT(section_desc) FROM ref_document_section WHERE section_desc LIKE '%$sectionDesc%' ";
        $sql = " INSERT INTO ref_document_section (section_code, section_desc, json_section, layout, active_status, created_by, created_date) "
                . " VALUES ((SELECT MAX(section_code)+1 FROM ref_document_section AS section_code), '$sectionDesc', '$jsonSection', '$layout', '1', 'ADMIN', NOW()) "; 
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    //23JULAI
    public function InsertElementId($elementDesc){
        $replace = str_replace(' ', '_', $elementDesc);
        $str = strtolower(preg_replace('/[^a-zA-Z0-9_]/','',$replace));
        $jsonElement = preg_replace('/_+/', '_', $str);
        $sql = " INSERT INTO ref_document_element (element_desc, json_element, active_status, created_by, created_date) "
                . " VALUES ('$elementDesc', '$jsonElement', '1', 'ADMIN', NOW()) "; 
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
     //20JULAI
    public function searchSecDesc($search){
        $sql = " SELECT section_code, section_desc, json_section, layout, active_status FROM ref_document_section WHERE section_desc LIKE '%$search%' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result; 
    }
    
    //5OKT
    public function searchTitleDesc($search){
        $sql = " SELECT doc_name_id, doc_name_desc FROM document WHERE doc_name_desc LIKE '%$search%' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result; 
    }
    //26JULAI
    public function ListDocDesc(){
        $sql = " SELECT doc_name_id, doc_name_desc FROM document ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result; 
    }
    //26JULAI
//    public function ListSecDesc(){
//        $sql = " SELECT section_code, section_desc FROM ref_document_section ";
//        $this->db->connect();
//        $this->db->prepare($sql);
//        $this->db->queryexecute();
//        $result = $this->db->fetchOut('array');
//        return $result;
//    }
    //26JULAI
    public function ListElementDesc(){
        $sql = " SELECT element_code, element_desc, json_element FROM ref_document_element ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    //23JULAI
    public function searchElement($search){
        $sql = " SELECT element_code, element_desc, json_element, active_status FROM ref_document_element WHERE element_desc LIKE '%$search%' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result; 
    }
    //19JULAI
    public function GetAllSecDesc(){
        $sql = " SELECT section_code, section_desc, json_section, layout, active_status FROM ref_document_section ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function GetAllTitle(){
        $sql = " SELECT doc_name_id, doc_name_desc FROM document ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    //23JULAI
//    public function GetSecDesc(){
//        $sql = " SELECT section_desc FROM ref_document_section ";
//        $this->db->connect();
//        $this->db->prepare($sql);
//        $this->db->queryexecute();
//        $result = $this->db->fetchOut('array');
//        return $result;
//    }
    //23JULAI
    public function GetAllElementDesc(){
        $sql = " SELECT element_code, element_desc, json_element, active_status FROM ref_document_element ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function GetSectionId($docId){
        $sql = "SELECT DISTINCT section_code FROM document_element WHERE doc_name_id='" . (int) $docId . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;  
    }
    
    public function UpdateDocLayout($code,$layout){
        $sql = "UPDATE ref_document_section SET layout='".$layout."' WHERE section_code='".(int) $code ."'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    public function UpdateDocTitle($code, $title){
        $sql = "UPDATE document SET doc_name_desc='".$title."' WHERE doc_name_id='".(int) $code ."'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    //9AUG
    public function copyBaru($docName,$curName){
        $sql = "INSERT INTO document (doc_group_code, dc_type_code, doc_name_desc, active_status, created_date, created_by) "
                ."SELECT doc_group_code, dc_type_code, '$docName', '1', NOW(), 'ADMIN' "
                ."FROM document "
                ."WHERE doc_name_id = '".(int) $curName."' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $sql= "INSERT INTO document_template (doc_name_id, json_template, text_template, report_name, active, created_date, created_by) "
                ."SELECT (SELECT MAX(doc_name_id) FROM document), json_template, text_template, report_name, active, NOW(),'ADMIN' "
                ."FROM document_template "
                ."WHERE doc_name_id = '".(int) $curName."' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $sql = "INSERT INTO discipline_document (discipline_code, doc_name_id, favourite, doc_sorting, gender_code, age_from, age_to, created_date, created_by) "
                ."SELECT discipline_code, (SELECT MAX(doc_name_id) FROM document), favourite, doc_sorting, gender_code, age_from, age_to, NOW(),'ADMIN' "
                ."FROM discipline_document "
                ."WHERE doc_name_id = '".(int) $curName."' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $sql = "INSERT INTO document_element (doc_name_id, section_code, parent_element_code, child_element_code, sorting, section_sorting, section_tooltips, sec_file_type_code, element_level, element_position, element_layout, element_properties, input_type, data_type, element_type_code, doc_method_code, method, additional_attribute, element_tooltips, element_hint, file_type_code, show_label, image_name_id, image_path, component_flag, mandatory_flag, active, created_date, created_by) "
                ."SELECT (SELECT MAX(doc_name_id) FROM document), section_code, parent_element_code, child_element_code, sorting, section_sorting, section_tooltips, sec_file_type_code, element_level, element_position, element_layout, element_properties, input_type, data_type, element_type_code, doc_method_code, method, additional_attribute, element_tooltips, element_hint, file_type_code, show_label, image_name_id, image_path, component_flag, mandatory_flag, '1', NOW(),'ADMIN' "
                ."FROM document_element "
                ."WHERE doc_name_id = '".(int) $curName."' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $sql = "INSERT INTO ref_multiple_answer (doc_name_id, element_code, multiple_desc_code, sorting, input_type, method, parent_element_code, child_element_code, element_tooltips, element_hint, file_type_code, image_path, component_flag, show_label, active, created_date, created_by, multi_answer_desc) "
                ."SELECT (SELECT MAX(doc_name_id) FROM document), element_code, multiple_desc_code, sorting, input_type, method, parent_element_code, child_element_code, element_tooltips, element_hint, file_type_code, image_path, component_flag, show_label, '1', NOW(),'ADMIN', multi_answer_desc "
                ."FROM ref_multiple_answer "
                ."WHERE doc_name_id = '".(int) $curName."' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $sql = "INSERT INTO ref_multiple_item (doc_name_id, element_code, multiple_desc_code, ref_element_code, show_label, element_tooltips, element_hint, file_type_code, created_date, created_by, multi_answer_desc) "
                ."SELECT (SELECT MAX(doc_name_id) FROM document), element_code, multiple_desc_code, ref_element_code, show_label, element_tooltips, element_hint, file_type_code, NOW(),'ADMIN', multi_answer_desc "
                ."FROM ref_multiple_item "
                ."WHERE doc_name_id = '".(int) $curName."' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    //10AUG
//        public function GetMaxTemplate(){
//        $sql = "SELECT template_id "
//                ."FROM document_template ";
//        $this->db->connect();
//        $this->db->prepare($sql);
//        $this->db->queryexecute();
//        $result = $this->db->fetchOut('array');
//        return $result; 
//    } 
//        public function GetMaxTemplate($docName){
//        $sql = "SELECT dt.template_id "
//                ."FROM document_template dt "
//                ."INNER JOIN document d ON (d.doc_name_id=dt.doc_name_id) "
//                ."WHERE d.doc_name_desc='$docName' ";
//        $this->db->connect();
//        $this->db->prepare($sql);
//        $this->db->queryexecute();
//        $result = $this->db->fetchOut('array');
//        return $result; 
//    } 
    public function GetMaxTemplate(){
        $sql = "SELECT MAX(template_id) + 1 AS template_id FROM document_template ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result; 
    }   
    //1AUG
    public function generateBaru($value,$value2){
//        $test = json_encode($value2);
//        print_r($test);
        $sql = "INSERT INTO document_element(doc_name_id, section_code, sorting, section_sorting,parent_element_code, created_by, created_date) "
                . "VALUES((SELECT doc_name_id FROM document WHERE doc_name_desc='$value'), (SELECT section_code FROM ref_document_section WHERE section_desc='$value2'), '2', '2', '3611' , 'ADMIN', now()) ";
//        (SELECT DISTINCT de.parent_element_code FROM ref_document_element rde LEFT JOIN document_element de ON(de.parent_element_code=rde.element_code) WHERE rde.element_desc='$value3')
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
//        $result = $this->db->fetchOut('array');
//        return $result; 
    }
    
//    public function InsertDocTitle($docGroup,$docType,$docDesc,$status){
//        $sql = "INSERT INTO document (doc_group_code, dc_type_code, doc_name_desc, active_status, created_by, created_date) "
//                . "VALUES ('.$docGroup.','.$docType.','.$docDesc.','.$status.','ADMIN','now()');";
//        $this->db->connect();
//        $this->db->prepare($sql);
//        $this->db->queryexecute();
//        return true;
//    }
    
    public function GetChildDetail($doc,$element) {
        $sql = "SELECT parent_element_code FROM ref_multiple_answer "
                . " WHERE doc_name_id='" . (int)$doc. "' and element_code='" . (int) $element. "'";  
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function UpdateSectionDetail(array $section) {
        $sql = "UPDATE ref_document_section SET "
                . "section_desc='" . $section['section_desc'] . "',"
                . "layout='".$section['layout']."' "
                . "WHERE section_code='" . (int) $section['section_code'] . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    //update element name
    public function UpdateElementName($code, $name) {
        $sql = "UPDATE ref_document_element SET element_desc='" . $name . "' WHERE element_code='" . (int) $code . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    public function UpdateElementDetails(array $val) {
        $sql = "UPDATE document_element SET child_element_code='".(int) $val['element_group']."',element_position='" . $val['element_position'] . "',element_properties='" . $val['element_properties'] . "',input_type='" . $val['input_type'] . "',data_type='" . $val['data_type'] . "',method='" . $val['method'] . "',additional_attribute='".$val['json']."' "
                . "WHERE doc_name_id='".(int) $val['doc_id']."' AND parent_element_code='" . (int) $val['element_code'] . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    public function UpdateMethodDetails(array $val) {
        $sql = "UPDATE document_element SET child_element_code='".(int) $val['element_group']."',element_position='" . $val['element_position'] . "',element_properties='" . $val['element_properties'] . "',input_type='" . $val['input_type'] . "',data_type='" . $val['data_type'] . "',method='" . $val['method_info'] . "',doc_method_code='" . (int) $val['doc_method_code'] . "',additional_attribute='".$val['json']."' "
                . "WHERE doc_name_id='".(int) $val['doc_id']."' AND parent_element_code='" . (int) $val['element_code'] . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
       
    public function UpdateElementToBasic(array $val) {
        if(isset($val['doc_method_code'])):
            $methodCodes = $val['doc_method_code'];
        endif;
        if(isset($val['data_type'])):
            $data_type = $val['data_type'];
        endif;
        $sql = "UPDATE document_element SET child_element_code='".(int) $val['child_element_code']."', element_position='" . $val['element_position'] . "', element_properties='" . $val['element_properties'] . "', input_type='" . $val['input_type'] . "', data_type = $data_type, method=(SELECT method_info FROM ref_document_method WHERE doc_method_code=$methodCodes), doc_method_code=$methodCodes "
                ."WHERE doc_name_id='".(int) $val['doc_name_id']."' AND parent_element_code='" . (int) $val['element_code'] . "' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    public function CleanMultipleAnswer(array $val){
        $sql = "DELETE FROM ref_multiple_answer WHERE doc_name_id='".(int) $val['documentId']."' AND element_code='". (int) $val['elementCode'] ."'";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    public function CleanChild($docID,$elementID){
        $sql = "DELETE FROM ref_multiple_answer WHERE doc_name_id='".(int) $docID."' AND element_code='". (int) $elementID ."'";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    public function InsertMultiAnswer($docID,$elementID,$mult){
        if(isset($mult['parent_element_code'])):
            $parent = $mult['parent_element_code'];
        endif;
        if(isset($mult['child_element_code'])):
            $child = $mult['child_element_code'];
        endif;
        $sql = "INSERT INTO ref_multiple_answer (doc_name_id, element_code, multiple_desc_code, sorting, input_type, parent_element_code, child_element_code, active, created_by, created_date, multi_answer_desc) "
                . "VALUES ('".(int) $docID."', '".(int) $elementID."', (SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc='".$mult['multiple_desc']."'), '".(int) $mult['sorting']."', '".$mult['input_type']."', $parent , $child, '1', 'ADMIN', NOW(), '".$mult['multiple_desc']."' )";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
//        if(isset($mult['show_label'])):
//            
//        endif;
//        $sql = "INSERT INTO ref_multiple_item (doc_name_id, element_code, multiple_desc_code, ref_element_code, show_label, created_by, created_date, multi_answer_desc) "
//                . "VALUES('".(int) $docID."', '".(int) $elementID."', (SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc='".$mult['ref_desc']."'), (SELECT element_code FROM ref_document_element WHERE element_desc='".$mult['multiple_desc']."'), '".$mult['show_label']."','ADMIN', NOW(),'".$mult['multiple_desc']."')";
//        print_r($sql);
//        $this->db->connect();
//        $this->db->prepare($sql);
//        $this->db->queryexecute();
        return true;
    }
    
//    public function InsertMultiAnswer($docID,$elementID,$label,$sorting,$input,$childcode){
//        $sql = "INSERT INTO ref_multiple_answer (doc_name_id,element_code,multi_answer_desc,sorting,input_type,parent_element_code)"
//                . "VALUES ('".(int) $docID."','".(int) $elementID."','".$label."','".$sorting."','".$input."','".$childcode."')";
//        print_r($sql);
//        $this->db->connect();
//        $this->db->prepare($sql);
//        $this->db->queryexecute();
//        return true;
//    }
    
    //23AUG
    public function InsertMethod($docID,$elementID){
        $sql = "INSERT INTO ref_multiple_answer (doc_name_id,element_code,multi_answer_desc,sorting,input_type,parent_element_code)"
                . "VALUES ('".(int) $docID."','".(int) $elementID."','".$label."','".$sorting."','".$input."','".$childcode."')";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    public function InsertParentMultiAnswer($docID,$elementID,$label,$sorting,$input){
        $sql = "INSERT INTO ref_multiple_answer (doc_name_id,element_code,multi_answer_desc,sorting,input_type)"
                . "VALUES ('".(int) $docID."','".(int) $elementID."','".$label."','".$sorting."','".$input."')";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    public function getMaxItem(){
        $sql = "SELECT MAX(ref_multiple_item_id)+1 AS ref_multiple_item_id FROM ref_multiple_item";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    public function InsertChild($docID,$elementID,$childmult){
        if(isset($childmult['parent_element_code'])):
            $parent = $childmult['parent_element_code'];
        endif;
        if(isset($childmult['child_element_code'])):
            $child = $childmult['child_element_code'];
        endif;
        $sql = "INSERT INTO ref_multiple_answer (doc_name_id, element_code, multiple_desc_code, sorting, input_type, parent_element_code, child_element_code, active, created_by, created_date, multi_answer_desc) "
                . "VALUES ('".(int) $docID."', '".(int) $elementID."', (SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc='".$childmult['child_multiple_desc']."')+1, '".(int) $childmult['child_sorting']."', '".$childmult['child_input_type']."', $parent , $child, '1', 'ADMIN', NOW(), '".$childmult['child_multiple_desc']."' )";
//        $sql = "INSERT INTO ref_multiple_item (ref_multiple_item_id, doc_name_id, element_code, multiple_desc_code, ref_element_code, created_by, created_date, multi_answer_desc) "
//                . "VALUES($max,'".(int) $docID."', '".(int) $elementID."', (SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc='".$mult['multiple_desc']."'), '6330', 'ADMIN', NOW(), '".$mult['multiple_desc']."')";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    public function InsertNewRefElement($element_desc,$element_code,$json_element,$grouping,$element_sorting,$level, array $val){
        $sql = "INSERT INTO ref_document_element (element_code,element_desc,json_element)"
               . "VALUES ('".$element_code."', '".$element_desc."','".$json_element."');"        
               . "INSERT INTO document_element (doc_name_id,section_code,parent_element_code,child_element_code,sorting,section_sorting,element_level,element_position,element_properties)"
               . "VALUES ('".(int)$val['doc_id']."','".$val['section_code']."','".$element_code."','".$grouping."','".$element_sorting."','".$val['section_sorting']."','".$level."','".$val['position']."','".$val['element_properties']."');";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    public function DeleteElementData($docId,$sectionCode,$elementCode){
        $sql = "DELETE FROM document_element WHERE doc_name_id='".(int)$docId."' AND section_code='".(int)$sectionCode."' AND parent_element_code='".(int)$elementCode."'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;    
    }
    
//    public function UpdateElementToMethod(array $val) {
//        $sql = "UPDATE document_element SET element_properties='" . $val['element_properties'] . "',input_type='METHOD',data_type=NULL,method='".$val['method_name']."',additional_attribute='".$val['method_json']."' "
//                . "WHERE doc_name_id='".(int) $val['doc_id']."' AND parent_element_code='" . (int) $val['element_code'] . "'";
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
    
     public function GetAvailableTemplateId() {
        $sql = "SELECT template_id"
                . " FROM document_template"
                . " GROUP BY template_id";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function UpdateJSONDocument($documents) {
        $jsonForm = $this->jsonForm;
        $docNameId = $documents['doc_name_id'];
        $newLine = array('\r\n', '\n', '\r');
        $replace = '<br />';
        $json = str_replace($newLine, $replace, $jsonForm);
        $jsonDoc = addslashes($json);
            echo '<pre>';
            print_r($jsonDoc);
            echo '</pre>';
        $sql = "UPDATE document_template SET "
                . "json_template = '$jsonDoc', "
                . "updated_date = now(), "
                . "updated_by = 'ADMIN' "
                . "WHERE doc_name_id='" . (int) $docNameId . "' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    public function MainMethod() {
        $sql = " SELECT rde.element_code, rdm.doc_method_code as code,rdm.doc_method_desc as label, rdm.image_path, rde.element_desc "
               . " FROM document_element de "
               . " INNER JOIN ref_document_element rde ON (de.parent_element_code=rde.element_code) "
               . " INNER JOIN ref_document_method rdm ON (de.doc_method_code=rdm.doc_method_code) ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }
    
    public function ListMethodInfo() {
        $sql = " SELECT DISTINCT doc_method_code, doc_method_desc, method_info "
                ." FROM ref_document_method "
                . "ORDER BY doc_method_desc ASC ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function ListMultAns() {
        $sql = "SELECT DISTINCT input_type "
                ."FROM ref_multiple_answer "
                ."ORDER BY input_type ASC ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
//    public function getDocDesc($templateId){
//        $sql = "SELECT dt.doc_name_id, d.doc_name_desc "
//                ."FROM document_template dt "
//                ."LEFT JOIN document d ON(d.doc_name_id = dt.doc_name_id) "
//                ."WHERE dt.template_id='".$templateId."' ";
//        $this->db->connect();
//        $this->db->prepare($sql);
//        $this->db->queryexecute();
//        $result = $this->db->fetchOut('object');
//        return $result[0]; 
//    }
//    public function CheckTemplate() {
//        $sql = "SELECT d.doc_name_id, d.doc_name_desc, gd.discipline_name, rdt.dc_type_desc,md.main_discipline_name"
//                . "(CASE WHEN (SELECT doc_name_id FROM document_template WHERE doc_name_id IS NULL) THEN FALSE ELSE TRUE END) as available"
//                . "FROM document_element de INNER JOIN document d ON (d.doc_name_id=de.doc_name_id)"
//                . "INNER JOIN ref_document_section rds ON (rds.section_code=de.section_code)"
//                . "INNER JOIN ref_document_element rde ON (rde.element_code=de.parent_element_code)"
//                . "INNER JOIN discipine_document dd ON (d.doc_name_id=dd.doc_name_id)"
//                . "INNER JOIN ref_document_element rdee ON (rdee.element_code=de.child_element_code)"
//                . "INNER JOIN ref_generaldisciplines gd ON (dd.discipline_code=gd.discipline_code)"
//                . "INNER JOIN ref_maindisciplines md ON (gd.main_discipline_code=d.dc_type_code)"
//                . "INNER JOIN ref_document_type rdt ON (rdt.dc_type_code=d.dc_type_code)"
//                . "INNER JOIN ref_document_group rdg ON (rdg.doc_group_code=rdt.doc_group_code)"
//                . "WHERE gd.main_discipline_code ='$discipline'";
//    }
    
}
