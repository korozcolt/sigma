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
 * App\Models\Coordinator
 *
 * @property int $id
 * @property int $dni
 * @property string $first_name
 * @property string $last_name
 * @property int $phone
 * @property string|null $address
 * @property string|null $type
 * @property \App\Enums\EntityStatus|null $status
 * @property string|null $debate_boss
 * @property string|null $candidate
 * @property int $user_id
 * @property int $place_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Leader> $leaders
 * @property-read int|null $leaders_count
 * @property-read \App\Models\Place $place
 * @property-read \App\Models\User|null $users
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereCandidate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereDebateBoss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereDni($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereUserId($value)
 */
	class Coordinator extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Leader
 *
 * @property int $id
 * @property int $dni
 * @property string $first_name
 * @property string $last_name
 * @property int $phone
 * @property string|null $address
 * @property string|null $type
 * @property \App\Enums\EntityStatus|null $status
 * @property string|null $debate_boss
 * @property string|null $candidate
 * @property int $user_id
 * @property int $place_id
 * @property int $coordinator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $public_url_token
 * @property-read \App\Models\Coordinator $coordinator
 * @property-read \App\Models\Place $place
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voter> $voters
 * @property-read int|null $voters_count
 * @method static \Illuminate\Database\Eloquent\Builder|Leader newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Leader newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Leader query()
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereCandidate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereCoordinatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereDebateBoss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereDni($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader wherePublicUrlToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereUserId($value)
 */
	class Leader extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Place
 *
 * @property int $id
 * @property string $place
 * @property string $table
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Coordinator> $coordinators
 * @property-read int|null $coordinators_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Leader> $leaders
 * @property-read int|null $leaders_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voter> $voters
 * @property-read int|null $voters_count
 * @method static \Illuminate\Database\Eloquent\Builder|Place newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Place newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Place query()
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereUpdatedAt($value)
 */
	class Place extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Sms
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Sms newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sms newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sms query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereUpdatedAt($value)
 */
	class Sms extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $last_logout_at
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property string|null $session_id
 * @property-read \App\Models\Coordinator|null $coordinator
 * @property-read \App\Models\Leader|null $leader
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLogoutAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Voter
 *
 * @property int $id
 * @property int $dni
 * @property string $first_name
 * @property string $last_name
 * @property int $phone
 * @property \App\Enums\EntityParent $entity_parent
 * @property string|null $address
 * @property string|null $type
 * @property \App\Enums\EntityStatus|null $status
 * @property string|null $debate_boss
 * @property string|null $candidate
 * @property int $place_id
 * @property int $leader_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Leader $coordinador
 * @property-read \App\Models\Leader $leader
 * @property-read \App\Models\Place $place
 * @method static \Illuminate\Database\Eloquent\Builder|Voter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereCandidate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereDebateBoss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereDni($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereEntityParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereLeaderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereUpdatedAt($value)
 */
	class Voter extends \Eloquent {}
}

