<?php

class Obstetrics_Clerking_Note_Method{
    
    public function OtherInfectiveScreenSpecify(){
        include_once VIEW . '/form_methods/ObstetricsClerkingNote/other_infective_screen_specify.php';
    }
    
    public function PastObstetricsHistory(){
        include_once VIEW . '/form_methods/ObstetricsClerkingNote/past_obstetrics_history.php';
    }
    
    public function BreastTable(){
        include_once VIEW . '/form_methods/ObstetricsClerkingNote/breast.php';
    }
}