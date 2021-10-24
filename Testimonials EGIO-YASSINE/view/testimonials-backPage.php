<?php 

$rejeter=testimontial_class::afficher_testimontial_count_statu("Rejeter");
$Approuve=testimontial_class::afficher_testimontial_count_statu("Approuvé");
$enattente=testimontial_class::afficher_testimontial_count_statu("En Attente");

?>
<div class="container">
    
<div class="row w-100 mt-5 d-flex">
    <div class="col-lg-4 col-md-6 col-sm-12 p-3">
        <div class="testimontial_box shadow-sm p-3">
            <div class="testimontial_box_icon accepter_testimontial">
                <i class="fas fa-check fa-2x"></i>
            </div>
            <div class="testimontial_box_content">
                <div class="testimontial_box_nbr">
                            <h4> <?php 
                            foreach ($Approuve as $prv) {
                                echo $prv->stat;
                            }
                            
                            ?> </h4>
                </div>
                <div class="testimontial_box_text">
                        Testimontial Approuvé
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-12 p-3">
        <div class="testimontial_box shadow-sm p-3">
            <div class="testimontial_box_icon att_testimontial">
                <i class="fas fa-hourglass-half fa-2x"></i>
            </div>
            <div class="testimontial_box_content">
                <div class="testimontial_box_nbr">
                <h4> <?php 
                            foreach ($enattente as $prv) {
                                echo $prv->stat;
                            }

                            ?>
                    </div>
                <div class="testimontial_box_text">
                        Testimontial En Attente
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-12 p-3">
        <div class="testimontial_box shadow-sm p-3">
            <div class="testimontial_box_icon rejet_testimontial">
                <i class="fas fa-times fa-2x"></i>
            </div>
            <div class="testimontial_box_content">
                <div class="testimontial_box_nbr">
                <h4> <?php 
                            foreach ($rejeter as $prv) {
                                echo $prv->stat;
                            }
                            
                            ?>
                </div>
                <div class="testimontial_box_text">
                        Testimontial Rejeter
                </div>
            </div>
        </div>
    </div>
</div>

<!----- button pour ajouter nouveau testimontial ---->
<button class="button-primary mt-2 p-2 nouveau_testimontial_class" onclick="window.location.href='admin.php?page=Ajouter-testimontial'">Nouveau Testimontial</button>

<!----- tableau afficher liste des testimontials ------>
    <table class="table table-light mt-5 mb-5 table-responsive" id="testimontials_table">
        <thead id="thead_dt">
            <tr>
                <th width="10%">#</th>
                <th width="10%">IMAGE</th>
                <th width="30%">TITRE</th>
                <th width="20%">DATE</th>
                <th width="20%">STATU</th>
                <th width="10%">ACTION</th>
            </tr>
        </thead>
        <tbody class="tbody_dt dragdrop_select">
        <?php 
        
            $data=testimontial_class::afficher_testimontial_client();

             $i=0;
            foreach ($data as $testimontial) {
                global $statu_class;

                if($testimontial->statu=="En Attente"){
                    $statu_class="bg-warning";
                }else if($testimontial->statu=="Approuvé"){
                    $statu_class="bg-success";
                }else if($testimontial->statu=="Rejeter"){
                    $statu_class="bg-danger";
                }
        ?>


            <tr id="<?php echo $testimontial->id; ?>">
                <td id="dragdrop" class="text-center align-middle"> <i class="fas fa-grip-horizontal fa-2x"> </i>  </td>
                <td class="img_tab_testimontial">  <img src="<?php echo site_url().$testimontial->url; ?>" alt="Testimontial img">  </td>
                <td class="align-middle"><?php echo $testimontial->titre; ?></td>
                <td class="align-middle"><?php echo $testimontial->date; ?></td>
                <td class="align-middle"><span class="badge <?php echo $statu_class; ?> p-3"><?php echo $testimontial->statu; ?></span></td>


                <td class="align-middle"> 
                    <!----- modification btn ---->
                    <div class="testimontial_action_tab">

                        <div class="divv align-middle">
                            <form action="admin.php?page=modifie-testimontial"  method="post"> 
                                <input type="hidden" name="admin_testimontial_id" value="<?php echo $testimontial->id; ?>">    
                                <button type="submit" class="btn btn-warning"><i class="far fa-edit"></i></button> 
                            </form>
                        </div>
                    
                        <div class="div align-middle">
                            <!----- supprimer btn ---->
                             <button type="button" onclick="send_id_to_func('<?php echo $testimontial->id; ?>'); " data-bs-toggle="modal" data-bs-target="#supprimer_testimontial" class="btn btn-secondary send_id_to_func"><i class="far fa-trash-alt"></i> </button> 
                        </div>
                    </div> 

                  
                </td>

            </tr>

        <?php
            }//end foreach
            
        ?>
        </tbody>
        <tfoot>
            <tr class="tfooter_dt">
                <th>DRAG/DROP</th>
                <th>IMAGE</th>
                <th>TITRE</th>
                <th>DATE</th>
                <th>STATU</th>
                <th>ACTION</th>        </tr>
        </tfoot>
    </table>



</div>


<!-- Modal pour la confirmation du supprission -->
<div class="modal fade" id="supprimer_testimontial" tabindex="-1" aria-labelledby="supprimer_testimontialLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="supprimer_testimontialLabel">Supprimer Testimontial</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Voulez vous Vraiment Supprimer cette Testimontial
      </div>
      <div class="modal-footer">
        <form action="" method="POST">
            <input type="hidden" name="testimontial_id" class="supprimer_testimontial_id">
            <input type="hidden" name="check" class="check_value" value="supprimer">
            <button type="submit" class="btn btn-danger testimontial_supp">Oui</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

      </div>
    </div>
  </div>
</div>


<script>



//sort able par ajax
  function send_id_to_func(id){
     $(".supprimer_testimontial_id").val(id);
  } 



  $(".dragdrop_select").sortable({
      delay:150,
      stop:function(){
          var table= new Array();
          $(".dragdrop_select>tr").each(function(){
            table.push($(this).attr("id"));

          });

          //appeler a la method ajax pour envoyée nouveau sort
          $.ajax({
              url:"",
              method:"POST",
              data:{
                  data:table
              },success:function(resultat){
                    //j'ai vidé cette partie pour aura pas des message
            }

          })//end ajax

      }//end stop
});//end sortable function





</script>

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

