<?php
namespace Model; 

use Model\ActiveRecord;

 class Proyecto extends ActiveRecord{

    protected static $tabla='proyectos';
    protected static $columnasDB= ['id','proyecto','url','usuarioid'];

    public function __construct($args= [])
    {
      $this->id=$args['id']?? null;
      $this->proyecto=$args['proyecto']?? '';
      $this->url=$args['url'] ?? '';
      $this->usuarioid=$args['usuarioid']?? '';
    }


    public  function validarProyecto(){

      if(!$this->proyecto){
         self::$alertas['error'][]='Introduzca su Proyecto';
      }
     return self::$alertas;
    }

 }

