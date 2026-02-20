<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('messenger_access')->default(false)->after('remember_token');
            $table->string('trueconf_login', 255)->nullable()->after('messenger_access');
            $table->string('trueconf_user_id', 255)->nullable()->after('trueconf_login');
            $table->text('trueconf_password_encrypted')->nullable()->after('trueconf_user_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'messenger_access',
                'trueconf_login',
                'trueconf_user_id',
                'trueconf_password_encrypted',
            ]);
        });
    }
};
