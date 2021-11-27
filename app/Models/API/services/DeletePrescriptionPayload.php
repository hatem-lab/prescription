<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\services;


use Illuminate\Database\Eloquent\Model;

/**
 * Class DeletePrescriptionPayload
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="DeletePrescriptionPayload model",
 *     description="DeletePrescriptionPayload model",
 * )
 */
class DeletePrescriptionPayload extends Model
{

    protected $fillable = [
        'prescription_id'

    ];

    /**
     * @OA\Property(
     *     description="Id of prescription",
     *     title="prescription_id",
     * )
     *
     * @var integer
     */
    public $prescription_id;




}

