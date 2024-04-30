/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./Pages/*.{html,js,php}",
    "./index.php"
  ],
  theme: {
    extend: {
      gridTemplateColumns: {
        'or': '2fr 1fr 2fr',
      },
      keyframes: {
        moveLeft: {
          '0%': { transform: 'translateX(0)' },
          '100%': { transform: 'translateX(-100%)' },
        },
      },
      keyframes: {
        moveRight: {
          '0%': { transform: 'translateX(0)' },
          '100%': { transform: 'translateX(100%)' },
        },
      },
      boxShadow: {
        'borderL': '1px -33px 0px 0px #1f1f1f',
        'borderR': '-0.5px -32px 0px 0px #1f1f1f',
      }
    },
  },
  plugins: [],
}