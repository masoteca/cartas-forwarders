<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Airline
 *
 * @property int $id
 * @property string $name
 * @property string $prefix
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Airline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Airline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Airline query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Airline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Airline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Airline whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Airline wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Airline whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Airline extends Model
{
    //
}
