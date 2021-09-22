<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['nome'];

    public static function rules($id = ''){
        
        return [
            'nome' => 'required',
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
        ];

    }

    public function locacoes(){
        return $this->hasMany(Locacao::class);
    }
}
