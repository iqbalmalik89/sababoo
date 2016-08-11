<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 11/08/2016
 * Time: 10:14 AM
 */


namespace BusinessObject;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'skills';
    public $timestamps = false;    
}
