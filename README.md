*Add composer.json
"autoload": {
        "psr-4": {
            
            "Nvt1904\\Languages\\":"vendor/nvt1904/languages/src"
        }
    },

*Add config/filesystem.php
'lang' => [
            'driver' => 'local',
            'root' =>resource_path('lang/'),
        ],

Add config/app.php
Nvt1904\Languages\LanguagesServiceProvider::class


*Cmd
php artisan config:cache
composer dumpautoload
php artisan migrate

*Browser
<domain>/en/language
