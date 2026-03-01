## Docker Setup (Laravel Sail)

```bash
# Install dependencies
composer install
npm install

# Start containers
./vendor/bin/sail up -d

# Run migrations
./vendor/bin/sail artisan migrate --seed

# Run Vite dev server (in another terminal)
npm run dev
# or
./vendor/bin/sail npm run dev

Visit: http://localhost