<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(
            Supplier::class,
            'id_supplier',   // FK di pembelian
            'id_supplier'    // PK di supplier
        );

        // Artinya: "Setiap pembelian MILIK SATU supplier"
        // Kasus: FK ada di tabel ini  | Relasi: belongsTo
        // Kasus: FK ada di tabel lain | Relasi: hasMany / hasOne
    }
}
