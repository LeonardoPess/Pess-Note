<?php

    date_default_timezone_set('America/Sao_Paulo');

    $autoload = function($class){
        include('classes/'.$class.'.php');
    };

    spl_autoload_register($autoload);

    define('INCLUDE_PATH','http://localhost/curso-web-master/back_end/projetos/pess_notes/');

    //Connect with database!
    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','pess_note');

    //Functions

    function selecionadoMenu($par){
        $url = explode('/',@$_GET['url'])[0];
        if($url == strval($par)){
            echo 'class="selected"';
        }
        
    }
