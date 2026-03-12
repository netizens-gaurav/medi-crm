<?php

namespace App\Models;

use App\PlanStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Plan extends Model
{
    use HasUuids,SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'annual_discount',
        'tagline',
        'is_most_popular',
        'show_on_landing',
        'display_order',
        'status',
        'modules',
        'max_patients',
        'max_appointments_per_month',
        'max_team_seats',
        'max_lab_referrals_per_month',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'slug' => 'string',
            'price' => 'decimal:2',
            'status' => PlanStatus::class,
            'modules' => 'array',
            'limits' => 'array',
            'is_most_popular' => 'boolean',
            'show_on_landing' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($plan) {
            if (empty($plan->slug)) {
                $plan->slug = Str::slug($plan->name);
            }
        });
    }
}
