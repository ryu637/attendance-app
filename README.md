## Attendance App

Laravel 10 + Vue 3 + Docker 開発環境

### 1. リポジトリをクローン
```bash
git clone https://github.com/ryu637/attendance-app.git
cd attendance-app/src
```

### 2. Docker 環境を起動
```bash
docker compose build
docker compose up -d
```

サービス一覧

php-apache : PHP 8 + Apache

mysql : MySQL 8

phpmyadmin : phpMyAdmin

ブラウザアクセス

Laravel: http://localhost:8080

phpMyAdmin: http://localhost:8081

### 3. Laravel 環境設定
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Laravel 設定・キャッシュクリア
```bash
docker compose exec php-apache bash
php artisan key:generate
php artisan migrate
php artisan config:clear
php artisan cache:clear
```

### 5. npm / Vue 開発環境
```bash
npm install
npm run dev
```