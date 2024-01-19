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

        $fktp = [
            // Pare-Pare
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Lauleng Bukit Harapan', 'code' => '03441002', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Lemoe', 'code' => '03441003', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Lompoe', 'code' => '18140201', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Fitriyanur Sahrir', 'code' => '0344U112', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Nadhillah Alkatiri', 'code' => '0344U117', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Lumpue', 'code' => '18140202', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Teratai Pabbettowali', 'code' => '03440003', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr.Haslinda Kadir', 'code' => '0344U106', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Cempae', 'code' => '18140102', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Lakessi', 'code' => '18140101', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Polkes Denkesyah 07.04.04 pare', 'code' => '03440104', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Nurjannah', 'code' => '0344U116', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. H. Jamal Sahil, M.Kes', 'code' => '0344U008', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Mulia Medica', 'code' => '0344B003', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr.Hj. Linda Iriani Raflus', 'code' => '0344U108', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Labukkang', 'code' => '18140302', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Lapade', 'code' => '18140301', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr.Hj. Renny Anggraeny Sari', 'code' => '0344U105', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Kimia Farma', 'code' => '0344B002', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr.Hj. Jumriani Kamila', 'code' => '0344U114', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Res Parepare', 'code' => '03440002', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Fausia', 'code' => '0344G007', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Andi Cenrara', 'code' => '0344G004', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Nurbaya Azis', 'code' => '0344G002', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Indah Ikawaty', 'code' => '0344G003', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Sufriani', 'code' => '0344G005', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Lusjmahria', 'code' => '0344G001', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Apotik Kimia Farma Makkasau', 'code' => '0344A011', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Prodia Parepare', 'code' => '1814L001', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Laboratorium Aira Medika', 'code' => '0344L004', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            
            // Barru
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Madello', 'code' => '18060501', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Fadhiah', 'code' => '0329U004', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Padongko', 'code' => '18060502', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Palakka', 'code' => '18060503', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Amis Rifai (jst)', 'code' => '0329U005', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Res Barru', 'code' => '03290011', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Tiara Nusantara', 'code' => '0329B004', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Bojo Baru', 'code' => '18060402', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Tuty Moehaiyang', 'code' => '0329U006', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Palanro', 'code' => '18060401', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Doi-Doi', 'code' => '03290703', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Pujananting', 'code' => '18060701', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Besse Wadeng', 'code' => '0329U007', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Mangkoso', 'code' => '18060301', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Lisu', 'code' => '18060201', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Ralla', 'code' => '18060202', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Pekkae', 'code' => '18060101', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Pancana', 'code' => '03290702', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Burhan', 'code' => '0329G003', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Dian Irtianah Putri', 'code' => '0329G002', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            
            // Pinrang
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Batu Lappa', 'code' => '18150402', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Tadang Palie', 'code' => '03340001', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Cempa', 'code' => '18150801', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Bungi', 'code' => '18150601', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Lampa', 'code' => '18150602', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. H. Ramli Yunus', 'code' => '0334U009', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Lanrisang', 'code' => '18150502', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Haura', 'code' => '0334B004', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Tuppu', 'code' => '18150701', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Salimbongan', 'code' => '03341002', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Mattiro Bulu', 'code' => '18150101', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Mattombong', 'code' => '18150501', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Polkes 14.9.14 Pinrang', 'code' => '03340004', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Sulili', 'code' => '18150303', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Amtsyir Muhadi,M.Adm.Kes', 'code' => '0334U010', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Rahmi Riani ', 'code' => '0334U007', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Leppangang', 'code' => '03341003', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Teppo', 'code' => '18150401', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Poli Yonif 721 / MKS', 'code' => '03340003', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Lero', 'code' => '03340002', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Suppa', 'code' => '18150201', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Hj. Andi Silviani', 'code' => '0334U008', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Mattiro Deceng', 'code' => '18150301', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. H. Makbul Tapa', 'code' => '1815U003', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Belpi', 'code' => '0329B003', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Res Pinrang', 'code' => '03340005', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'BP Klinik Fathir', 'code' => '0334B001', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Four EF Medica', 'code' => '0334B003', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Rifai M.Kes', 'code' => '0334U014', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Kimia Farma Pinrang', 'code' => '0334B002', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Salo', 'code' => '18150302', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Hj. Nasriwati Amir M.Kes', 'code' => '0334G002', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Apotik Hikma Farma', 'code' => '0334A006', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Apotik Kimia Farma 201 Pinrang', 'code' => '0334A005', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            
            // Sidrap
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Andi Sabriana', 'code' => '0333U013', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Baranti', 'code' => '18160101', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Manisa', 'code' => '18160102', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Muhajir', 'code' => '0333B002', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Tanru Tedong', 'code' => '18160701', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Kulo', 'code' => '18160501', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Eny Nuraeny', 'code' => '0333U007', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Polkes 14.09.19 Kodim 1420 Sidrap', 'code' => '03330002', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Hasniwati', 'code' => '0333U011', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Res Sidrap', 'code' => '03330003', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Pangkajene', 'code' => '18160201', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Surahmayanti Tahir', 'code' => '0333U016', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Klinik Fella', 'code' => '0333B001', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Bilokka', 'code' => '18160401', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Rappang', 'code' => '18160502', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Barukku', 'code' => '18160702', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Belawae', 'code' => '03330001', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Dongi', 'code' => '18160704', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Lancirang', 'code' => '18160703', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Amparita', 'code' => '18160601', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Lawawoi', 'code' => '18160301', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PKM Empagae', 'code' => '18160202', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Parmita', 'code' => '0333G000', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Abdul Azis, M.Kes', 'code' => '0333G001', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Apotik Nursari Farma', 'code' => '1816A002', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
        ];

        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'ADMIN',
        ]);

        Hospital::insert($hospitals);
        Hospital::insert($fktp);
    }
}
