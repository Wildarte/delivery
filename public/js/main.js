$(document).ready(function(){
   
    function formata_num(valor){
        let valorBRL = Intl.NumberFormat('pt-br', {style: 'currency', currency: 'BRL'}).format(valor)
        return valorBRL;
    }

    $('#valor-editar').val(formata_num($('#valor-editar').val()));

    document.getElementById('botao').addEventListener('click', function(){

        document.getElementById('url').select();

        document.execCommand('copy');

    });

});
