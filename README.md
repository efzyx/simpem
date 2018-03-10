[Demo Aplikasi Klik Disini](https://pemesanan.herokuapp.com)

[![build status](https://gitlab.com/fauzipadlaw/pemesanan/badges/master/build.svg)](https://gitlab.com/fauzipadlaw/pemesanan/commits/master)

# Sistem Manajemen Pemesanan

#### Clone Project

* `git clone git@gitlab.com:fauzipadlaw/pemesanan.git`

* `cd pemesanan`

* Copy file .env.example to .env

  * **bash :** `cp .env.example .env`

  * **cmd  :** `copy .env.example .env`

* `composer install && php artisan migrate --seed`

* `php artisan key:generate`

**Default Email    :** _admin@admin.com_

**Default Password :** _secret_
