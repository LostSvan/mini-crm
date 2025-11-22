<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'subject', 'text', 'status', 'answered_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function scopeDay(Builder $query)
    {
        return $query->where('created_at', '>=', Carbon::now()->subDay());
    }

    public function scopeWeek(Builder $query)
    {
        return $query->where('created_at', '>=', Carbon::now()->subWeek());
    }
    public function scopeMonth(Builder $query)
    {
        return $query->where('created_at', '>=', Carbon::now()->subMonth());
    }


}
