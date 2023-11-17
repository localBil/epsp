// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable(
    {
      "oLanguage":{
        "sLengthMenu":"afficher_MENU_entrées",
        "sSearch":"Recherche",
        "oPaginate":{
          "sPrevious":"Précédent",
          "sNext":"Suivant"
        }
      }
    }
  );
});
