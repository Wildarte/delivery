<?php
include './../app/config.php';
include './../app/libraries/Rota.php';
include './../app/libraries/Controller.php';
include './../app/libraries/Database.php';

$db = new Database();

$nome = "Bolo de Cenoura";
$descricao = "Bolo de cenoura com recheio de chocolate";
$preco = 7.50;
$imagem = "assets/imagens/img.jpg";

$db->query("INSERT INTO produtos (nome, descricao, preco, imagem) VALUES(:nome, :descricao, :preco, :imagem)");
$db->bind(":nome", $nome);
$db->bind(":descricao", $descricao);
$db->bind(":preco", $preco);
$db->bind(":imagem", $imagem);

$db->executa();

echo "Total de resultados: ". $db->totalResultados() . "<br>";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=APP_NOME?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="<?=URL?>public/css/style.css">
</head>
<body>
    
    <?php
        include APP.'/views/header.php';
        $rota = new Rota();
        include APP.'/views/footer.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="<?=URL?>public/js/main.js"></script>

    <script>

        $(document).ready(function(){
            
            

            //valor do perdido passado para uma variavel
            let valorTotal = parseFloat($('#valor_total').val());

            console.log(valorTotal)


            // *********** botão do item, quando clicado acrescenta um item ao carrinho
            $('#add_item1, #add_plus').click(function(){
                
                //pega o preço do item 1 coloca na variavel preco
                let preco = parseFloat($('#preco_item1').text());

                //essa linha acrescenta + 1 do item nos pedidos
                let valor = parseInt($('form #id_form_item #add1').text()) + 1;
                $('form #id_form_item #add1').text(valor);
                $('#count_cart').text(valor);

                valorTotal += preco;
                
                //essa linha transforma o valor da variavel em formato de real
                let valorTotalBRL = Intl.NumberFormat('pt-br', {style: 'currency', currency: 'BRL'}).format(valorTotal)
                $('#valor_total').val(valorTotalBRL)

                console.log(valorTotalBRL);
                console.log(valorTotal);

                
                // **********  *********** */
                let itemClicado = parseInt($('form #id_form_item #add1').text());
                if(itemClicado){
                    $('#confirma_item1').addClass('fas fa-check')
                }else{
                    $('#confirma_item1').removeClass('fas fa-check')
                }

                console.log('item: ',itemClicado) //aqui é só pra mim saber se está saindo o valor
            });



            $('#add_less').click(function(){


                let valor = parseInt($('form #id_form_item #add1').text());
                let preco = parseFloat($('#preco_item1').text());

                if(valor > 0){

                    
                    valor -= 1;
                    
                    $('form #id_form_item #add1').text(valor);
                    $('#count_cart').text(valor);

                    valorTotal -= preco;

                    //essa linha transforma o valor da variavel em formato de real
                    let valorTotalBRL = Intl.NumberFormat('pt-br', {style: 'currency', currency: 'BRL'}).format(valorTotal)

                    $('#valor_total').val(valorTotalBRL)

                    
                }
                let itemClicado = parseInt($('form #id_form_item #add1').text());
                if(itemClicado >= 1){
                        $('#confirma_item1').addClass('fas fa-check')
                    }else{
                        $('#confirma_item1').removeClass('fas fa-check')
                    }
                
                console.log('item: ',itemClicado) //aqui é só pra mim saber se está saindo o valor
                
            });

        });

    </script>

</body>
</html>