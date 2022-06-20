<?php

namespace App\Models;

use App\Events\SaveInvoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    const STATUS_PAID = 'paid';
    const STATUS_UNPAID = 'unpaid';
    const STATUS_DUE = 'due';


    protected $attributes = [
        'status' => 'unpaid'
    ];

    protected $dispatchesEvents = [
        'updated' => SaveInvoice::class,
        'deleted' => SaveInvoice::class
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function calculateInvoice()
    {
        $subtotal = 0;

        foreach ($this->invoiceItems as $invoiceItem) {
            $subtotal += $invoiceItem->amount;
        }

        $this->total = $subtotal + $this->additional_cost - $this->discount;
        $this->status = $this->updateStatus();
        $this->update();
    }

    public function updateStatus()
    {
        if ($this->total <= $this->paid) {
            return self::STATUS_PAID;
        } else if ($this->total > $this->paid) {
            return self::STATUS_DUE;
        }

        return self::STATUS_UNPAID;
    }
}
