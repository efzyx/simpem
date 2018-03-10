# Sistem Manajemen Pemesanan

#### Clone Project

* `git clone git@gitlab.com:fauzipadlaw/pemesanan.git`

* `cd pemesanan`

* Copy file .env.example to .env

  * **bash :** `cp .env.example .env`

  * **cmd  :** `copy .env.example .env`

* `composer install && php artisan migrate --seed`

* `php artisan key:generate`

**Default Email    :** __admin@admin.com__
**Default Password :** __secret__
