<?php

namespace Model;

class Usuario extends ActiveRecord{

    protected static $tabla='usuarios';
    protected static $columnasDB=['id', 'nombre', 'email', 'password', 'token', 'confirmado'];


  public function __construct($args =[])
  {
     $this->id = $args['id'] ?? null;
     $this->nombre =$args['nombre'] ?? '';
     $this->email=$args['email'] ?? '';
     $this->password=$args['password'] ?? '';
     $this->password2=$args['password2'] ?? '';
     $this->password_actual=$args['password_actual'] ?? '';
     $this->password_nuevo=$args['password_nuevo'] ?? '';
     $this->token=$args['token'] ?? '';
     $this->confirmado=$args['confirmado'] ?? 0;
  }
 

  public function validarLogin(){
    if(!$this->email){

      self::$alertas['error'][]= 'Email del Usuario es Obligatorio';
    }

    if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
      self::$alertas['error'][]='Email no valido';
    }
  
    if(!$this->password){
      self::$alertas['error'][]="Introduzca su contraseña";
    }

    return self::$alertas;
  }


public function validarNuevaCuenta(){
  if(!$this->nombre){

    self::$alertas['error'][]= 'Nombre del Usuario es Obligatorio';
  }

  if(!$this->email){

    self::$alertas['error'][]= 'Email del Usuario es Obligatorio';
  }
  if(!$this->password){
    self::$alertas['error'][]="Introduzca su contraseña";
  }

  if(strlen($this->password)<6){
    self::$alertas['error'][]="La contraseña debe tener al menos 6 caracteres";
   }

   if($this->password !==$this->password2){
    self::$alertas['error'][]="La contraseña no coincide";
   }
  return self::$alertas;
}


public function validarEmail(){
  if(!$this->email){
   self::$alertas['error'][]='Email obligatorio';
  }

  if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
    self::$alertas['error'][]='Email no valido';
  }

  return self::$alertas;
}


public function validarPassWord(){
  if(!$this->password){
    self:: $alertas[]="Introduzca su contraseña";
  }
  if(strlen($this->password)<6){
    self::  $alertas[]="La contraseña debe tener al menos 6 caracteres";
   }
  return self::$alertas;

}


public function nuevo_Password() : array{
  if(!$this->password_actual){
    self:: $alertas['error'][]="Introduzca su contraseña";
  }
  if(strlen($this->password_actual)<6){
    self::  $alertas['error'][]="La contraseña debe tener al menos 6 caracteres";
   }
   if(!$this->password_nuevo){
    self:: $alertas['error'][]="Introduzca nueva contraseña";
  }
  if(strlen($this->password_nuevo)<6){
    self::  $alertas['error'][]="La contraseña nueva debe tener al menos 6 caracteres";
   }

  return self::$alertas;
}


public function comprobarPassword() :bool{
  return password_verify($this->password_actual, $this->password);
}

public function validarPerfil(){
  if(!$this->nombre) {
    self::$alertas['error'][] = 'El Nombre es Obligatorio';
  }
  if(!$this->email) {
    self::$alertas['error'][] = 'El Email es Obligatorio';
  }

  return self::$alertas;
}

public function hashPassword(){
  $this->password=password_hash($this->password, PASSWORD_BCRYPT);
 }


 public function crearToken() : void{
  $this->token=uniqid();
 }



}

