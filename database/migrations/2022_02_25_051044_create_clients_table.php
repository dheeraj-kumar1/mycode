<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group_id');
            $table->string('full_name');
            $table->string('company_name');
            $table->string('title');
            $table->string('first_name');
            $table->string('sur_name');
            $table->string('friendly_name');
            $table->string('email');   
            $table->string('mobile_phone', 20); 
            $table->string('home_phone', 25); 
            $table->string('work_phone', 50);
            $table->string('fax', 255);
            $table->string('notes', 255);
            $table->text('address_line1');
            $table->text('address_line2');
            $table->text('town');
            $table->string('county', 250);
            $table->string('postcode', 250);
            $table->string('country', 250);
            $table->dateTime('date_registered');
            $table->dateTime('registration_complete');
            $table->string('reg_website', 250);
            $table->string('branches', 500);
            $table->string('source', 500);
            $table->string('grouping', 250);
            $table->string('property_email', 250);
            $table->string('property_sms', 250);
            $table->text('other_marketing');
            $table->dateTime('consent_updated');
            $table->text('consent_link');
            $table->dateTime('delete_before');
            $table->string('finance_status', 250);
            $table->text('finance_status_notes');
            $table->string('chain_status', 250);
            $table->text('chain_status_notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
