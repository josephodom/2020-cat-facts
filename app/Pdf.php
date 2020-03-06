<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    public function url() : string {
        return url('pdf/' . $this->filename . '.pdf');
    }
}
