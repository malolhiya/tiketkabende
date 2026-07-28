#!/bin/bash
set -e

echo "🚀 Menyiapkan aplikasi Laravel..."

# Tunggu MySQL siap menerima koneksi sebelum lanjut
echo "⏳ Menunggu database MySQL siap..."
until mysqladmin ping -h"${DB_HOST:-db}" -u"${DB_USERNAME:-root}" -p"${DB_PASSWORD:-}" --ssl=0 --silent; do
    sleep 2
done
echo "✅ Database siap."

# Generate APP_KEY jika belum ada
if ! grep -q "^APP_KEY=base64" .env; then
    echo "🔑 Generate APP_KEY..."
    php artisan key:generate --force
fi

# Jalankan migration otomatis
echo "🗄️  Menjalankan migration..."
php artisan migrate --force

# Buat symlink storage (agar gambar/bukti pembayaran bisa diakses publik)
if [ ! -L "public/storage" ]; then
    echo "🔗 Membuat storage link..."
    php artisan storage:link
fi

# Bersihkan cache lama
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "✅ Aplikasi siap dijalankan!"

exec "$@"