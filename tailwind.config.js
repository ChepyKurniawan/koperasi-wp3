/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./tes/*.{js,php,html}"],
  theme: {
    container: {
      center: true,
    },
    extend: {
      fontFamily: {
        poppins: ["Poppins", "sans-serif"],
      },
    },
  },
  plugins: [],
};
