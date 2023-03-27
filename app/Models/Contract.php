<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'instituicao',
        'instituicao_id',
        'codModalidade',
        'user_id',
        'offer_qnt_installments_max',
        'offer_qnt_installments_min',
        'offer_juros_mes',
        'offer_value_max',
        'offer_value_min',
        'hire_value',
        'hire_qnt_installments',
        'status'
    ];

    public function validate($data)
    {
        $validator = Validator::make($data, [
            'instituicao' => 'required',
            'instituicao_id' => 'required',
            'codModalidade' => 'required',
            'offer_qnt_installments_max' => 'required',
            'offer_qnt_installments_min' => 'required',
            'offer_juros_mes' => 'required',
            'offer_value_max' => 'required',
            'offer_value_min' => 'required',
            'hire_value' => 'required',
            'hire_qnt_installments' => 'required',
            'user_id' => 'required|exists:users,id'
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
