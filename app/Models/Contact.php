<?php

namespace Contacts\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


/**
 * This is the Contact model.
 *
 * @author Daniel Pérez Atanacio<daniel@apagelab.io>
 * @package App
 */
class Contact extends Model
{
    use Searchable;

    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'address', 'phone', 'email', 'user_id'];

    /**
     * That attributes that should be hidden for arrays.
     *
     * @var string[]
     */
    protected $hidden = [];

    /**
     * The searchable fields.
     *
     * @var string[]
     */
    protected $searchable = [
        'name'
    ];

    /**
     * Gets the index name for the model
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'contacts';
    }

    /**
     * Gets indexable data array for the model.
     *
     * @return any[]
     */
    public function toSearchableArray() {

        $array = $this->toArray();

        return $array;
    }
}
