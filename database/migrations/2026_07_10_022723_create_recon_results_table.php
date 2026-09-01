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
        Schema::create('recon_results', function (Blueprint $table) {
        $table->id();
        $table->foreignId('conversation_id')->nullable()->constrained()->nullOnDelete();
        $table->string('username');
        $table->string('platform');
        $table->string('profile_url')->nullable();
        $table->boolean('found')->default(false);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recon_results');
    }
};
