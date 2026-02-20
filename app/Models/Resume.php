<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'resumes';

    public $fillable = ['user_id', 'file_path', 'raw_text'];
}
