# مقدمه‌ی جامع و مفصل سیستم Core + Theme

در توسعه‌ی قالب‌های اختصاصی وردپرس برای مشتریان مختلف — مخصوصاً قالب‌های خبری، مجله‌ای و اطلاع‌رسانی — معمولاً ۷۰٪ تا ۸۰٪ اجزای فنی تکراری هستند؛ اما ظاهر (UI) و برخی نیازهای خاص پروژه متفاوت است. این موضوع باعث می‌شود:

* زمان توسعه زیاد شود
* اشتباهات تکراری رخ دهد
* ساختار پروژه‌ها یکپارچه نباشد
* نگه‌داری و توسعه‌ی بعدی سخت شود
* حتی با وجود Tailwind و ابزارهای مدرن، باز هم بسیاری از کارها دوباره‌کاری باشند

برای حل این مشکل، یک **هسته‌ی مرکزی (Core)** طراحی می‌شود که تمامی پروژه‌ها از آن استفاده کنند و فقط بخش ظاهری و viewهای خاص هر پروژه در فولدر **mytheme/** قرار بگیرد.

این سیستم باعث می‌شود:

* توسعه‌ی پروژه‌های جدید بسیار سریع‌تر شود
* تمام قابلیت‌های مشترک فقط یکبار ساخته شوند
* قالب هر مشتری از یک سیستم استاندارد، تست‌شده و پایدار استفاده کند
* Tailwind، Customizer، Layout، Enqueue، Tokens و Template Loader همگی هماهنگ و استاندارد باشند
* قالب‌ها سبک، بهینه و بدون کدهای بلااستفاده باقی بمانند

این سند دقیقاً همین سیستم را به شکل کاملاً مستند، مرحله‌به‌مرحله و قابل اجرا تعریف می‌کند تا هر **AI Agent** یا توسعه‌دهنده‌ای بتواند کار را از هر مرحله ادامه دهد.

---

# اهداف دقیق این سیستم

## هدف ۱ — کاهش زمان ساخت قالب‌های اختصاصی

* ساخت قالب جدید از صفر به چند ساعت کاهش پیدا کند
* فقط UI جدید ساخته شود، نه زیرساخت

## هدف ۲ — بهینه بودن ۱۰۰٪

* عدم استفاده از فریم‌ورک‌های سنگین
* Tailwind فقط یکبار build شود
* تنظیمات قالب فقط باعث تغییر tokens شوند نه build جدید

## هدف ۳ — انعطاف کامل

* هسته باید برای همهٔ قالب‌های آینده قابل استفاده باشد
* هر بخش از core قابل override توسط قالب اختصاصی باشد

## هدف ۴ — ساختار حرفه‌ای و مقیاس‌پذیر

* شبیه سیستم‌های مدرن مثل Laravel + Blade اما سبک و اختصاصی وردپرس
* استاندارد قابل فهم برای توسعه‌دهندگان دیگر

---

# ساختار نهایی پروژه (بر پایه توافق کامل)

```
wp-content/
└── themes/
    └── mytheme/                 ← قالب اصلی پروژه
        ├── functions.php
        ├── style.css
        ├── views/
        │    ├── pages/
        │    ├── partials/
        │    └── loops/
        ├── _core/               ← هسته مشترک درون خود قالب
        │   ├── bootstrap.php
        │   ├── config.php
        │   ├── helpers.php
        │   ├── modules/
        │   │    ├── template/
        │   │    │     ├── loader.php
        │   │    │     └── sections.php
        │   │    ├── enqueue/
        │   │    ├── customizer/
        │   │    └── tokens/
        │   ├── views/
        │   │    ├── components/
        │   │    └── layout/
        │   └── assets/
        │        ├── css/
        │        │    ├── core-static.css
        │        │    └── core-rtl.css
        │        └── js/
        └── assets/
            ├── css/
            │    ├── theme.css
            │    └── tokens.css
            └── js/
```

---

# توضیح کامل اجزای سیستم

## ۱) Bootstrap

کارش این است که تمام بخش‌های Core را فعال کند:

* load ماژول‌ها
* load helperها
* register autoload ساده
* ایجاد متغیرهای مسیر

این فایل در قالب اختصاصی فراخوانی می‌شود:

```php
require get_template_directory() . '/../_core/bootstrap.php';
```

---

## ۲) Template Loader

این سیستم کاری شبیه Blade انجام می‌دهد اما بسیار سبک است.

### کارهایی که انجام می‌دهد:

* پیدا کردن فایل view از mytheme یا core
* extract کردن داده‌ها
* render کردن layout
* پشتیبانی از section / yield

### نحوه کارکرد:

اگر توسعه‌دهنده بنویسد:

```php
core_view('pages/home', ['title' => 'اخبار']);
```

Loader این مسیر را جستجو می‌کند:

1. `mytheme/views/pages/home.php`
2. اگر نبود: `_core/views/pages/home.php`

---

## ۳) Layout System

این سیستم ۳ دستور کلیدی دارد:

* core_start_section('name')
* core_end_section()
* core_yield('name')

نمونه:

```php
core_start_section('title'); ?>صفحه اصلی<?php core_end_section();
core_start_section('content'); ?> محتوا <?php core_end_section();
core_view('layout/base');
```

در layout:

```php
<title><?php core_yield('title'); ?></title>
```

این ساختار اجازه می‌دهد قالب‌های اختصاصی فقط فایل UI را بسازند.

---

## ۴) Token Compiler + CSS Variables

Customizer مقدار رنگ‌ها و اندازه‌ها را می‌گیرد:

```php
$tokens = [
  'color_primary' => '#3490dc',
  'font_h1' => '32px'
];
```

Compiler از آنها `tokens.css` می‌سازد:

```css
:root {
  --color-primary: #3490dc;
  --font-h1: 32px;
}
```

این فایل در mytheme/assets/css ذخیره می‌شود.

Tailwind با این tokenها هماهنگ می‌شود.

---

## ۵) Tailwind Dynamic Strategy

این بخش یکی از مهم‌ترین یافته‌ها بود:

### چرا Tailwind نباید بعد از هر تغییر دوباره build شود؟

چون وقت‌گیر و غیرعملی است.

### راه‌حل قطعی:

* Tailwind فقط یک بار build می‌شود
* خروجی حاوی کلاس‌های ثابت است
* مقادیر متغیر (رنگ، سایز فونت) در tokens.css تغییر می‌کنند
* کلاس‌هایی مثل `text-h1` همیشه تولید می‌شوند اما مقدارشان داینامیک است

### مزیت:

تغییر تنظیمات = تغییر مقادیر CSS vars
نه ساخت دوباره Tailwind

---

## ۶) Customizer Module

این بخش:

* رنگ‌ها
* سایز تایپوگرافی
* فاصله‌ها
* لوگو
* عرض کانتینر

را مدیریت می‌کند.

بعد از هر ذخیره:

* tokens.css بازنویسی می‌شود
* هیچ چیز دیگری build نمی‌شود

---

## ۷) Enqueue System

همهٔ CSS/JSهای core و theme را مدیریت می‌کند.

این باعث جلوگیری از تکرار و لود غیر ضروری می‌شود.

---

# فازهای اجرایی (برای AI Agent)

این بخش آماده شده تا هر توسعه‌دهنده‌ای بتواند دقیقاً از همین مراحل کار را ادامه دهد.

## Phase 1 — ساخت پوشه‌ها و اسکلت

## Phase 2 — Template Loader

## Phase 3 — Layout System

### وضعیت: پیاده‌سازی شده

**فایل‌های ایجاد شده:**
1. `_hasht_core/modules/template/sections.php`: حاوی کلاس `Core_Layout_Engine` و توابع کمکی.
2. `_hasht_core/modules/template.php`: فایل اصلی ماژول که اجزای template را بارگذاری می‌کند.

**توابع کلیدی:**
- `core_start_section(string $name)`: شروع بافرینگ برای یک سکشن.
- `core_end_section()`: پایان بافرینگ و ذخیره محتوا.
- `core_yield(string $name, string $default = '')`: نمایش محتوای ذخیره شده.

**نحوه عملکرد:**
این سیستم از `ob_start()` و `ob_get_clean()` برای ذخیره خروجی HTML در یک آرایه استاتیک استفاده می‌کند تا در فایل Layout اصلی فراخوانی شود.


## Phase 4 — Enqueue System

## Phase 5 — Token Compiler

## Phase 6 — Customizer

## Phase 7 — Tailwind Integration

## Phase 8 — ساخت نمونه واقعی از theme

