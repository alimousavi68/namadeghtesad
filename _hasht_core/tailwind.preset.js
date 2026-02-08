/** @type {import('tailwindcss').Config} */
module.exports = {
  theme: {
    extend: {
      colors: {
        primary: 'var(--color-primary)',
        secondary: 'var(--color-secondary)',
        background: 'var(--color-background)',
        text: {
          main: 'var(--color-text-main)',
        }
      },
      borderRadius: {
        global: 'var(--global-radius)',
      },
      fontSize: {
        'base': ['calc(var(--text-base) * 1px)', { lineHeight: '1.6' }],
        'h1':   ['calc(var(--text-h1) * 1px)',   { lineHeight: '1.2' }],
        'h2':   ['calc(var(--text-h2) * 1px)',   { lineHeight: '1.3' }],
        'h3':   ['calc(var(--text-h3) * 1px)',   { lineHeight: '1.3' }],
        'h4':   ['calc(var(--text-h4) * 1px)',   { lineHeight: '1.4' }],
      }
    },
  },
}