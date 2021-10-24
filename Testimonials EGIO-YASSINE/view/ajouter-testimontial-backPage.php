<div class="container">

<div class="ajouter_testimontial_admin">

    <div class="in_ajouter_testimontial_admin col-lg-5 col-md-8 col-sm-12 p-5 mt-5 shadow-sm">
        <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group mt-4">
                <label for="ajouter_testimontial_admin_titre" class="mb-2">TITRE</label>
                <input required type="text" id="ajouter_testimontial_admin_titre" name="testimontial_titre" class="form-control col-12">
              </div>

              <div class="form-group mt-4">
                <label for="ajouter_testimontial_admin_image" class="mb-2">IMAGE</label>
                <input type="file" id="ajouter_testimontial_admin_image" name="testimontial_file" class="form-control border-0 col-12">
              </div>

              <div class="form-group mt-4">
                <label for="ajouter_testimontial_admin_statu" class="mb-2">STATU</label>
                <select value="test" name="testimontial_statu" id="ajouter_testimontial_admin_statu" class="form-control">
                    <option value="En Attente">En Attente</option>
                    <option value="Approuvé">Approuvé</option>
                    <option value="Rejeter">Rejeter</option>
                </select>

              </div>

              <div class="form-group mt-4">
                <label for="ajouter_testimontial_admin_message" class="mb-2">MESSAGE</label>
                <textarea required name="testimontial_message" id="ajouter_testimontial_admin_message" class="col-12"   rows="3"></textarea>
              </div>

              <input type="hidden" name="check" value="ajouter">

              <div class="form-group mt-4">
                    <button type="submit" class="button-primary p-2">Ajouter Testimontial</button>
              </div>
        </form>
    </div>

</div>
    

</div>


<?php 

//afficher message
if(isset($_SESSION["msg"])){
    $msg=$_SESSION["msg"];
    $titre_msg=$msg["statu"];
    $message_msg=$msg["message"];
    $_SESSION["msg"]=null;
    echo "<script> 
                

    iziToast.$titre_msg({
     message: '<strong>$message_msg</strong>',
     position:'topRight'
 });
 

    </script> ";
}




?>

