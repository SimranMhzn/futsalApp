/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",  // Include Laravel Blade templates
    "./resources/**/*.js",
    "./resources/**/*.ts",
    "./resources/**/*.jsx",
    "./resources/**/*.tsx",
    "./node_modules/flowbite-react/**/*.js", // Flowbite
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin'),
  ],
}
