<?php

namespace AGStore\Repositories;

use AGStore\Models\PagSeguroTransaction;
use AGStore\Repositories\Contracts\PagSeguroTransactionRepositoryInterface;
use DateTime;
use Illuminate\Support\Facades\Auth;

class PagSeguroTransactionRepository extends AbstractRepository implements PagSeguroTransactionRepositoryInterface
{

    protected $transactionStatus = [

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


    /**
     * @param PagSeguro $model
     */
    public function __construct(PagSeguroTransaction $model)
    {
        /** @var PagSeguro $model */
        $this->model = $model;
    }

    public function findByTransaction($code)
    {
        return $this->model()->where('code', '=', $code)->get();
    }

    public function modelTransaction()
    {
        return $this->model();
    }

    public function saveTransaction($link)
    {
        $xml = simplexml_load_file($link);

        $code = str_replace('-', "", e($xml->code));

        $dataTransaction = [
            'code' => $code,
            'date' => date('Y-m-d H:i:s', strtotime($xml->date)),
            'type' => e($xml->type),
            'status' => e($xml->status),
            'lastEventDate' => date('Y-m-d H:i:s', strtotime($xml->lastEventDate)),
            'paymentMethodType' => e($xml->paymentMethod->type),
            'paymentMethodCode' => e($xml->paymentMethod->code),
            'grossAmount' => e($xml->grossAmount),
            'discountAmount' => e($xml->discountAmount),
            'netAmount' => e($xml->netAmount),
            'escrowEndDate' => date('Y-m-d H:i:s', strtotime($xml->escrowEndDate)),
            'extraAmount' => e($xml->extraAmount),
            'senderEmail' => e($xml->sender->email)
        ];

        $find = $this->findByTransaction($code)->first();

        if ($find) {
            $dataTransaction['updated_at'] = new DateTime();
            $transactionInsert = $this->update($find->id, $dataTransaction);
        } else {

            $user_id = 1;

            if (Auth::check()) {
                $user_id = Auth::user()->id; // Não pega via POST!
            }

            $dataTransaction['user_id'] = $user_id;

            $transactionInsert = $this->create($dataTransaction);
        }

        return $transactionInsert;
    }

    public function pagSeguroNotificationLink($notificationCode)
    {
        // https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/IDNOTIFICATION?email=email@domine.com&token=36CARACTERES

        $credentials = config('pagseguro');

        $NotificationLink = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/';
        $NotificationLink .= $notificationCode;
        $NotificationLink .= '?email=' . $credentials['email'];
        $NotificationLink .= '&token=' . $credentials['token'];

        return $NotificationLink;
    }

    public function findTransaction($id)
    {
        return $this->find($id);
    }

    public function allTransaction()
    {
        return $this->getAll();
    }

    public function listTransaction()
    {
        return $this->model()->lists('code', 'id');
    }

    public function paginateTransaction($number = 10)
    {
        return $this->model()->paginate($number);
    }

    public function insertTransaction(array $data)
    {
        return $this->create($data);
    }

    public function updateTransaction($id, array $data)
    {
        return $this->update($id, $data);
    }

    public function deleteTransaction($id)
    {
        return $this->delete($id);
    }

    /**
     * @return array
     */
    public function getTransactionStatus($id = null)
    {
        if (!is_null($id)) {
            if (array_key_exists($id, $this->transactionStatus)) {
                return $this->transactionStatus[$id];
            }
        }
        return $this->transactionStatus;
    }
}