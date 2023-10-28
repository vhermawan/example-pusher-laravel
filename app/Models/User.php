<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * 
 * @property int $id
 * @property int $id_role
 * @property string $name
 * @property string $password
 * @property string $username
 * @property int $status
 * @property string $phone_number
 * @property int|null $created_by
 * @property Carbon $created_at
 * @property int|null $updated_by
 * @property Carbon $updated_at
 * 
 * @property Role $role
 * @property Collection|Kandang[] $kandangs
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasApiTokens, Notifiable;
	protected $table = 'users';

	protected $casts = [
		'id_role' => 'int',
		'status' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'id_role',
		'name',
		'password',
		'username',
		'status',
		'phone_number',
		'created_by',
		'updated_by'
	];

	public function role()
	{
		return $this->belongsTo(Role::class, 'id_role');
	}

	public function kandangs()
	{
		return $this->hasMany(Kandang::class, 'id_user');
	}
}
