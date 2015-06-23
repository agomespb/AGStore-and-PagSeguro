<?php

namespace AGStore\Repositories;


abstract class AbstractRepository implements Contracts\RepositoryInterface
{
    protected $model;

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
     * @return mixed
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return bool if false and mixed to true
     */
    public function find($id)
    {
        $search = $this->model->find($id);

        if( count($search) ) {
            return $search;
        }

        return false;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $insert = $this->model->fill($data);
        $insert->save();

        return $insert;
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $search = $this->model->find($id);

        if( count($search) ) {
            $search->update($data);
        }

        return $search;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $search = $this->model->find($id);

        if( count($search) ) {
            return $search->delete();
        }

        return false;
    }

    /**
     * @return array
     */
    public function getTransactionStatus()
    {
        return $this->transactionStatus;
    }

}
