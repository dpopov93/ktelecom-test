$( function() {
    var dialog, form,
    
      partner_name = $( "#partner_name" ),
      partner_type = $( "#partner_type" ),
      is_vip = $( "#is_vip" ),
      city = $( "#city" ),
      service_type = $( "#service_type" ),
      base_address = $( "#base_address" ),
      destination_address = $( "#destination_address" ),
      bandwidth = $( "#bandwidth" ),
      date_request_recieved = $( "#date_request_recieved" ),
      traffic_source = $( "#traffic_source" ),
      personal_manager = $( "#personal_manager" );
 
    function addUser() {
      
        $( "#table-partners" ).append( "<tr>" +
          "<td class='table-row'>" + partner_name.val() + "</td>" +
          "<td class='table-row'>" + partner_type.val() + "</td>" +
          "<td class='table-row'>" + is_vip.val() + "</td>" +
          "<td class='table-row'>" + city.val() + "</td>" +
          "<td class='table-row'>" + service_type.val() + "</td>" +
          "<td class='table-row'>" + base_address.val() + "</td>" +
          "<td class='table-row'>" + destination_address.val() + "</td>" +
          "<td class='table-row'>" + bandwidth.val() + "</td>" +
          "<td class='table-row'>" + date_request_recieved.val() + "</td>" +
          "<td class='table-row'>" + traffic_source.val() + "</td>" +
          "<td class='table-row'>" + personal_manager.val() + "</td>" +
          "<td class='no-editable'><ul class='list-inline m-0'><li \
          class='list-inline-item btn-action'><button class='btn btn-success\
          btn-sm rounded-0' type='button' data-toggle='tooltip' \
          data-placement='top' title='Edit'><i class='fa fa-edit'></i>\
          </button></li><li class='list-inline-item btn-action'><button\
          class='btn btn-danger btn-sm rounded-0' type='button'\
          data-toggle='tooltip' onClick=\"$(this).closest('tr').remove();\" \
          data-placement='top' title='Delete'><i class='fa fa-trash'></i>\
          </button></li></ul></td>" +
        "</tr>" );
        dialog.dialog( "close" );
    }
 
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      modal: true,
      buttons: {
        "Создать": addUser,
        "Отмена": function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addUser();
    });
 
    $( "#create-record" ).button().on( "click", function() {
      dialog.dialog( "open" );
    });
  });