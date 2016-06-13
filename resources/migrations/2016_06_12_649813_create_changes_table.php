<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'changes', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->morphs( 'changeable' );
            $table->json( 'old' )->nullable();
            $table->json( 'new' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop( 'changes' );
    }
}