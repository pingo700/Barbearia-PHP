
function Comprar(ID){
    $.ajax({
        type: "POST",
        url: "model/Ajax.php",
        data: {
            ID: ID,
        },
        success: function (data) {
      
        }
    });
}

// $(function () {
//     $("#formHistoricoDeCompras").submit(function (e) {
//         e.preventDefault();
//         $('#btn-historico-de-compras').prop('disabled', true);
//         var form = $(this);
//         var load = $(".ajax_load");
//         form.ajaxSubmit({
//             url: form.attr("action"),
//             type: "POST",
//             dataType: "json",
//             success: function (response) {

//             },
//             error: function(xhr, status, error) {
//                 console.log(xhr, status, error);
//                 alert('Erro');
//                 load.fadeOut();
//             }
//         });
//     });
// });