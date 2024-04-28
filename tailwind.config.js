/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./Pages/*.{html,js,php}"],
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
    },
  },
  plugins: [],
}