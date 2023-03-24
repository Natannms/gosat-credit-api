<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Role extends Model
{
    use HasFactory;

    public function validate($data)
    {
        $validator = Validator::make($data, [
            'user_id' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }

    public function errors(){
        return $this->errors;
    }



    protected $fillable = [
        'user_id',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
