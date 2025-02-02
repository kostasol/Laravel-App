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
		Schema::create('payments', function (Blueprint $table) {
			$table->id();
			$table->foreignId('client_id')->constrained()->onDelete('cascade');
			$table->decimal('amount', 10, 2);
			$table->timestamps();
			
			$table->index('created_at');
			$table->index(['client_id', 'created_at']);
		});
	}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
