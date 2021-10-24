<?php 

class frontView_class 
{

    public $template;

    public function __construct()
    {
        //ajouter la page Testimontial
        add_action("init",array($this,"ajouter_fronView"));

        //add shortcode
        add_shortcode("TestimontialFront",array($this,"design"));

        //ajouter une template specialement pour la page testimontialss

        $this->template=array(
            '/template/testimontial-template.php'=>'Testimontial'
        );
    
        add_filter( 'page_template', array($this,'testimontial_template') );


    }




    //le vue de la page testimontials
    function design()
    {
        include_once plugin_dir_path(__FILE__)."../view/testimonials-FrontPage.php";
    
    }



    //$title_of_the_page,$content,
    public function ajouter_fronView( )
    {
            
        //ajouter la page testimontials avec son design
        $title_of_the_page="testimontials";
                $objPage = get_page_by_title($title_of_the_page, 'OBJECT', 'page');
                if (empty($objPage)) {
                    wp_insert_post(
                        array(
                        'comment_status' => 'close',
                        'post_author'    => 1,
                        'post_title'     => ucwords($title_of_the_page),
                        'post_name'      => strtolower(str_replace(' ', '-', trim($title_of_the_page))),
                        'post_status'    => 'publish',
                        'post_content'   => '[TestimontialFront]',
                        'post_type'      => 'page',
                        'post_parent'    =>  null 
                        )
                    );
                }
                

    }


    //integré template de la page testimontials
    function testimontial_template( $page_template )
    {
        if (is_page('Testimontials')) {
            $page_template = plugin_dir_path(__FILE__)."../template/testimontial-template.php";
        }

        return $page_template;
    }




    
}


new frontView_class();










?>