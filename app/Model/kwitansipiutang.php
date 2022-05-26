<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class kwitansipiutang extends Model
{
    protected $table = 'kwitansipiutangs';
    protected $primaryKey = 'KodeKwitansi';
    public $incrementing = false;
}
