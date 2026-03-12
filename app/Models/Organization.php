<?php

namespace App\Models;

use App\Enum\OrganizationStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Organization extends Model
{
    use HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'plan_id',
        'ref',
        'status',
    ];

    protected static function booted(): void
    {
        static::creating(function (Organization $organization) {
            $organization->ref = strtoupper(Str::random(8));
        });
    }

    /**
     * Relationship with the Plan model.
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class, 'organization_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'organization_id');
    }

    protected function casts(): array
    {
        return [
            'status' => OrganizationStatus::class,
        ];
    }

    public $incrementing = false;

    protected $keyType = 'string';
}
