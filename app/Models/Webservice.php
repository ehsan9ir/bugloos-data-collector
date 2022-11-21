<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Webservice
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $request_method
 * @property mixed|null $payload
 * @property string|null $token
 * @property mixed $response_template
 * @property string $response_type
 * @property string $storage_type
 * @property string|null $schedule_frequency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice whereRequestMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice whereResponseTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice whereResponseType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice whereScheduleFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice whereStorageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice whereUrl($value)
 * @method static \Database\Factories\WebserviceFactory factory(...$parameters)
 * @property string|null $storage_model
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice whereStorageModel($value)
 */
class Webservice extends Model
{
    use HasFactory;
    protected $guarded= ['id'];

    public const JSON_TYPE_RESPONSE = 'json';
    public const XML_TYPE_RESPONSE = 'xml';

    public const GENERAL_TYPE_STORAGE = 'general';
    public const SEPARATE_TYPE_STORAGE = 'separate';

    public static array $responseTypes = [self::JSON_TYPE_RESPONSE, self::XML_TYPE_RESPONSE];
    public static array $storageTypes = [self::GENERAL_TYPE_STORAGE, self::SEPARATE_TYPE_STORAGE];
}
