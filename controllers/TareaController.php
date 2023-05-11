<?php
namespace Controllers;

use Model\Proyecto;
use Model\Tarea;
use MVC\Router;

class TareaController{

    public static function index(Router $router){
       $proyectoid=$_GET['id'];
       if(!$proyectoid)header('Location: /dashboard');
        
       $proyecto=Proyecto::where('url',$proyectoid);

       session_start();
       if(!$proyecto || $proyecto->usuarioid !== $_SESSION['id']) header('Location: /404');

       $tareas= Tarea::belongTo('proyectoid',$proyecto->id);
       echo json_encode(['tareas'=>$tareas]); //lo mandamos
    }


    public static function crear(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            session_start();
            $proyectoid=$_POST['proyectoid']; 
            $proyecto=Proyecto::where('url',$proyectoid);

         if(!$proyecto|| $proyecto->usuarioid !==$_SESSION['id']) {
            $respuesta=['tipo'=>'error','mensaje'=>'Error al agregar Tarea'];
            echo json_encode($respuesta); //lo mandamos a javascript
            return;
         } 
      
         $tarea= new Tarea($_POST);
         $tarea->proyectoid=$proyecto->id;
         $resultado=$tarea->guardar();
         $respuesta=['tipo'=>'exito', 'id'=>$resultado['id'],'mensaje'=>'Tarea creada',
         'proyectoid'=>$proyecto->id];
         echo json_encode($respuesta);
        }

    }

    public static function actualizar(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
           
            $proyecto=Proyecto::where('url',$_POST['proyectoid']);
            session_start();
            if(!$proyecto|| $proyecto->usuarioid !==$_SESSION['id']) {
                $respuesta=['tipo'=>'error','mensaje'=>'Error al actualizar Tarea'];
                echo json_encode($respuesta); //lo mandamos a javascript
                return;
             } 

             $tarea= new Tarea($_POST);
             $tarea->proyectoid=$proyecto->id;
             $resultado=$tarea->guardar();
             if($resultado){
                $respuesta=['tipo'=>'exito', 'id'=>$tarea->id, 'mensaje'=>'Actualizado Correctamente',
                'proyectoid'=>$proyecto->id]; 
               echo json_encode(['respuesta'=>$respuesta]);
             }
    
        }
    }


    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $proyecto=Proyecto::where('url',$_POST['proyectoid']);
            session_start();
            if(!$proyecto|| $proyecto->usuarioid !==$_SESSION['id']) {
                $respuesta=['tipo'=>'error','mensaje'=>'Error al actualizar Tarea'];
                echo json_encode($respuesta); //lo mandamos a javascript
                return;
             } 

             $tarea= new Tarea($_POST);
             $resultado=$tarea->eliminar();

                $resultado=['resultado'=>$resultado,  'mensaje'=>'Eliminado Correctamente',
                'tipo'=>'exito']; 

               echo json_encode(['resultado'=>$resultado]);
             
        }


        
    }
}