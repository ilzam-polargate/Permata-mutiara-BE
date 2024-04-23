<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryLeads extends Model
{
    use HasFactory;

    protected $table = 'history_leads';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'leads_id',
        'sales_id',
        'created_date',
    ];

    // Relationship with Leads
    public function lead()
    {
        return $this->belongsTo(Leads::class, 'leads_id');
    }

    // Relationship with Sales
    public function sales()
    {
        return $this->belongsTo(Sales::class, 'sales_id');
    }
}
