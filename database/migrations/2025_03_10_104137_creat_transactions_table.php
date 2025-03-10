<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('transactions', function (Blueprint $table) {
           $table->id();
           $table->date('dateTransaction');
           $table->string('nomExpediteur');
           $table->string('nomDestinataire');
           $table->float('montant');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
