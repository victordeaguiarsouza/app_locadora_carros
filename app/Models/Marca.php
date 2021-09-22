<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Modelo;

class Marca extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['nome', 'imagem'];

    public static function rules($id = ''){
        
        return [
            'nome'   => 'required|unique:marcas,nome,'.$id.'|min:3',
            'imagem' => 'required|file|mimes:png,jpeg,jpg'
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
            'nome.unique' => 'O nome da marca já existe'
        ];

    }

    public function modelos(){
        return $this->hasMany(Modelo::class);
    }
}
