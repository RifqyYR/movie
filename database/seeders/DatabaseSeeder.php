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
            ['uuid' => Uuid::uuid7(), 'name' => 'LAULENG BUKIT HARAPAN', 'code' => '03441002', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PUSKESMAS LEMOE', 'code' => '03441003', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'LOMPOE', 'code' => '18140201', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. FITRIYANUR SAHRIR', 'code' => '0344U112', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. NADHILLAH ALKATIRI', 'code' => '0344U117', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'LUMPUE', 'code' => '18140202', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'KLINIK DEN B', 'code' => '03440003', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. HASLINDA KADIR', 'code' => '0344U106', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'CEMPAE', 'code' => '18140102', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'LAKESSI', 'code' => '18140101', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'POLKES DENKESYAH 07.04.04 PARE', 'code' => '03440104', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. NURJANNAH', 'code' => '0344U116', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. H. Jamal Sahil, M.Kes', 'code' => '0344U008', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'MULIA MEDICA', 'code' => '0344B003', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Hj. LINDA IRIANI RAFLUS', 'code' => '0344U108', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'LABUKKANG', 'code' => '18140302', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'LAPADE', 'code' => '18140301', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Hj. Renny Anggraeny Sari', 'code' => '0344U105', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'KLINIK KIMIA FARMA', 'code' => '0344B002', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. HJ. JUMRIANI KAMILA', 'code' => '0344U114', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'KLINIK RES PAREPARE', 'code' => '03440002', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. FAUSIA', 'code' => '0344G007', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. A. CENRARA', 'code' => '0344G004', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Nurbaya Azis', 'code' => '0344G002', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. INDAH IKAWATY', 'code' => '0344G003', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. SUFRIANI', 'code' => '0344G005', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Lusjmahria', 'code' => '0344G001', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Apotek Kimia Farma Makkasau', 'code' => '0344A011', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Prodia Parepare', 'code' => '1814L001', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Laboratorium Aira Medika', 'code' => '0344L004', 'region' => 'ParePare', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],

            // Barru
            ['uuid' => Uuid::uuid7(), 'name' => 'MADELLO', 'code' => '18060501', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'KLINIK FADHIAH', 'code' => '0329U004', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PADONGKO', 'code' => '18060502', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PALAKKA', 'code' => '18060503', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Amis Rifai (JST)', 'code' => '0329U005', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'KLINIK RES BARRU', 'code' => '03290011', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'KLINIK TIARA NUSANTARA', 'code' => '0329B004', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'BOJO BARU', 'code' => '18060402', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Tuty Moehaiyang', 'code' => '0329U006', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PALANRO', 'code' => '18060401', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Puskesmas Doi-doi', 'code' => '03290703', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PUJANANTING', 'code' => '18060701', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Besse Wadeng', 'code' => '0329U007', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'MANGKOSO', 'code' => '18060301', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'LISU', 'code' => '18060201', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'RALLA', 'code' => '18060202', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PEKKAE', 'code' => '18060101', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'Puskesmas Pancana', 'code' => '03290702', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. BURHAN', 'code' => '0329G003', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. DIAN IRTIANAH PUTRI', 'code' => '0329G002', 'region' => 'Barru', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            
            // Pinrang
            ['uuid' => Uuid::uuid7(), 'name' => 'BATU LAPPA', 'code' => '18150402', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'TADANG PALIE', 'code' => '03340001', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'CEMPA', 'code' => '18150801', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'BUNGI', 'code' => '18150601', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'LAMPA', 'code' => '18150602', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. H. RAMLI YUNUS', 'code' => '0334U009', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'LANRISANG', 'code' => '18150502', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'KLINIK HAURA', 'code' => '0334B004', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'TUPPU', 'code' => '18150701', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PUSKESMAS SALIMBONGAN', 'code' => '03341002', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'MATTIRO BULU', 'code' => '18150101', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'MATTOMBONG', 'code' => '18150501', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'POSKES 07.10.13 PINRANG', 'code' => '03340004', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'SULILI', 'code' => '18150303', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Amtsyir Muhadi, M.Adm.Kes', 'code' => '0334U010', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Rahmi Riani (JST)', 'code' => '0334U007', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'LEPPANGANG', 'code' => '03341003', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'TEPPO', 'code' => '18150401', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'POLI YONIF 721 / MKS', 'code' => '03340003', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'LERO', 'code' => '03340002', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'SUPPA', 'code' => '18150201', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Hj. Andi Silviani', 'code' => '0334U008', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'MATTIRO DECENG', 'code' => '18150301', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. H. MAKBUL TAPA', 'code' => '1815U003', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'KLINIK BELPI', 'code' => '0329B003', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'KLINIK RES PINRANG', 'code' => '03340005', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'BP Klinik Fathir', 'code' => '0334B001', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'KLINIK FOUR EF MEDICA', 'code' => '0334B003', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. RIFAI M.Kes', 'code' => '0334U014', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'KLINIK KIMIA FARMA PINRANG', 'code' => '0334B002', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'SALO', 'code' => '18150302', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Hj. NASRIWATI AMIR, A.M.Kes', 'code' => '0334G002', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'APOTEK HIKMAH FARMA', 'code' => '0334A006', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'APOTEK KIMIA FARMA 201 PINRANG', 'code' => '0334A005', 'region' => 'Pinrang', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            
            // Sidrap
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. ANDI SABRIANA', 'code' => '0333U013', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'BARANTI', 'code' => '18160101', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'MANISA', 'code' => '18160102', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'KLINIK MUHAJIR', 'code' => '0333B002', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'TANRU TEDONG', 'code' => '18160701', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'KULO', 'code' => '18160501', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. Eny Nuraeny', 'code' => '0333U007', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'POSKES 07.10.18 SIDRAP', 'code' => '03330002', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. HASNIWATI', 'code' => '0333U011', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'KLINIK RES SIDRAP', 'code' => '03330003', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'PANGKAJENE', 'code' => '18160201', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'dr. SURAHMAYANTI TAHIR', 'code' => '0333U016', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'KLINIK FELLA', 'code' => '0333B001', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'BILOKKA', 'code' => '18160401', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'RAPPANG', 'code' => '18160502', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'BARUKKU', 'code' => '18160702', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'BELAWAE', 'code' => '03330001', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'DONGI', 'code' => '18160704', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'LANCIRANG', 'code' => '18160703', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'AMPARITA', 'code' => '18160601', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'LAWAWOI', 'code' => '18160301', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'EMPAGAE', 'code' => '18160202', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Parmita (JST)', 'code' => '0333G000', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'drg. Abdul Azis, M.Kes', 'code' => '0333G001', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
            ['uuid' => Uuid::uuid7(), 'name' => 'APOTIK NURSARI FARMA', 'code' => '1816A002', 'region' => 'Sidrap', 'level' => 'FKTP', 'created_at' => now(), 'updated_at' => now()],
        ];

        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'ADMIN',
        ]);

        // Claim::insert($claims);
        Hospital::insert($hospitals);
        Hospital::insert($fktp);
    }
}
