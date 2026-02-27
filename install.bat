@echo off
setlocal
color 0B

echo ========================================================
echo        N-COMICS PLATFORM - ONE-CLICK INSTALLER
echo ========================================================
echo.
echo Script ini akan menyiapkan platform N-COMICS secara otomatis.
echo Pastikan PHP, Composer, Node.js, dan MySQL sudah berjalan.
echo.
pause
echo.

echo [1/10] Menginstall Composer Dependencies...
call composer install
if %errorlevel% neq 0 goto error
echo [SUKSES] Composer dependencies berhasil diinstall.
echo.

echo [2/10] Menyiapkan Environment File...
if not exist .env (
    copy .env.example .env
    echo [SUKSES] File .env berhasil disalin dari .env.example.
) else (
    echo [INFO] File .env sudah ada. Melewati langkah ini.
)
echo.

echo [3/10] Membuat Application Key...
call php artisan key:generate
if %errorlevel% neq 0 goto error
echo [SUKSES] Application key berhasil dibuat.
echo.

echo [4/10] Membuat Storage Symlink...
call php artisan storage:link
echo [SUKSES] Storage symlink berhasil dibuat.
echo.

echo [5/10] Membuat Folder Storage yang Diperlukan...
if not exist storage\app\public\covers  mkdir storage\app\public\covers
if not exist storage\app\public\episodes mkdir storage\app\public\episodes
if not exist storage\app\public\comics  mkdir storage\app\public\comics
if not exist storage\framework\cache\data mkdir storage\framework\cache\data
if not exist storage\framework\sessions  mkdir storage\framework\sessions
if not exist storage\framework\views     mkdir storage\framework\views
if not exist storage\logs                mkdir storage\logs
echo [SUKSES] Semua folder storage sudah disiapkan.
echo.

echo [6/10] Menjalankan Migrasi dan Seeder Database...
echo PERHATIAN: Proses ini akan MENGHAPUS data lama dan mengisi ulang dengan data baru!
call php artisan migrate:fresh --seed
if %errorlevel% neq 0 goto error
echo [SUKSES] Database berhasil dimigrasi dan di-seed.
echo.

echo [7/10] Menginstall NPM Dependencies...
call npm install
if %errorlevel% neq 0 goto error
echo [SUKSES] Node modules berhasil diinstall.
echo.

echo [8/10] Membangun Frontend Assets (Vite)...
call npm run build
if %errorlevel% neq 0 goto error
echo [SUKSES] Frontend assets berhasil dikompilasi.
echo.

echo [9/10] Membersihkan Cache...
call php artisan optimize:clear
if %errorlevel% neq 0 goto error
echo [SUKSES] Semua cache berhasil dibersihkan.
echo.

echo [10/10] Mengatur Permissions Storage...
icacls "storage" /grant Everyone:(OI)(CI)F /T /C /Q >nul 2>&1
icacls "bootstrap\cache" /grant Everyone:(OI)(CI)F /T /C /Q >nul 2>&1
echo [SUKSES] Permissions storage berhasil dikonfigurasi.
echo.

echo ========================================================
echo           INSTALASI SELESAI DENGAN SUKSES!
echo ========================================================
echo.
echo Kredensial Admin Default:
echo ----------------------------------
echo Email    : admin@ncomics.com
echo Password : admin123
echo Role     : admin
echo ----------------------------------
echo.
echo 10 komik dummy sudah otomatis tersedia setelah seeder berjalan.
echo.
echo Apakah Anda ingin menjalankan server sekarang?
choice /C YN /M "Jalankan server (Y/N)?"
if errorlevel 2 goto exit_script
if errorlevel 1 goto start_server

:start_server
echo.
echo Menjalankan Laravel Development Server di http://127.0.0.1:8000 ...
echo CATATAN: Server dijalankan dengan batas upload 200MB untuk file PDF.
call php -d upload_max_filesize=200M -d post_max_size=200M artisan serve --port=8000
goto exit_script

:error
echo.
echo ========================================================
echo     ERROR: Instalasi berhenti karena terjadi kesalahan.
echo     Periksa output di atas untuk mengetahui penyebabnya.
echo ========================================================
pause
exit /b 1

:exit_script
exit /b 0
