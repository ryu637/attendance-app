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

## 3. Laravel の依存パッケージをインストール

コンテナに入る:

```bash
docker exec -it php-apache bash
cd /var/www/html
composer install
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
cd src
npm install
npm run dev
```
```js
// vite.config.js
import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    vue(),
  ],
  resolve: {
    alias: {
      'vue': 'vue/dist/vue.esm-bundler.js',
      '@': path.resolve(__dirname, 'resources/js'),
    },
  },
});
```