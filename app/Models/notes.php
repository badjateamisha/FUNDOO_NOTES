<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notes extends Model
{
    use HasFactory;
    protected $table = 'notes';
    protected $fillable = [
        'Title',
        'Description', 
        'pin'      ,
        'archive',
    ];

    
    public function noteId($id) {
        return Notes::where('id', $id)->first();
    }
}
