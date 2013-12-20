<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 13/12/2013
 * Time: 15:03
 */

class SessionManager {

    private $session = NULL;
    private static $singeltonInstance;
    private $namespaces = array();


    public static function getInstance($namespace = NULL)
    {
        if(!isset(self::$singeltonInstance))
        {
            self::$singeltonInstance = new SessionManager($namespace);
        }

        return self::$singeltonInstance;
    }


    public function __construct($namespace){
        session_start();
        $this->session = $_SESSION;
        $this->addNamespace($namespace);
    }

    public function getSession(){
        return $this->session;
    }

    public function addNamespace($namespace){
        if (in_array($namespace,$this->namespaces)) return;
        else{
            $this->namespaces[] = $namespace;
            $this->session[$namespace] = array();
        }
    }



} 