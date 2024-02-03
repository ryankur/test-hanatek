<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPengguna extends Model
{
    use HasFactory;
    protected $table = "master_pengguna";
    protected $primaryKey = 'user_id';
    protected $guarded = [''];
}
