<?php
 
 namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level'; // Nama tabel sesuai migrasi
    protected $primaryKey = 'level_id'; // Primary key tabel
    public $incrementing = true; // Menentukan bahwa primary key adalah auto-increment
    protected $keyType = 'int'; // Tipe data primary key
    public $timestamps = true; // Aktifkan timestamps jika ingin menggunakan created_at & updated_at

    protected $fillable = ['level_kode', 'level_nama']; // Mengizinkan mass assignment

    /**
     * Relasi ke UserModel (One to Many)
     */
    public function users(): HasMany
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    }
}
