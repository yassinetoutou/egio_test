<?php 

class testimontial_class
{
    
    //constructeur
    public function __construct()
    {

        //cette code aura execute aprés l'activation du plugin
        add_action("activate_plugin",array($this,"base"));
        
        //verifier le type de mise a jour
        if(isset($_POST["check"])){
            if($_POST["check"]=="ajouter"){
                $this->verifier_ajouter();
            }else if($_POST["check"]=="modifie"){
                $this->verifier_modifie();
            }else if($_POST["check"]=="supprimer"){
                $this->supprimer_testimontial();
            }
        }
       
    }

    //base de donnée
    public function base()
    {  

        //création du dossier pour les document
        $this->document_dossier(ABSPATH."wp-content/uploads/testimontial_egio_yassine_media");

        //copy default image de plugin a wordpress uploads
        $this->copy_default_img();

        // WP Globals
        global $table_prefix, $wpdb;

        // tableau Testimontial 
        $testimontial = $table_prefix . 'testimontial_test_yassine';

        // crée testimontial Table s'il ne existe pas 
        if( $wpdb->get_var( "show tables like '$testimontial'" ) != $testimontial ) {

        // code sql pour la création de tableau testimontial
        $sql = "CREATE TABLE `$testimontial` (";
        $sql .= " `id` int(11) primary key auto_increment, ";
        $sql .= " `titre` varchar(70), ";
        $sql .= " `date` date, ";
        $sql .= " `statu` varchar(20), ";
        $sql .= " `url` varchar(200), ";
        $sql .= " `description` varchar(310),";
        $sql .= " `sortable` int";
        $sql .= ") AUTO_INCREMENT=1;";

        // Include Upgrade Code
        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

        // crée le tableau
        dbDelta( $sql );
        
        }
        
    }

    //copy default image de plugin img a wordpress images dossier
    public function copy_default_img()
    {
        copy(plugin_dir_path(__FILE__)."../assets/img/default.png",ABSPATH."/wp-content/uploads/testimontial_egio_yassine_media/default.png");

    }

    //verification des donner avant ajouter une testimontial
    public function verifier_ajouter()
    {
        if(isset($_POST["testimontial_titre"]) && isset($_POST["testimontial_message"])){

            $titre=$_POST["testimontial_titre"];
            $message=$_POST["testimontial_message"];
            $url="/wp-content/uploads/testimontial_egio_yassine_media/default.png";
            $date=date("y-m-d");
            $statu="En Attente";


            if(isset($_POST["testimontial_statu"])){
                $statu=$_POST["testimontial_statu"];
            }

    
            if (strlen($titre)==0 || strlen($titre)>60) {
                    $_SESSION["msg"]=array(
                        "statu"=>"error",
                        "message"=>"vous ne devez pas dépasser 70 caractères dans le titre"
                    );

            }else if(strlen($message)==0 || strlen($message)>300){

                $_SESSION["msg"]=array(
                    "statu"=>"error",
                    "message"=>"vous ne devez pas dépasser 300 caractères dans le Message"
                );

            }else{

                //verifier si l'utilisateur ajouter l'image ou none
                if($_FILES["testimontial_file"]["size"]>0){
                  
                    $ext_acpt=array("doc","DOC","docx","DOCX","png","PNG","jpg","JPG","jpeg","JPEG");
                    $get_ext = explode('.', $_FILES['testimontial_file']['name']);
                    $file_ext = end($get_ext);


                    if($_FILES["testimontial_file"]["size"]>1000000){
    
                        $_SESSION["msg"]=array(
                            "statu"=>"error",
                            "message"=>"la Taille maximum du fichie est 1MB!!!"
                        );
                        
                    }else if(!in_array($file_ext,$ext_acpt)){
    
                        $_SESSION["msg"]=array(
                            "statu"=>"error",
                            "message"=>"nous avons accepter seulement les esxtentions DOC, DOCX, PNG, JPG"
                        );
    
                    }else{

                        $new_name_file=time().$_FILES["testimontial_file"]["name"];
                        $url="/wp-content/uploads/testimontial_egio_yassine_media/".$new_name_file;
                        $base_url=ABSPATH."wp-content/uploads/testimontial_egio_yassine_media/".$new_name_file;

                        //copy le ficher vers nos dossies du plugin
                        move_uploaded_file($_FILES["testimontial_file"]["tmp_name"],$base_url);

                        //changer la permission
                        chmod($base_url,0777);

                        //ajouter testimontial si l'utilisateur ajouter une image
                        $this->Ajouter_testimontial($titre,$date,$statu,$url,$message);
                        
                    }
                }else{
                
                    //ajouter testimontial si l'utilisateur pas ajouter une image
                    $this->Ajouter_testimontial($titre,$date,$statu,$url,$message);

                }


            }

        }

    }

    //ajouter nouveau testimontial
    public static function Ajouter_testimontial($titre,$date,$statu,$url,$message)
    {
     
       
                //ajouter
                global $wpdb;     
                $testim_table = $wpdb->prefix . 'testimontial_test_yassine';     
                $wpdb->insert($testim_table, array(
                    'titre' => $titre,
                     'date' => $date,
                     'statu'=>$statu,
                     'url'=>$url,
                     'description'=>$message
                    )); 

                    //session pour le message 
                    $_SESSION["msg"]=array(
                        "statu"=>"success",
                        "message"=>"Votre Message est bien envoyée"
                    );


            
                
    }


    //verification des donner modifie testimontial
    public function verifier_modifie()
    {
        if(isset($_POST["testimontial_id"]) && isset($_POST["testimontial_titre"]) && isset($_POST["testimontial_message"])){

            $titre=$_POST["testimontial_titre"];
            $message=$_POST["testimontial_message"];
            $url=$_POST["dernier_image_testimontial"];
            $date=date("y-m-d");
            $statu="pending";
            $id=$_POST["testimontial_id"];

            if(isset($_POST["testimontial_statu"])){
                $statu=$_POST["testimontial_statu"];
            }

            if(isset($_POST["testimontial_date"])){
                $date=$_POST["testimontial_date"];
            }

       



            if (strlen($titre)==0 || strlen($titre)>60) {
                    $_SESSION["msg"]=array(
                        "statu"=>"error",
                        "message"=>"vous ne devez pas dépasser 70 caractères dans le titre"
                    );

            }else if(strlen($message)==0 || strlen($message)>300){

                $_SESSION["msg"]=array(
                    "statu"=>"error",
                    "message"=>"vous ne devez pas dépasser 300 caractères dans le Message"
                );

            }else{

                if($_FILES["testimontial_file"]["size"]>0){
                  
                    $ext_acpt=array("doc","DOC","docx","DOCX","png","PNG","jpg","JPG","jpeg","JPEG");
                    $get_ext = explode('.', $_FILES['testimontial_file']['name']);
                    $file_ext = end($get_ext);


                    if($_FILES["testimontial_file"]["size"]>1000000){
    
                        $_SESSION["msg"]=array(
                            "statu"=>"error",
                            "message"=>"la Taille maximum du fichie est 1MB!!!"
                        );
                        
                    }else if(!in_array($file_ext,$ext_acpt)){
    
                        $_SESSION["msg"]=array(
                            "statu"=>"error",
                            "message"=>"nous avons accepter seulement les esxtentions DOC, DOCX, PNG, JPG"
                        );
    
                    }else{

                        $new_name_file=time().$_FILES["testimontial_file"]["name"];
                        $url="/wp-content/uploads/testimontial_egio_yassine_media/".$new_name_file;
                        $base_url=ABSPATH."wp-content/uploads/testimontial_egio_yassine_media/".$new_name_file;

                        //copy le ficher vers nos dossies du plugin
                        move_uploaded_file($_FILES["testimontial_file"]["tmp_name"],$base_url);

                        //changer la permission
                        chmod($base_url,0777);

                        //ajouter testimontial
                        $this->modifie_testimontial($id,$titre,$date,$statu,$url,$message);
                        
                    }
                }else{
                
                    //ajouter testimontial
                    $this->modifie_testimontial($id,$titre,$date,$statu,$url,$message);

                }


            }

        }else{
            $_SESSION["msg"]=array(
                "statu"=>"error",
                "message"=>"Completer Les Champs Obligatoir stp"
            );
        }

    }

    

    //modifie testimontial
    public static function modifie_testimontial($id,$titre,$date,$statu,$url,$message)
    {
            //ajouter
            global $wpdb;     
            $testim_table = $wpdb->prefix . 'testimontial_test_yassine'; 
            $wpdb->update($testim_table, array(
                'titre' => $titre,
                'date' => $date,
                'statu'=>$statu,
                'url'=>$url,
                'description'=>$message
            ),array(
                'id'=>$id
            ));
    

                //session pour le message 
                $_SESSION["msg"]=array(
                    "statu"=>"success",
                    "message"=>"Testimontial est bien Modifié"
                );
    }

    //modifie sort
     public static function modifie_testimontial_sort($id,$sort)
     {
             //ajouter
             global $wpdb;     
             $testim_table = $wpdb->prefix . 'testimontial_test_yassine'; 
             $wpdb->update($testim_table, array(
                 'sortable' => $sort
             ),array(
                 'id'=>$id
             ));
     
 
                 //session pour le message 
                 $_SESSION["msg"]=array(
                     "statu"=>"success",
                     "message"=>"Testimontial est bien Modifié"
                 );
     }

      //Supprimer testimontial
    public static function supprimer_testimontial()
    {
        if(isset($_POST["testimontial_id"])){
            global $wpdb;
            $testimontial_tab = $wpdb->prefix . "testimontial_test_yassine";
            $wpdb->delete($testimontial_tab,array(
                "id"=>$_POST["testimontial_id"]
            ));


        }
    }

    //afficher testimontial au niveau de cote client
    public static function afficher_testimontial_client()
    {
        global $wpdb;
        // this adds the prefix which is set by the user upon instillation of wordpress
        $testimontial_tab = $wpdb->prefix . "testimontial_test_yassine";
        // this will get the data from your table
       return $wpdb->get_results( "SELECT * FROM $testimontial_tab ORDER BY sortable ASC" );
   
  
    }


    //afficher testimontial au niveau de cote client
    public static function afficher_testimontial_count_statu($statu)
    {
        global $wpdb;
        // this adds the prefix which is set by the user upon instillation of wordpress
        $testimontial_tab = $wpdb->prefix . "testimontial_test_yassine";
        // this will get the data from your table
       return $wpdb->get_results( "SELECT COUNT(*) as 'stat' FROM wp_testimontial_test_yassine WHERE statu='$statu' " );
   
    }


        //afficher testimontial par id
        public static function afficher_testimontial_id($id)
        {
            global $wpdb;
            // this adds the prefix which is set by the user upon instillation of wordpress
            $testimontial_tab = $wpdb->prefix . "testimontial_test_yassine";
            // this will get the data from your table
           return $wpdb->get_results( "SELECT * FROM $testimontial_tab WHERE id=$id" );
             
        }


    //crée un dossier si il ne pas existe
    public function document_dossier($url) {
        if(!file_exists($url)){
             mkdir($url, 0777, true);
        }
        
      }

}//end class

new testimontial_class();











?>