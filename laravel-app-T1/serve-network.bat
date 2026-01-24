@echo off
REM Serve the Laravel app on the local network and show the URL to use from other devices.

echo Finding local IPv4 address...
set "IP="
for /f "usebackq delims=" %%i in (`powershell -NoProfile -Command "(Get-WmiObject Win32_NetworkAdapterConfiguration | Where-Object { $_.IPAddress -ne $null -and $_.IPAddress[0] -ne '127.0.0.1' } | Select-Object -ExpandProperty IPAddress | Select-Object -First 1)"`) do set "IP=%%i"

if "%IP%"=="" (
    echo Could not determine local IP address automatically.
    echo You can still serve the app and access it via your machine's IP.
    echo Starting server bound to 0.0.0.0 on port 8000...
    php artisan serve --host=0.0.0.0 --port=8000
    goto :eof
)

echo Local IP detected: %IP%
echo Starting Laravel dev server on all interfaces (0.0.0.0:8000)...
start "Laravel Server" cmd /k php artisan serve --host=0.0.0.0 --port=8000

echo.
echo Open the following URL on other devices in the same local network:
echo   http://%IP%:8000
echo.
echo If firewall blocks access, allow incoming connections on port 8000.
echo Press any key to exit this helper...
pause >nul
