/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js", // se usar JS que tenha classes Tailwind
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
