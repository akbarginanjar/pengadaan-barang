<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
use Alert;

class Supplier extends Model
{
    use HasFactory;

    // memberikan akses data apa saja yang bisa dilihat
    protected $visible = ['nama_supplier', 'no_telepon', 'alamat'];
    //memberikan akses data apa saja yang bisa di isi
    protected $fillable = ['nama_supplier', 'no_telepon', 'alamat'];
    //mencatat waktu pembuatan dan update data otomatis
    public $timestamps = true;

    public function barangmasuk()
    {
        //data model "Author" bisa memiliki banyak data
        //dari model "Book" melalui fk "author_id"
        return $this->hasMany('App\Models\Barangmasuk', 'supplier_id');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($supplier) {
            if ($supplier->barangmasuk->count() > 0) {
                Alert::error('Gagal Menghapus', 'Data tidak bisa di hapus karena memiliki Barang Masuk');
                return false;
            }
        });
    }
    
    

}
