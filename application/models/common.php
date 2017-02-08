<?php 

class Common_Model {
    
    public $statusItemDalamStok = 10;
    public $statusItemTelahJual = 11;
    
    private $allowCategory = array('916','999','750','585','925');
    
    private $mainKategori = array('biasa','rantai','cincin','gelang');
    private $subKategoriRantai = array('rantai kaki','rantai leher','rantai padu','rantai tangan kosong','rantai tangan fesyen');
    
    private $prefixBiasa = array(35,36);
    private $prefixRantai = array(32,33,34);
    private $prefixCincin = array(27,28,29,30,31);
    private $prefixGelang = array(37);
    
    private $rantaiKaki = array(4);
    private $rantaiLeher = array(8);
    private $rantaiPadu = array(9);
    private $rantaiTanganKosong = array(10);
    private $rantaiTanganFesyen = array(11,12,13,14);
    
    private $cincinPerak = array(1);
    private $cincinEmas = array(2);
    private $cincinEmasPermata = array(3);
    
    private $subangEmas = array(5);
    
    private $gelangEmas = array(6);
    
    public function WhereKategoryTerpilih(){
        $where = 'kod_Purity = ' . implode(' OR kod_Purity = ',$this->allowCategory);
        return $where;
    }
    
    public function SenaraiKategori(){
        $categories = $this->mainKategori;
        $info = array();
        foreach($categories as $categories):
            $categoryId = 'prefix'.ucfirst($categories);
            $info[$categories] = $this->$categoryId;
        endforeach;
        return $info;
    }
    
   
    
    public function ProdukBiasa(){
        
    }
    
    public function ProdukRantai(){
        
    }
    
    public function ProdukCincin(){
        
    }
    
    public function ProdukGelang(){
        
    }
    
    
}