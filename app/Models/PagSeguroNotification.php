<?php

namespace AGStore\Models;


use Illuminate\Database\Eloquent\Model;

class PagSeguroNotification extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pag_seguro_notification';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['notificationType', 'notificationCode', 'transaction_id'];

    public function transaction()
    {
        return $this->belongsTo('AGStore\Models\PagSeguroTransaction');
    }

}