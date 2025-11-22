# 🚀 Project Laravel 8 – PHP 7.4 – MySQL 8 with Cloudflare Tunnel Deployment

Project ini dikembangkan menggunakan:

- **PHP**: 7.4.33  
- **Laravel Framework**: 8.83.23  
- **MySQL**: 8.0.44 (Ubuntu)  
- **OS Server**: Ubuntu 22.04 x86_64  
- **Web Exposure**: Cloudflare Tunnel (tanpa IP Publik)

---

## 📁 Struktur Utama

- `/app` – Source code Laravel
- `/routes` – Route web & API
- `.env` – Environment configuration
- `/public` – Public web root
- `/database` – Migration & Seeder

---

# ⚙️ 1. Persiapan Server

Pastikan VPS menggunakan:

```
Ubuntu 22.04 LTS
```

Update sistem:

```bash
sudo apt update && sudo apt upgrade -y
```

Install dependency dasar:

```bash
sudo apt install -y curl zip unzip git software-properties-common
```

---

# 🧩 2. Install PHP 7.4

Tambahkan repository:

```bash
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
```

Install PHP 7.4 + extension Laravel:

```bash
sudo apt install -y php7.4 php7.4-cli php7.4-common php7.4-fpm php7.4-mysql \
php7.4-xml php7.4-mbstring php7.4-curl php7.4-zip php7.4-bcmath php7.4-gd
```

Cek versi:

```bash
php -v
```

---

# 🛢 3. Install MySQL 8

```bash
sudo apt install mysql-server -y
```

Cek:

```bash
mysql --version
```

Buat database:

```sql
CREATE DATABASE absensi;
```

---

# 📦 4. Clone Project

```bash
git clone https://github.com/hanissiddiq/aplikasi-absensi-hnis.git
cd project
```

Install Composer dependencies:

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
```
```bash
php -r "if (hash_file('SHA384', 'composer-setup.php') === trim(file_get_contents('https://composer.github.io/installer.sig'))) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
```
```bash
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```
cek apakah composer berhasil di install. cara diatas untuk php 7.4.33
```bash
composer --version
```

atau
```bash
composer install
```

Copy environment:

```bash
cp .env.example .env
```

Generate key:

```bash
php artisan key:generate
```

Set konfigurasi database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=absensi
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

jika muncul tampilan seperti berikut ketika login. 
<img width="1230" height="337" alt="image" src="https://github.com/user-attachments/assets/cf3790e9-e67c-4a8b-9e50-ab7ee676f1ea" />
maka ikuti step berikut :
1. pada VPS masuk ke MYSQL dengan cara ```mysql -u root -p```
   kemudian
```bash
CREATE DATABASE absensi;
CREATE USER 'absensi'@'127.0.0.1' IDENTIFIED BY 'absensi123';
GRANT ALL PRIVILEGES ON absensi.* TO 'absensi'@'127.0.0.1';
FLUSH PRIVILEGES;
```
setelah semuanya selesai maka ubahlah ```.env``` menjadi

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=absensi
DB_USERNAME=absensi
DB_PASSWORD=absensi123
```

Migrasi database:

```bash
php artisan migrate --seed
```

---

# 🌐 5. Setup Cloudflare Tunnel (Tanpa IP Publik)

Metode ini aman & tidak membutuhkan port forwarding atau IP publik.

## 5.1 Install Cloudflared

```bash
wget https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-linux-amd64.deb
sudo dpkg -i cloudflared-linux-amd64.deb
sudo apt --fix-broken install -y
```

## 5.2 Login Cloudflare via VPS(hosting)

```bash
cloudflared tunnel login
```

Salin URL yang muncul → buka di browser → pilih domain.

## 5.3 Buat Tunnel

```bash
cloudflared tunnel create vps-tunnel
```

Akan menghasilkan file:

```
/root/.cloudflared/<tunnel-id>.json
```

## 5.4 Buat DNS Routing

```bash
cloudflared tunnel route dns vps-tunnel subdomain.domainkamu.com(domain yang sudah kamu beli contoh hnis.myid)
```

## 5.5 Konfigurasi `config.yml`

Edit:

```bash
sudo nano /etc/cloudflared/config.yml
```

Isi:

```yaml
tunnel: vps-tunnel
credentials-file: /root/.cloudflared/<tunnel-id>.json

ingress:
  - hostname: subdomain.domainkamu.com
    service: http://localhost:80
  - service: http_status:404
```

## 5.6 Install & enable sebagai service

```bash
sudo cloudflared service install
sudo systemctl start cloudflared
sudo systemctl enable cloudflared
```

Cek status:

```bash
systemctl status cloudflared
```

Harus **active (running)**.

---

# 🌍 6. Setup Web Server (Nginx)

Install Nginx:

```bash
sudo apt install nginx -y
```

Buat config:

```bash
sudo nano /etc/nginx/sites-available/aplikasi-absensi-hnis
```

Isi:

```nginx
server {
    listen 80;
    server_name localhost;

    root /var/www/aplikasi-absensi-hnis/public;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php7.4-fpm.sock;
    }
}
```
atau ikuti documentasi nginx untuk laravel 8 seperti berikut :
```bash
server {
    listen 80;
    listen [::]:80;
    server_name localhost;
    root /var/www/aplikasi-absensi-hnis/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Aktifkan config:

```bash
sudo ln -s /etc/nginx/sites-available/aplikasi-absensi-hnis /etc/nginx/sites-enabled/
sudo systemctl restart nginx
```

---

# 🚀 7. Jalankan Laravel di Production

Set permission:

```bash
sudo chown -R www-data:www-data /var/www/project
sudo chmod -R 775 /var/www/project/storage
sudo chmod -R 775 /var/www/project/bootstrap/cache
```

Set environment:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

# 🎉 Aplikasi Siap Digunakan

Akses melalui:

```
https://subdomain.domainkamu.com
```

Semua trafik akan melewati Cloudflare Tunnel → aman dan tanpa IP publik.

---

# 🤝 Kontribusi

Pull request dan issue sangat diterima!

---

# 📄 Dokumentasi
webcam.js (camera) akan berjalan jika server(hosting) sudah punya domain yang sudah SSL (https)
- <img width="1366" height="733" alt="image" src="https://github.com/user-attachments/assets/42761536-592e-4e40-87ab-f4c0251e0c6e" />
- <img width="1359" height="728" alt="image" src="https://github.com/user-attachments/assets/bba69b2f-bed5-43c9-a5f5-8f2f4770b7b8" />
- <img width="1365" height="721" alt="image" src="https://github.com/user-attachments/assets/20b3797e-ec56-4aaf-bd3f-3997269e9744" />




Project ini menggunakan lisensi bebas sesuai kebutuhan Anda.



<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
