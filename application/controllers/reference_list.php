<?php

class Reference_List_Controller {

    static function GetReferenceList($elementCode, $docNameId, $tree) {
//        echo $docNameId.'----';
        $list = new Reference_List_Model();
        $return = false;
        switch ($tree):
            case 'parent':
                $return = $list->GetReferenceList($elementCode, $docNameId);
                break;
            case 'child':
                $return = $list->GetChildMultipleAnswerList($elementCode, $docNameId);
                break;
            case 'parent-id':
                $return = $list->GetReferenceListInMultipleAnswer($elementCode, $docNameId);
                break;
        endswitch;
        return $return;
    }

}
