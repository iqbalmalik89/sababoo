<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 11/08/2016
 * Time: 10:14 AM
 */


namespace BusinessObject;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class JobPost extends Model
{
	use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'job_post';

}
