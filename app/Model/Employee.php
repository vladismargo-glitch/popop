<?php
namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'last_name',
        'first_name',
        'patronymic',
        'gender',
        'birth_date',
        'address',
        'position',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->first_name} {$this->patronymic}";
    }
}