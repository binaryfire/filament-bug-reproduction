import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig(({ mode }) => {
    // Load app .env variables. Only variables prefixed with VITE_ are loaded.
    const env = loadEnv(mode, process.cwd());

    return {
        plugins: [
            laravel({
                input: [
                    'resources/css/filament/admin/theme.css',
                    'resources/css/app.css',
                    'resources/js/app.js'
                ],
                refresh: true,
            }),
            tailwindcss(),
        ],
        server: {
            host: env.VITE_SERVER_HOST || 'localhost',
            port: 5173,
            cors: env.VITE_CORS ? env.VITE_CORS === 'true' : undefined,
        },
    };
});
