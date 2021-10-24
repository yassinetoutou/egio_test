<?php 




if(isset($_POST["data"])){
   
    $i=0;
    foreach ($_POST["data"] as $testimontial) {
            testimontial_class::modifie_testimontial_sort($testimontial,$i);
            $i++;
    }


}




?>