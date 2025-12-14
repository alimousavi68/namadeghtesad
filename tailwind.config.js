/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './views/**/*.php',
    './_hasht_core/views/**/*.php',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        // اتصال کلاس‌های Tailwind به متغیرهای CSS ما
        primary: 'var(--color-primary)',
        secondary: 'var(--color-secondary)',
        background: 'var(--color-background)',
        text: {
          main: 'var(--color-text-main)',
        }
      },
      container: {
        center: true,
        padding: '1rem',
      },
      spacing: {
        // مثال: استفاده از واحد فاصله داینامیک (اگر نیاز باشد)
        // 'gutter': 'var(--spacing-unit)',
      },
      borderRadius: {
        // اتصال به متغیر گردی گوشه‌ها
        global: 'var(--global-radius)',
      }
    },
  },
  plugins: [],
}