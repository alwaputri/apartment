<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'ktp',
        'first_name',
        'last_name',
        'email',
        'phone',
        'gender',
    ];

    public function reservasis(): HasMany
{
    return $this->hasMany(Reservasi::class, 'customer_id', 'id');
}

    
}
