<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    protected $nombre;
    protected $email;
    protected $token;


    public function __construct($nombre,$email,$token)
    {
        $this->nombre=$nombre;
        $this->email=$email;
        $this->token=$token;
    }


    public function enviarConfirmacion(){

        $mail= new PHPMailer();
        //configurar SMTP
      $mail->isSMTP();
      // $mail->Host='smtp.gmail.com';  //especifico de gmail
       $mail->Host='sandbox.smtp.mailtrap.io'; 
       $mail->SMTPAuth=true;
       $mail->Username='ca03251c7f4c46';
       $mail->Password='359fd3bb1ae93f';
     //  $mail->SMTPSecure='tls';   //canal seguro
       $mail->Port=2525;

       $mail->setFrom('pruebaproyectosjr@gmail.com', 'Agenda');

       $mail->addAddress('correo@correo.com', 'Agenda');  //quien recibe

       $mail->Subject='Confirma tu contraseña';

       $mail->isHTML(true);
       $mail->CharSet='UTF-8';  //PARA admitir acentos y otras cosas
         
         $contenido= '<html>';
         $contenido .='<p>Confirma tú Password</p>';
         $contenido .='<p>Presiona en el siguiente enlace</p>';
         $contenido .="<p> Pincha aqui: <a href='http://localhost:3000/confirmar?token=" .
         $this->token . "'>Confirma Password</a></p>";
          $contenido .= '</html>';
    
         $mail->Body=$contenido;
         $mail->send();
    }



    public function enviarInstrucciones(){

      $mail= new PHPMailer();
      //configurar SMTP
     $mail->isSMTP();
     // $mail->Host='smtp.gmail.com';  //especifico de gmail
     $mail->Host='sandbox.smtp.mailtrap.io'; 
     $mail->SMTPAuth=true;
     $mail->Username='ca03251c7f4c46';
     $mail->Password='359fd3bb1ae93f';
     //  $mail->SMTPSecure='tls';   //canal seguro
     $mail->Port=2525;


     $mail->setFrom('pruebaproyectosjr@gmail.com', 'Agenda');

     $mail->addAddress('correo@correo.com', 'Agenda');  //quien recibe

     $mail->Subject='Reestablecer tu contraseña';

     $mail->isHTML(true);
     $mail->CharSet='UTF-8';  //PARA admitir acentos y otras cosas
       
       $contenido= '<html>';
       $contenido .='<p>Reestablece tú Password</p>';
       $contenido .='<p>Presiona en el siguiente enlace</p>';
       $contenido .="<p> Pincha aqui: <a href='http://localhost:3000/reestablecer?token=" .
       $this->token . "'>Reestablecer Password</a></p>";
        $contenido .= '</html>';
  
       $mail->Body=$contenido;
       $mail->send();
  }





}