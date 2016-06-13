<?php

namespace Mangopixel\Tracker;

trait TrackChanges
{
    /**
     * The booting method of the model trait. This method will be called once
     * the model using the trait has been booted, and registers a listener
     * listening for updates to this model and registers changes made.
     *
     * @return void
     */
    protected static function bootTrackChanges()
    {
        static::updating( function ( Changeable $model ) {
            $fetch = Fetch::latest( 'started_at' )->first();
            if ( ! $fetch || ! count( $model->getNewData() ) ) {
                return;
            }

            Change::create( [
                'fetchId'        => $fetch->id,
                'changeableId'   => $model->id,
                'changeableType' => $model->getTable(),
                'new'            => json_encode( $model->getNewData() ),
                'old'            => json_encode( $model->getOldData() )
            ] );
        } );
    }

    /**
     * Get the changes associated with the changeable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function changes()
    {
        return $this->morphMany( Change::class );
    }

    /**
     * Get an array with all fields that have been modified since last fetch.
     *
     * @return array
     */
    public function getNewData()
    {
        $modified = [ ];
        $dirty = $this->getModifiedData();
        $original = $this->getOriginalData();

        if ( ! count( $original ) ) {
            return $dirty;
        }

        foreach ( $dirty as $key => $value ) {
            if ( $dirty[ $key ] === $original[ camel_case( $key ) ] ) {
                continue;
            }

            if ( $this->isAttributeAppended( $key ) ) {
                continue;
            }

            $modified[ camel_case( $key ) ] = $value;
        }

        return $modified;
    }

    /**
     * Get an array with all fields that have been modified since last fetch,
     * but with the data the model had before the last fetch.
     *
     * @return array
     */
    public function getOldData()
    {
        $original = $this->getOriginalData();

        return array_only( $original, array_keys( $this->getNewData() ) );
    }

    /**
     *
     *
     * @return array
     */
    protected function getModifiedData()
    {
        
    }

    /**
     *
     *
     * @return array
     */
    protected function getOriginalData()
    {
        $original = collect( $this->getOriginal() );

        return $original->map( function ( $item, $key ) {
            return $this->hasCast( $key ) ? $this->castAttribute( $key, $item ) : $item;
        } )->toArray();
    }

    protected function isAttributeAppended( $attribute )
    {
        $appendedAttributes = [ 'effective_interest', 'total_cost', 'cashback', 'fuel_bonus' ];

        foreach ( $appendedAttributes as $appendedAttribute ) {
            if ( $attribute === $appendedAttribute ) {
                return true;;
            }
        }

        return false;
    }
}