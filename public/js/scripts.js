
$(document).ready(function () {
    $('#id_cpf').mask('999.999.999-99', { reverse: true });
    $('#id_dtanasc').mask('99/99/9999', { reverse: true });

    var x = document.getElementById("msg");

    x.className = "show";

    setTimeout(function () { x.className = x.className.replace("show", ""); }, 5000);
})
$(document).on('click', '#btnmodal', function () {
    $('#confirmModal').modal('show');
    let id = $(this).attr('data-id');
    let cpf = $(this).attr('data-cpf');

    $('#formdel').get(0).setAttribute('action', '/remove/' + id);
    $('#h5cpf').text('Confirma exclusão do usuario com cpf: ' + cpf + "?");
});

