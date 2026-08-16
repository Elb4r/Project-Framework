<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('transactions', function (Blueprint $table) {
        if (!Schema::hasColumn('transactions', 'sender_id')) {
            $table->unsignedBigInteger('sender_id')->after('id');
        }
    });
}

public function down()
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->dropColumn('sender_id');
    });
}
};
