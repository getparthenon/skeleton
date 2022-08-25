/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      height: {
        '630px': '630px'
      },
      padding: {
        '150px': '150px'
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
