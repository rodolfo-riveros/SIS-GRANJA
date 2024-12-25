<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cow extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'mother_id',
        'father_id',
        'birth_date',
    ];

    // Relación con la madre
    public function mother()
    {
        return $this->belongsTo(Cow::class, 'mother_id');
    }

    // Relación con el padre
    public function father()
    {
        return $this->belongsTo(Cow::class, 'father_id');
    }

    // Relación inversa para los hijos
    public function children()
    {
        return $this->hasMany(Cow::class, 'mother_id')->orWhere('father_id', $this->id);
    }
}
