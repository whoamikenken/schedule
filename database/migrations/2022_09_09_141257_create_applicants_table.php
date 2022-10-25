<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_id', 30)->nullable();
            $table->string('er_ref', 30)->nullable();
            $table->string('maid_ref', 30)->nullable();
            $table->string('jobsite', 30)->nullable();
            $table->string('branch', 30)->nullable();
            $table->string('principal', 30)->nullable();
            $table->string('applicant_type', 30)->nullable();
            $table->string('sales_manager', 30)->nullable();
            $table->string('fname', 30)->nullable();
            $table->string('mname', 30)->nullable();
            $table->string('lname', 30)->nullable();
            $table->string('contact', 30)->nullable();
            $table->string('address', 50)->nullable();
            $table->string('family_contact_name', 30)->nullable();
            $table->string('family_contact', 30)->nullable();
            $table->string('gender', 30)->nullable()->default('Female');
            $table->string('is_ex_abroad', 3)->nullable()->default('No');
            $table->integer('abroad_experience')->default(0);
            $table->string('is_first', 30)->nullable()->default('Yes');
            $table->string('is_walkin', 30)->nullable()->default('Yes');
            $table->date('date_applied')->nullable();
            $table->text('passport')->nullable();
            $table->string('passport_no', 30)->nullable();
            $table->date('passport_issued')->nullable();
            $table->date('passport_validity')->nullable();
            $table->string('passport_place_issued', 30)->nullable()->default('PH');
            $table->date('vac_first_dose_date')->nullable();
            $table->string('vac_first_brand', 30)->nullable();
            $table->string('vac_first_country', 30)->nullable()->default('PH');
            $table->date('vac_second_dose_date')->nullable();
            $table->string('vac_second_brand', 30)->nullable();
            $table->string('vac_second_country', 30)->nullable()->default('PH');
            $table->date('vac_booster_dose_date')->nullable();
            $table->string('vac_booster_brand', 30)->nullable();
            $table->string('vac_booster_country', 30)->nullable()->default('PH');
            $table->date('bio_trans_date')->nullable();
            $table->date('bio_lunch_date')->nullable();
            $table->string('bio_status', 30)->nullable()->default('Pending');
            $table->string('bio_availability', 30)->nullable()->default('Signed Up');
            $table->date('jo_received')->nullable();
            $table->date('jo_confirmed')->nullable();
            $table->string('jo_er_iscancel', 3)->default('No');
            $table->string('jo_maid_iscancel', 3)->default('No');
            $table->date('med_first_date')->nullable();
            $table->string('med_first_result', 30)->nullable();
            $table->string('med_first_clinic', 30)->nullable();
            $table->string('med_first_cost', 30)->nullable();
            $table->text('med_first_cert')->nullable();
            $table->date('med_first_expiration', 30)->nullable();
            $table->string('med_first_done', 30)->nullable()->default('No');
            $table->date('med_second_date')->nullable();
            $table->string('med_second_result', 30)->nullable();
            $table->string('med_second_clinic', 30)->nullable();
            $table->string('med_second_cost', 30)->nullable();
            $table->text('med_second_cert')->nullable();
            $table->date('med_second_expiration', 30)->nullable();
            $table->string('med_second_done', 30)->nullable()->default('No');
            $table->date('med_third_date')->nullable();
            $table->string('med_third_result', 30)->nullable();
            $table->string('med_third_clinic', 30)->nullable();
            $table->string('med_third_cost', 30)->nullable();
            $table->text('med_third_cert')->nullable();
            $table->date('med_third_expiration', 30)->nullable();
            $table->string('med_third_done', 30)->nullable()->default('No');
            $table->date('med_fourth_date')->nullable();
            $table->string('med_fourth_result', 30)->nullable();
            $table->string('med_fourth_clinic', 30)->nullable();
            $table->string('med_fourth_cost', 30)->nullable();
            $table->text('med_fourth_cert')->nullable();
            $table->date('med_fourth_expiration', 30)->nullable();
            $table->string('med_fourth_done', 30)->nullable()->default('No');
            $table->text('sup_doc_id988a')->nullable();
            $table->text('sup_pt6')->nullable();
            $table->text('sup_coe')->nullable();
            $table->text('sup_hq')->nullable();
            $table->text('sup_polohk')->nullable();
            $table->text('sup_infosheet')->nullable();
            $table->text('sup_privacy_policy')->nullable();
            $table->text('sup_affidavit')->nullable();
            $table->text('sup_mmr_vac')->nullable();
            $table->text('cert_ereg')->nullable();
            $table->text('cert_peos')->nullable();
            $table->text('cert_prc')->nullable();
            $table->text('cert_driver_license')->nullable();
            $table->text('cert_pdos')->nullable();
            $table->date('cert_pdos_date')->nullable();
            $table->date('cert_pdos_release_date')->nullable();
            $table->integer('cert_pdos_cost')->nullable()->default(0);
            $table->string('cert_pdos_done', 30)->nullable()->default('No');
            $table->date('cert_pdos_date_done')->nullable();
            $table->text('cert_owwa')->nullable();
            $table->date('cert_owwa_date')->nullable();
            $table->date('cert_owwa_release_date')->nullable();
            $table->text('cert_nc2')->nullable();
            $table->date('cert_nc2_date')->nullable();
            $table->string('cert_nc2_by_applicant', 30)->nullable()->default('No');
            $table->string('cert_nc2_payment_status', 30)->nullable();
            $table->integer('cert_nc2_cost')->default(0);
            $table->string('cert_nc2_done', 30)->nullable()->default('No');
            $table->date('cert_nc2_date_done')->nullable();
            $table->text('cert_ofw_infosheet')->nullable();
            $table->text('visa')->nullable();
            $table->string('visa_number', 30)->nullable();
            $table->date('visa_date_received')->nullable();
            $table->date('visa_date_expired')->nullable();
            $table->date('visa_reactive_date')->nullable();
            $table->string('visa_status', 30)->nullable()->default('Pending');
            $table->string('visa_er_iscancel', 3)->default('No');
            $table->string('visa_maid_iscancel', 3)->default('No');
            $table->string('oec_number', 30)->nullable();
            $table->string('oec_cost_done', 30)->nullable()->default('No');
            $table->integer('oec_cost')->nullable()->default(0);
            $table->date('oec_date_done')->nullable();
            $table->date('oec_contract_received')->nullable();
            $table->text('oec_covid_dec')->nullable();
            $table->string('oec_pagibig', 30)->nullable();
            $table->text('oec_insurance')->nullable();
            $table->string('oec_insurance_done', 30)->nullable()->default('No');
            $table->integer('oec_insurance_cost')->nullable()->default(0);
            $table->date('oec_insurance_date_done')->nullable();
            $table->date('oec_date_filed')->nullable();
            $table->date('oec_date_expiration')->nullable();
            $table->text('oec_pregnancy_test')->nullable();
            $table->string('oec_pregnancy_test_done', 30)->nullable()->default('No');
            $table->integer('oec_pregnancy_test_cost')->nullable()->default(0);
            $table->date('oec_pregnancy_test_date_done')->nullable();
            $table->text('oec_swab_test')->nullable();
            $table->date('oec_flight_departure')->nullable();
            $table->text('user_profile')->nullable();
            $table->text('user_profile_face')->nullable();
            $table->text('user_video')->nullable();
            $table->integer('total_cost')->nullable()->default(0);
            $table->string('isactive', 30)->nullable()->default('Active');
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->string('modified_by', 30)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->string('created_by', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
};
