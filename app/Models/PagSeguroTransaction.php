<?php

namespace AGStore\Models;


use Illuminate\Database\Eloquent\Model;

class PagSeguroTransaction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pag_seguro_transaction';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'code',
        'date',
        'type',
        'status',
        'lastEventDate',
        'paymentMethodType',
        'paymentMethodCode',
        'grossAmount',
        'discountAmount',
        'netAmount',
        'escrowEndDate',
        'extraAmount',
        'senderEmail',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('AGStore\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany('AGStore\Models\PagSeguroNotification');
    }

}