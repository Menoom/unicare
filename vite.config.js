import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/welcome-blade.css',
                'resources/css/dashboard-blade.css',
                'resources/css/doctor-dashboard-blade.css',
                'resources/css/admin-dashboard-blade.css',
                'resources/css/auth-login-blade.css',
                'resources/css/auth-register-blade.css',
                'resources/css/custom.css',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
