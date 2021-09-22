<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Marca;

class Modelo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'marca_id',
        'nome', 
        'imagem', 
        'numero_portas', 
        'lugares', 
        'air_bag', 
        'abs'
    ];

    public static function rules($id = ''){
        
        return [
            'marca_id'      => 'exists:marcas,id',
            'nome'          => 'required|unique:modelos,nome,'.$id.'|min:3',
            'imagem'        => 'required|file|mimes:png,jpeg,jpg',
            'numero_portas' => 'required|integer|digits_between:1,5',
            'lugares'       => 'required|integer|digits_between:1,20',
            'air_bag'       => 'required|boolean',
            'abs'           => 'required|boolean',
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
            'nome.unique' => 'O nome do modelo já existe'
        ];

    }

    public function marca(){
        return $this->belongsTo(Marca::class);
    }
}
