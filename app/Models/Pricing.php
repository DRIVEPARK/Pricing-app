<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;
    protected $fillable = ['id','description', 'amount', 'project_id','client_id'];

    public function pricing()
    {
        return $this->belongsTo(Pricing::class);
    }

}
