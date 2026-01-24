@echo off
echo 🚀 بدء إعداد قاعدة البيانات...

REM 1. تنظيف الكاش
echo ✅ تنظيف الكاش...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

REM 2. تشغيل المايجريشن
echo ✅ تشغيل المايجريشن...
php artisan migrate --force

REM 3. تشغيل السيدرات
echo ✅ تشغيل السيدرات...
php artisan db:seed --force

echo 🎉 تم إعداد قاعدة البيانات بنجاح!
echo.
echo 📋 بيانات التسجيل:
echo 👤 Admin: admin@laundrypro.com / password123
echo 👤 User:  user@laundrypro.com  / password123
echo.
echo 🚀 تشغيل السيرفر...
php artisan serve