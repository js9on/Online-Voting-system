
function add_fields() {
    document.getElementById('wrapper').innerHTML += '<br><input type="text" name="description" id="descriptiton"> \r\n';
}




$(document).ready( function () {
    $('#example').DataTable({
        dom: 'Bfrtip',
        responsive: "true",
        
    });
} );