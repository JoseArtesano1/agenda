<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{

    public static function login(Router $router){
      $script='';
        $alertas=[];
        if($_SERVER['REQUEST_METHOD']==='POST'){
           $auth=new Usuario($_POST);
           
           $alertas=$auth->validarLogin();

           if(empty($alertas)){

            //existe usuario

            $usuario= Usuario::where('email',$auth->email);

            if(!$usuario || !$usuario->confirmado){
                $alertas=Usuario::setAlerta('error', 'No existe este Usuario o No está confirmado');
            }else{
                if(password_verify($auth->password, $usuario->password)){
                    session_start();
                    $_SESSION['id']=$usuario->id;
                    $_SESSION['nombre']=$usuario->nombre;
                    $_SESSION['email']=$usuario->email;
                    $_SESSION['login']=true;

                    header('Location: /dashboard');
                }else{
                    $alertas=Usuario::setAlerta('error', 'Password Incorrecta');
                }
            }
           }
        }
        $script .='<script src="build/js/mensajes.js"></script>
          <script src="build/js/limpiar.js"></script>';
        //render a la vista
       $alertas=Usuario::getAlertas();

        $router->render('auth/login',[
            'titulo'=>'Iniciar Sesión',
            'alertas'=>$alertas,
            'script'=>$script
        ]);
    }



    public static function logout(){
       session_start();
       $_SESSION=[];
       header('Location: /');

    }


    public static function crear(Router $router){
          $usuario= new Usuario;
        $alertas= [];
        $script='';
        if($_SERVER['REQUEST_METHOD']==='POST'){
          $usuario->sincronizar($_POST);
           $alertas=$usuario->validarNuevaCuenta();
        
         // $usuario= new Usuario($_POST['usuario']);
          if(empty($alertas)){

            $existeUsuario=Usuario::where('email',$usuario->email);

            if($existeUsuario){
              Usuario::setAlerta('error','El usuario ya existe');
              $alertas=Usuario::getAlertas();
            
            }else{
               
                //Hasear Password
                $usuario->hashPassword();
                //eliminar password2
                unset($usuario->password2);
                $usuario->crearToken();
              
                //new user
                $resultado=  $usuario->guardar();
                
                //email
                $email=new Email($usuario->nombre, $usuario->email,$usuario->token);
                $email->enviarConfirmacion();

               if($resultado){
                    header('Location: /mensaje');
                }
            }
          }

        }
        $script .='<script src="build/js/mensajes2.js"></script>
        <script src="build/js/limpiar.js"></script>';
         //render a la vista
         $router->render('auth/crear',[
            'titulo'=>'Crea Tú Cuenta en Agenda',
            'usuario'=>$usuario,
            'alertas'=>$alertas,
            'script'=>$script
        ]);
    }



    public static function olvide(Router $router){
        $alertas=[];
        $script='';
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuario= new Usuario($_POST);
            $alertas= $usuario->validarEmail();

            if(empty($alertas)){

                $existeUsuario=Usuario::where('email',$usuario->email);

                if($existeUsuario && $existeUsuario->confirmado){
                    $existeUsuario->crearToken();
                    unset($existeUsuario->password2);
                    //Edit user
                    $resultado=  $existeUsuario->guardar();
                    
                    //email
                    $email=new Email($existeUsuario->nombre, $existeUsuario->email,$existeUsuario->token);
                    $email->enviarInstrucciones();
                    Usuario::setAlerta('exito','Instrucciones en tú Email');
                  
                }else{
                    Usuario::setAlerta('error','El usuario no existe');
                }

            }
        }

        $script .='<script src="build/js/mensajes3.js"></script>
        <script src="build/js/limpiar.js"></script>';

        $alertas=Usuario::getAlertas();
        $router->render('auth/olvide',[
            'titulo'=>'Recuperar',
            'alertas'=>$alertas,
            'script'=>$script
        ]);
    }



    public static function reestablecer(Router $router){
        $token=s($_GET['token']);   
        $mostrar=true;
        if(!$token) header('Location: /');

        // identificar al usuario con el token
        $usuario= Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token no valido');
            $mostrar=false;
        }
       
        if($_SERVER['REQUEST_METHOD']==='POST'){

            //añadir nuevo password
            $usuario->sincronizar($_POST);
            $alertas= $usuario->validarPassword();

           if(empty($alertas)){
            
             $usuario->hashPassword();
             $usuario->token=null;
             $resultado=$usuario->guardar();
             if($resultado){ header('Location: /');}
           }

        }

        $alertas=Usuario::getAlertas();
        $router->render('auth/reestablecer',[
            'titulo'=>'Reestablecer PassWord',
            'alertas'=>$alertas,
            'mostrar'=>$mostrar
        ]);
    }



    public static function mensaje(Router $router){
        $router->render('auth/mensaje',[
            'titulo'=>'Cuenta Recuperada con Exito'
        ]);
        
    }



    public static function confirmar(Router $router){
         $token= s($_GET['token']);
        if(!$token) header('Location: /');
           
        //encontrar usuario con el token
        $usuario=Usuario::where('token',$token);

        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token no Valido');
        }else{
            //confirmar cuenta
            $usuario->confirmado=1;
            $usuario->token=null;
            unset($usuario->password2);
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Confirmada');
        }

        $alertas=Usuario::getAlertas();

        $router->render('auth/confirmar',[
            'titulo'=>'Confirma tú Cuenta',
            'alertas'=>$alertas
        ]);
    }

}