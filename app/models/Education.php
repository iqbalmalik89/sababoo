<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 15/08/2016
 * Time: 10:07 PM
 */


namespace BusinessObject;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'education';
    public $timestamps = true;
}
