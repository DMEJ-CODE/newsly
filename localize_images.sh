#!/bin/bash
# Localize Unsplash assets for deployment

mkdir -p public/images/unsplash
echo "Downloading high-quality optimized images..."

wget -qO public/images/unsplash/ai.jpg "https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format,compress&fit=crop&w=1200&q=85"
wget -qO public/images/unsplash/markets.jpg "https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format,compress&fit=crop&w=1200&q=85"
wget -qO public/images/unsplash/space.jpg "https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format,compress&fit=crop&w=1200&q=85"

wget -qO public/images/unsplash/auth-bg.jpg "https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format,compress&fit=crop&w=1600&q=85"

wget -qO public/images/unsplash/avatar1.jpg "https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format,compress&fit=crop&w=200&q=85"
wget -qO public/images/unsplash/avatar2.jpg "https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format,compress&fit=crop&w=200&q=85"
wget -qO public/images/unsplash/avatar3.jpg "https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format,compress&fit=crop&w=200&q=85"

wget -qO public/images/unsplash/curated.jpg "https://images.unsplash.com/photo-1546422904-90eab23c3d7e?auto=format,compress&fit=crop&w=400&q=85"
wget -qO public/images/unsplash/model.jpg "https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format,compress&fit=crop&w=800&q=85"
wget -qO public/images/unsplash/stories.jpg "https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format,compress&fit=crop&w=400&q=85"

echo "Replacing URLs in views..."
find views/ -type f -name "*.php" -exec sed -i 's|https://images.unsplash.com/photo-1534528741775-53994a69daeb[^"]*|<?= BASE_URL ?>public/images/unsplash/avatar1.jpg|g' {} +
find views/ -type f -name "*.php" -exec sed -i 's|https://images.unsplash.com/photo-1506794778202-cad84cf45f1d[^"]*|<?= BASE_URL ?>public/images/unsplash/avatar2.jpg|g' {} +
find views/ -type f -name "*.php" -exec sed -i 's|https://images.unsplash.com/photo-1517841905240-472988babdf9[^"]*|<?= BASE_URL ?>public/images/unsplash/avatar3.jpg|g' {} +
find views/ -type f -name "*.php" -exec sed -i 's|https://images.unsplash.com/photo-1546422904-90eab23c3d7e[^"]*|<?= BASE_URL ?>public/images/unsplash/curated.jpg|g' {} +
find views/ -type f -name "*.php" -exec sed -i 's|https://images.unsplash.com/photo-1544005313-94ddf0286df2[^"]*|<?= BASE_URL ?>public/images/unsplash/model.jpg|g' {} +
find views/ -type f -name "*.php" -exec sed -i 's|https://images.unsplash.com/photo-1504711434969-e33886168f5c[^"]*|<?= BASE_URL ?>public/images/unsplash/stories.jpg|g' {} +

echo "Replacing URLs in CSS..."
sed -i "s|https://images.unsplash.com/photo-1543269865-cbf427effbad[^']*|images/unsplash/auth-bg.jpg|g" public/style.css
sed -i "s|https://images.unsplash.com/photo-1543269865-cbf427effbad[^\"]*|images/unsplash/auth-bg.jpg|g" public/style.css

echo "Replacing URLs in database mock..."
sed -i "s|https://images.unsplash.com/photo-1677442136019-21780ecad995[^']*|public/images/unsplash/ai.jpg|g" database.sql
sed -i "s|https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3[^']*|public/images/unsplash/markets.jpg|g" database.sql
sed -i "s|https://images.unsplash.com/photo-1451187580459-43490279c0fa[^']*|public/images/unsplash/space.jpg|g" database.sql

echo "Syncing MariaDB mock data URLs to relative logic via SQL..."
mysql -u newsly_user -p'12345678' -e "
USE newsly;
UPDATE articles SET image_url = 'public/images/unsplash/ai.jpg' WHERE image_url LIKE '%photo-1677442136019%';
UPDATE articles SET image_url = 'public/images/unsplash/markets.jpg' WHERE image_url LIKE '%photo-1611974789855%';
UPDATE articles SET image_url = 'public/images/unsplash/space.jpg' WHERE image_url LIKE '%photo-1451187580459%';
"

echo "Done! All images are localized for production."
