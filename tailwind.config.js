const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Outfit', ...defaultTheme.fontFamily.sans],
        heading: ['Space Grotesk', ...defaultTheme.fontFamily.sans],
      },

      colors: {
        mega: {
          orange: '#ff5a00',
          orangeDark: '#e64d00',
          black: '#050505',
          text: '#2d2927',
          muted: '#6d6874',
          soft: '#f8f5f1',
          cream: '#f3eee7',
          line: '#e8e1da',
        },
      },

      boxShadow: {
        soft: '0 18px 50px rgba(7, 7, 7, 0.08)',
        premium: '0 28px 80px rgba(7, 7, 7, 0.14)',
      },
    },
  },

  plugins: [],
};