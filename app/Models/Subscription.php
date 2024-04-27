<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    const ACTIVE = 1;
    const CANCEL = 2;
    const DELIVERED = 1;
    const UNDELIVERED = 0;

    protected $guarded = [];
}
