<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;

use App\Models\API\other\IdValueApiModel;
use Illuminate\Database\Eloquent\Model;


/**
 * Class CategoryApiModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="CategoryApiModel model",
 *     description="CategoryApiModel model",
 * )
 */
class CompanyApiModel extends Model
{

    protected $fillable = [
        'id' ,'company_name'
    ];

    /**
     * @OA\Property(
     *     description="ID",
     *     title="id",
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *     description="company_name",
     *     title="company_name",
     * )
     *
     * @var string
     */
    public $company_name;






}

