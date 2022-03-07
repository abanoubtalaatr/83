<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
/**
 * @property string $name
 * @property \DateTime $from
 * @property  \DateTime $to
 * @property float $total
 * @property  float $daily_budget
 * @property \Illuminate\Http\File $images
 */
class AdvertisingCampaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'from',
        'to',
        'total',
        'daily_budget',
        'images'
    ];

    protected $casts = [
        'daily_budget' => 'float',
        'total' => 'float'
    ];
}
