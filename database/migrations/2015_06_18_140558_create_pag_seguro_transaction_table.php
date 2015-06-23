<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagSeguroTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pag_seguro_transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->string('code', 36)->unique();
            $table->timestamp('date');
            $table->smallInteger('type');
            $table->smallInteger('status');
            $table->timestamp('lastEventDate'); // Data do último evento.
            $table->smallInteger('paymentMethodType'); //Tipo do meio de pagamento.
            $table->smallInteger('paymentMethodCode'); //Código identificador do meio de pagamento
            $table->decimal('grossAmount'); //Valor bruto da transação.
            $table->decimal('discountAmount'); //Valor do desconto.
            $table->decimal('netAmount'); //Valor do líquido.
            $table->timestamp('escrowEndDate'); // Data em que o valor da transação estará disponível na conta do vendedor.
            $table->decimal('extraAmount');
            $table->string('senderEmail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pag_seguro_transaction');
    }
}
