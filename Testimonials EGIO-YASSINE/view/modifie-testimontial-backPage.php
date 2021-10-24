<?php 


//verifier si l'utilisateur accéss cette page sans envoyée une form post
    if ( !isset( $_POST["admin_testimontial_id"] ) ) {
        $redirect = 'admin.php?page=Testimontial-plugin-yassine';
       echo "<script>
       
       window.location.href='$redirect';
       
       </script>
       ";
    }
 
//afficher message
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




        $data=testimontial_class::afficher_testimontial_id($_POST["admin_testimontial_id"]);

        foreach ($data as $testimontial) {
            
        }
?>

<script>

$("#ajouter_testimontial_admin_statu").val()="<?php $testimontial->statu ?>";


</script>


<!------ view de edition la page ----->
<div class="container">

<div class="ajouter_testimontial_admin">

    <div class="in_ajouter_testimontial_admin col-lg-5 col-md-8 col-sm-12 p-5 mt-5 shadow-sm">
        <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group mt-4">
                <label for="ajouter_testimontial_admin_titre" class="mb-2">TITRE</label>
                <input value="<?php echo $testimontial->titre; ?>" required type="text" id="ajouter_testimontial_admin_titre" name="testimontial_titre" class="form-control col-12">
              </div>

              <div class="form-group mt-4">
                <label for="ajouter_testimontial_admin_image" class="mb-2">IMAGE</label>
                <input  type="file" id="ajouter_testimontial_admin_image" name="testimontial_file" class="form-control col-12">
              </div>

              <input type="hidden" name="dernier_image_testimontial" value="<?php echo $testimontial->url; ?>">

              <div class="form-group mt-4">
                <label for="ajouter_testimontial_admin_image" class="mb-2">DATE</label>
                <input value="<?php echo $testimontial->date; ?>" type="date" id="ajouter_testimontial_admin_date" name="testimontial_date" class="form-control col-12">
              </div>

              <div class="form-group mt-4">
                <label for="ajouter_testimontial_admin_image" class="mb-2">STATU</label>
                <select name="testimontial_statu" id="ajouter_testimontial_admin_statu" class="form-control">
                    <option value="En Attente">En Attente</option>
                    <option value="Approuvé">Approuvé</option>
                    <option value="Rejeter">Rejeter</option>

                </select>
              </div>

              <div class="form-group mt-4">
                <label for="ajouter_testimontial_admin_message" class="mb-2">MESSAGE</label>
                <textarea required name="testimontial_message" id="ajouter_testimontial_admin_message" class="col-12"   rows="3">
                    <?php echo $testimontial->description; ?>
                </textarea>
              </div>

              <input type="hidden" name="check" value="modifie">
              <input type="hidden" name="testimontial_id" value="<?php echo $testimontial->id; ?>">

              <div class="form-group mt-4">
                    <button type="submit" class="button-primary p-2">Modifie Testimontial</button>
              </div>
        </form>
    </div>

</div>
    

</div>



