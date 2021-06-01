<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\app_info;
use App\Models\API\auth_admin\ProfileAdminResult;
use App\Models\API\location\Location;
use App\Models\API\location\LocationAdmin;
use App\Models\API\other\IdValueApiModel;
use Facade\FlareClient\Time\Time;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Cast\Double;


/**
 * Class AboutApp
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="AboutApp model",
 *     description="AboutApp model",
 * )
 */

class AboutApp extends Model
{
    protected $fillable = [
        'description'
    ];


    /**
     * @OA\Property(
     *     description="Description",
     *     title="description",
     * )
     *
     * @var String
     */
    public $description;


}

