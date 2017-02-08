<?php

class Forms_Controller extends Common_Controller {
    
    public function main(array $getVars, array $params = null) {
        $case = str_replace('?', '', $params[URL_ARRAY + 1]);
        $ajax = false;
        switch ($case):
            default:
                $documentId = $params[URL_ARRAY+1];
                $docTemplate = new Document_Template_Model();
                $output = $docTemplate->ReadDocumentTemplate($documentId);
                $result['link_style'] = "<link href='localhost/FORMjson/assets/library/summernote/' rel='stylesheet' />";
                $result['form_element'] = $output;
                $result['form_title'] = $output['doc_name_desc'];
                $result['doc_components'] = json_decode($output['json_template']);
                break;
        endswitch;

        if (!$ajax):
            $result['header'] = $this->RenderOutput('common/main',$result['link_style']);
            $result['footer'] = $this->RenderOutput('common/footer');
            $view = new View_Model('forms/index');
            $view->assign('content', $result);
        endif;
    }

}