<?php

/*
|--------------------------------------------------------------------------
| Para este Helper funcionar
|--------------------------------------------------------------------------
|
| É necessário atualizar o arquivo composer.json! Informe o path. Exemplo:

    "autoload": {
        "classmap": [
            "database"
        ],
        "psr-4": {
            "AGStore\\": "app/"
        },
        "files": [
          "app/Helpers/Helper.php"         <--------------= Aqui!
        ]
    },
|
| Depois execute: composer dumpauto
|
*/


/**
 * @param  string $value
 * @return string
 */
function date_to_view($value)
{
    $date = ($value != '0000-00-00') ? $value : '';
    if ($date != '') {
        $date = date('d/m/Y \à\s H:i', strtotime($date));
    }
    return $date;
}

/**
 * @param Currency $value
 * @return string
 */
function currency_brl($value)
{
    $brl = number_format($value, 2, ',', '.');
    return 'R$ ' . $brl;
}

/**
 * @param Interge $value
 * @return string
 */
function order_transaction_status($value)
{
    $transactionStatus = [

        /*
         * o comprador iniciou a transação, mas até o momento o PagSeguro
         * não recebeu nenhuma informação sobre o pagamento.
         */
        1 => 'Aguardando pagamento',

        /*
         * o comprador optou por pagar com um cartão de crédito e o PagSeguro
         * está analisando o risco da transação.
         */
        2 => 'Em análise',

        /*
         * a transação foi paga pelo comprador e o PagSeguro já recebeu uma
         * confirmação da instituição financeira responsável pelo processamento.
         */
        3 => 'Paga',

        /*
         * a transação foi paga e chegou ao final de seu prazo de liberação
         * sem ter sido retornada e sem que haja nenhuma disputa aberta.
         */
        4 => 'Disponível',

        /*
         * o comprador, dentro do prazo de liberação da transação, abriu uma disputa.
         */
        5 => 'Em disputa',

        /*
         * o valor da transação foi devolvido para o comprador.
         */
        6 => 'Devolvida',

        /*
         * a transação foi cancelada sem ter sido finalizada.
         */
        7 => 'Cancelada',

        /*
         * o valor da transação foi devolvido para o comprador.
         */
        8 => 'Chargeback debitado',

        /*
         * o comprador abriu uma solicitação de chargeback junto à operadora do cartão de crédito.
         */
        9 => 'Em contestação',
    ];

    return (array_key_exists($value, $transactionStatus)) ? $transactionStatus[$value] : $transactionStatus[1];
}