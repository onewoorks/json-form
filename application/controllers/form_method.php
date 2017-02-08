<?php

class Form_Method_Controller extends Common_Controller {

    public $par = URL_ARRAY;
    
    public function TypeOfConception(){
        $options = array('spontaneous','assisted');
        $drugUsed = array('procedures','drugused');
        $drugUsedChild = array('Clomid', 'Gonadotropin');
        $drugProcedureChild = array('IUI','IVF','ICSI');
        include_once 'application/views/form_methods/type_of_conceptions.php';
    }
}
