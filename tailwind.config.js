export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './app/Filament/**/*.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                ink: '#172b25',
                forest: '#23493d',
                leaf: '#a4bf78',
                citrus: '#e8b24a',
                paper: '#f7f7f1',
            },
            fontFamily: {
                sans: ['DM Sans', 'sans-serif'],
                display: ['Fraunces', 'Georgia', 'serif'],
            },
        },
    },
    plugins: [],
};