<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class IdeHelperGeneralDataResponses {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property int|null $role_id
 * @property string $name
 * @property string $email
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $settings
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed $locale
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \TCG\Voyager\Models\Role|null $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\TCG\Voyager\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class IdeHelperUser {}
}

namespace App\Models{
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
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|Webservice whereIsActive($value)
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class IdeHelperWebservice {}
}

namespace App\Models{
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
 */
	class IdeHelperWebserviceRequests {}
}

