<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;

class Country extends Model
{
    public function statesInOrder()
    {
        return $this->hasMany(State::class, 'country_code', 'code')->orderBy('state_name', 'asc');
    }
}
