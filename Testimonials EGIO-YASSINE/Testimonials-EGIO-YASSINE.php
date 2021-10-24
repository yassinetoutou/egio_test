<?php
    /*
    plugin name:Testimonials EGIO-YASSINE
    author:Yassine Toutou
    description:Egio Digital Testimonials plugin pour le Test
    author uri:https://yassinetoutou.info
    version:1.0
    */

    if ( ! defined( 'ABSPATH' ) ) die();

    //appel aux donnée
   require_once plugin_dir_path(__FILE__)."classes/assets-class.php";
   require_once plugin_dir_path(__FILE__)."classes/testimontial-class.php";
   require_once plugin_dir_path(__FILE__)."classes/backView-class.php";
   require_once plugin_dir_path(__FILE__)."classes/frontView-class.php";

   //ajax
   require_once plugin_dir_path(__FILE__)."ajax/sortable.php";



?>