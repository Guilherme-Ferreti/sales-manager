<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BrazilianState implements Rule
{
    const STATES = [
        'Acre',               
        'Alagoas',            
        'Amapá',              
        'Amazonas',           
        'Bahia' ,             
        'Ceará',              
        'Distrito Federal' ,  
        'Espírito Santo',     
        'Goiás',              
        'Maranhão',           
        'Mato Grosso',        
        'Mato Grosso do Sul', 
        'Minas Gerais',       
        'Pará',               
        'Paraíba',            
        'Paraná',             
        'Pernambuco',         
        'Piauí',              
        'Rio de Janeiro',     
        'Rio Grande do Norte',
        'Rio Grande do Sul',  
        'Rondônia',           
        'Roraima',            
        'Santa Catarina',     
        'São Paulo',          
        'Sergipe',            
        'Tocantins',          
    ];

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, Self::STATES);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be an existing brazilian state.';
    }
}
