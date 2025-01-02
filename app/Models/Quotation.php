<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = ['prescription_id', 'drugs', 'total', 'status'];

    protected $casts = [
        'drugs' => 'array',
    ];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}
