/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",

    "./packages/VadiksMoniks/PhoneBook/resources/**/*.blade.php",
    "./packages/VadiksMoniks/PhoneBook/resources/**/*.js",
    "./packages/VadiksMoniks/PhoneBook/resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
