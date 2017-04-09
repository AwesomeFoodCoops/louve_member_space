<script>
$(document).ready(function(){
$( ".subscribeftop" ).click(function() {

var data = {
    date_begin: $(this).data( "date_begin" ),
    shift_id: $(this).data( "shift_id" ),
    shift_ticket_id: $(this).data( "shift_ticket_id" )
};

$.getJSON("https://membres.cooplalouve.fr:4443/shift/subscribeftopshift/", data, function (result) {
    alert('Votre demande va être validée par le brureau des membres');
});



}); 
}); 
</script>