/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './pages/**/*.{html,js,php}'
  ],
  theme: {
    extend: {
      fontFamily: {
        'cg': ['Cormorant Garamond', 'serif'],
        'poppins': ['Poppins', 'sans-serif'],
        'nunito': ['Nunito', 'sans-serif']
      },
    },
  },
  plugins: [require('daisyui')],
}

