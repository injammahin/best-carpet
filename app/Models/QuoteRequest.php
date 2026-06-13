<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company',
        'preferred_contact',
        'subscribe',
        'job_type',
        'installation_address',
        'suburb',
        'postcode',
        'rooms',
        'products',
        'suitable_days',
        'local_store',
        'comments',
        'status',
        'read_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'preferred_contact' => 'array',
        'subscribe' => 'boolean',
        'job_type' => 'array',
        'rooms' => 'array',
        'products' => 'array',
        'suitable_days' => 'array',
        'read_at' => 'datetime',
    ];

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function getIsUnreadAttribute(): bool
    {
        return is_null($this->read_at);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'contacted' => 'Contacted',
            'booked' => 'Booked',
            'completed' => 'Completed',
            'archived' => 'Archived',
            default => 'New',
        };
    }

    public function getStatusClassAttribute(): string
    {
        return match ($this->status) {
            'contacted' => 'bg-blue-50 text-blue-700 border-blue-200',
            'booked' => 'bg-orange-50 text-orange-700 border-orange-200',
            'completed' => 'bg-green-50 text-green-700 border-green-200',
            'archived' => 'bg-gray-100 text-gray-600 border-gray-200',
            default => 'bg-mega-orange/10 text-mega-orange border-mega-orange/20',
        };
    }
}