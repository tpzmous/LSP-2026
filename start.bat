@echo off
color 0B

echo ========================================================
echo          N-COMICS - MENJALANKAN SERVER
echo ========================================================
echo.
echo Server berjalan di http://127.0.0.1:8000
echo Tekan Ctrl+C untuk menghentikan server.
echo.

cd /d "%~dp0"
php -d upload_max_filesize=200M -d post_max_size=200M artisan serve --port=8000
