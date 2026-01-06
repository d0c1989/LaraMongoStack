#!/usr/bin/env bash
set -e

echo ""
echo "🐳 Laravel MongoDB Docker Starter"
echo "--------------------------------"

# Detect WSL
if grep -qi microsoft /proc/version; then
  echo "🪟 Running inside WSL"
fi

if ! command -v docker &> /dev/null; then
  echo "❌ Docker is not available."
  echo "👉 If you are on Windows, run this inside WSL2."
  exit 1
fi

if ! docker compose version &> /dev/null; then
  echo "❌ Docker Compose is required."
  exit 1
fi

if [ ! -f .env ]; then
  echo "📄 Creating .env"
  cp .env.example .env
fi

echo "🐳 Building containers..."
docker compose build

echo "🚀 Starting containers..."
docker compose up -d

echo "📦 Installing PHP dependencies..."
docker compose exec app composer install --no-interaction --prefer-dist

echo "🔑 Generating APP_KEY..."
docker compose exec app sh -c "cd /var/www && php artisan key:generate --force"

echo "🔐 Fixing permissions..."
docker compose exec app chown -R www-data:www-data storage bootstrap/cache
docker compose exec app chmod -R 775 storage bootstrap/cache

echo ""
echo "✅ Done!"
echo "🌍 http://localhost"
