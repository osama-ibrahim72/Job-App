<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('context_user', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\User::class)->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(\App\Models\Context::class)->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('context_user');
    }
};
