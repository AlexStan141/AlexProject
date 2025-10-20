<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    protected $fillable = ['full_name', 'phone', 'company_name', 'address', 'notes', 'status', 'user_id'];
    public static array $status = ['Active', 'Inactive'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
