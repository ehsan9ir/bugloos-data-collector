<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WebserviceRequests
 *
 * @method static \Illuminate\Database\Eloquent\Builder|WebserviceRequests newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebserviceRequests newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebserviceRequests query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $webservice_id
 * @property string|null $modelable_type
 * @property int|null $modelable_id
 * @property int $is_success
 * @property string $status_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WebserviceRequests whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebserviceRequests whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebserviceRequests whereIsSuccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebserviceRequests whereModelableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebserviceRequests whereModelableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebserviceRequests whereStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebserviceRequests whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebserviceRequests whereWebserviceId($value)
 * @method static \Database\Factories\WebserviceRequestsFactory factory(...$parameters)
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 * @mixin IdeHelperWebserviceRequests
 */
class WebserviceRequests extends Model
{
    use HasFactory;
    protected $guarded= ['id'];
}
