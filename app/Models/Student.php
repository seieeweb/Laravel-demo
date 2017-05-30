<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model {

    protected $table = 'students';

    public function getAgeAttribute() {
        return Carbon::now()->diffInYears(Carbon::parse($this->birthday));
    }

}
