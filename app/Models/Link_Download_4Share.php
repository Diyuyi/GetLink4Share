<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link_Download_4Share extends Model
{
    use HasFactory;
    protected $table = 'link_download_4share';
    protected $fillable = ['id', 'link_download_vip'];
    public function FourShare()
    {
        return $this->hasOne(FourShare::class, 'id');
    }
}
