<?php
namespace Controllers;

use Model\Proyecto;
use Model\Usuario;
use MVC\Router;

class DashboardController{


    public static function index(Router $router){
        session_start();
        isAuth();

        $id=$_SESSION['id'];

        $proyectos= Proyecto::belongTo('usuarioid',$id);
      
        $router->render( 'dashboard/index',[

            'titulo'=>'Proyectos',
            'proyectos'=>$proyectos
        ]);
    }


    public static function crear_proyecto(Router $router){
        session_start();
         isAuth(); //proteger ruta

        $alertas=[];

        if($_SERVER['REQUEST_METHOD']==='POST'){
          
            $proyecto= new Proyecto($_POST);
             $alertas=$proyecto->validarProyecto();

            if(empty($alertas)){

                //crear codigo url
                $hash=md5(uniqid());
                $proyecto->url=$hash;

                //obtener id usuario
                $proyecto->usuarioid=$_SESSION['id'];

                $proyecto->guardar();

                header('Location: /proyecto?id=' . $proyecto->url);
                
            }
        }
       
        $router->render('dashboard/crear-proyecto',[
            'alertas'=>$alertas,
            'titulo'=>'Crear Proyecto'
        ]);
    }


    public static function proyecto(Router $router){
        session_start();
        isAuth(); //proteger ruta
        $token= $_GET['id'];

        if(!$token) header('Location: /dashboard');
        //revisar si el usuario es el creador
      $proyecto= Proyecto::where('url',$token);

      if($proyecto->usuarioid !==$_SESSION['id']){
        header('Location: /dashboard');
      }

        $router->render('dashboard/proyecto', [
            'titulo'=>$proyecto->proyecto
        ]);
    }



    public static function perfil(Router $router){
        session_start();
        isAuth();
        $alertas = [];
         $usuario=Usuario::find($_SESSION['id']);
         if($_SERVER['REQUEST_METHOD']==='POST'){

          $usuario->sincronizar($_POST);
          $alertas=$usuario->validarPerfil();

          if(empty($alertas)){
            $existeUsuario = Usuario::where('email', $usuario->email);

            if($existeUsuario && $existeUsuario->id !== $usuario->id ) {
                // Mensaje de error
                Usuario::setAlerta('error', 'Email no válido, ya pertenece a otra cuenta');
                $alertas = $usuario->getAlertas();
            } else {
                // Guardar el registro
                $usuario->guardar();

                Usuario::setAlerta('exito', 'Guardado Correctamente');
                $alertas = $usuario->getAlertas();

                // Asignar el nombre nuevo a la barra
                $_SESSION['nombre'] = $usuario->nombre;
            }
          }

         }

        $router->render('dashboard/perfil',[
            'usuario'=>$usuario,
            'titulo'=>'Perfil',
            'alertas'=>$alertas
        ]);
    }



    public static function cambiar_password(Router $router){
        session_start();
        isAuth();
        $alertas = [];
       
       if($_SERVER['REQUEST_METHOD']==='POST'){
        $usuario=Usuario::find($_SESSION['id']);
        $usuario->sincronizar($_POST);
        $alertas=$usuario->nuevo_Password();
    
        if(empty($alertas)){
          $resultado=$usuario->comprobarPassword();

          if($resultado){
            
             $usuario->password=$usuario->password_nuevo;
             //elimina
             unset($usuario->password_actual);
             unset($usuario->password_nuevo); 

             $usuario->hashPassword();
            $resultado= $usuario->guardar();
            if($resultado){
                Usuario::setAlerta('exito', 'Password Guardado');
                $alertas=Usuario::getAlertas();
            }

          }else{
            Usuario::setAlerta('error', 'Password Erroneo');
            $alertas=Usuario::getAlertas();
          }
        }


       }
        $router->render('dashboard/cambiar-password',[
           // 'usuario'=>$usuario,
            'titulo'=>'Cambiar Password',
            'alertas'=>$alertas
        ]);
    }
}