<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class House extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $model->slug = Str::slug($model->name) . '-' . $model->id;

            return true;
        });
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function flats()
    {
        return $this->hasMany(Flat::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
