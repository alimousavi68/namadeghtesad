/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    './*.php',
    './views/**/*.php',
    './_hasht_core/views/**/*.php',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        // Core Theme Colors
        primary: 'var(--color-primary)',
        secondary: 'var(--color-secondary)',
        background: 'var(--color-background)',
        
        // Semantic Colors
        text: {
          main: 'var(--color-text-main)',
          light: 'var(--color-text-light)',
        },
        border: {
          DEFAULT: 'var(--color-border)',
        },
        
        // Component Colors
        header: {
          bg: 'var(--color-header-bg)',
        },
        footer: {
          bg: 'var(--color-footer-bg)',
        }
      },
      container: {
        center: true,
        padding: '1rem',
      },
      borderRadius: {
        global: 'var(--global-radius)',
      }
    },
  },
  plugins: [],
}
