<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 * App\Models\Document
 *
 * @property int $id
 * @property string $awb
 * @property int $id_destination
 * @property string $iata_code
 * @property string $fecha_envio
 * @property int $id_product
 * @property int $id_airline
 * @property string $rut_encargado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Airline $airline
 * @property-read \App\Models\Destination $destination
 * @property-read \App\Models\Encargado $encargado
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereAwb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereFechaEnvio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereIataCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereIdAirline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereIdDestination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereIdProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereRutEncargado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Document extends Model
{
    protected $fillable = ['awb', 'id_destination', 'iata_code', 'fecha_envio', 'id_product', 'id_airline', 'rut_encargado'];

    public function destination()
    {
        return $this->hasOne(Destination::class, 'id', 'id_destination');
    }

    public function airline()
    {
        return $this->hasOne(Airline::class, 'id', 'id_airline');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'id_product');
    }

    public function encargado()
    {
        return $this->hasOne(Encargado::class, 'rut', 'rut_encargado');
    }
}
