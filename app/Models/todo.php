<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class todo extends Model
{
    use HasFactory;
    // use SoftDeletes; // Uncomment jika ingin menggunakan soft delete
    
    /**
     * Nama tabel yang digunakan oleh model.
     * Opsional jika nama tabel sama dengan nama model (dalam bentuk jamak).
     */
    protected $table = 'todo';

    /**
     * Primary key yang digunakan oleh model.
     * Opsional jika menggunakan 'id'.
     */
    protected $primaryKey = 'todo_id';

    /**
     * Menentukan apakah timestamps digunakan.
     * Default: true (timestamps digunakan)
     */
    // public $timestamps = true;

    /**
     * Field yang bisa diisi (mass assignment).
     */
    protected $fillable = [
      'title','is_done'
    ];

    /**
     * Field yang tidak boleh diisi.
     */
    protected $guarded = [
        // 'kolom_yang_tidak_boleh_diisi'
    ];

    /**
     * Field yang disembunyikan saat mengubah model ke array/JSON.
     */
    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];

    /**
     * Field yang selalu disertakan saat mengubah model ke array/JSON.
     */
    protected $appends = [
        // 'full_name',
    ];

    /**
     * Cast tipe data kolom.
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        // 'is_active' => 'boolean',
        // 'settings' => 'array',
        // 'price' => 'decimal:2'
    ];

    /**
     * Relasi One to Many.
     */
    // public function posts()
    // {
    //     return $this->hasMany(Post::class);
    // }

    /**
     * Relasi Belongs To.
     */
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    /**
     * Relasi Many to Many.
     */
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }

    /**
     * Accessor - Mengubah data saat diakses.
     */
    // public function getFullNameAttribute()
    // {
    //     return $this->first_name . ' ' . $this->last_name;
    // }

    /**
     * Mutator - Mengubah data sebelum disimpan.
     */
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    /**
     * Scope query - Filter khusus.
     */
    // public function scopeActive($query)
    // {
    //     return $query->where('is_active', true);
    // }

    /**
     * Boot method - Dijalankan saat model diinisialisasi.
     */
    // protected static function boot()
    // {
    //     parent::boot();
    
    //     static::creating(function ($model) {
    //         // Kode yang dijalankan sebelum model dibuat
    //     });
    // }
}