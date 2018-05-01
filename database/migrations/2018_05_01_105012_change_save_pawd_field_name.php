<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSavePawdFieldName extends Migration
{
	public function __construct()
	{
		DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
	}

	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_importer', function (Blueprint $table) {
	        $table->renameColumn('save_pawd', 'save_password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_importer', function (Blueprint $table) {
	        $table->renameColumn('save_password', 'save_pawd');
        });
    }
}
