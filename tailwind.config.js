/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
    './resources/js/**/*.js',
  ],
    theme: {
        extend: {
            colors: {
                'primary-orange': '#f97316',
                'orange-hover': '#ea580c',
                'accent-blue': '#3b82f6',
                'accent-indigo': '#6366f1'
            }
        }
    },
  plugins: [],
};
