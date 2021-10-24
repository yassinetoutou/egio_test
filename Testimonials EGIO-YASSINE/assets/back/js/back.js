

function datatable_js(){
    // appeler a datatable 
$(document).ready( function () {

    //integé datatable
    $('#testimontials_table').DataTable({

        "language": {
            "lengthMenu": "Display _MENU_ enregistrements par page ",
            "zeroRecords": "Rien trouvé - désolé",
            "info": "Afficher la page  _PAGE_ of _PAGES_",
            "infoEmpty": "Aucun Testimontial disponible",
            "infoFiltered": "(filtré de  _MAX_ total des Testimontials)",
            "searchPlaceholder": "Rechercher sur Testimontail",
            "paginate": {
                "previous": "Page précédente ",
                "next": "Page Suivante ",

              }

        },
        "oLanguage": {
            "sSearch": ""
          }

    });

  


} );

}//end function

datatable_js();




