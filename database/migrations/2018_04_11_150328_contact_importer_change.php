<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContactImporterChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_importer', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->enum('refresh', ['auto', 'daily', 'weekly', 'monthly'])->default('auto');
            $table->string('imap_host');
            $table->string('imap_port');
            $table->enum('save_pawd', ['y', 'n'])->default('n');
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
}
