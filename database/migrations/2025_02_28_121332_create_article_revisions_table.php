<?php

use App\Models\Article;
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
        Schema::table('article_revisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles')->onDelete('cascade')->index();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->index();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->longText('body')->nullable();
            $table->json('tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_revisions');
    }
};
