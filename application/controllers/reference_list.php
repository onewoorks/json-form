<?php

class Reference_List_Controller {
    
    static function GetReferenceList($elementCode,$tree){
        $list = new Reference_List_Model();
        $return = false;
        switch($tree):
            case 'parent':
                $return = $list->GetReferenceList($elementCode);
                break;
            case 'child':
                $return = $list->GetChildMultipleAnswerList($elementCode);
                break;
            case 'parent-id':
                $return = $list->GetReferenceListInMultipleAnswer($elementCode);
                break;
        endswitch;
        return $return;
    }
    
}