/** @type {import('tailwindcss').Config} */

const defaultTheme = require('tailwindcss/defaultTheme')

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/views/Home.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    screens: {
      xs: "270px",
      sm: "400px",
      md: "620px",
      lg: "770px",
      xl: "1240px",
    },
    extend: {},

  },
  plugins: [],
}