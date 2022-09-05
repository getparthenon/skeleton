/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      keyframes: {
        shake: {
          '0%, 20%, 40%, 60%, 80%, 100%': { transform: 'translate(-3px, 0px)' },
          '10%, 30%, 50%, 70%, 90%': { transform: 'translate(3px, 0px)' },
        }
      },
      animation: {
        shake: 'shake 1s',
      },
      height: {
        '630px': '630px'
      },
      padding: {
        '150px': '150px'
      }
    },
  },
  plugins: [
  ],
}
