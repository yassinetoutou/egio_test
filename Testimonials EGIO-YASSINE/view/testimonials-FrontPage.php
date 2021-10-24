<div class="testimontial_egio_yassine">
    <div class="container">
        <div class="form_testimontial">
           <div class="in_form_testimontial mt-5 mb-5 col-lg-6 col-md-8 col-sm-11 p-5 shadow-sm">
             
                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="my-input" class="testi_form_label">TITRE *</label>
                        <input id="my-input" class="form-control border" type="text" name="testimontial_titre" required>
                    </div>

                    <div class="form-group mt-4">
                        <label for="my-input" class="testi_form_label">IMAGE</label>
                        <input id="my-input" class="form-control border-0" type="file" name="testimontial_file">
                    </div>

                    <div class="form-group mt-4">
                        <label for="my-input" class="testi_form_label">MESSAGE *</label>
                        <textarea name="testimontial_message" class="form-control border" cols="30" rows="5" required></textarea>
                    </div>
                    <input type="hidden" name="check" value="ajouter">

                    <div class="form-group on_testimontial_btn mt-5">
                    <button type="submit" class="testimontial_egio_yassine_btn "><span>ADD NEW TESTIMONTIAL</span></button>
                    </div>
            
                </form>
            </div>

        </div>
    </div>

            <div class="in_testimontial_content mt-3 mb-5">
                <div class="container">
                    <div class="in_testimontial_title  text-center">
                        <h1>Testimontials</h1>
                    </div>

                    <div class="row">
                      
<?php 

        $data=testimontial_class::afficher_testimontial_client();
        foreach ($data as $testimontial){ 

            if ($testimontial->statu=="Approuvé") {
                ?>

                <div class="col-lg-3 col-md-6 col-sm-12 mt-5 p-5">

                <div class="testimontial_img ">
                    
                    <img src= "<?php echo site_url().$testimontial->url; ?>" alt="Testimontial Image">
                </div>

                <div class="testimontial_title text-center mt-3">
                    <h4><?php echo $testimontial->titre; ?></h4>
                </div>

                <div class="testimontial_content text-center mt-4">
                    <p><?php echo $testimontial->description; ?></p>
                </div>

                </div>

<?php
            }//end if   
        }//end foreach
?>


   



                    </div>
                </div>
            </div>



</div> <!---- end page ---->


   
<?php 

//afficher messages
if(isset($_SESSION["msg"])){
    $msg=$_SESSION["msg"];
    $titre_msg=$msg["statu"];
    $message_msg=$msg["message"];
    $_SESSION["msg"]=null;
    echo "<script> 
                
    iziToast.$titre_msg({
     message: '<strong>$message_msg</strong>',
     position:'topCenter'
 });
 
    </script> ";
}


?>

