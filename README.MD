# Assessment Maxy Academy

Repositori Project Test

## Fitur Aplikasi

1. Menambah data Siswa
2. Edit data Siswa
3. Hapus data Siswa
4. Search Realtime dengan datatable

## Framework Aplikasi

1. Backend | Laravel 10.40 (PHP 8.2.13)
2. Frontend | Vue 3 (Node v21.4.0)
3. Database | MySQL

## Instalasi dan Konfigurasi Database

1. Buat Database dengan nama myapp

## Instalasi dan Konfigurasi Backend

1. Clone repositori:

   ```bash
   git clone https://github.com/nopiibagusputra/assesment_maxy_academy.git
   ```

2. Masuk ke folder backend:

   ```bash
   cd assessment_maxy_academy/myapp_backend
   ```

3. Instal dependensi aplikasi dengan Composer:

   ```bash
   composer install
   ```

4. Salin file `.env.example` menjadi `.env`:

   ```bash
   cp .env.example .env
   ```

5. Update file `.env`. kemudian ganti nama database menjadi `myapp`.

6. Jalankan generate key

   ```bash
   php artisan key:generate
   ```

7. Jalankan optimisasi aplikasi

   ```bash
   php artisan optimize
   ```

8. Jalankan migrasi database:

   ```bash
   php artisan migrate
   ```

9. Jalankan server pengembangan Laravel:

   ```bash
   php artisan serve
   ```

   API backend akan dapat diakses pada `http://127.0.0.1:8000/api/v1`.

## Instalasi dan Konfigurasi Frontend

1. Masuk ke folder frontend:

   ```bash
   cd ../myapp_frontend
   ```

2. Instal dependensi Node.js:

   ```bash
   npm install
   ```

3. Jalankan server pengembangan Vite:

   ```bash
   npm run dev
   ```

Aplikasi sudah dapat digunakan.

##
