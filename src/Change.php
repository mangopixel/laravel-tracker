<?php

namespace Mangopixel\Tracker;

use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'changeableId',
        'changeableType',
        'new',
        'old'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the trackable model associated with the change.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trackable()
    {
        return $this->morphTo();
    }

    /**
     *
     *
     * @return array
     */
    public function getOldAttribute( $old )
    {
        return json_decode( $old, true );
    }

    /**
     *
     *
     * @return array
     */
    public function getNewAttribute( $new )
    {
        return json_decode( $new, true );
    }
}