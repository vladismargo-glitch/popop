<?php
namespace Model;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'user_name',
        'action',
        'ip_address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}