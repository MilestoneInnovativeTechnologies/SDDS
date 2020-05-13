# Switch database of the application according to the subdomain
php artisan vendor:publish --provider=Milestone\Sdds\SDDSServiceProvider
<hr>
add <br> \Milestone\SDDS\SDDS::class into the $middleware property of app\Http\Kernal.php
<hr>
change route and cache key if required.

To add/update details, visit the route configured here
