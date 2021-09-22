<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locacao extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'locacoes';
    protected $fillable = [
        'cliente_id', 
        'carro_id', 
        'data_inicio_periodo', 
        'data_final_previsto_periodo', 
        'data_final_realizado_periodo',
        'valor_diaria',
        'km_inicial',
        'km_final',
    ];

    public static function rules($id = ''){
        
        return [
            'cliente_id'                   => 'required',   
            'carro_id'                     => 'required',   
            'data_inicio_periodo'          => 'required',   
            'data_final_previsto_periodo'  => 'required',   
            'data_final_realizado_periodo' => 'required',
            'valor_diaria'                 => 'required',
            'km_inicial'                   => 'required',
            'km_final'                     => 'required',
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
        
        return [];

    }

    public function carro(){
        return $this->belongsTo(Carro::class);
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
