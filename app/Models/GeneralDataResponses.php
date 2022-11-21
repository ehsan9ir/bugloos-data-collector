<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RequestDataResponses
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDataResponses newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDataResponses newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDataResponses query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $request_id
 * @property mixed|null $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDataResponses whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDataResponses whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDataResponses whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDataResponses whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDataResponses whereUpdatedAt($value)
 * @property-read \App\Models\WebserviceRequests|null $webserviceRequest
 */
class GeneralDataResponses extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'general_data_responses';

    public function webserviceRequest()
    {
        return $this->morphOne(WebserviceRequests::class, 'modelable');
    }
}
