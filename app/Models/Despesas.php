<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesas extends Model
{
    use HasFactory;

    protected $table = "despesas";

    protected $fillable = ['user_id', 'descricao', 'valor', 'categoria'];

}
