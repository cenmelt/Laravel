@servers(['production' => ['clement-collet@13.39.150.46']])
 
@task('deploy', ['on' => 'production'])
    cd clement-collet.dhonnabhain.me
    git checkout production
    cd app
    composer update
    php artisan migrate
    composer install --optimize-autoloader --no-dev
@endtask