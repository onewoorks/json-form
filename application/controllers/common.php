<?php

class Common_Controller {
    
    private function Masak(){
        return 'masak';
    }

    function form_array($arrays) {
        $val = array();
        foreach ($arrays as $v):
            $val[$v['name']] = $v['value'];
        endforeach;
        return $val;
    }

    public function RandomNumber() {
        return rand(100000, 999999);
    }

    public function SessionCheck($sessionName, $values) {
        $newArray = array();
        if (isset($_SESSION[$sessionName])):
            if (count($_SESSION[$sessionName]) == 0):
                $newArray = $values;
            else:
                $appendArray = $_SESSION[$sessionName];
                array_push($appendArray, $values);
            endif;
            $newArray = $appendArray;
        else:
            $newArray[0] = $values;
        endif;
        $_SESSION[$sessionName] = $newArray;
        return $newArray;
    }

    public function SessionCall($sessionName) {
        return $_SESSION[$sessionName];
    }

    public function SessionUnset($sessionName) {
        unset($_SESSION[$sessionName]);
        return true;
    }

    public function RenderOutput($file, $vars = null) {
        if (is_array($vars) && !empty($vars)) {
            extract($vars);
        }
        ob_start();
        include VIEW . '/' . $file . '.php';

        return ob_get_clean();
    }

     public function RefMainDiscipline() {
         $reference = new Reference_Table_Model();
         $disciplines = $reference->MainDiscipline();
         $result = array();
         foreach ($disciplines as $discipline):
             $result[] = array(
                 'value' => $discipline['main_discipline_code'],
                 'label' => $discipline['main_discipline_name']);
          endforeach;
          return $result;
      }
     
     public function RefGeneralDiscipline() {
         $reference = new Reference_Table_Model();
         $disciplines = $reference->GeneralDiscipline();
         $result = array();
         foreach ($disciplines as $discipline):
             $result[] = array(
                 'value' => $discipline['discipline_code'],
                 'label' => $discipline['discipline_name']);
         endforeach;
         return $result;
     }
 
    public function RefDocumentType($groupCode = null) {
        $reference = new Reference_Table_Model();
        $docType = $reference->DocumentType($groupCode);
        return $docType;
    }

    public function RefDocumentGroup() {
        $reference = new Reference_Table_Model();
        $docGroup = $reference->DocumentGroup();
        return $docGroup;
    }

    public function SelectOptionBuilder(array $values) {
        $option = '';
        foreach ($values as $value):
            $option .= "<option value='" . $value['code'] . "'>" . $value['label'] . "</option>";
        endforeach;
        return $option;
    }

    public function GenerateJSONFormatA($documentId, $action = 'insert') {
        $documentTemplate = new Document_Template_Model();
        $documentData = $documentTemplate->ReadDocumentSetup($documentId);
        $result['skeleton'] = $documentData;
        $result['document_title'] = $documentData[0]['doc_name_desc'];
        $sections = $documentTemplate->ReadDocumentSectionGroup($documentId);
        $documentArray = $this->GetDocumentSections($documentId, $sections);
        $result['json_elements'] = $documentArray;
        $this->CreateJSONForm($documentId, $documentArray, $action);
//        return true;
    }

    public function GenerateJSONFormat($documentId, $action = 'insert') {
        $documentTemplate = new Document_Template_Model();
        $documentData = $documentTemplate->ReadDocumentSetup($documentId);
        $result['skeleton'] = $documentData;
        $result['document_title'] = $documentData[0]['doc_name_desc'];
        $sections = $documentTemplate->ReadDocumentSectionGroup($documentId);

        $documentArray = $this->GetDocumentSections($documentId, $sections);

        $result['json_elements'] = $documentArray;
        $this->CreateJSONForm($documentId, $documentArray, $action);
        return true;
    }

    public function GetDocumentSections($documentId, $sections) {
        $documentSections = array();
        foreach ($sections as $section):
            $documentSections[$section['json_section']] = array(
                'json_section' => $section['json_section'],
                'section_code' => $section['section_code'],
                'section_desc' => $section['section_desc'],
                'section_sorting' => $section['section_sorting'],
                'elements' => $this->GetDocumentSectionElement($documentId, $section['section_code'])
            );
        endforeach;
        return $documentSections;
    }

    private function GetDocumentSectionElement($documentId, $sectionId) {
        $document = new Document_Template_Model();
        $elements = array();
        $sectionElements = $document->ReadDocumentSectionElements($documentId, $sectionId);
        foreach ($sectionElements as $elem):
            $elementItem = array();
            foreach ($elem as $key=>$el):
                if ($key == 'additional_attribute'):
                    $elementItem[$key] = json_decode($el);
                else:
                    $elementItem[$key] = $el;
                endif;
            endforeach;
            $elements[$elem['json_element']] = $elementItem;
        endforeach;
        return $elements;
    }

    public function CreateJSONForm($documentId, array $documentData, $action = 'insert') {
        $document = new Document_Template_Model();
        $document->documentId = $documentId;
        $document->jsonForm = json_encode($documentData);
//        echo $document->jsonForm;
        switch ($action):
            case 'insert':
                $document->CreateDocumentJSONFormat();
                break;
            case 'update':
//                echo $document->jsonForm;
//                print_r($documentData);
                $document->UpdateDocumentJSONFormat();
                break;
        endswitch;
        return true;
    }

    private function ObjectSorting($arr) {
        $data = (array) $arr;
        usort($data, function($a, $b) {
            return $a->section_sorting < $b->section_sorting ? -1 : 1;
        });
        return (object) $data;
    }

    private function ElementSorting($arr) {
        $data = (array) $arr;
        usort($data, function($a, $b) {
            return $a->sorting < $b->sorting ? -1 : 1;
        });
        return (object) $data;
    }

    private function SectionSorting($data) {
        $newArray = array();
        foreach ($data as $key => $sections):
            $aa = array();
            foreach ($sections as $s => $section):
                if ($s == 'elements'):
                    $aa[$s] = $this->ElementSorting($section);
                else:
                    $aa[$s] = $section;
                endif;
            endforeach;
            $newArray[$key] = (object) $aa;
        endforeach;
        return $this->ObjectSorting($newArray);
    }

    protected function JsonWithSectionSorting($data) {
        return $this->SectionSorting($data);
    }

}
