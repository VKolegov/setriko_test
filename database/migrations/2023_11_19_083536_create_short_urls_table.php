<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('short_urls', function (Blueprint $table) {
            $table->id();

            $table->string('slug', 16)
                  ->unique()
                  ->comment('Короткий ключ');

            $table->string('destination_url', 2048)
                  ->comment('Адрес для перенаправления');

            $table->string('name')
                  ->nullable()
                  ->comment('Название ссылки');

            $table->unsignedBigInteger('hits')
                  ->comment('Количество переходов')
                  ->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('short_urls');
    }
};
