<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPorta extends Model
{
    protected $table      = 'status_porta';
    protected $primaryKey = 'status_porta_id';

    const CREATED_AT = 'stp_data_cadastro';
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['stp_status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
