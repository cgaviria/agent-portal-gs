<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserDummyData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('users', function($table)
	    {
		    $table->unsignedInteger('agency_id')->nullable()->change();
	    });

    	$agency_one = \App\Agency::where('id' , '=', '1')->first();
	    $agency_two = \App\Agency::where('id' , '=', '2')->first();

	    $agency_role = \App\Role::where('slug' , '=', 'agency')->first();
	    $agency_role->name = 'Agency Manager';
	    $agency_role->save();

	    $users = [
			[
			    'email'=>'cbarretta@shoreex.com',
			    'password'=>12345,
			    'first_name'=>'Carrie',
			    'last_name'=>'Baretta',
			    'role'=>'Admin'
		    ],
		    [
			    'email'=>'testowner@shoreex.com',
			    'password'=>12345,
			    'first_name'=>'Test',
			    'last_name'=>'Owner',
			    'role'=>'Owner'
		    ],
		    [
			    'email'=>'testowner2@shoreex.com',
			    'password'=>12345,
			    'first_name'=>'Test Two',
			    'last_name'=>'Owner',
			    'role'=>'Owner'
		    ],
		    [
			    'email'=>'testagencymanager@shoreex.com',
			    'password'=>12345,
			    'first_name'=>'Test',
			    'last_name'=>'Agencymanager',
			    'role'=>'Agency',
			    'agency_id' => $agency_one->id
		    ],
		    [
			    'email'=>'testagencymanager2@shoreex.com',
			    'password'=>12345,
			    'first_name'=>'Test Two',
			    'last_name'=>'Agencymanager',
			    'role'=>'Agency',
			    'agency_id' => $agency_two->id
		    ],
		    [
			    'email'=>'testagencymanager3@shoreex.com',
			    'password'=>12345,
			    'first_name'=>'Test Three',
			    'last_name'=>'Agencymanager',
			    'role'=>'Agency',
			    'agency_id' => $agency_one->id
		    ],
		    [
			    'email'=>'testagencymanager4@shoreex.com',
			    'password'=>12345,
			    'first_name'=>'Test Four',
			    'last_name'=>'Agencymanager',
			    'role'=>'Agency',
			    'agency_id' => $agency_two->id
		    ],
		    [
			    'email'=>'testagent@shoreex.com',
			    'password'=>12345,
			    'first_name'=>'Test',
			    'last_name'=>'Agent',
			    'role'=>'Agent',
			    'agency_id' => $agency_one->id
		    ],
		    [
			    'email'=>'testagent2@shoreex.com',
			    'password'=>12345,
			    'first_name'=>'Test Two',
			    'last_name'=>'Agent',
			    'role'=>'Agent',
			    'agency_id' => $agency_two->id
		    ],
		    [
			    'email'=>'testagent3@shoreex.com',
			    'password'=>12345,
			    'first_name'=>'Test Three',
			    'last_name'=>'Agent',
			    'role'=>'Agent',
			    'agency_id' => $agency_one->id
		    ],
		    [
			    'email'=>'testagent4@shoreex.com',
			    'password'=>12345,
			    'first_name'=>'Test Four',
			    'last_name'=>'Agent',
			    'role'=>'Agent',
			    'agency_id' => $agency_two->id
		    ],
	    ];

	    $agency_two->name = 'Agency Test Two';

	    $agency_two->save();

	    foreach ($users as $user) {
		    $current = Sentinel::create($user);
		    $role = Sentinel::findRoleByName($user['role']);
		    $role->users()->attach($current);

		    $activation = Activation::create($current);
		    Activation::complete($current, $activation->code);

		    if (isset($user['agency_id'])) {
			    $current->agency_id = $user['agency_id'];
			    $current->save();
		    }

		    if ($current->email == 'testowner@shoreex.com') {
			    $agency_one->owner_id = $current->id;
			    $agency_one->save();
		    } else if ($current->email == 'testowner2@shoreex.com') {
			    $agency_two->owner_id = $current->id;
			    $agency_two->save();
		    }
	    }

	    $admin_user = \App\User::where('email' , '=', 'christiangaviri@gmail.com')->first();
	    $admin_user->agency_id = null;
	    $admin_user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
