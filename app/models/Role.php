<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role  extends Model
{
    use SoftDeletes;
    protected $table = 'roles';
    const SUPER_ADMIN = 1;
}