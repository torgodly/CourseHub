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
  myRed: '#e63946',
        primaryOrange: '#fb8500',
        neutralGray: '#333333',
        accentPurple: '#a78bfa',
        yellow: '#fbbf24',
        backgroundLight: '#f6f6f6',
      },
      fontFamily: {
        sans: ['Cairo', 'Inter', 'Helvetica Neue', 'Arial', 'sans-serif'],
      },
    },
  },
  plugins: [],
};
