$(document).ready(function(){
   
    function formata_num(valor){
        let valorBRL = Intl.NumberFormat('pt-br', {style: 'currency', currency: 'BRL'}).format(valor)
        return valorBRL;
    }

    $('#valor-editar').val(formata_num($('#valor-editar').val()));

    function salvar(){

        let text = document.getElementById("texto_comprovante").text;
        let titulo = document.getElementById("titulo_comprovante").text;
    
        let blob = new Blob([text],
            {
                type: "text/plain;charset=utf-8"
            });
        
        saveAs(blob, titulo + ".pdf");
    
    }

});

