/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",

    "./vendor/vadiksmoniks/phonebook/resources/**/*.blade.php",
    "./vendor/vadiksmoniks/phonebook/resources/**/*.js",
    "./vendor/vadiksmoniks/phonebook/resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
