<?php

use Illuminate\Support\Facades\Session;

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

if (!function_exists('date_to_view'))
{
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
}

if (!function_exists('currency_brl'))
{
    /**
     * @param Currency $value
     * @return string
     */
    function currency_brl($value)
    {
        $brl = number_format($value, 2, ',', '.');
        return 'R$ ' . $brl;
    }
}

if (!function_exists('prime_name'))
{
    /**
     * @param string $value
     * @return string
     */
    function prime_name($value)
    {
        $name = explode(' ', $value);
        return $name[0];
    }
}

if (!function_exists('set_flash_message'))
{
    function set_flash_message($type, $message)
    {
        Session::flash('flash_message', $message);
        Session::flash($type, $type);
        return;
    }
}

if (!function_exists('get_flash_message'))
{
    function get_flash_message()
    {
        $alerts = array();
        $alert_types = array('danger', 'success', 'warning', 'info');

        if(Session::has('flash_message')){

            foreach ($alert_types as $type) {
                if(Session::has($type)) {
                    array_push($alerts, '<div class="alert alert-' . $type . ' alert-dismissable">');
                    array_push($alerts, '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>');
                    array_push($alerts, Session::get('flash_message'));
                    array_push($alerts, '</div>');
                }
            }
            return implode("", $alerts);
        }

        return '';
    }
}

if (!function_exists('order_transaction_status'))
{
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
}


