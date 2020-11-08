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

            let contaItens = parseInt($('#count_cart').text());

            console.log(valorTotal)

            
            // esse trecho busca no banco de a quantidade de itens, e vai colocando a lógica do botões de adicionar, diminui, acrescentar etc em cada item da lista de produtos
            <?php
                // *********************** inicio do laço do banco de dados *********************
               
                $db->query("SELECT * FROM produtos");
                $num_item_logica = 1;// item responsável por ir adicinando a lógica dos botões conforme o número de produtos vindos do banco de dados
                foreach($db->resultados() as $produto_logica):
                
            ?>
            // *****************************************************************
                
                console.log('numero: ',<?= $num_item_logica ?>)
            // *********** botão do item, quando clicado acrescenta um item ao carrinho
            $('#add_item<?= $num_item_logica ?>, #add_plus<?= $num_item_logica ?>').click(function(){
                

                //pega o preço do item 1 coloca na variavel preco
                let preco = parseFloat($('#preco_item<?= $num_item_logica ?>').text());

                //essa linha acrescenta + 1 do item nos pedidos
                let valor = parseInt($('form #id_form_item #add<?= $num_item_logica ?>').text()) + 1;
                $('form #id_form_item #add<?= $num_item_logica ?>').text(valor);

                //esse trecho acrescenta um a sacola de compras 
                contaItens += 1;
                $('#count_cart').text(contaItens);

                valorTotal += preco;
                console.log("Contagem depois da soma: ",valor);
                //essa linha transforma o valor da variavel em formato de real
                let valorTotalBRL = Intl.NumberFormat('pt-br', {style: 'currency', currency: 'BRL'}).format(valorTotal)
                $('#valor_total').val(valorTotalBRL)

                console.log(valorTotalBRL);
                console.log(valorTotal);

                
                // **********  *********** */
                let itemClicado = parseInt($('form #id_form_item #add<?= $num_item_logica ?>').text());
                if(itemClicado){
                    $('#confirma_item<?= $num_item_logica ?>').addClass('fas fa-check')
                }else{
                    $('#confirma_item<?= $num_item_logica ?>').removeClass('fas fa-check')
                }

                console.log('item: ',itemClicado) //aqui é só pra mim saber se está saindo o valor
            });


            // **************** botão que diminui em 1 o valor do carrinho **************
            $('#add_less<?= $num_item_logica ?>').click(function(){


                let valor = parseInt($('form #id_form_item #add<?= $num_item_logica ?>').text());
                let preco = parseFloat($('#preco_item<?= $num_item_logica ?>').text());

                if(valor > 0){

                    
                    valor -= 1;
                    
                    $('form #id_form_item #add<?= $num_item_logica ?>').text(valor);

                    //Esse diminui 1 item no sacola de compras
                    contaItens -= 1;
                    $('#count_cart').text(contaItens);

                    valorTotal -= preco;

                    //essa linha transforma o valor da variavel em formato de real
                    let valorTotalBRL = Intl.NumberFormat('pt-br', {style: 'currency', currency: 'BRL'}).format(valorTotal)

                    $('#valor_total').val(valorTotalBRL)

                    
                }
                let itemClicado = parseInt($('form #id_form_item #add<?= $num_item_logica ?>').text());
                if(itemClicado >= 1){
                        $('#confirma_item<?= $num_item_logica ?>').addClass('fas fa-check')
                    }else{
                        $('#confirma_item<?= $num_item_logica ?>').removeClass('fas fa-check')
                    }
                
                console.log('item: ',itemClicado) //aqui é só pra mim saber se está saindo o valor
                
            });
            // *****************************************************************************

            <?php
                // ********* fim do laço do banco de dados ****************
                $num_item_logica++;
                endforeach;
            ?>

        });

    </script>

</body>
</html>