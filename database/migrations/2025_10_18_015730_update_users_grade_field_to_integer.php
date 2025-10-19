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
        // Schema::table('integer', function (Blueprint $table) {
        
        // });

        Schema::table('users', function (Blueprint $table) {
            // Change grade from string to integer
            $table->integer('grade')->nullable()->change();
            
            // Add parent_contact if not exists (optional)
            if (!Schema::hasColumn('users', 'parent_contact')) {
                $table->string('parent_contact', 15)->nullable()->after('address');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('integer', function (Blueprint $table) {
        //     //
        // });

        Schema::table('users', function (Blueprint $table) {
            $table->string('grade')->nullable()->change();
            
            if (Schema::hasColumn('users', 'parent_contact')) {
                $table->dropColumn('parent_contact');
            }
        });
    }
};