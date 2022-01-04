<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiteUrl extends Model
{
    use HasFactory;

    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'site_url';

    /** @var string */
    protected $primaryKey = 'site_id';

    /** @var string[] */
    protected $fillable = [
        'ee_id',
        'url',
        'registration_date',
        'event_tag',
    ];

    /** @var string[] */
    protected $dates = [
        'registration_date',
    ];

    /** @return \Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function emergencyEvent(): BelongsTo
    {
        return $this->belongsTo(EmergencyEvent::class, 'ee_id', 'ee_id');
    }
}
