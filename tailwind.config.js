/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],

  theme: {
    extend: {
      fontFamily: {
        heading: ['"Space Grotesk"', 'sans-serif'],
        body: ['"Outfit"', 'sans-serif'],
      },

      colors: {
        mega: {
          orange: "#ff5a0a",
          orangeDark: "#e64a00",
          black: "#070707",
          dark: "#171717",
          text: "#242424",
          muted: "#6d6d6d",
          soft: "#f7f4f1",
          cream: "#fbf7f2",
          line: "#e8e2dd",
        },
      },

      boxShadow: {
        soft: "0 18px 45px rgba(7,7,7,0.08)",
        glow: "0 18px 40px rgba(255,90,10,0.18)",
      },
    },
  },

  plugins: [],
};