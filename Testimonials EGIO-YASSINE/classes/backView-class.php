<?php 

class backView_class
{
    public function __construct()
    {
        //declare pour ajouter la button Testimontial au admin menu
        add_action("admin_menu",array($this,"ajouter_adminPage"));
        add_action("admin_menu",array($this,"ajouter_submenu"));       
    }

        //ajouter la botton testimontial au admin menu
        public function ajouter_adminPage()
        {
            add_menu_page("Testimontial Plugin Test Yassine","Testimontials","manage_options","Testimontial-plugin-yassine",array($this,"view_adminPage"),"dashicons-testimonial",2);
        }

        //ajouter sub menu
        public function ajouter_submenu()
        {
            //la page d'ajoute testimontial
            add_submenu_page("Testimontial-plugin-yassine","Ajouter Témoignages"," Nouveau Testimontial","manage_options","Ajouter-testimontial",array($this,"view_ajouterPage"));

            //la page modification d'une testimontial
            add_submenu_page("null","Ajouter Témoignages"," Modifie Testimontial","manage_options","modifie-testimontial",array($this,"view_ModifiePage"));

        }

        //la page d'ajoute une testimontial
        public function view_ajouterPage()
        {
            require_once plugin_dir_path(__FILE__)."../view/ajouter-testimontial-backPage.php";  
        }

         //la page d'ajoute une testimontial
         public function view_ModifiePage()
         {
             require_once plugin_dir_path(__FILE__)."../view/modifie-testimontial-backPage.php";  
         }

    
        //la page de coté client
        public function view_adminPage()
        {
            require_once plugin_dir_path(__FILE__)."../view/testimonials-backPage.php";  
        }



}


new backView_class();








?>