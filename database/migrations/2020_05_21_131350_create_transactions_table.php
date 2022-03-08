<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kpt_number', 50)->nullable();
            $table->string('coi_number', 10)->nullable()->index();
            $table->string('terminal_coi_number', 10)->unique();
            $table->string('policy_number', 25)->nullable();
            $table->string('bos_entry_number', 50)->nullable();
            $table->string('ticket_number', 50)->nullable();
            $table->string('insured_name', 150)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('civil_status', 10)->nullable();
            $table->string('beneficiary', 255)->nullable();
            $table->string('relationship', 50)->nullable();
            $table->date('dateofbirth')->nullable();
            $table->string('guardian', 255)->nullable();
            $table->date('guardian_dateofbirth')->nullable();
            $table->string('guardian2', 255)->nullable();
            $table->date('guardian_dateofbirth2')->nullable();
            $table->string('child_siblings', 255)->nullable();
            $table->date('child_siblings_dateofbirth')->nullable();
            $table->string('child_siblings2', 255)->nullable();
            $table->date('child_siblings_dateofbirth2')->nullable();
            $table->string('child_siblings3', 255)->nullable();
            $table->date('child_siblings_dateofbirth3')->nullable();
            $table->string('child_siblings4', 255)->nullable();
            $table->date('child_siblings_dateofbirth4')->nullable();
            $table->string('type', 3);
            $table->tinyInteger('units')->nullable();
            $table->decimal('price', 10, 2);
            $table->date('date_issued')->nullable();
            $table->string('time_issued', 255)->nullable();
            $table->string('status', 10)->nullable();
            $table->boolean('posted')->nullable();
            $table->boolean('uploaded')->default(0);
            $table->smallInteger('userid_created')->nullable();
            $table->string('userbranch', 255)->nullable();
            $table->string('reason', 255)->nullable();
            $table->smallInteger('userid_modified')->nullable();
            $table->timestamps();

            $table->index('date_issued');
            $table->index('status');
            $table->index('userid_created');
            $table->index('userid_modified');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
