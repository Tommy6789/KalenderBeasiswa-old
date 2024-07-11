<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class negara extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'id_benua'];

    public function benua()
    {
        return $this->belongsTo(benua::class, 'id_benua', 'id');
    }

    public function kalender_beasiswa()
{
    return $this->belongsToMany(kalender_beasiswa::class, 'knegaras', 'id_negara', 'id_kbeasiswa')
                ->withPivot('deleted_at')
                ->withTimestamps()
                ->using(Knegara::class); // Ensure using the correct pivot model
}
}
