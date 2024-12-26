<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class AddColumnsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after('email');
            $table->string('phone')->nullable()->after('username');
            $table->string('address')->nullable()->after('phone');
        });

        // Ensure all existing users have unique usernames
        $users = User::all();
        foreach ($users as $user) {
            if (empty($user->username)) {
                $user->username = 'user_' . $user->id;
                $user->save();
            }
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['username']);
            $table->dropColumn('username');
            $table->dropColumn('phone');
            $table->dropColumn('address');
        });
    }
}
