<?php

namespace Dgtlss\Helix;

use Illuminate\Database\Eloquent\Model;

class CheckConfiguration extends Model
{
    protected $table = 'health_check_configurations';
    protected $fillable = ['check_name', 'is_enabled', 'settings'];
    protected $casts = ['settings' => 'object', 'is_enabled' => 'boolean'];
}