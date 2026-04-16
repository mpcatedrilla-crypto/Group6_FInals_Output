$env:Path = "C:\xampp\php;" + $env:Path
Set-Location $PSScriptRoot/..
php artisan tinker --execute="echo App\Models\DemoRecord::count();"
