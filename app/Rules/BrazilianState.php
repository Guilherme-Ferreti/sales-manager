<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

class BrazilianState implements Rule
{
    const STATES = [
        ['name' => 'Acre',                  'initials' => 'AC'],
        ['name' => 'Alagoas',               'initials' => 'AL'],
        ['name' => 'Amapá',                 'initials' => 'AP'],
        ['name' => 'Amazonas',              'initials' => 'AM'],
        ['name' => 'Bahia' ,                'initials' => 'BA'],
        ['name' => 'Ceará',                 'initials' => 'CE'],
        ['name' => 'Distrito Federal' ,     'initials' => 'DF'],
        ['name' => 'Espírito Santo',        'initials' => 'ES'],
        ['name' => 'Goiás',                 'initials' => 'GO'],
        ['name' => 'Maranhão',              'initials' => 'MA'],
        ['name' => 'Mato Grosso',           'initials' => 'MT'],
        ['name' => 'Mato Grosso do Sul',    'initials' => 'MS'],
        ['name' => 'Minas Gerais',          'initials' => 'MG'],
        ['name' => 'Pará',                  'initials' => 'PA'],
        ['name' => 'Paraíba',               'initials' => 'PB'],
        ['name' => 'Paraná',                'initials' => 'PR'],
        ['name' => 'Pernambuco',            'initials' => 'PE'],
        ['name' => 'Piauí',                 'initials' => 'PI'],
        ['name' => 'Rio de Janeiro',        'initials' => 'RJ'],
        ['name' => 'Rio Grande do Norte',   'initials' => 'RN'],
        ['name' => 'Rio Grande do Sul',     'initials' => 'RS'],
        ['name' => 'Rondônia',              'initials' => 'RO'],
        ['name' => 'Roraima',               'initials' => 'RR'],
        ['name' => 'Santa Catarina',        'initials' => 'SC'],
        ['name' => 'São Paulo',             'initials' => 'SP'],
        ['name' => 'Sergipe',               'initials' => 'SE'],
        ['name' => 'Tocantins',             'initials' => 'TO'],
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
        return in_array($value, Arr::pluck(Self::STATES, 'initials'));
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
