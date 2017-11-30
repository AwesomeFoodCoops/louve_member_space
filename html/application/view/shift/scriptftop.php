<script>
$(document).ready(function(){
$( ".subscribeftop" ).click(function() {

var data = {
    date_begin: $(this).data( "date_begin" ),
    shift_id: $(this).data( "shift_id" ),
    shift_ticket_id: $(this).data( "shift_ticket_id" )
};
if(confirm("Confirmez-vous votre inscription au service suivant : "+ $(this).data( "date_begin_formated" )))
 {
$.getJSON("/shift/subscribeftopshift/", data, function (result) {
if(result.errno=="-1")
{
alert('Vous ètes déjà inscrit sur ce service ou vous avez dépassé votre quota quotidien de service');
var arr=result.raw_data.split('<value><string>')[1].split('</string></value>')[0].replace('None','');
alert("Message du bureau des membres :\n"+arr);
}
else
{
alert('Votre inscription a été prise en compte, elle sera visible lors de votre prochaine connexion ');
}
});

}

}); 





}); 




</script>
