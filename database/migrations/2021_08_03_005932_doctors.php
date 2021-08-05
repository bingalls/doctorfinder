<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Doctors extends Migration
{
    private const table = 'doctors';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasTable(static::table)) {
            Schema::create(static::table, static function (Blueprint $table) {
                $table->bigIncrements('id');

                $table->string('Associated_Physician_Profile_ID_1')->nullable();
                $table->string('Associated_Physician_Profile_ID_2')->nullable();
                $table->string('Physician_Profile_Address_Line_1')->nullable();
                $table->string('Physician_Profile_Address_Line_2')->nullable();
                $table->string('Physician_Profile_Alternate_First_Name')->nullable();
                $table->string('Physician_Profile_Alternate_Middle_Name')->nullable();
                $table->string('Physician_Profile_Alternate_Last_Name')->nullable();
                $table->string('Physician_Profile_Alternate_Suffix')->nullable();
                $table->string('Physician_Profile_City')->nullable();
                $table->string('Physician_Profile_Country_Name')->nullable();
                $table->string('Physician_Profile_First_Name')->nullable();
                $table->string('Physician_Profile_ID')->nullable();
                $table->string('Physician_Profile_Last_Name')->nullable();
                $table->string('Physician_Profile_License_State_Code_1')->nullable();
                $table->string('Physician_Profile_License_State_Code_2')->nullable();
                $table->string('Physician_Profile_License_State_Code_3')->nullable();
                $table->string('Physician_Profile_License_State_Code_4')->nullable();
                $table->string('Physician_Profile_License_State_Code_5')->nullable();
                $table->string('Physician_Profile_Middle_Name')->nullable();
                $table->string('Physician_Profile_OPS_Taxonomy_1')->nullable();
                $table->string('Physician_Profile_OPS_Taxonomy_2')->nullable();
                $table->string('Physician_Profile_OPS_Taxonomy_3')->nullable();
                $table->string('Physician_Profile_OPS_Taxonomy_4')->nullable();
                $table->string('Physician_Profile_OPS_Taxonomy_5')->nullable();
                $table->string('Physician_Profile_Primary_Specialty')->nullable();
                $table->string('Physician_Profile_Province_Name')->nullable();
                $table->string('Physician_Profile_State')->nullable();
                $table->string('Physician_Profile_Suffix')->nullable();
                $table->string('Physician_Profile_Zipcode')->nullable();

                $table->timestampsTz();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(static::table);
    }
}
