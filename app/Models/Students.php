<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Students
 * @package App\Models
 * @version October 1, 2019, 6:10 am UTC
 *
 * @property string name
 * @property string email
 * @property string contact_number
 * @property string profile_image
 */
class Students extends Model
{
    use SoftDeletes;

    public $table = 'students';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'email',
        'contact_number',
        'profile_image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'contact_number' => 'string',
        'profile_image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'contact_number' => 'required',
        'profile_image' => 'required'
    ];

    
}
