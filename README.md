
# Kings Manpower DB

A applicant monitoring for kings manpower services inc


![Logo](https://scontent.fmnl30-3.fna.fbcdn.net/v/t1.18169-9/20663652_261370511031141_8390296900467258490_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeGKv6WyhzI0_DDBEdDOlXRVycLsltPvyNvJwuyW0-_I2zuJt1CR46LHU5nIg9zYto4FknnwgEtIuXYFvK83utt5&_nc_ohc=p2ROAknPzRkAX-3_8er&_nc_ht=scontent.fmnl30-3.fna&oh=00_AT88JtyFa8B2lZpp3Nmlg2mB_dxFX9Jl4sAoKJT8Osu6_w&oe=633849EC)


#sail setup
```
https://laravel.com/docs/9.x/sail

composer require laravel/sail --dev
php artisan sail:install
./vendor/bin/sail up
php artisan sail:install --devcontainer

 
./vendor/bin/sail up -d
./vendor/bin/sail stop

./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed --force
./vendor/bin/sail artisan migrate:fresh --seed

```
