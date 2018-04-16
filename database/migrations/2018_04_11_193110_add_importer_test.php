<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\ContactImporter;

class AddImporterTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $importer =
            [
                'user_id'=>"1",
                'email'=>'christiangaviria@christiangaviria.com',
                'password'=>'12345',
                'refresh'=>'auto',
                'imap_host'=>'mail.gmail.com',
                'imap_port'=>'26',
                'save_pawd'=>'y'
            ];

        $im = new ContactImporter($importer);
        $im->save();
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
