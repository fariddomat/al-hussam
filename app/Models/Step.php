<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Step extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'icon'];

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255'
        ];
    }

    protected $searchable = ['name', 'description', 'icon'];
}