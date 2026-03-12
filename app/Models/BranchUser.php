<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BranchUser extends Pivot
{
    /**
     * Since this is a pivot table, we define the table name explicitly
     */
    protected $table = 'branch_user';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'branch_id',
        'user_id',
        'role',
        'status',
    ];

    /**
     * If you want to treat the IDs as UUIDs automatically
     */
    protected $keyType = 'string';

    public $incrementing = false;
}
