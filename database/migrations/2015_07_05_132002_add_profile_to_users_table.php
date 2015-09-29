<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfileToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            if (!Schema::hasColumn('users', 'country'))
                $table->char('country', 2);
            if (!Schema::hasColumn('users', 'locale'))
                $table->char('locale', 5);
            if (!Schema::hasColumn('users', 'currency'))
                $table->char('currency', 3);
            if (!Schema::hasColumn('users', 'first_name'))
                $table->char('first_name', 32);
            if (!Schema::hasColumn('users', 'last_name'))
                $table->char('last_name', 32);
            if (!Schema::hasColumn('users', 'company'))
                $table->char('company', 32);
            if (!Schema::hasColumn('users', 'address_1'))
                $table->char('address_1', 64);
            if (!Schema::hasColumn('users', 'address_2'))
                $table->char('address_2', 64);
            if (!Schema::hasColumn('users', 'city'))
                $table->char('city', 32);
            if (!Schema::hasColumn('users', 'state'))
                $table->char('state', 32);
            if (!Schema::hasColumn('users', 'postcode'))
                $table->char('postcode', 16);
            if (!Schema::hasColumn('users', 'phone'))
                $table->char('phone', 16);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('locale');
            $table->dropColumn('currency');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('company');
            $table->dropColumn('address_1');
            $table->dropColumn('address_2');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('postcode');
            $table->dropColumn('phone');
        });
    }
}
