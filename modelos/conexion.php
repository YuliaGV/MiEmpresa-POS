<?php


class Conexion{	  
    public static function Conectar() {    
        
        
        if(!defined('dbhost')){
            define('dbhost','localhost');
        }
        if(!defined('servidor')){
            define('servidor','localhost');
        }
        if(!defined('nombre_bd')){
            define('nombre_bd','bd_miempresapos');
        }

        if(!defined('usuario')){
            define('usuario','root');
        }
        if(!defined('password')){
            define('password','Kenway74');
        }

        
        

        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
        try{
            $link = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);			
            return $link;
        }catch (Exception $e){
            die("El error de Conexión es: ". $e->getMessage());
        }
    }
}
