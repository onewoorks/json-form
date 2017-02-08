<?php

class Common_Form_Method {

    public function Orders() {
        include_once VIEW . '/form_methods/common/orders.php';
    }

    public function SeenDiscussedRecord() {
        $seenByRecords = array(
            array(
                'name' => 'Dr Adam Malik (12345)',
                'designation' => 'Pegawai Perubatan (UD38)'
            ),
            array(
                'name' => 'Dr. Wan Kadir bin Wan Karim (34556)',
                'designation' => 'Pegawai Perubatan (UD48)'
            ),
            array(
                'name' => 'Dr. Siti Khatijah Bt Mukhriz (12346)',
                'designation' => 'Pegawai Perubatan (UD48)')
        );

        $discussedWith = array(
            array(
                'name' => 'Dr. Nik Yahya bin Nik Abas (34556)',
                'designation' => 'Pakar Perubatan (UD54)'
            )
        );
        include_once VIEW . '/form_methods/common/seen_discussed_record.php';
    }
    
    public function AlertAndAllergies(){
        include_once VIEW .'/form_methods/common/alert_and_allergies.php';
    }
    
    public function VitalSign(){
        include_once VIEW . '/form_methods/common/vital_sign.php';
    }
    
    public function Signature(){
        include_once VIEW . '/form_methods/common/signature.php';
    }

}
