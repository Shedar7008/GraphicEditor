$( ".add-to-bsk" ).click(function() {
    $.ajax({
        method: "GET",
        url: "index.php",
        data: { module: "Basket", method: "add", ajax: "Y", productID: $(this).data('id')}
    })
        .done(function() {
            alert( "Product added to the cart" );
        });

});

$(document).on('click', ".b-item-delete", function(){
    var id = $(this).data('id');
    $( "#main_container" ).load('?module=Basket&method=remove&ajax=Y&id='+id );
});