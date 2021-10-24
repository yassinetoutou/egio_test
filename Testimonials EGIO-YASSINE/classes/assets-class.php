<?php 

class assets_class
{

    public function __construct() {

        //load scripts lorsque le plugin est démarrer
            add_action("wp_enqueue_scripts", array($this,"front_scripts"));
            add_action("admin_enqueue_scripts",array($this,"back_scripts"));
    }


    //front page scripts
    public function front_scripts()
    {

        //jquery
        wp_enqueue_script("jquery_script","https://code.jquery.com/jquery-3.6.0.min.js");

        //personalisé
        wp_enqueue_style("front_style",plugins_url("../assets/front/css/front.css",__FILE__));
        wp_enqueue_script("front_script",plugins_url("../assets/front/js/front.js",__FILE__));

        //bootstrapp
        wp_enqueue_style("bootstrapp_css","https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css");
        wp_enqueue_script("bootstrap_script","https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js");

        //izToasts
        wp_enqueue_style("iz_style","https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css");
        wp_enqueue_script("iz_script","https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js");
       
    }

    //admin page scripts
    public function back_scripts($hook)
    {

        if (isset($_GET["page"])) {
            $tab=array("Ajouter-testimontial","modifie-testimontial","Testimontial-plugin-yassine");
if (in_array($_GET["page"],$tab)) {


    
        
    //jquery
    wp_enqueue_script("jquery_script", "https://code.jquery.com/jquery-3.6.0.min.js");

    //jquery ui
    wp_enqueue_script("jquery_ui_script", "https://code.jquery.com/ui/1.13.0/jquery-ui.min.js");

 
    //bootstrapp
    wp_enqueue_style("bootstrapp_css", "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css", array(), "", "all");
    wp_enqueue_script("bootstrap_script", "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js");
      
    //izToasts
    wp_enqueue_style("iz_style", "https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css");
    wp_enqueue_script("iz_script", "https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js");
      
    //datatable
    wp_enqueue_style("dtt_style", "https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css");
    wp_enqueue_script("dtt_script", "https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js");

    // fontAwseme
    wp_enqueue_style("font_awseme", "https://pro.fontawesome.com/releases/v5.10.0/css/all.css");

   //personalié
   wp_enqueue_style("back_style", plugins_url("../assets/back/css/back.css", __FILE__));
   wp_enqueue_script("back_script", plugins_url("../assets/back/js/back.js", __FILE__));


}
       
        }

    }


    
}


new assets_class();





?>