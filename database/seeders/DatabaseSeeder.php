<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Claim;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $hospitals = [
            ['uuid' => Uuid::uuid7(), 'name' => 'RS Andi Makkasau', 'code' => '1814R001', 'region' => 'ParePare', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'RS Hasri Ainun Habibie', 'code' => '0344R002', 'region' => 'ParePare', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'RS Sumantri', 'code' => '1814R002', 'region' => 'ParePare', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'RS Fatima', 'code' => '1814R004', 'region' => 'ParePare', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'RS Ananda Trifa', 'code' => '0344R001', 'region' => 'ParePare', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Utama Sitti Khadijah', 'code' => '0344S001', 'region' => 'ParePare', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Utama Mulia Medica 2', 'code' => '0344S002', 'region' => 'ParePare', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Optik Sumber Rejeki', 'code' => '0344O001', 'region' => 'ParePare', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Optik 88 Parepare', 'code' => '0344O002', 'region' => 'ParePare', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Optik Bintang Laris', 'code' => '0344O003', 'region' => 'ParePare', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Optik Irama Jaya', 'code' => '1814O001', 'region' => 'ParePare', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'RS La Patarai', 'code' => '1806R001', 'region' => 'Barru', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Utama Aflahal', 'code' => '0329S001', 'region' => 'Barru', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Utama Citra Sehat 99', 'code' => '0329S003', 'region' => 'Barru', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Optik Alam Barru', 'code' => '0329O002', 'region' => 'Barru', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'RS Nene Mallomo', 'code' => '1816R001', 'region' => 'Sidrap', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => "RS Arifin Nu'mang", 'code' => '1816R002', 'region' => 'Sidrap', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'RS Anugrah Pangkajene', 'code' => '0333R001', 'region' => 'Sidrap', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Optik EFFEM', 'code' => '0333O002', 'region' => 'Sidrap', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'RS Lasinrang', 'code' => '1815R001', 'region' => 'Pinrang', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'RS Aisyiyah Sitti Khadijah', 'code' => '0334R005', 'region' => 'Pinrang', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'RS Madising', 'code' => '0334R006', 'region' => 'Pinrang', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Optik Remaja', 'code' => '0334O003', 'region' => 'Pinrang', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Optik Ummi', 'code' => '0334O004', 'region' => 'Pinrang', 'created_at' => now(), 'updated_at' => now()],
        ];

        // $claims = [
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Andi Makkasau', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Andi Makkasau', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Andi Makkasau', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Hasri Ainun Habibie', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Hasri Ainun Habibie', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Hasri Ainun Habibie', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Sumantri', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Sumantri', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Sumantri', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Fatima', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Fatima', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Fatima', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Ananda Trifa', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Ananda Trifa', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Ananda Trifa', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Klinik Utama Sitti Khadijah', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Klinik Utama Sitti Khadijah', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Klinik Utama Sitti Khadijah', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Klinik Utama Mulia Medica 2', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Klinik Utama Mulia Medica 2', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Klinik Utama Mulia Medica 2', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Optik Sumber Rejeki', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Optik 88 Parepare', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'Agustus 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Optik Bintang Laris', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Optik Irama Jaya', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS La Patarai', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS La Patarai', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'Agustus 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS La Patarai', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Klinik Utama Aflahal', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'September 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Klinik Utama Aflahal', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Klinik Utama Aflahal', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Klinik Utama Citra Sehat 99', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Klinik Utama Citra Sehat 99', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Klinik Utama Citra Sehat 99', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Optik Karya', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Nene Mallomo', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Nene Mallomo', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Nene Mallomo', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Arifin Nu\'mang', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Arifin Nu\'mang', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Arifin Nu\'mang', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Anugrah Pangkajene', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Anugrah Pangkajene', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Anugrah Pangkajene', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Optik EFFEM', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Lasinrang', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Lasinrang', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Lasinrang', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Aisyiyah Sitti Khadijah', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Aisyiyah Sitti Khadijah', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Aisyiyah Sitti Khadijah', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Madising', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Madising', 'level' => 'FKRTL', 'claim_type' => 'Ambulance Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'RS Madising', 'level' => 'FKRTL', 'claim_type' => 'Apotek Kronis Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Optik Remaja', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        //     ['uuid' => Uuid::uuid7(), 'hospital_name' => 'Optik Ummi', 'level' => 'FKRTL', 'claim_type' => 'Pelayanan Reguler', 'month' => 'November 2023', 'created_date' => now(), 'ba_date' => now(), 'completion_limit_date' => now()->addDays(9), 'status' => 'BA Serah Terima', 'created_at' => now()],
        // ];

        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'ADMIN',
        ]);

        // Claim::insert($claims);
        Hospital::insert($hospitals);
    }
}
