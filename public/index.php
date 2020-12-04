<?php
session_start();

include './../app/config.php';
include './../app/autoload.php';

$db = new Database();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=APP_NOME?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="<?=URL?>public/css/styles.css">
</head>
<body>
    
    <?php
        
        $rota = new Rota();
        include APP.'/views/footer.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
    <script src="<?=URL?>public/js/main.js"></script>

    <script>

        $(document).ready(function(){

            //valor do perdido passado para uma variavel
            let valorTotal = parseFloat($('#valor_total').val());

            let contaItens = parseInt($('#count_cart').text());

            console.log(valorTotal);

            
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
                $('#show_total').text(valorTotalBRL)

                console.log(valorTotalBRL);
                console.log(valorTotal);

                let valida = $('.col-2 #add<?=$num_item_logica?>').text();
                $('#valida_item<?=$num_item_logica?>').val(valida)

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
                    let valorTotalBRL = Intl.NumberFormat('pt-br', {style: 'currency', currency: 'BRL'}).format(valorTotal);

                    let valida = $('.col-2 #add<?=$num_item_logica?>').text();
                    $('#valida_item<?=$num_item_logica?>').val(valida)

                    $('#valor_total').val(valorTotalBRL)
                    $('#show_total').text(valorTotalBRL)

                    
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





            // *********************** aqui é a lógica do formulario de edição ********************

            
            
            
            <?php
                // *********************** inicio do laço do banco de dados para o form de edição  *********************
               
                $db->query("SELECT * FROM produtos");
                $num_prod_edita = 1;// item responsável por ir adicinando a lógica dos botões conforme o número de produtos vindos do banco de dados
                foreach($db->resultados() as $produto_logica):
                
            ?>

            $('#botao-edita-produto<?=$num_prod_edita?>').click(function(){

                var id_prod = $('#card_edita_prod<?= $num_prod_edita ?> #id<?= $num_prod_edita ?>').text();

                var prod_edita = $('#card_edita_prod<?= $num_prod_edita ?> #nome_produto_edita<?= $num_prod_edita ?>').text();

                var desc_edita = $('#card_edita_prod<?= $num_prod_edita ?> #desc_produto_edita<?=$num_prod_edita ?>').text();

                var preco_edita = $('#card_edita_prod<?= $num_prod_edita ?> #preco_produto_edita<?=$num_prod_edita?>').text();
                
                let imagem_prod = $('#pega_img<?= $num_prod_edita ?>').text();

                console.log(id_prod);
                console.log(prod_edita);
                console.log(desc_edita);
                console.log(preco_edita);
                console.log(imagem_prod);

                $('#form-edita-produto :input:eq(0)').val(id_prod);
                $('#form-edita-produto :input:eq(1)').val(prod_edita);
                $('#form-edita-produto :input:eq(2)').val(desc_edita);
                $('#form-edita-produto :input:eq(3)').val(preco_edita);
                $('#form-edita-produto :input:eq(4)').val(imagem_prod);

            });

            <?php
                // ********* fim do laço do banco de dados para o form de edição ****************
                $num_prod_edita++;
                endforeach;
            ?>

            // *** esse trecho impede que coloque vírgula no campo de preço do formulário de edição do produto ******
            $('#form-edita-produto :input:eq(3)').on("input", function(e) {
                $(this).val($(this).val().replace(/,/g, ""));
                $(this).val($(this).val().replace(/R/g, ""));
                $(this).val($(this).val().replace(/$/g, ""));
            });
            // ***************************************************************************************



            
            <?php
            //esse techo de código é para colocar o id do produto que será deletado no form que envia o id do produto que vais ser deletado
            $db = new Database();
            $db->query("SELECT * FROM pedidos");

            foreach($db->resultados() as $pedidoBotao):
            ?>

            $('#botao<?= $pedidoBotao->id_ped ?>').click(function(){

                $('#form_delete :input:eq(0)').val('<?= $pedidoBotao->id_ped?>');
                $('#form_delete #id').text('<?= $pedidoBotao->id_ped?>');

            })

            <?php
                endforeach;
            ?>
            //**************** fim do trecho de código onde é para colocar o id do produto que será deletado */

            
            
            $('#cliente_del_pedido'),click(function(){

                $('')

            })                


        });

    </script>

</body>
</html>