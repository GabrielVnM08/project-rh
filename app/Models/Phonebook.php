<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Phonebook extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'author'
    ];
}
