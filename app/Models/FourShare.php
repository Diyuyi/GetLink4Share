<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FourShare extends Model
{
    use HasFactory;

    protected $table = 'four_shares';
    protected $fillable = ['link', 'name', 'size', 'access_count'];
    public function Link_Vip()
    {
        return $this->hasOne(Link_Download_4Share::class, 'id');
    }
}
