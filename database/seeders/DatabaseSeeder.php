<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\LearningLog;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin / Test User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Sample Categories
        $categoryLaravel = Category::create([
            'name' => 'Laravel',
            'slug' => 'laravel',
        ]);

        $categoryAi = Category::create([
            'name' => 'AI & Antigravity',
            'slug' => 'ai-antigravity',
        ]);

        $categoryFrontend = Category::create([
            'name' => 'Frontend',
            'slug' => 'frontend',
        ]);

        // Sample Projects
        Project::create([
            'category_id' => $categoryLaravel->id,
            'title' => 'Personal Portfolio & DevLog',
            'slug' => 'personal-portfolio-devlog',
            'description' => 'A full-stack portfolio web application built with Laravel 12, Blade, Tailwind CSS, Alpine.js, and MySQL. Optimized for shared hosting (InfinityFree).',
            'image' => null,
            'tech_stack' => 'Laravel 12, PHP 8.3, Tailwind CSS, Alpine.js, MySQL',
            'collaboration_type' => 'solo',
            'github_url' => 'https://github.com/Isnaini212/portfolio-app',
            'demo_url' => 'https://example.com',
            'is_featured' => true,
        ]);

        Project::create([
            'category_id' => $categoryLaravel->id,
            'title' => 'Website Manajemen Piket',
            'slug' => 'website-manajemen-piket',
            'description' => 'Sistem informasi manajemen piket berbasis gamifikasi menggunakan Laravel 13 dan Livewire 3.',
            'readme' => <<<'MARKDOWN'
# Manajemen Piket (Piket RPG)

Sistem Manajemen Piket Berbasis Gamifikasi menggunakan **Laravel 13** dan **Livewire 3**.

---

## Tentang Project

**Manajemen Piket (Piket RPG)** adalah aplikasi pengelolaan jadwal dan pelaksanaan piket (sekolah, asrama, atau organisasi) yang dikembangkan dengan konsep **gamifikasi**. Aplikasi ini mengintegrasikan tugas piket dengan mekanisme *XP (Experience Points)*, *Leveling*, *Badge Achievement*, *Streak*, serta sistem *Convict Status* (status terhukum) dan *Redemption* (penebusan) untuk siswa yang mangkir atau terlambat.

---

## Fitur Utama

### Modul Admin / Pengurus
- **Dashboard Overview**: Pemantauan statistik piket, siswa aktif, verifikasi pending, dan status sistem.
- **Manajemen Slot Piket (`DutySlot`)**: Pengaturan alokasi dan penugasan piket harian dan mingguan.
- **Verifikasi Laporan Piket**: Peninjauan dan verifikasi foto bukti pelaksanaan piket siswa.
- **Badge Builder**: Konfigurasi lencana/pencapaian secara dinamis berdasarkan kriteria tertentu.
- **Config Panel System**: Pengaturan parameter sistem (rasio XP, visibilitas status convict, dll).
- **Manajemen Siswa & Reset Semester**: Pengelolaan data siswa dan mekanisme transisi/reset semester.
- **Log Tukar Piket (`Swap Logs`)**: Pemantauan riwayat pertukaran jadwal antar siswa.
- **Rekapitulasi Bulanan**: Ekspor laporan bulanan ke format **PDF** dan **Excel**.
- **Artisan Runner**: Eksekusi perintah otomatisasi langsung dari panel admin.

### Modul Siswa / Petualang
- **Dashboard Siswa**: Informasi level, progress XP bar, streak, dan tugas piket mendatang.
- **Misi Piket & Unggah Bukti**: Pelaporan pelaksanaan piket melalui unggah foto bukti.
- **Pengajuan Tukar Jadwal (`Swap Request`)**: Fitur pertukaran shift piket antar siswa dengan konfirmasi pihak terkait.
- **Pencapaian & Badge (`Badges`)**: Koleksi gelar dan lencana yang diraih dari aktivitas piket.
- **Papan Peringkat (`Leaderboard`)**: Klasemen peringkat siswa berdasarkan XP dan total piket.
- **Sistem Convict & Penebusan**: Penanganan otomatis siswa mangkir dengan mekanisme tugas penebusan (*Redemption*).

---

## Teknologi & Dependensi

- **Framework**: [Laravel 13](https://laravel.com) (PHP 8.3+)
- **Frontend / Dynamic UI**: [Livewire 3](https://livewire.laravel.com), Volt, Alpine.js, Tailwind CSS
- **Database**: MySQL / MariaDB / SQLite
- **Packages**:
  - `barryvdh/laravel-dompdf` (Cetak Laporan PDF)
  - `maatwebsite/excel` (Ekspor Excel)
  - `intervention/image` (Pemrosesan & Kompresi Foto Bukti)

---

## Cara Instalasi & Penggunaan

### 1. Prasyarat System
- PHP `>= 8.3` (dengan ekstensi GD/ImageMagick, PDO, OpenSSL)
- Composer
- Node.js & NPM
- Database Server (MySQL / MariaDB / SQLite)

### 2. Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/username/Manajemen_piket.git
cd Manajemen_piket

# 2. Install dependensi PHP
composer install

# 3. Salin file environment & generate app key
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database pada file .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=manajemen_piket
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Jalankan migrasi database & seeder
php artisan migrate --seed

# 6. Install dependensi Node.js & build asset
npm install
npm run build
```

### 3. Akun Bawaan (Default Credentials)

Setelah menjalankan `php artisan migrate --seed`, akun berikut siap digunakan:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@gmail.com` | `password` |
| **Siswa 1** | `siswa1@gmail.com` | `password` |
| **Siswa 2** | `siswa2@gmail.com` | `password` |
| *(Siswa 3 - 10)* | `siswa3@gmail.com` s/d `siswa10@gmail.com` | `password` |

---

## Perintah Artisan Khusus (Scheduled Tasks)

Aplikasi menyediakan perintah Artisan kustom untuk otomatisasi tugas:

```bash
# Mengecek siswa yang melewatkan jadwal piket
php artisan piket:check-missed

# Mengecek masa berlaku pertukaran piket pengganti
php artisan piket:check-replacement-expiry

# Mengecek masa berlaku penebusan status convict
php artisan piket:check-redemption-expiry
```

---

## Lisensi

Project ini dirilis di bawah lisensi [MIT License](LICENSE).
MARKDOWN,
            'image' => 'projects/5nFm2KvMW0MndVVsXSd6M0DsG9OHwKyVyd9GdlTs.png',
            'tech_stack' => 'Laravel 13, PHP 8.3, Livewire 3, MySQL',
            'collaboration_type' => 'team',
            'github_url' => null,
            'demo_url' => 'https://piketrpg.gamer.free',
            'is_featured' => true,
        ]);

        Project::create([
            'category_id' => $categoryLaravel->id,
            'title' => 'Sistem Penjadwalan Lab ICT',
            'slug' => 'sistem-penjadwalan-lab-ict',
            'description' => 'Aplikasi web untuk manajemen dan penjadwalan penggunaan ruangan Laboratorium ICT secara terpusat.',
            'image' => null,
            'tech_stack' => 'Laravel, Tailwind CSS, MySQL',
            'collaboration_type' => 'team',
            'github_url' => 'https://github.com/Isnaini212/penjadwalan-lab-ICT',
            'demo_url' => null,
            'is_featured' => true,
        ]);

        // Sample Learning Logs
        LearningLog::create([
            'category_id' => $categoryLaravel->id,
            'title' => 'Mastering Laravel Blade & Alpine.js Communication',
            'slug' => 'mastering-laravel-blade-alpinejs-communication',
            'content' => 'Explored seamless data binding between Blade templates and Alpine.js component scope without relying on heavy frontend frameworks.',
            'status' => 'completed',
            'learned_at' => '2026-07-20',
        ]);

        LearningLog::create([
            'category_id' => $categoryLaravel->id,
            'title' => 'Optimizing Laravel Deployment for Shared Hosting',
            'slug' => 'optimizing-laravel-deployment-shared-hosting',
            'content' => 'Investigating strategies for running Laravel apps on hostings without SSH/Composer access such as InfinityFree.',
            'status' => 'in_progress',
            'learned_at' => '2026-07-25',
        ]);

        LearningLog::create([
            'category_id' => $categoryAi->id,
            'title' => 'Prompt Engineering & Agentic Workflow Design',
            'slug' => 'prompt-engineering-agentic-workflow-design',
            'content' => 'Studied best practices for tool execution safety, context management, and iterative planning in autonomous AI coding assistants.',
            'status' => 'completed',
            'learned_at' => '2026-07-22',
        ]);

        LearningLog::create([
            'category_id' => $categoryFrontend->id,
            'title' => 'Modern Styling with Tailwind CSS v4',
            'slug' => 'modern-styling-with-tailwind-css-v4',
            'content' => 'Planning to explore Tailwind CSS v4 features, Vite integration, and performance benchmarks.',
            'status' => 'planning',
            'learned_at' => '2026-07-27',
        ]);

        // Default Hero & Site Settings
        \App\Models\Setting::set('preloader_text', 'INFORMATION SYSTEMS & WEB DEV');
        \App\Models\Setting::set('hero_status_badge', 'IS Student & Web Developer');
        \App\Models\Setting::set('hero_sub_badge', 'Building & learning in public');
        \App\Models\Setting::set('hero_headline_1', 'INFORMATION');
        \App\Models\Setting::set('hero_headline_2', 'SYSTEMS');
        \App\Models\Setting::set('hero_headline_3', '& DEVLOG');
        \App\Models\Setting::set('hero_bio', 'Mahasiswa Sistem Informasi yang berfokus pada pengembangan aplikasi web modern (Laravel, Livewire, Tailwind CSS) dan manajemen basis data. Mendokumentasikan setiap proses belajar di sini.');
        \App\Models\Setting::set('hero_email', 'isnaini@gmail.com');
    }
}
