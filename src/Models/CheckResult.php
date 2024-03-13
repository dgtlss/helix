<?php

namespace Dgtlss\Helix;

use Illuminate\Database\Eloquent\Model;

class CheckResult extends Model
{
    protected $table = 'health_check_results';
    protected $fillable = ['check_name', 'message', 'status', 'additional_data'];
    protected $casts = ['additional_data' => 'object'];
}