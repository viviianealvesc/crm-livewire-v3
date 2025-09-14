import forms from '@tailwindcss/forms'
import typo from '@tailwindcss/typography'

/** @type {import('tailwindcss').Config} */
export default {
	darkMode: 'class',
  content: [
		"./resources/**/*.blade.php",
		 "./resources/**/*.js",
		 "./vendor/robsontenorio/mary/src/View/Components/**/*.php"
	],
  theme: {
    extend: {
      colors: {
        purple: {
          50: '#faf5ff',
          100: '#f3e8ff',
          200: '#e9d5ff',
          300: '#d8b4fe',
          400: '#c084fc',
          500: '#a855f7',
          600: '#9333ea',
          700: '#7c3aed',
          800: '#6b21a8',
          900: '#581c87',
          950: '#3b0764',
        }
      }
    },
  },
  plugins: [
		forms,
		typo,
		require("daisyui")
	],
}