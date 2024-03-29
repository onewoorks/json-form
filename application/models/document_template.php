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

        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }

    public function ReadElementExisted($generateArray) {
        $discipline = $generateArray['discipline'];
        if (isset($generateArray['general_discipline'])) {
            $subDiscipline = $generateArray['general_discipline'];
        } else {
            $subDiscipline = 0;
        }
        $docGroup = $generateArray['doc_group'];
        if (isset($generateArray['doc_type'])) {
            $docType = $generateArray['doc_type'];
        } else {
            $docType = 0;
        }
        $sql = "SELECT d.doc_name_id, d.doc_name_desc, gd.discipline_name,rdt.dc_type_desc,md.main_discipline_name, "
                . "(CASE WHEN ((SELECT DISTINCT doc_name_id FROM document_template WHERE doc_name_id = d.doc_name_id) IS NULL) THEN FALSE ELSE TRUE END) as available "
                . "FROM document_element de INNER JOIN document d ON(d.doc_name_id=de.doc_name_id) " //document id
                . "INNER JOIN ref_document_section rds ON(rds.section_code=de.section_code) "        //document section
                . "INNER JOIN ref_document_element rde ON (rde.element_code=de.parent_element_code) " //document element
                . "INNER JOIN discipline_document dd ON(d.doc_name_id=dd.doc_name_id) "                //discipline document
                . "INNER JOIN ref_document_element rdee ON (rdee.element_code=de.child_element_code) " //child element
                . "LEFT JOIN ref_generaldisciplines gd ON(dd.discipline_code=gd.discipline_code) "     //general discipline
                . "LEFT JOIN ref_main_disciplines md ON(gd.main_discipline_code=md.main_discipline_code)" //main discipline
                . "INNER JOIN ref_document_type rdt ON(rdt.dc_type_code=d.dc_type_code)"                    //document type
                . "INNER JOIN ref_document_group rdg ON(rdg.doc_group_code=rdt.doc_group_code) ";           //document_group
        if (PROJECT_PATH == 'cd'):
            $sql .= "WHERE gd.main_discipline_code = '$discipline' AND rdg.doc_group_code IN ('CN','PS','RL','PDS') ";
        elseif ((PROJECT_PATH == 'rispac')):
            $sql .= "WHERE gd.main_discipline_code = '$discipline' AND rdg.doc_group_code IN ('RR') ";
        elseif ((PROJECT_PATH == 'prod' || PROJECT_PATH == 'uat' || PROJECT_PATH == 'stg')):
            $sql .= "WHERE gd.main_discipline_code = '$discipline' AND rdg.doc_group_code IN ('CN','PS','RL','PDS') ";
        endif;
        if ($discipline != "0") {
            $sql .= "AND gd.main_discipline_code = '$discipline' ";
        }
        if ($subDiscipline != "0") {
            $sql .= "AND gd.discipline_code = '$subDiscipline'";
        }
        if ($docType != "0") {
            $sql .= "AND d.dc_type_code = '$docType' ";
        }
        if ($docGroup != "0") {
            $sql .= "AND rdt.doc_group_code = '$docGroup' ";
        }
        $sql .= "GROUP BY de.doc_name_id ORDER BY gd.main_discipline_code,gd.discipline_name ASC";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function NakTengokJson($documentId) {
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

    public function GetElementSorting($section_code, $document_id) {
        $sql = "SELECT MAX(sorting) AS newsorting FROM document_element WHERE section_code=" . (int) $section_code . " AND doc_name_id=" . (int) $document_id . " ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }

    public function GetMaxSectionSorting($documentId) {
        $sql = "SELECT MAX(section_sorting) AS newsorting FROM document_element WHERE doc_name_id=" . (int) $documentId . " ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }

    //zarith-10/3
    public function ReadDocumentTemplate($templateId) {
        $sql = "SELECT o.doc_name_desc, d.json_template, d.doc_name_id, d.template_id, gd.discipline_name, md.main_discipline_name, rdg.doc_group_code"
                . " FROM document_template d"
                . " LEFT JOIN document o ON o.doc_name_id=d.doc_name_id"
                . " INNER JOIN discipline_document dd ON dd.doc_name_id=d.doc_name_id"
                . " LEFT JOIN ref_generaldisciplines gd ON gd.discipline_code=dd.discipline_code"
                . " LEFT JOIN ref_main_disciplines md ON md.main_discipline_code=gd.main_discipline_code"
                . " INNER JOIN ref_document_group rdg ON rdg.doc_group_code=o.doc_group_code "
                . " WHERE d.template_id='" . (int) $templateId . "' ";
//                . " AND d.active = 1";
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
        print_r($sql);
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
                . "doc_name_id = '" . (int) $docNameId . "',"
                . "json_template = '$jsonDoc', "
                . "created_date = now(), "
                . "created_by = 'ADMIN' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function CreateDocumentDiagnosis($doc) {

        $sql = "INSERT INTO document_diagnosis SET "
                . "diagnosis_code = '" . $doc['icd10_id'] . "',"
                . "doc_name_id = '" . $doc['doc_name_id'] . "', "
                . "created_date = now(), "
                . "created_by = 'ADMIN' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    //zarith-10/3
    public function GetListAvailableDocument() {
        $sql = "SELECT dt.template_id,d.active_status, dt.doc_name_id,rmd.main_discipline_name,rdt.dc_type_desc,d.doc_name_desc,gd.discipline_name,rdg.doc_group_desc,d.doc_group_code, "
                . "(CASE WHEN d.active_status='1' THEN true ELSE false END) AS available, "
                . "(CASE WHEN d.active_status='0' THEN true ELSE false END) AS unavailable, "
                . "(CASE WHEN d.doc_group_code='PDS' THEN TRUE ELSE FALSE END) AS pds, "
                . "(CASE WHEN de.doc_name_id IS NULL THEN TRUE WHEN (SUM(IF(de.compare = 1, 1, 0)) = 0) THEN FALSE WHEN de.doc_name_id IS NULL THEN TRUE ELSE TRUE END) AS dimmedonload "
                . "FROM document_template dt "
                . "INNER JOIN document d ON(dt.doc_name_id=d.doc_name_id) "
                . "LEFT JOIN (SELECT `doc_name_id`,IF((SUM(IF(`active` = 0, 1, 0))) = (SUM(IF(`doc_name_id` IS NOT NULL, 1, 0))), 1,0) AS compare FROM document_element GROUP BY doc_name_id,section_code) de ON (d.doc_name_id = de.doc_name_id) "
                . "INNER JOIN discipline_document dd ON(d.doc_name_id=dd.doc_name_id) "
                . "LEFT JOIN ref_generaldisciplines gd ON(dd.discipline_code=gd.discipline_code) "
                . "LEFT JOIN ref_main_disciplines rmd ON(rmd.main_discipline_code=gd.main_discipline_code) "
                . "INNER JOIN ref_document_type rdt ON(rdt.dc_type_code=d.dc_type_code)"
                . "INNER JOIN ref_document_group rdg ON(rdg.doc_group_code=rdt.doc_group_code) ";
        if (PROJECT_PATH == 'cd'):
            $sql .= "WHERE rmd.module='cd' AND rdg.doc_group_code IN ('CN','RL','PS','PDS') GROUP BY dt.doc_name_id";
        elseif (PROJECT_PATH == 'rispac'):
            $sql .= "WHERE rmd.main_discipline_code = '08' AND rdg.doc_group_code IN ('RR') GROUP BY dt.doc_name_id";
        elseif ((PROJECT_PATH == 'prod' || PROJECT_PATH == 'uat' || PROJECT_PATH == 'stg')):
            $sql .= "WHERE rmd.module='cd' AND rdg.doc_group_code IN ('CN','RL','PS','PDS') GROUP BY dt.doc_name_id";
        endif;
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    //zarith-10/3
    public function GetFilterListByGroupType($documentArray) {
        $discipline = $documentArray['discipline'];
        if (isset($documentArray['general_discipline'])) {
            $subDiscipline = $documentArray['general_discipline'];
        } else {
            $subDiscipline = 0;
        }
        $docGroup = $documentArray['doc_group'];
        if (isset($documentArray['doc_type'])) {
            $docType = $documentArray['doc_type'];
        } else {
            $docType = 0;
        }
        $sql = "SELECT dt.template_id,dt.doc_name_id,dt.active, d.active_status, rmd.main_discipline_name,rdt.dc_type_desc,d.doc_name_desc,gd.discipline_name,rdg.doc_group_desc,d.doc_group_code, "
                . "(CASE WHEN d.active_status='1' THEN true ELSE false END) AS available, "
                . "(CASE WHEN d.active_status='0' THEN true ELSE false END) AS unavailable, "
                . "(CASE WHEN d.doc_group_code='PDS' THEN TRUE ELSE FALSE END) AS pds, "
                . "(CASE WHEN de.doc_name_id IS NULL THEN TRUE WHEN (SUM(IF(de.compare = 1, 1, 0)) = 0) THEN FALSE WHEN de.doc_name_id IS NULL THEN TRUE ELSE TRUE END) AS dimmedonload "
                . "FROM document_template dt "
                . "INNER JOIN document d ON(dt.doc_name_id=d.doc_name_id) "
                . "LEFT JOIN (SELECT doc_name_id,IF((SUM(IF(active = 0, 1, 0))) = (SUM(IF(doc_name_id IS NOT NULL, 1, 0))), 1,0) AS compare FROM document_element GROUP BY doc_name_id,section_code) de ON (d.doc_name_id = de.doc_name_id) "
                . "INNER JOIN discipline_document dd ON(d.doc_name_id=dd.doc_name_id) "
                . "LEFT JOIN ref_generaldisciplines gd ON(dd.discipline_code=gd.discipline_code) "
                . "LEFT JOIN ref_main_disciplines rmd ON(rmd.main_discipline_code=gd.main_discipline_code) "
                . "INNER JOIN ref_document_type rdt ON(rdt.dc_type_code=d.dc_type_code) "
                . "INNER JOIN ref_document_group rdg ON(rdg.doc_group_code=rdt.doc_group_code)";
        if (PROJECT_PATH == 'cd'):
            $sql .= "WHERE rmd.main_discipline_code = '$discipline' AND rdg.doc_group_code IN ('CN','RL','PS','PDS') ";
        elseif (PROJECT_PATH == 'rispac'):
            //        $discipline = '08';    
            $sql .= "WHERE rmd.main_discipline_code = '$discipline' AND rdg.doc_group_code IN ('RR') ";
        elseif ((PROJECT_PATH == 'prod' || PROJECT_PATH == 'uat' || PROJECT_PATH == 'stg')):
            $sql .= "WHERE rmd.main_discipline_code = '$discipline' AND rdg.doc_group_code IN ('CN','RL','PS','PDS') ";
        endif;
        if ($discipline != "0") {
            $sql .= "AND gd.main_discipline_code = '$discipline' ";
        }
        if ($subDiscipline != "0") {
            $sql .= "AND gd.discipline_code = '$subDiscipline' ";
        }
        if ($docType != "0") {
            $sql .= "AND d.dc_type_code = '$docType' ";
        }
        if ($docGroup != "0") {
            $sql .= "AND d.doc_group_code = '$docGroup'";
        }
        $sql .= "GROUP BY dt.doc_name_id ORDER BY COALESCE(dt.updated_date,dt.created_date) DESC";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function GetFilterListByGroupType2($documentArray) {
        $discipline = $documentArray['discipline'];
        if (isset($documentArray['general_discipline'])) {
            $subDiscipline = $documentArray['general_discipline'];
        } else {
            $subDiscipline = 0;
        }
        $docGroup = $documentArray['doc_group'];
        if (isset($documentArray['doc_type'])) {
            $docType = $documentArray['doc_type'];
        } else {
            $docType = 0;
        }
        $sql = "SELECT d.doc_name_id, d.active_status, rmd.main_discipline_name,rdt.dc_type_desc,d.doc_name_desc,gd.discipline_name,rdg.doc_group_desc,rdg.doc_group_code "
                . "FROM document d "
                . "INNER JOIN discipline_document dd ON(d.doc_name_id=dd.doc_name_id) "
                . "LEFT JOIN ref_generaldisciplines gd ON(dd.discipline_code=gd.discipline_code) "
                . "LEFT JOIN ref_main_disciplines rmd ON(rmd.main_discipline_code=gd.main_discipline_code) "
                . "INNER JOIN ref_document_type rdt ON(rdt.dc_type_code=d.dc_type_code) "
                . "INNER JOIN ref_document_group rdg ON(rdg.doc_group_code=rdt.doc_group_code)";
        if (PROJECT_PATH == 'cd'):
            $sql .= "WHERE rmd.main_discipline_code = '$discipline' AND rdg.doc_group_code IN ('CN','RL','PS') ";
        elseif (PROJECT_PATH == 'rispac'):
            $sql .= "WHERE rmd.main_discipline_code = '$discipline' AND rdg.doc_group_code IN ('RR') ";
        elseif ((PROJECT_PATH == 'prod' || PROJECT_PATH == 'uat' || PROJECT_PATH == 'stg')):
            $sql .= "WHERE rmd.main_discipline_code = '$discipline' AND rdg.doc_group_code IN ('CN','RL','PS') ";
        endif;
        if ($discipline != "0") {
            $sql .= "AND gd.main_discipline_code = '$discipline' ";
        }
        if ($subDiscipline != "0") {
            $sql .= "AND gd.discipline_code = '$subDiscipline' ";
        }
        if ($docType != "0") {
            $sql .= "AND d.dc_type_code = '$docType' ";
        }
        if ($docGroup != "0") {
            $sql .= "AND d.doc_group_code = '$docGroup'";
        }
        $sql .= "AND d.active_status='1' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function GetSectionDetail($sectionCode) {
        $sql = "SELECT section_code, section_desc, json_section FROM ref_document_section WHERE section_code='" . (int) $sectionCode . "' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }

    public function GetSectionSorting($section, $doc) {
        $sql = "SELECT section_sorting FROM document_element WHERE section_code='" . (int) $section . "' AND doc_name_id='" . (int) $doc . "' GROUP BY section_code ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }

    public function GetMaxElementCode() {
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

    public function GetElementDetail($elementCode, $documentId, $sectionId) {
        $sql = "SELECT rde.element_code, de.section_code, rde.json_element,rde.element_desc,de.child_element_code,de.data_type,de.sorting,de.element_level,de.input_type, de.method,de.doc_method_code,de.element_position, de.element_properties, de.additional_attribute "
                . " FROM document_element de INNER JOIN document d ON(d.doc_name_id=de.doc_name_id) "
                . " INNER JOIN ref_document_section rds ON(rds.section_code=de.section_code) "
                . " INNER JOIN ref_document_element rde ON (rde.element_code=de.parent_element_code) "
                . " INNER JOIN ref_document_element rdee ON (rdee.element_code=de.child_element_code) "
//                . " LEFT JOIN ref_document_method rdm ON (rdm.doc_method_code=de.doc_method_code) "
                . " WHERE de.doc_name_id='" . (int) $documentId . "' AND rde.element_code='" . (int) $elementCode . "' AND de.section_code = '" . (int) $sectionId . "' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }

    public function GetElementGrouping($sectionCode, $documentId) {
        $sql = "SELECT rde.element_code, rde.element_desc "
                . " FROM document_element de INNER JOIN document d ON(d.doc_name_id=de.doc_name_id) "
                . " INNER JOIN ref_document_section rds ON(rds.section_code=de.section_code) "
                . " INNER JOIN ref_document_element rde ON (rde.element_code=de.parent_element_code) "
                . " INNER JOIN ref_document_element rdee ON (rdee.element_code=de.child_element_code) "
                . " WHERE rds.section_code='" . (int) $sectionCode . "' AND de.doc_name_id='" . (int) $documentId . "' AND de.parent_element_code=de.child_element_code";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function GetLayoutDetail($docId) {
        $sql = "SELECT DISTINCT rds.layout"
                . " FROM ref_document_section rds INNER JOIN document_element de ON (rds.section_code=de.section_code)"
                . " WHERE de.doc_name_id='" . (int) $docId . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }

    public function GetTitleDetail($docId) {
        $sql = "SELECT doc_name_id, doc_name_desc"
                . " FROM document"
                . " WHERE doc_name_id='" . (int) $docId . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }

    //22OCT
    public function GetMethodDetail($docId) {
        $sql = "SELECT doc_method_code, doc_method_desc, method_info"
                . " FROM ref_document_method"
                . " WHERE doc_method_code='" . (int) $docId . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }

    public function GetSectionsDetail($docId) {
        $sql = "SELECT section_code, section_desc, json_section"
                . " FROM ref_document_section"
                . " WHERE section_code='" . (int) $docId . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }

    public function GetElementsDetail($docId) {
        $sql = "SELECT element_code, element_desc, json_element"
                . " FROM ref_document_element"
                . " WHERE element_code='" . (int) $docId . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }
    
    public function GetPredefinesDetail($docId) {
        $sql = "SELECT multiple_desc_code, multiple_desc"
                . " FROM ref_multiple_desc"
                . " WHERE multiple_desc_code='" . (int) $docId . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }

    public function GetTitleId($docId) {
        $sql = "SELECT DISTINCT doc_name_id, doc_name_desc FROM document WHERE doc_name_id='" . (int) $docId . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    //22OCT
    public function GetMethodId($docId) {
        $sql = "SELECT DISTINCT doc_method_code, doc_method_desc FROM ref_document_method WHERE doc_method_code='" . (int) $docId . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function GetSectionsId($docId) {
        $sql = "SELECT DISTINCT section_code, section_desc FROM ref_document_section WHERE section_code='" . (int) $docId . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function GetElementId($docId) {
        $sql = "SELECT DISTINCT element_code, element_desc FROM ref_document_element WHERE element_code='" . (int) $docId . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    //4Ogos20
    public function GetPredefineId($docId) {
        $sql = "SELECT DISTINCT multiple_desc_code, multiple_desc FROM ref_multiple_desc WHERE multiple_desc_code='" . (int) $docId . "'";
        //print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    //18JULAI
    //zarith-8/3
    public function InsertDocId($subDis, $docGroup, $docType, $titleDesc) {
        if (is_string($subDis)):
            $sql = " INSERT INTO document (doc_group_code, dc_type_code, doc_name_desc,active_status, created_by, created_date) "
                    . " VALUES ('" . (string) $docGroup . "', '" . (string) $docType . "', '$titleDesc', '0', 'ADMIN', now()) ;"
                    . " INSERT INTO discipline_document (discipline_code, doc_name_id, favourite, status, created_by, created_date) "
                    . " VALUES ('" . (string) $subDis . "', (SELECT MAX(doc_name_id) FROM document AS doc_name_id), (NULL), '1', 'ADMIN', now());"
                    . " INSERT INTO document_template (doc_name_id, active, created_date,  created_by)"
                    . " VALUES ((SELECT MAX(doc_name_id) FROM document AS doc_name_id), '0' ,now(), 'ADMIN')";
        else:
            $sql = " INSERT INTO document (doc_group_code, dc_type_code, doc_name_desc, created_by, created_date) "
                    . " VALUES ('" . (string) $docGroup . "', '" . (string) $docType . "', '$titleDesc', 'ADMIN', now()) ;"
                    . " INSERT INTO discipline_document (discipline_code, doc_name_id, favourite, created_by, created_date) "
                    . " VALUES ('" . (int) $subDis . "', (SELECT MAX(doc_name_id) FROM document AS doc_name_id), (NULL),'ADMIN', now())";
        endif;
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    //19JULAI
    //28Feb19
    public function InsertMethodId($result) {
        $method_desc = ucwords($result['method_desc']);
        $method_info = $result['method_info'];
//        $sql = " SELECT COUNT(section_desc) FROM ref_document_section WHERE section_desc LIKE '%$sectionDesc%' ";
        $sql = " INSERT INTO ref_document_method (doc_method_code, doc_method_desc, method_info, active_status, created_by, created_date) "
                . " VALUES ((SELECT MAX(doc_method_code)+1 FROM ref_document_method AS doc_method_code), '$method_desc', '$method_info', '1', 'ADMIN', NOW()) ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    //27Feb19
    public function InsertSecId($result) {
        $section_desc = $result['section_desc'];
        $json_section = $result['json_section'];
        $layout = $result['layout'];
//        $sql = " SELECT COUNT(section_desc) FROM ref_document_section WHERE section_desc LIKE '%$sectionDesc%' ";
        $sql = " INSERT INTO ref_document_section (section_code, section_desc, json_section, layout, active_status, created_by, created_date) "
                . " VALUES ((SELECT MAX(section_code)+1 FROM ref_document_section AS section_code), '$section_desc', '$json_section', '$layout', '1', 'ADMIN', NOW()) ";

        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    //23JULAI
    public function InsertElementId($result) {
        $element_desc = $result['element_desc'];
        $json_element = $result['json_element'];
        $sql = " INSERT INTO ref_document_element (element_desc, json_element, active_status, created_by, created_date) "
                . " VALUES ('" . (string) $element_desc . "', '" . (string) $json_element . "', '1', 'ADMIN', NOW()) ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    //4Ogos20
    public function InsertPredefinetId($result) {
        $multiple_desc = $result['multiple_desc'];
        $sql = " INSERT INTO ref_multiple_desc (multiple_desc, active_status, created_by, created_date) "
                . " VALUES ('" . (string) $multiple_desc . "', '1', 'ADMIN', NOW()) ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    //20JULAI
    public function searchSecDesc($search) {
        $sql = " SELECT section_code, section_desc, json_section, layout, active_status FROM ref_document_section WHERE section_desc LIKE '%$search%' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    //5OKT
    public function searchTitleDesc($search) {
        $sql = " SELECT doc_name_id, doc_name_desc FROM document WHERE doc_name_desc LIKE '%$search%' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    //26JULAI
    public function ListDocDesc() {
        $sql = " SELECT doc_name_id, doc_name_desc FROM document ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    //26JULAI
    public function ListElementDesc() {
        $sql = " SELECT element_code, element_desc, json_element FROM ref_document_element ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    //23JULAI
    public function searchElement($search) {
        $sql = " SELECT element_code, element_desc, json_element, active_status FROM ref_document_element WHERE element_desc LIKE '%$search%' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function GetAllmethodDesc() {
        $sql = " SELECT doc_method_code, doc_method_desc, section_code, json_method, method_info, image_path, active_status FROM ref_document_method WHERE active_status='1'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    //19JULAI
    public function GetAllSecDesc() {
        $sql = "SELECT section_code, section_desc, json_section, layout, active_status FROM ref_document_section WHERE active_status='1' ORDER BY section_desc ASC";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    //4Ogos20
    public function GetAllPredefineDesc() {
        $sql = "SELECT multiple_desc_code, multiple_desc, active_status FROM ref_multiple_desc WHERE active_status='1' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function GetAllTitle() {
        $sql = " SELECT doc_name_id, doc_name_desc, active_status FROM document";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    //zarith-11/3
    public function GetDocumentDesc($documentId) {
        $sql = " SELECT doc_name_id, doc_name_desc FROM document WHERE doc_name_id='" . (int) $documentId . "'  ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result[0] : false;
    }

    //23JULAI
    public function GetAllElementDesc() {
        $sql = "SELECT element_code, element_desc, json_element, active_status FROM ref_document_element WHERE active_status='1' ORDER BY element_desc ASC";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function GetAllElement() {
        $sql = "SELECT element_code, element_desc, json_element, active_status FROM ref_document_element WHERE active_status='1' ORDER BY created_date DESC limit 1000";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function GetAllPredefine() {
        $sql = "SELECT multiple_desc_code, multiple_desc, active_status FROM ref_multiple_desc WHERE active_status='1' ORDER BY created_date DESC limit 1000";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function GetSectionId($docId) {
        $sql = "SELECT DISTINCT section_code FROM document_element WHERE doc_name_id='" . (int) $docId . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function UpdateDocLayout($code, $layout) {
        $sql = "UPDATE ref_document_section SET layout='" . $layout . "' WHERE section_code='" . (int) $code . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function UpdateDocTitle($code, $title) {
        $sql = "UPDATE document SET doc_name_desc='" . $title . "' WHERE doc_name_id='" . (int) $code . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    //zarith-10/3
//    public function UpdateDocumentStatus($document_id, $val) {
//        $sql = "UPDATE document "
//                . "SET active_status='" . $val . "' "
//                . "WHERE doc_name_id='" . $document_id . "'";
//        $this->db->connect();
//        $this->db->prepare($sql);
//        $this->db->queryexecute();
//        return true;
//    }
    
    public function UpdateDocumentStatus($document_id, $val, $group){
        if ($group == "PDS"):
        $sql = "UPDATE document SET active_status ='" . $val . "' "
                . "WHERE doc_name_id = '" . $document_id . "' ";
        else:
        $sql = "UPDATE document SET active_status ='" . $val . "' "
                . "WHERE doc_name_id = (SELECT CASE WHEN SUM(IF(a.compare = 1, 1, 0)) = 0 THEN a.doc_name_id ELSE NULL END "
                . "FROM (SELECT doc_name_id,IF((SUM(IF(active = 0, 1, 0))) = (SUM(IF(doc_name_id IS NOT NULL, 1, 0))), 1,0) AS compare "
                . "FROM document_element "
                . "WHERE doc_name_id = '" . $document_id . "' "
                . "GROUP BY section_code) a )";
        endif;
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    //22OCT
    public function UpdateMethodInfo($code, $title, $info) {
        $sql = "UPDATE ref_document_method SET doc_method_desc='" . $title . "', method_info='" . $info . "' WHERE doc_method_code='" . (int) $code . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function UpdateSectionInfo($code, $title, $info) {
        $sql = "UPDATE ref_document_section SET section_desc='" . $title . "', json_section='" . $info . "' WHERE section_code='" . (int) $code . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function UpdateElementInfo($code, $title, $info) {
        $sql = "UPDATE ref_document_element SET element_desc='" . $title . "', json_element='" . $info . "' WHERE element_code='" . (int) $code . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    //4Ogos20
    public function UpdatePredefineInfo($code, $title) {
        $sql = "UPDATE ref_multiple_desc SET multiple_desc='" . $title . "' WHERE multiple_desc_code='" . (int) $code . "'";
        //print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    //zarith-10/3
    public function copyBaru($docName, $curName, $subdis, $type, $group) {
        if (isset($subdis)):
            $subdiscipline = "SELECT '$subdis', (SELECT MAX(doc_name_id) FROM document), favourite, doc_sorting, gender_code, age_from, age_to, NOW(),'ADMIN' ";
        else:
            $subdiscipline = "SELECT discipline_code, (SELECT MAX(doc_name_id) FROM document), favourite, doc_sorting, gender_code, age_from, age_to, NOW(),'ADMIN' ";
        endif;

        if (isset($group) && ($type)):
            $doc_group = "SELECT '$group','$type','$docName', '0', NOW(), 'ADMIN' ";
        else:
            $doc_group = "SELECT doc_group_code, dc_type_code, '$docName', '0', NOW(), 'ADMIN' ";
        endif;
        $sql = "INSERT INTO document (doc_group_code, dc_type_code, doc_name_desc, active_status, created_date, created_by) "
                . $doc_group
                . "FROM document "
                . "WHERE doc_name_id = '" . (int) $curName . "' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $sql = "INSERT INTO document_template (doc_name_id, json_template, text_template, report_name, active, created_date, created_by) "
                . "SELECT (SELECT MAX(doc_name_id) FROM document), json_template, text_template, report_name, active, NOW(),'ADMIN' "
                . "FROM document_template "
                . "WHERE doc_name_id = '" . (int) $curName . "' limit 1";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $sql = "INSERT INTO discipline_document (discipline_code, doc_name_id, favourite, doc_sorting, gender_code, age_from, age_to, created_date, created_by) "
                . $subdiscipline
                . "FROM discipline_document "
                . "WHERE doc_name_id = '" . (int) $curName . "' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $sql = "INSERT INTO document_element (doc_name_id, section_code, parent_element_code, child_element_code, sorting, section_sorting, section_tooltips, sec_file_type_code, element_level, element_position, element_layout, element_properties, input_type, data_type, element_type_code, doc_method_code, method, additional_attribute, element_tooltips, element_hint, file_type_code, show_label, image_name_id, image_path, component_flag, mandatory_flag, active, created_date, created_by) "
                . "SELECT (SELECT MAX(doc_name_id) FROM document), section_code, parent_element_code, child_element_code, sorting, section_sorting, section_tooltips, sec_file_type_code, element_level, element_position, element_layout, element_properties, input_type, data_type, element_type_code, doc_method_code, method, additional_attribute, element_tooltips, element_hint, file_type_code, show_label, image_name_id, image_path, component_flag, mandatory_flag, active, NOW(),'ADMIN' "
                . "FROM document_element "
                . "WHERE doc_name_id = '" . (int) $curName . "' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $sql = "INSERT INTO ref_multiple_answer (doc_name_id, element_code, multiple_desc_code, sorting, input_type, method, parent_element_code, child_element_code, element_tooltips, element_hint, file_type_code, image_path, component_flag, show_label, active, created_date, created_by, multi_answer_desc) "
                . "SELECT (SELECT MAX(doc_name_id) FROM document), element_code, multiple_desc_code, sorting, input_type, method, parent_element_code, child_element_code, element_tooltips, element_hint, file_type_code, image_path, component_flag, show_label, '1', NOW(),'ADMIN', multi_answer_desc "
                . "FROM ref_multiple_answer "
                . "WHERE doc_name_id = '" . (int) $curName . "' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $sql = "INSERT INTO ref_multiple_item (doc_name_id, element_code, multiple_desc_code, ref_element_code, show_label, element_tooltips, element_hint, file_type_code, created_date, created_by, multi_answer_desc) "
                . "SELECT (SELECT MAX(doc_name_id) FROM document), element_code, multiple_desc_code, ref_element_code, show_label, element_tooltips, element_hint, file_type_code, NOW(),'ADMIN', multi_answer_desc "
                . "FROM ref_multiple_item "
                . "WHERE doc_name_id = '" . (int) $curName . "' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function GetMaxTemplate() {
        $sql = "SELECT MAX(template_id) + 1 AS template_id FROM document_template ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    //1AUG
    public function generateBaru($value, $value2) {
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

    public function GetChildDetail($doc, $element) {
        $sql = "SELECT parent_element_code FROM ref_multiple_answer "
                . " WHERE doc_name_id='" . (int) $doc . "' and element_code='" . (int) $element . "'";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function UpdateElementSorting($output) {
        $sql = "UPDATE document_element SET "
                . "sorting = '" . (int) $output['sorting'] . "', section_code='" . (int) $output['section_code'] . "' "
                . "WHERE doc_name_id='" . (int) $output['doc_name_id'] . "' AND parent_element_code='" . (int) $output['element_code'] . "' AND section_code='" . (int) $output['current'] . "' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        print_r($sql);
        return true;
    }

    public function UpdateSectionSorting(array $data) {
        $sql = "UPDATE document_element SET "
                . "section_sorting='" . (int) $data['section_sorting'] . "' "
                . "WHERE section_code='" . (int) $data['section_code'] . "' AND doc_name_id='" . (int) $data['doc_name_id'] . "' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        print_r($sql);
        return true;
    }

    //zarith-31/3
    public function UpdateSectionDetail($documentArray) {
        $docId = $documentArray['document_id'];
        $section = $documentArray['section_code'];
        $section_desc = $documentArray['section_desc'];
        $sql = "UPDATE document_element "
                . "SET section_code=(SELECT section_code FROM ref_document_section WHERE section_desc='" . $section_desc . "' LIMIT 1) "
                . "WHERE section_code='" . (int) $section . "' AND doc_name_id='" . (int) $docId . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        print_r($sql);
        return true;
    }

    public function UpdateElementName($code, $name, $document_id) {
        $sql = " UPDATE document_element "
                . " SET parent_element_code = '" . (int) $name . "' "
                . " WHERE parent_element_code = '" . (int) $code . "' AND doc_name_id = '" . (int) $document_id . "' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function UpdateElementDetails(array $val) {
        $sql = "UPDATE document_element SET child_element_code='" . (int) $val['element_group'] . "',element_position='" . $val['element_position'] . "',element_properties='" . $val['element_properties'] . "',input_type='" . $val['input_type'] . "',data_type='" . $val['data_type'] . "',method='" . $val['method'] . "',additional_attribute='" . $val['json'] . "' "
                . "WHERE doc_name_id='" . (int) $val['doc_id'] . "' AND parent_element_code='" . (int) $val['element_code'] . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function UpdateMethodDetails(array $val) {
        $sql = "UPDATE document_element SET child_element_code='" . (int) $val['element_group'] . "',element_position='" . $val['element_position'] . "',element_properties='" . $val['element_properties'] . "',input_type='" . $val['input_type'] . "',data_type='" . $val['data_type'] . "',method='" . $val['method_info'] . "',doc_method_code='" . (int) $val['doc_method_code'] . "',additional_attribute='" . $val['json'] . "' "
                . "WHERE doc_name_id='" . (int) $val['doc_id'] . "' AND parent_element_code='" . (int) $val['element_code'] . "'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function UpdateElementToDecoSUb(array $val) {
        $sql = "UPDATE document_element SET child_element_code='" . (int) $val['child_element_code'] . "', element_level='" . $val['element_level'] . "', element_position='" . $val['element_position'] . "', element_properties='" . $val['element_properties'] . "', input_type='" . $val['input_type'] . "',updated_by='ADMIN', updated_date = now() "
                . "WHERE doc_name_id='" . (int) $val['doc_name_id'] . "' AND parent_element_code='" . (int) $val['element_code'] . "' AND section_code ='" . (int) $val['section_code'] . "' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function UpdateElementToBasic(array $val) {
        if (isset($val['doc_method_code'])):
            $methodCodes = $val['doc_method_code'];
        endif;
        if (isset($val['data_type'])):
            $data_type = $val['data_type'];
        endif;
        $sql = "UPDATE document_element SET child_element_code='" . (int) $val['child_element_code'] . "', element_level='" . $val['element_level'] . "', element_position='" . $val['element_position'] . "', element_properties='" . $val['element_properties'] . "', input_type='" . $val['input_type'] . "', data_type = $data_type, method =(SELECT method_info FROM ref_document_method WHERE doc_method_code = $methodCodes LIMIT 1), doc_method_code=$methodCodes, updated_by='ADMIN', updated_date = now() "
                . "WHERE doc_name_id='" . (int) $val['doc_name_id'] . "' AND parent_element_code='" . (int) $val['element_code'] . "' AND section_code ='" . (int) $val['section_code'] . "' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function CleanMultipleAnswer(array $val) {
        $sql = "DELETE FROM ref_multiple_answer WHERE doc_name_id='" . (int) $val['documentId'] . "' AND element_code='" . (int) $val['elementCode'] . "' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function CleanMultipleItem(array $val) {
        $sql = "DELETE FROM ref_multiple_item WHERE doc_name_id='" . (int) $val['documentId'] . "' AND element_code='" . (int) $val['elementCode'] . "' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

//    public function CleanChild($docID, $elementID) {
//        $sql = "DELETE FROM ref_multiple_answer WHERE doc_name_id='" . (int) $docID . "' AND element_code='" . (int) $elementID . "'";
//        print_r($sql);
//        $this->db->connect();
//        $this->db->prepare($sql);
//        $this->db->queryexecute();
//        return true;
//    }
//    
    //zarith 26/8
     public function CleanMultipleAnswerParent($docID, $child) {
        
        $sql = "DELETE FROM ref_multiple_answer WHERE doc_name_id='" . (int) $docID . "' AND element_code='" . $child['sparent_code'] . "' "
                . "AND multiple_desc_code IN (SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc = '" . $child['parent_code'] . "') ";
        echo '<pre>';
        print_r($sql);
        echo '</pre>';
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
       
        if ($child['label_code'] !== '(NULL)'):
        $sql = "DELETE FROM ref_multiple_item WHERE doc_name_id='" . (int) $docID . "' AND multiple_desc_code IN (SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc = '" . $child['parent_code'] . "') "
              . "AND element_code='" . $child['sparent_code'] . "' "
              . "AND ref_element_code IN (SELECT element_code FROM ref_document_element WHERE element_desc = '" . $child['label_code'] . "')";
        echo '<pre>';
        print_r($sql);
        echo '</pre>';
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        endif;
        
        return true;
    }
    
    //zarith-23/7
    public function CleanMultipleAnswerChild($docID, $child) {
        if ($child['label_code'] === '(NULL)'):
        $sql = "DELETE FROM ref_multiple_answer WHERE doc_name_id='" . (int) $docID . "' AND multiple_desc_code IN (SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc = '" . $child['child_code'] . "') "
              . "AND element_code IN (SELECT element_code FROM ref_document_element WHERE element_desc = '" . $child['parent_code'] . "')";

        echo '<pre>';
        print_r($sql);
        echo '</pre>';
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
       
        elseif ($child['label_code'] !== '(NULL)'):
        $sql = "DELETE FROM ref_multiple_item WHERE doc_name_id='" . (int) $docID . "' AND multiple_desc_code IN (SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc = '" . $child['child_code'] . "') "
              . "AND element_code IN (SELECT element_code FROM ref_document_element WHERE element_desc = '" . $child['parent_code'] . "') "
              . "AND ref_element_code IN (SELECT element_code FROM ref_document_element WHERE element_desc = '" . $child['label_code'] . "')";

        echo '<pre>';
        print_r($sql);
        echo '</pre>';
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        endif;
        
        return true;
    }
    
    //zarith:19/8
    public function CleanMultipleItemChild($docID, $child) {
        if ($child['child_code'] === '(NULL)' && $child['sparent_code'] === '(NULL)'):
        $sql = "DELETE FROM ref_multiple_item WHERE doc_name_id='" . (int) $docID . "' AND ref_element_code IN (SELECT element_code FROM ref_document_element WHERE element_desc = '" . $child['label_code'] . "') "
                . "AND multiple_desc_code IN (SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc = '" . $child['parent_code'] . "') ";
        echo '<pre>';
        print_r($sql);
        echo '</pre>';
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        
        elseif ($child['child_code'] === '(NULL)'):
             $sql = "DELETE FROM ref_multiple_item WHERE doc_name_id='" . (int) $docID . "' AND ref_element_code IN (SELECT element_code FROM ref_document_element WHERE element_desc = '" . $child['label_code'] . "') "
                . "AND multiple_desc_code IN (SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc = '" . $child['parent_code'] . "') ";
        echo '<pre>';
        print_r($sql);
        echo '</pre>';
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        
        elseif ($child['parent_code'] === '(NULL)'):
            $sql = "DELETE FROM ref_multiple_item WHERE doc_name_id='" . (int) $docID . "' AND ref_element_code IN (SELECT element_code FROM ref_document_element WHERE element_desc = '" . $child['label_code'] . "') "
                . "AND multiple_desc_code IN (SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc = '" . $child['child_code'] . "')"
                . "AND element_code IN (SELECT element_code FROM ref_document_element WHERE element_desc = '" . $child['sparent_code'] . "')"; 
        echo '<pre>';
        print_r($sql);
        echo '</pre>';
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        endif;
        
        return true;
    }

    public function InsertParentMultiAnswer($docID, $elementID, $multi) {

        $sql = "INSERT INTO ref_multiple_answer (doc_name_id, element_code, multiple_desc_code, sorting, input_type, method, parent_element_code, child_element_code, show_label, active, updated_by, updated_date, multi_answer_desc) "
                . " VALUES ('" . (int) $docID . "', '" . (int) $elementID . "', (SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc = '" . $multi['multi_ans_code'] . "' LIMIT 1), '" . $multi['sorting'] . "', '" . $multi['multi_input_type'] . "', (NULL), (NULL), (NULL), '" . $multi['show_label'] . "', '1', 'ADMIN', now(),'" . $multi['multi_ans_code'] . "'); ";
        echo '<pre>';
        print_r($sql);
        echo '</pre>';
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();

        if ($multi['ref_element_code'] !== '(NULL)' && $multi['show_label_child'] !== '(NULL)'):
            $sql = "INSERT INTO ref_multiple_item (doc_name_id, element_code, multiple_desc_code, ref_element_code, show_label, created_by, created_date, multi_answer_desc) "
                    . " VALUES ('" . (int) $docID . "', '" . (int) $elementID . "',(SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc = '" . $multi['multi_ans_code'] . "' LIMIT 1), (SELECT element_code FROM ref_document_element WHERE element_desc = '" . $multi['ref_element_code'] . "' LIMIT 1), '" . $multi['show_label_child'] . "', 'ADMIN', now(), '" . $multi['multi_ans_code'] . "'); ";
            echo '<pre>';
            print_r($sql);
            echo '</pre>';
            $this->db->connect();
            $this->db->prepare($sql);
            $this->db->queryexecute();
        endif;

        return true;
    }

    public function InsertChildMultiAnswer($docID, $child) {

        $sql = "INSERT INTO ref_multiple_answer (doc_name_id, element_code, multiple_desc_code, sorting, input_type, method, parent_element_code, child_element_code, show_label, active, updated_by, updated_date, multi_answer_desc) "
                . "VALUES ('" . (int) $docID . "', (SELECT element_code FROM ref_document_element WHERE element_desc = '" . $child['element_code'] . "' LIMIT 1), "
                . "(SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc = '" . $child['multi_ans_code'] . "' LIMIT 1), "
                . "'" . $child['sorting'] . "', '" . $child['multi_input_type'] . "', (NULL), (NULL), (NULL), '" . $child['show_label'] . "', '1', 'ADMIN', now(),'" . $child['multi_ans_code'] . "'); ";
        echo '<pre>';
        print_r($sql);
        echo '</pre>';
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();

        if ($child['ref_element_code'] !== '(NULL)' && $child['show_label_child'] !== '(NULL)'):
            $sql = "INSERT INTO ref_multiple_item (doc_name_id, element_code, multiple_desc_code, ref_element_code, show_label, created_by, created_date, multi_answer_desc) "
                    . " VALUES ('" . (int) $docID . "', (SELECT element_code FROM ref_document_element WHERE element_desc = '" . $child['element_code'] . "' LIMIT 1),"
                    . "(SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc = '" . $child['multi_ans_code'] . "' LIMIT 1), "
                    . "(SELECT element_code FROM ref_document_element WHERE element_desc = '" . $child['ref_element_code'] . "' LIMIT 1), '" . $child['show_label_child'] . "', 'ADMIN', now(), "
                    . "'" . $child['multi_ans_code'] . "'); ";
            echo '<pre>';
            print_r($sql);
            echo '</pre>';
            $this->db->connect();
            $this->db->prepare($sql);
            $this->db->queryexecute();
        endif;

        return true;
    }

    public function getMaxItem() {
        $sql = "SELECT MAX(ref_multiple_item_id)+1 AS ref_multiple_item_id FROM ref_multiple_item";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function InsertChild($docID, $elementID, $childmult) {
        if (isset($childmult['parent_element_code'])):
            $parent = $childmult['parent_element_code'];
        endif;
        if (isset($childmult['child_element_code'])):
            $child = $childmult['child_element_code'];
        endif;
        $sql = "INSERT INTO ref_multiple_answer (doc_name_id, element_code, multiple_desc_code, sorting, input_type, parent_element_code, child_element_code, active, created_by, created_date, multi_answer_desc) "
                . "VALUES ('" . (int) $docID . "', '" . (int) $elementID . "', (SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc='" . $childmult['child_multiple_desc'] . "')+1, '" . (int) $childmult['child_sorting'] . "', '" . $childmult['child_input_type'] . "', $parent , $child, '1', 'ADMIN', NOW(), '" . $childmult['child_multiple_desc'] . "' )";
//        $sql = "INSERT INTO ref_multiple_item (ref_multiple_item_id, doc_name_id, element_code, multiple_desc_code, ref_element_code, created_by, created_date, multi_answer_desc) "
//                . "VALUES($max,'".(int) $docID."', '".(int) $elementID."', (SELECT multiple_desc_code FROM ref_multiple_desc WHERE multiple_desc='".$mult['multiple_desc']."'), '6330', 'ADMIN', NOW(), '".$mult['multiple_desc']."')";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function InsertNewRefElement(array $val) {
        $sql = "INSERT INTO document_element (doc_name_id, section_sorting, section_code, sorting, parent_element_code, created_by, created_date)"
                . "VALUES ('" . (int) $val['documentId'] . "','" . (int) $val['section_sorting'] . "','" . (int) $val['sectionId'] . "','" . (int) $val['sorting'] . "',"
                . " '" . (int) $val['parent_element_code'] . "',  'ADMIN', NOW()) ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function DeleteElementData($docId, $sectionCode, $elementCode) {
        $sql = "DELETE FROM document_element "
//                . "SET active = '0' "
                . "WHERE doc_name_id='" . (int) $docId . "' AND section_code='" . (int) $sectionCode . "' AND parent_element_code='" . (int) $elementCode . "'";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function DeleteEditSectionData($docId, $sectionCode) {
        $sql = "DELETE FROM document_element "
                . "WHERE doc_name_id='" . (int) $docId . "' AND section_code='" . (int) $sectionCode . "'";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function DeleteDocumentData($docId) {
        $sql = "UPDATE document "
                . "SET active_status = '0' "
                . "WHERE doc_name_id='" . (int) $docId . "'";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function DeleteMethodData($docId) {
        $sql = "UPDATE ref_document_method "
                . "SET active_status = '0' "
                . "WHERE doc_method_code='" . (int) $docId . "'";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function DeleteSectionData($docId) {
        $sql = "DELETE FROM ref_document_section "
                . "WHERE section_code='" . (int) $docId . "'";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function DeleteElementsData($docId) {
        $sql = "DELETE FROM ref_document_element "
                . "WHERE element_code='" . (int) $docId . "'";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
    //4Ogos20
    public function DeletePredefineData($docId) {
        $sql = "DELETE FROM ref_multiple_desc "
                . "WHERE multiple_desc_code='" . (int) $docId . "'";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

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
//            echo '<pre>';
//            print_r($jsonDoc);
//            echo '</pre>';
        $sql = "UPDATE document_template SET "
                . "json_template = '$jsonDoc', "
                . "updated_date = now(), "
                . "updated_by = 'ADMIN' "
                . "WHERE doc_name_id='" . (int) $docNameId . "' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function UpdateNewJSONDocument($documents) {
        $jsonForm = $this->jsonForm;
        $docNameId = $this->documentId;
        $newLine = array('\r\n', '\n', '\r');
        $replace = '<br />';
        $json = str_replace($newLine, $replace, $jsonForm);
        $jsonDoc = addslashes($json);

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

    public function searchMethod($method_code) {
        $sql = " SELECT image_path "
                . " FROM ref_document_method "
                . " WHERE doc_method_code = $method_code ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
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
                . " FROM ref_document_method "
                . "ORDER BY doc_method_desc ASC ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function ListMultAns() {
        $sql = "SELECT DISTINCT input_type "
                . "FROM ref_multiple_answer WHERE input_type IS NOT NULL "
                . "ORDER BY input_type ASC ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function ListMultAnsDesc() {
        $sql = "SELECT multiple_desc_code, multiple_desc "
                . "FROM ref_multiple_desc "
                . "ORDER BY multiple_desc ASC ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    //zarith-8/3
    public function InsertNewForm(array $outputS) {
        $sql = "INSERT INTO document_element (doc_name_id, section_sorting, section_code, sorting, parent_element_code, created_by, created_date) "
                . "VALUES ((SELECT doc_name_id FROM document WHERE doc_name_desc = '" . $outputS['doc_name_id'] . "'), '" . $outputS['section_sorting'] . "', "
                . "(SELECT section_code FROM ref_document_section WHERE section_desc = '" . $outputS['section_code'] . "' LIMIT 1), '" . $outputS['sorting'] . "', "
                . "(SELECT DISTINCT element_code FROM ref_document_element WHERE element_desc ='" . $outputS['parent_element_code'] . "' LIMIT 1), 'ADMIN', NOW()) ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    //zarith-18/3
    public function InsertNewSection(array $outputS) {
        $sql = "INSERT INTO document_element (doc_name_id, section_sorting, section_code, sorting, parent_element_code, child_element_code,element_level, element_properties, input_type,active,  created_by, created_date) "
                . "VALUES ((SELECT doc_name_id FROM document WHERE doc_name_id = '" . $outputS['doc_name_id'] . "'), '" . $outputS['section_sorting'] . "', "
                . "(SELECT section_code FROM ref_document_section WHERE section_code = '" . $outputS['section_code'] . "' LIMIT 1), '" . $outputS['sorting'] . "', "
                . "(SELECT DISTINCT element_code FROM ref_document_element WHERE element_code ='" . $outputS['parent_element_code'] . "' LIMIT 1), "
                . "(SELECT DISTINCT element_code FROM ref_document_element WHERE element_code ='" . $outputS['child_element_code'] . "' LIMIT 1), "
                . "'1','" . $outputS['element_properties'] . "','" . $outputS['input_type'] . "','0','ADMIN', NOW()) ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function checkElementLevel($elementId, $docId) {
        $sql = "SELECT element_level "
                . "FROM document_element "
                . "WHERE doc_name_id = '$docId' AND parent_element_code = '$elementId' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function checkShowLabel($elementId, $docId) {
        $sql = "SELECT show_label "
                . "FROM ref_multiple_answer "
                . "WHERE doc_name_id = '$docId' AND element_code = '$elementId' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
     public function GetUsedElement($doc_Id, $section_Id) {
        $sql = "SELECT de.parent_element_code, rde.element_desc FROM document_element de "
                . "LEFT JOIN ref_document_element rde ON (rde.element_code = de.parent_element_code) "
                . "WHERE doc_name_id='$doc_Id' AND section_code='$section_Id' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function GetAllNcpDocuments() {
        $sql = "SELECT doc_name_id, doc_name_desc FROM document WHERE doc_name_desc LIKE '%NURSING CARE PLAN%'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
     public function GetAllNcpDiagnosis() {
        $sql = "SELECT rma.doc_name_id, d.doc_name_desc, rma.element_code, rde.element_desc, rma.multiple_desc_code, rmd.multiple_desc, rma.input_type, rma.method "
                . "FROM ref_multiple_answer rma "
                . "INNER JOIN ref_document_element rde ON(rde.element_code = rma.element_code) "
                . "INNER JOIN ref_multiple_desc rmd ON(rmd.multiple_desc_code = rma.multiple_desc_code) "
                . "INNER JOIN document d ON (d.doc_name_id = rma.doc_name_id) "
                . "WHERE d.doc_name_desc LIKE '%NURSING CARE PLAN%' LIMIT 1";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function GetNcpDiagnosis($doc_Id) {
        $sql = "SELECT rma.doc_name_id, d.doc_name_desc, rma.element_code, rde.element_desc, rma.multiple_desc_code, rmd.multiple_desc, rma.input_type, rma.method "
                . "FROM ref_multiple_answer rma "
                . "INNER JOIN ref_document_element rde ON(rde.element_code = rma.element_code) "
                . "INNER JOIN ref_multiple_desc rmd ON(rmd.multiple_desc_code = rma.multiple_desc_code) "
                . "INNER JOIN document d ON (d.doc_name_id = rma.doc_name_id) "
                . "WHERE rma.doc_name_id = '$doc_Id'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function GetAllNcpDocumentsGroup($documentArray) {
        $doc_Id = $documentArray['discipline'];
        if (isset($documentArray['doc_group'])) {
            $doc_group = $documentArray['doc_group'];
        } else {
            $doc_group = 0;
        }
        $sql = "SELECT rma.doc_name_id, d.doc_name_desc, rma.element_code, rde.element_desc, rma.multiple_desc_code, rmd.multiple_desc, rma.input_type, rma.method "
                . "FROM ref_multiple_answer rma "
                . "INNER JOIN ref_document_element rde ON(rde.element_code = rma.element_code) "
                . "INNER JOIN ref_multiple_desc rmd ON(rmd.multiple_desc_code = rma.multiple_desc_code) "
                . "INNER JOIN document d ON (d.doc_name_id = rma.doc_name_id) "
                . "WHERE rma.doc_name_id = '$doc_Id' AND rma.element_code='$doc_group'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function GetNcpDiagnosisId($doc_Id, $doc_group) {
        $sql = "SELECT rma.doc_name_id, d.doc_name_desc, rma.element_code, rde.element_desc, rma.multiple_desc_code, rmd.multiple_desc, rma.input_type, rma.method "
                . "FROM ref_multiple_answer rma "
                . "INNER JOIN ref_document_element rde ON(rde.element_code = rma.element_code) "
                . "INNER JOIN ref_multiple_desc rmd ON(rmd.multiple_desc_code = rma.multiple_desc_code) "
                . "INNER JOIN document d ON (d.doc_name_id = rma.doc_name_id) "
                . "WHERE rma.doc_name_id = '$doc_Id' AND rma.element_code='$doc_group'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }
    
    public function UpdateNcpMethod($documentArray) {
        $jsonForm = $documentArray['ncp_method'];
        $documentId = $documentArray['doc_id'];
        $elementId = $documentArray['element_id'];
        $multipleId = $documentArray['multiple_id'];
        $newLine = array('\r\n', '\n', '\r');
        $replace = '<br />';
        $json = str_replace($newLine, $replace, $jsonForm);
        $jsonDoc = addslashes($json);

        $sql = "UPDATE ref_multiple_answer SET method='" . $jsonDoc . "' WHERE doc_name_id='" . (int) $documentId . "' "
                . "AND element_code='" . (int) $elementId . "'"
                . "AND multiple_desc_code='" . (int) $multipleId . "' ";
        print_r($sql);
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }

    public function GetAllHyperlink() {
        $sql = "SELECT hyperlink_code, hyperlink_desc FROM ref_hyperlink";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function InsertNewHyperlink(array $val) {
        $sql = "INSERT INTO document_hyperlink (doc_name_id, element_code, hyperlink_code, child_element_code, active_status, created_by, created_date)"
                . "VALUES ('" . (int) $val['documentId'] . "','" . (int) $val['parent_element_code'] . "','" . (int) $val['hyperlink_code'] . "','" . (int) $val['element_group'] . "',"
                . " '1','ADMIN', NOW()) ";
        
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
    
     public function checkShowHyperlink($elementId, $docId) {
        $sql = "SELECT rh.icon_path, dh.hyperlink_code, rh.hyperlink_desc "
                . "FROM document_hyperlink dh "
                . "INNER JOIN ref_hyperlink rh ON( rh.hyperlink_code = dh.hyperlink_code) "
                . "WHERE dh.doc_name_id='$docId' AND dh.element_code='$elementId' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
   
     public function GetAllPDSGroup() {
       $sql = "SELECT doc_group_code, doc_group_desc FROM ref_document_group where doc_group_code='PDS'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function GetAllPDSDocument() {
        $sql = "SELECT doc_name_id as code, doc_group_code, dc_type_code,doc_name_desc as label FROM document WHERE doc_group_code='PDS'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function GetAllPDSList() {
        $sql = "SELECT d.doc_group_code, d.doc_name_id, d.doc_name_desc as label, dt.template_id, dt.json_template, gd.discipline_name  "
                . "FROM document d "
                . "INNER JOIN document_template dt ON dt.doc_name_id = d.doc_name_id "
                . "INNER JOIN discipline_document dd ON(d.doc_name_id=dd.doc_name_id) "
                . "LEFT JOIN ref_generaldisciplines gd ON(dd.discipline_code=gd.discipline_code) "
                . "INNER JOIN ref_document_group dg ON dg.doc_group_code = d.doc_group_code "
                . "WHERE d.doc_group_code='PDS'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function GetAllPdsDocumentsGroup($documentArray) {
        $doc_Id = $documentArray['discipline'];
        if (isset($documentArray['doc_group'])) {
            $doc_group = $documentArray['doc_group'];
        } else {
            $doc_group = 0;
        }
        $sql = "SELECT d.doc_group_code, d.doc_name_id AS code, d.doc_name_desc AS label, dt.template_id, dt.json_template, gd.discipline_name "
                . "FROM document d "
                . "INNER JOIN document_template dt ON dt.doc_name_id = d.doc_name_id "
                . "INNER JOIN discipline_document dd ON(d.doc_name_id=dd.doc_name_id)"
                . "LEFT JOIN ref_generaldisciplines gd ON(dd.discipline_code=gd.discipline_code)"
                . "INNER JOIN ref_document_group dg ON dg.doc_group_code = d.doc_group_code "
                . "WHERE d.doc_name_id = '$doc_group' AND d.doc_group_code='$doc_Id'";
        
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }
    
    public function GetPdsDocument($doc_Id, $temp_Id) {
        $sql = "SELECT d.doc_group_code, d.doc_name_id, d.doc_name_desc, dt.template_id, dt.json_template, dg.doc_group_desc "
                . "FROM document d "
                . "INNER JOIN document_template dt ON dt.doc_name_id = d.doc_name_id "
                . "INNER JOIN ref_document_group dg ON dg.doc_group_code = d.doc_group_code "
                . "WHERE d.doc_name_id = '$doc_Id' AND dt.template_id='$temp_Id'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('object');
        return $result[0];
    }
    
     public function UpdatePdsMethod($documentArray) {
        $jsonForm = $documentArray['pds_method'];
        $documentId = $documentArray['doc_id'];
        $tempId = $documentArray['temp_id'];
        $newLine = array('\r\n', '\n', '\r');
        $replace = '<br />';
        $json = str_replace($newLine, $replace, $jsonForm);
        $jsonDoc = addslashes($json);
      

        $sql = "UPDATE document_template SET json_template='" . $jsonDoc . "' WHERE doc_name_id='" . (int) $documentId . "' "
                . "AND template_id='" . (int) $tempId . "'";
        
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return true;
    }
}
