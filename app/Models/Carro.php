<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carro extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['modelo_id', 'placa', 'disponivel', 'valor_diaria', 'km'];

    public static function rules($id = ''){
        
        return [
            'modelo_id'      => 'exists:modelos,id',
            'placa'          => 'required|unique:carros,placa,'.$id.'|min:3',
            'disponivel'     => 'required',
            'km'             => 'required',
        ];

    }
    
    public static function rulesPatch($id = '', array $fields){
        
        $rulesPatch = [];

        foreach (self::rules($id) as $key => $r) {
            
            if(array_key_exists($key, $fields)){
                $rulesPatch[$key] = $r;
            }
        }
        
        return $rulesPatch;

    }

    public static function feedback(){
        
        return [
            'required' => 'O campo :attribute é obrigatório',
            'placa.unique' => 'A placa já está cadastrada em outro carro.'
        ];

    }

    public function modelo(){
        return $this->belongsTo(Modelo::class);
    }
}
