<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Reservasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'reservation_id';
    protected $fillable = [
        'customer_id',
        'kamar_id',
        'check_in_date',
        'check_out_date',
        'status',
    ];

    public function getCheckInDateAttribute($value)
{
    return Carbon::parse($value);
}

public function getCheckOutDateAttribute($value)
{
    return Carbon::parse($value);
}

    public function getTotalRentalPeriod()
{
    $checkIn = \Carbon\Carbon::parse($this->check_in_date);
    $checkOut = \Carbon\Carbon::parse($this->check_out_date);

    $days = $checkIn->diffInDays($checkOut);

    if ($days >= 365) {
        $years = floor($days / 365);
        return ['years' => $years];
    } elseif ($days >= 30) {
        $months = floor($days / 30);
        return ['months' => $months];
    } elseif ($days >= 7) {
        $weeks = floor($days / 7);
        return ['weeks' => $weeks];
    } elseif ($days >= 1) {
        return ['days' => $days];
    } else {
        $hours = $checkIn->diffInHours($checkOut);
        return ['hours' => $hours];
    }
}

public function getRentalDuration()
{
    $totalRentalPeriod = $this->getTotalRentalPeriod();

    if (isset($totalRentalPeriod['years'])) {
        return $totalRentalPeriod['years'] . ' Years';
    } elseif (isset($totalRentalPeriod['months'])) {
        return $totalRentalPeriod['months'] . ' Months';
    } elseif (isset($totalRentalPeriod['weeks'])) {
        return $totalRentalPeriod['weeks'] . ' Weeks';
    } elseif (isset($totalRentalPeriod['days'])) {
        return $totalRentalPeriod['days'] . ' Days';
    } else {
        $hours = $totalRentalPeriod['hours'];
        return $hours . ' Hours';
    }
}

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id', 'id');
    }
}
