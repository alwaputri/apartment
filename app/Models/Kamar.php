<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'no_kamar',
        'status',
    ];

    public function reservasis(): HasMany
{
    return $this->hasMany(Reservasi::class, 'kamar_id', 'id');
}

    
}
