## [Demo Aplikasi Klik Disini](https://pemesanan.herokuapp.com)

#### Bacaan menarik

* https://medium.com/@argadinata/menentukan-harga-proyek-it-untuk-freelancer-a7711afa118e

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

#### **_Aturan penulisan kode:_**

* Penulisan variable jangan disingkat dengan singkatan yang tidak wajar (betul : `$pemesanan`, `$no_polisi` | salah : `$pmsnn`, `$no_pls`)

* Jika belum di merge, push ke branch yang sama dengan branch push terakhir

* Jalankan `php artisan fixer:fix` sebelum push kode

* Samakan gaya penulisan dengan gaya penulisan kode yang sudah ada. Misal penulisan array : `[1,2,3]` bukan `array(1,2,3)`

### Motivation
 _**Boring solutions:** Use the most simple and boring solution for a problem. You can always make it more complex later if that is needed. The speed of innovation for our organization and product is constrained by the total complexity we have added so far, so every little reduction in complexity helps. Don't pick an interesting technology just to make your work more fun, using code that is popular will ensure many bugs are already solved and its familiarity makes it easier for others to contribute._
