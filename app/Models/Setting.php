<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'group'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getDecodedValueAttribute()
    {
        if (in_array($this->type, ['json', 'array'])) {
            return json_decode($this->value, true);
        }

        if ($this->type === 'boolean') {
            return (bool) $this->value;
        }

        return $this->value;
    }
}
