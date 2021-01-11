<?php

namespace Hcode;

use Rain\TpL;

class Page {

        // ATRIBUTOS    
        private $tpl;
        private $options = [];
        private $defaults =[
            "data"=>[]
        ];
    

        //METODOS 

    //Ele vai contruir o site dessa base com a variavel magica: __construct
    public function __construct($opts = array()){

        $this->options = array_merge($this->defaults, $opts); //array merge = Ele vai mescla dois arrays

                // config
                $config = array(
                            "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/",
                            "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/", 
                            "debug"         => false
                );

        Tpl::configure( $config );

        $this->tpl = new Tpl; //ok

        $this->setData($this->options["data"]); 

        foreach ($this->options["data"] as $key => $value){
            $this->tpl->assign($key,$value); //assing = 
        }

        $this->tpl->draw("header");//Ele vai repetir toda vez que colocar header em todas
    }


    private function setData($data = array())
    {
        foreach ($data as $key => $value){
            $this->tpl->assign($key,$value);
        }
    }       

    // $this->tpl->draw("header");
    public function setTpl($name, $data =array(), $returnHTML = false){
        
        $this->setData($data);

        return $this->tpl->draw($name, $returnHTML);
    }





    //metodo magico: __destruct 
    public function __destruct(){
        $this->tpl->draw("footer");
    }
    
}


?>