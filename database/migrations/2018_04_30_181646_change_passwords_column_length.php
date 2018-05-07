<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePasswordsColumnLength extends Migration
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
			$table->string('password', 5000)->change();
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
	        $table->string('password')->change();
        });
    }
}
