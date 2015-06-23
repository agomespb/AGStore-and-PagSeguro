<?php

namespace AGStore\Repositories;

use AGStore\Models\PagSeguroTransaction;
use AGStore\Repositories\Contracts\OrderRepositoryInterface;
use AGStore\Repositories\Contracts\PagSeguroTransactionRepositoryInterface;
use DateTime;

class PagSeguroTransactionRepository extends AbstractRepository implements PagSeguroTransactionRepositoryInterface
{

    protected $order;

    /**
     * @param PagSeguro $model
     */
    public function __construct(PagSeguroTransaction $model, OrderRepositoryInterface $orderRepositoryInterface)
    {
        /** @var PagSeguro $model */
        $this->model = $model;
        $this->order = $orderRepositoryInterface;
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
            'order_id' => e($xml->reference),
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

            $this->updateOrderStatus($dataTransaction['order_id'], $dataTransaction['status']);

        } else {

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

    public function updateOrderStatus($order_id, $status)
    {
        $order = $this->order->findOrder($order_id);

        if (count($order)) {
            $this->order->updateOrder($order_id, ['status' => $status]);
            return true;
        }

        return false;
    }

}