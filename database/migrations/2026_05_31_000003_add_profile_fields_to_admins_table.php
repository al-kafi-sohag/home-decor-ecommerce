<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('phone', 30)->nullable()->after('email');
            $table->string('designation')->nullable()->after('phone');
            $table->string('avatar')->nullable()->after('designation');
            $table->text('bio')->nullable()->after('avatar');
        });
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn(['phone', 'designation', 'avatar', 'bio']);
        });
    }
};
