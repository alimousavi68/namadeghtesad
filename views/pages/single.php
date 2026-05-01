<?php
/**
 * single.php view
 */
?>

<?php core_start_section('content'); ?>
<?php
$post_id = get_the_ID();

if (get_post_type($post_id) === 'company') {
    $company_id = $post_id;

    $website = get_post_meta($company_id, '_company_website', true);
    $email = get_post_meta($company_id, '_company_email', true);
    $phones = get_post_meta($company_id, '_company_phones', true);
    $addresses = get_post_meta($company_id, '_company_addresses', true);
    $location_address = get_post_meta($company_id, '_company_location_address', true);

    $social_instagram = get_post_meta($company_id, '_company_social_instagram', true);
    $social_telegram = get_post_meta($company_id, '_company_social_telegram', true);
    $social_linkedin = get_post_meta($company_id, '_company_social_linkedin', true);
    $social_x = get_post_meta($company_id, '_company_social_x', true);
    $social_whatsapp = get_post_meta($company_id, '_company_social_whatsapp', true);

    $intro = (string) get_post_meta($company_id, '_company_intro', true);
    $description = (string) get_post_meta($company_id, '_company_description', true);
    $products = (string) get_post_meta($company_id, '_company_products', true);

    $logo = get_the_post_thumbnail_url($company_id, 'medium');
    $activity_terms = get_the_terms($company_id, 'company_activity');
    $primary_activity_id = (!is_wp_error($activity_terms) && !empty($activity_terms)) ? (int) $activity_terms[0]->term_id : 0;
    $all_activities = get_terms([
        'taxonomy' => 'company_activity',
        'hide_empty' => false,
    ]);

    $archive_link = get_post_type_archive_link('company');
    $map_link = '';
    if (!empty($location_address)) {
        $validated = function_exists('wp_http_validate_url') ? wp_http_validate_url($location_address) : '';
        $map_link = $validated ? $validated : '';
    }

    $phones_list = [];
    if (!empty($phones)) {
        $phones_list = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $phones))));
    }
    $addresses_list = [];
    if (!empty($addresses)) {
        $addresses_list = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $addresses))));
    }
    ?>

    <div class="container mx-auto px-4 mt-6 lg:mt-10">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-6 shadow-sm">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden shrink-0 flex items-center justify-center">
                        <?php if ($logo) : ?>
                            <img src="<?php echo esc_url($logo); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover">
                        <?php else : ?>
                            <i data-lucide="building" width="22" class="text-slate-400"></i>
                        <?php endif; ?>
                    </div>
                    <div>
                        <h1 class="text-xl md:text-2xl font-black text-slate-900 dark:text-slate-100"><?php the_title(); ?></h1>
                        <div class="mt-2 flex items-center gap-2 flex-wrap">
                            <?php if (!is_wp_error($activity_terms) && !empty($activity_terms)) : ?>
                                <?php foreach (array_slice($activity_terms, 0, 3) as $t) : ?>
                                    <a href="<?php echo esc_url(get_term_link($t)); ?>" class="text-[10px] font-bold text-primary bg-primary/10 px-2 py-0.5 rounded-md hover:opacity-90 transition-opacity">
                                        <?php echo esc_html($t->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <span class="text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 dark:text-slate-300 px-2 py-0.5 rounded-md">بدون موضوع</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <form method="get" action="<?php echo esc_url($archive_link); ?>" class="w-full lg:w-auto">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-2 bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl px-3 py-2">
                                <i data-lucide="search" width="18" class="text-slate-400"></i>
                                <input type="text" name="q" value="" class="w-full bg-transparent outline-none text-sm text-slate-700 dark:text-slate-200 placeholder:text-slate-400" placeholder="جستجوی شرکت‌ها">
                            </div>
                        </div>
                        <div>
                            <select name="activity" class="w-full bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-700 dark:text-slate-200">
                                <option value="0">همه موضوع‌ها</option>
                                <?php if (!is_wp_error($all_activities) && !empty($all_activities)) : ?>
                                    <?php foreach ($all_activities as $t) : ?>
                                        <option value="<?php echo esc_attr($t->term_id); ?>" <?php selected((int) $t->term_id, (int) $primary_activity_id); ?>>
                                            <?php echo esc_html($t->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center gap-3">
                        <button type="submit" class="h-10 px-4 rounded-xl bg-primary text-white font-bold text-sm hover:opacity-90 transition-opacity inline-flex items-center justify-center gap-2">
                            <i data-lucide="filter" width="16"></i>
                            جستجو
                        </button>
                        <a href="<?php echo esc_url($archive_link); ?>" class="h-10 px-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 font-bold text-sm hover:border-primary hover:text-primary transition-colors inline-flex items-center justify-center">
                            آرشیو شرکت‌ها
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
            <aside class="lg:col-span-3">
                <div class="sticky top-24 space-y-4 transition-transform duration-300 will-change-transform">
                    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow-sm">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-9 h-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                                <i data-lucide="layout-list" width="18"></i>
                            </span>
                            <h2 class="text-sm font-black text-slate-900 dark:text-slate-100">منوی اطلاعات</h2>
                        </div>
                        <div class="space-y-2">
                            <button type="button" data-scroll-to="company-basic" class="group w-full flex items-center justify-between px-3 py-2 rounded-xl border border-transparent hover:bg-rose-50 hover:text-rose-700 hover:border-rose-200 dark:hover:bg-rose-900/20 dark:hover:text-rose-200 dark:hover:border-rose-900/30 text-sm font-bold text-slate-700 dark:text-slate-200 transition-colors">
                                <span class="inline-flex items-center gap-2 text-right">
                                    <i data-lucide="badge-info" width="16" class="text-slate-400 group-hover:text-rose-600 dark:group-hover:text-rose-200"></i>
                                    اطلاعات پایه
                                </span>
                                <i data-lucide="chevron-left" width="16" class="text-slate-400 group-hover:text-rose-600 dark:group-hover:text-rose-200"></i>
                            </button>
                            <button type="button" data-scroll-to="company-intro" class="group w-full flex items-center justify-between px-3 py-2 rounded-xl border border-transparent hover:bg-rose-50 hover:text-rose-700 hover:border-rose-200 dark:hover:bg-rose-900/20 dark:hover:text-rose-200 dark:hover:border-rose-900/30 text-sm font-bold text-slate-700 dark:text-slate-200 transition-colors">
                                <span class="inline-flex items-center gap-2 text-right">
                                    <i data-lucide="sparkles" width="16" class="text-slate-400 group-hover:text-rose-600 dark:group-hover:text-rose-200"></i>
                                    معرفی
                                </span>
                                <i data-lucide="chevron-left" width="16" class="text-slate-400 group-hover:text-rose-600 dark:group-hover:text-rose-200"></i>
                            </button>
                            <button type="button" data-scroll-to="company-description" class="group w-full flex items-center justify-between px-3 py-2 rounded-xl border border-transparent hover:bg-rose-50 hover:text-rose-700 hover:border-rose-200 dark:hover:bg-rose-900/20 dark:hover:text-rose-200 dark:hover:border-rose-900/30 text-sm font-bold text-slate-700 dark:text-slate-200 transition-colors">
                                <span class="inline-flex items-center gap-2 text-right">
                                    <i data-lucide="file-text" width="16" class="text-slate-400 group-hover:text-rose-600 dark:group-hover:text-rose-200"></i>
                                    توضیحات
                                </span>
                                <i data-lucide="chevron-left" width="16" class="text-slate-400 group-hover:text-rose-600 dark:group-hover:text-rose-200"></i>
                            </button>
                            <button type="button" data-scroll-to="company-products" class="group w-full flex items-center justify-between px-3 py-2 rounded-xl border border-transparent hover:bg-rose-50 hover:text-rose-700 hover:border-rose-200 dark:hover:bg-rose-900/20 dark:hover:text-rose-200 dark:hover:border-rose-900/30 text-sm font-bold text-slate-700 dark:text-slate-200 transition-colors">
                                <span class="inline-flex items-center gap-2 text-right">
                                    <i data-lucide="package" width="16" class="text-slate-400 group-hover:text-rose-600 dark:group-hover:text-rose-200"></i>
                                    محصولات
                                </span>
                                <i data-lucide="chevron-left" width="16" class="text-slate-400 group-hover:text-rose-600 dark:group-hover:text-rose-200"></i>
                            </button>
                            <button type="button" data-scroll-to="company-posts" class="group w-full flex items-center justify-between px-3 py-2 rounded-xl border border-transparent hover:bg-rose-50 hover:text-rose-700 hover:border-rose-200 dark:hover:bg-rose-900/20 dark:hover:text-rose-200 dark:hover:border-rose-900/30 text-sm font-bold text-slate-700 dark:text-slate-200 transition-colors">
                                <span class="inline-flex items-center gap-2 text-right">
                                    <i data-lucide="newspaper" width="16" class="text-slate-400 group-hover:text-rose-600 dark:group-hover:text-rose-200"></i>
                                    مطالب منتشر شده
                                </span>
                                <i data-lucide="chevron-left" width="16" class="text-slate-400 group-hover:text-rose-600 dark:group-hover:text-rose-200"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </aside>

            <main class="lg:col-span-9 space-y-6">
                <section id="company-basic" class="scroll-mt-28 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 dark:bg-rose-900/20 dark:text-rose-200 flex items-center justify-center">
                                <i data-lucide="badge-info" width="18"></i>
                            </span>
                            <h2 class="text-lg font-extrabold text-slate-900 dark:text-slate-100">اطلاعات پایه</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="border border-slate-200 dark:border-slate-800 rounded-2xl p-4">
                            <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                                <i data-lucide="layers" width="14"></i>
                                موضوع فعالیت
                            </div>
                            <div class="mt-2 flex items-center gap-2 flex-wrap">
                                <?php if (!is_wp_error($activity_terms) && !empty($activity_terms)) : ?>
                                    <?php foreach ($activity_terms as $t) : ?>
                                        <a href="<?php echo esc_url(get_term_link($t)); ?>" class="text-xs font-bold text-rose-700 bg-rose-50 dark:bg-rose-900/20 dark:text-rose-200 px-3 py-1 rounded-xl hover:opacity-90 transition-opacity">
                                            <?php echo esc_html($t->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <span class="text-xs text-slate-500 dark:text-slate-300">ثبت نشده</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="border border-slate-200 dark:border-slate-800 rounded-2xl p-4">
                            <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                                <i data-lucide="globe" width="14"></i>
                                وب‌سایت
                            </div>
                            <div class="mt-2 text-sm font-bold text-slate-800 dark:text-slate-100">
                                <?php if (!empty($website)) : ?>
                                    <a href="<?php echo esc_url($website); ?>" class="hover:text-rose-600 dark:hover:text-rose-200 transition-colors ltr" target="_blank" rel="noopener">
                                        <?php echo esc_html(preg_replace('#^https?://#', '', $website)); ?>
                                    </a>
                                <?php else : ?>
                                    <span class="text-slate-400">ثبت نشده</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="border border-slate-200 dark:border-slate-800 rounded-2xl p-4">
                            <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                                <i data-lucide="mail" width="14"></i>
                                ایمیل
                            </div>
                            <div class="mt-2 text-sm font-bold text-slate-800 dark:text-slate-100">
                                <?php if (!empty($email)) : ?>
                                    <a href="mailto:<?php echo esc_attr($email); ?>" class="hover:text-rose-600 dark:hover:text-rose-200 transition-colors ltr">
                                        <?php echo esc_html($email); ?>
                                    </a>
                                <?php else : ?>
                                    <span class="text-slate-400">ثبت نشده</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="border border-slate-200 dark:border-slate-800 rounded-2xl p-4">
                            <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                                <i data-lucide="phone" width="14"></i>
                                تلفن
                            </div>
                            <div class="mt-2 space-y-1">
                                <?php if (!empty($phones_list)) : ?>
                                    <?php foreach ($phones_list as $p) : ?>
                                        <div class="text-sm font-bold text-slate-800 dark:text-slate-100 ltr"><?php echo esc_html($p); ?></div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div class="text-sm text-slate-400">ثبت نشده</div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="border border-slate-200 dark:border-slate-800 rounded-2xl p-4">
                            <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                                <i data-lucide="share-2" width="14"></i>
                                شبکه‌های اجتماعی
                            </div>
                            <div class="mt-3 flex items-center gap-2 flex-wrap">
                                <?php if (!empty($social_instagram)) : ?>
                                    <a href="<?php echo esc_url($social_instagram); ?>" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-200 hover:border-rose-200 hover:text-rose-700 dark:hover:border-rose-900/30 dark:hover:text-rose-200 transition-colors flex items-center gap-2">
                                        <i data-lucide="instagram" width="14"></i>اینستاگرام
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($social_telegram)) : ?>
                                    <a href="<?php echo esc_url($social_telegram); ?>" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-200 hover:border-rose-200 hover:text-rose-700 dark:hover:border-rose-900/30 dark:hover:text-rose-200 transition-colors flex items-center gap-2">
                                        <i data-lucide="send" width="14"></i>تلگرام
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($social_linkedin)) : ?>
                                    <a href="<?php echo esc_url($social_linkedin); ?>" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-200 hover:border-rose-200 hover:text-rose-700 dark:hover:border-rose-900/30 dark:hover:text-rose-200 transition-colors flex items-center gap-2">
                                        <i data-lucide="linkedin" width="14"></i>لینکدین
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($social_x)) : ?>
                                    <a href="<?php echo esc_url($social_x); ?>" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-200 hover:border-rose-200 hover:text-rose-700 dark:hover:border-rose-900/30 dark:hover:text-rose-200 transition-colors flex items-center gap-2">
                                        <i data-lucide="twitter" width="14"></i>X
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($social_whatsapp)) : ?>
                                    <a href="<?php echo esc_url($social_whatsapp); ?>" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-200 hover:border-rose-200 hover:text-rose-700 dark:hover:border-rose-900/30 dark:hover:text-rose-200 transition-colors flex items-center gap-2">
                                        <i data-lucide="message-circle" width="14"></i>واتساپ
                                    </a>
                                <?php endif; ?>
                                <?php if (empty($social_instagram) && empty($social_telegram) && empty($social_linkedin) && empty($social_x) && empty($social_whatsapp)) : ?>
                                    <div class="text-sm text-slate-400">ثبت نشده</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    $address_display = '';
                    if (!empty($addresses_list)) {
                        $address_display = implode('، ', $addresses_list);
                    }
                    $map_link = '';
                    if (!empty($location_address)) {
                        $validated = function_exists('wp_http_validate_url') ? wp_http_validate_url($location_address) : '';
                        $map_link = $validated ? $validated : '';
                    }
                    ?>

                    <div class="mt-4 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden">
                        <div class="flex flex-col md:flex-row md:items-stretch">
                            <div class="flex-1 p-4 md:p-5">
                                <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                                    <i data-lucide="map-pin" width="14"></i>
                                    نشانی ثبت شده برای شرکت
                                </div>
                                <div class="mt-2 text-sm text-slate-700 dark:text-slate-200 leading-relaxed text-justify">
                                    <?php if ($address_display !== '') : ?>
                                        <?php echo esc_html($address_display); ?>
                                    <?php else : ?>
                                        <span class="text-slate-400">ثبت نشده</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="w-full md:w-[260px] p-4 md:p-0 md:border-r md:border-slate-200 md:dark:border-slate-800">
                                <?php if (!empty($map_link)) : ?>
                                    <a href="<?php echo esc_url($map_link); ?>" target="_blank" rel="noopener" class="block h-32 md:h-full bg-cover bg-center rounded-xl md:rounded-none overflow-hidden" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/map.png'); ?>');">
                                        <div class="w-full h-full bg-black/0 hover:bg-black/5 transition-colors flex items-center justify-center">
                                            <span class="w-10 h-10 rounded-2xl bg-white/90 text-rose-600 flex items-center justify-center shadow-sm">
                                                <i data-lucide="map" width="18"></i>
                                            </span>
                                        </div>
                                    </a>
                                <?php else : ?>
                                    <div class="h-32 md:h-full bg-cover bg-center rounded-xl md:rounded-none overflow-hidden opacity-60" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/map.png'); ?>');"></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="company-intro" class="scroll-mt-28 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-9 h-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                            <i data-lucide="sparkles" width="18"></i>
                        </span>
                        <h2 class="text-lg font-extrabold text-slate-900 dark:text-slate-100">معرفی</h2>
                    </div>
                    <?php if (trim($intro) !== '') : ?>
                        <div class="prose max-w-none prose-slate dark:prose-invert text-slate-700 dark:text-slate-200 text-justify leading-8 prose-p:leading-8 prose-li:leading-8">
                            <?php echo wp_kses_post($intro); ?>
                        </div>
                    <?php else : ?>
                        <div class="text-sm text-slate-400">موردی ثبت نشده است.</div>
                    <?php endif; ?>
                </section>

                <section id="company-description" class="scroll-mt-28 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-9 h-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                            <i data-lucide="file-text" width="18"></i>
                        </span>
                        <h2 class="text-lg font-extrabold text-slate-900 dark:text-slate-100">توضیحات</h2>
                    </div>
                    <?php if (trim($description) !== '') : ?>
                        <div class="prose max-w-none prose-slate dark:prose-invert text-slate-700 dark:text-slate-200 text-justify leading-8 prose-p:leading-8 prose-li:leading-8">
                            <?php echo wp_kses_post($description); ?>
                        </div>
                    <?php else : ?>
                        <div class="text-sm text-slate-400">موردی ثبت نشده است.</div>
                    <?php endif; ?>
                </section>

                <section id="company-products" class="scroll-mt-28 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-9 h-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                            <i data-lucide="package" width="18"></i>
                        </span>
                        <h2 class="text-lg font-extrabold text-slate-900 dark:text-slate-100">محصولات</h2>
                    </div>
                    <?php if (trim($products) !== '') : ?>
                        <div class="max-w-none text-justify leading-8 [&_p]:text-slate-700 dark:[&_p]:text-slate-200 [&_p]:leading-8 [&_p]:mb-4 [&_h1]:text-xl [&_h1]:font-extrabold [&_h1]:mt-6 [&_h1]:mb-3 [&_h2]:text-lg [&_h2]:font-extrabold [&_h2]:mt-6 [&_h2]:mb-3 [&_h3]:text-base [&_h3]:font-bold [&_h3]:mt-5 [&_h3]:mb-2 [&_strong]:font-bold [&_b]:font-bold [&_a]:text-rose-700 dark:[&_a]:text-rose-200 [&_a]:underline-offset-2 hover:[&_a]:underline [&_ul]:list-disc [&_ul]:pr-6 [&_ol]:list-decimal [&_ol]:pr-6 [&_li]:my-1">
                            <?php echo wp_kses_post($products); ?>
                        </div>
                    <?php else : ?>
                        <div class="text-sm text-slate-400">موردی ثبت نشده است.</div>
                    <?php endif; ?>
                </section>

                <section id="company-posts" class="scroll-mt-28 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 dark:bg-rose-900/20 dark:text-rose-200 flex items-center justify-center">
                            <i data-lucide="newspaper" width="18"></i>
                        </span>
                        <h2 class="text-lg font-extrabold text-slate-900 dark:text-slate-100">مطالب منتشر شده از شرکت</h2>
                    </div>
                    <?php
                    $company_posts = new WP_Query([
                        'post_type'      => 'post',
                        'post_status'    => 'publish',

                        'orderby'        => 'date',
                        'order'          => 'DESC',
                        'ignore_sticky_posts' => true,
                        'no_found_rows'  => true,
                        'meta_query'     => [
                            'relation' => 'AND',
                            [
                                'key'     => '_news_content_type',
                                'value'   => 'company',
                                'compare' => '=',
                            ],
                            [
                                'key'     => '_news_related_company_id',
                                'value'   => $company_id,
                                'compare' => '=',
                                'type'    => 'NUMERIC',
                            ],
                        ],
                    ]);
                    ?>

                    <?php if ($company_posts->have_posts()) : ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?php while ($company_posts->have_posts()) : $company_posts->the_post(); ?>
                                <?php
                                $p_id = get_the_ID();
                                
                                // Extra safety check to prevent "leaking" posts
                                $current_p_type = get_post_meta($p_id, '_news_content_type', true);
                                $current_p_company = get_post_meta($p_id, '_news_related_company_id', true);
                                
                                if ($current_p_type !== 'company' || (int)$current_p_company !== (int)$company_id) {
                                    continue;
                                }

                                $thumb = get_the_post_thumbnail_url($p_id, 'hasht-small-rect');
                                $time_diff = function_exists('hasht_time_ago') ? hasht_time_ago($p_id) : '';
                                ?>
                                <article class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 flex gap-4 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30 transition-all">
                                    <a href="<?php the_permalink(); ?>" class="w-28 h-20 rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 shrink-0 block">
                                        <?php if ($thumb) : ?>
                                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover">
                                        <?php endif; ?>
                                    </a>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 text-[11px] text-slate-400 mb-2">
                                            <?php if ($time_diff) : ?>
                                                <span class="inline-flex items-center gap-1">
                                                    <i data-lucide="clock" width="12"></i>
                                                    <?php echo esc_html($time_diff); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <h3 class="text-sm md:text-base font-bold text-slate-900 dark:text-slate-100 leading-relaxed line-clamp-2">
                                            <a href="<?php the_permalink(); ?>" class="hover:text-rose-600 dark:hover:text-rose-200 transition-colors"><?php the_title(); ?></a>
                                        </h3>
                                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400 leading-relaxed line-clamp-2">
                                            <?php echo esc_html(get_the_excerpt()); ?>
                                        </p>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                        <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                        <div class="text-sm text-slate-500 dark:text-slate-300 bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-2xl p-4">
                            مطلبی برای این شرکت ثبت نشده است.
                        </div>
                    <?php endif; ?>
                </section>
            </main>
        </div>
    </div>

    <?php
    core_end_section();
    core_view('layout/base');
    return;
}

// 1. Fetch Metadata
$content_type = get_post_meta($post_id, '_news_content_type', true);
if (empty($content_type)) $content_type = 'standard';

// Author / Interviewee
$custom_author_name = get_post_meta($post_id, '_news_author_name', true);
$custom_author_role = get_post_meta($post_id, '_news_author_position', true);

$interviewee_name = get_post_meta($post_id, '_news_interviewee_name', true);
$interviewee_role = get_post_meta($post_id, '_news_interviewee_position', true);

// Source
$source_name = get_post_meta($post_id, '_news_source_name', true);
$source_link = get_post_meta($post_id, '_news_source_link', true);

// Video Fields
$video_duration = get_post_meta($post_id, '_news_video_duration', true);
$video_source_type = get_post_meta($post_id, '_news_video_source_type', true);
$video_hq = get_post_meta($post_id, '_news_video_hq_link', true);
$video_lq = get_post_meta($post_id, '_news_video_lq_link', true);
$video_embed = get_post_meta($post_id, '_news_video_embed_code', true);

// Photo Report Fields
$photographer_name = get_post_meta($post_id, '_news_photographer_name', true);
$gallery_images = get_post_meta($post_id, '_news_gallery_images', true);

// Publication Fields
$pub_type = get_post_meta($post_id, '_news_publication_type', true);
$pub_file_id = get_post_meta($post_id, '_news_publication_file_id', true);
$pub_file_url = '';
if ($pub_file_id) {
    $pub_file_url = wp_get_attachment_url($pub_file_id);
}

// Author Box Logic (Always WP Author)
$author_id = get_post_field('post_author', $post_id);
$box_display_name = get_the_author_meta('display_name', $author_id);
if (empty($box_display_name)) {
    $box_display_name = get_the_author_meta('user_login', $author_id);
}
$box_avatar = get_avatar($author_id, 64, '', 'Author', ['class' => 'w-full h-full object-cover']);
$box_link = get_author_posts_url($author_id);
$box_description = get_the_author_meta('description', $author_id);

// Header Logic: Note > Interview > Standard
if ($content_type === 'note' && !empty($custom_author_name)) {
    $display_name = $custom_author_name;
    $display_role = $custom_author_role;
} elseif ($content_type === 'interview' && !empty($interviewee_name)) {
    $display_name = $interviewee_name;
    $display_role = $interviewee_role;
} elseif ($content_type === 'photo_report' && !empty($photographer_name)) {
    $display_name = $photographer_name;
    $display_role = 'عکاس';
} else {
    // For Standard/Video/Photo/Publication: Show WP Author in Header too
    $display_name = $box_display_name;
    $display_role = ''; 
}

// Image
$thumb_url = get_the_post_thumbnail_url($post_id, 'full');
$rotiter = get_post_meta($post_id, '_news_rotiter', true);
$share_url = rawurlencode(get_permalink($post_id));
$share_title = rawurlencode(get_the_title($post_id));
$share_text = rawurlencode(get_the_title($post_id) . ' - ' . get_permalink($post_id));
?>
<!-- Print Header (Visible only in print) -->
    <div class="hidden print:flex flex-col items-center mb-8 pt-8">
        <img src="logona (1) copy.webp" alt="نماد اقتصاد" class="h-20 w-auto object-contain mb-4 grayscale" />
        <div class="flex items-center justify-between w-full text-xs text-black font-bold mb-2">
            <span>تاریخ انتشار: <?php echo get_the_date('j F Y'); ?></span>
            <span><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></span>
        </div>
        <div class="w-full h-px bg-black mb-4"></div>
    </div>

    <!-- Header Container -->
    

    
        <div class="container mx-auto px-4 mt-6 lg:mt-10">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 print:block">

                <!-- Main Content (Columns 1-9) -->
                <article class="lg:col-span-9 print:w-full">

                    <!-- Breadcrumb + Tools -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 print:hidden">
                        <!-- Breadcrumb Links -->
                        <nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-text-light order-1">
                            <a href="<?php echo home_url('/'); ?>" class="hover:text-primary transition-colors">خانه</a>
                            <i data-lucide="chevron-left" width="14"></i>
                            <?php 
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="hover:text-primary transition-colors">' . esc_html($categories[0]->name) . '</a>';
                                } else {
                                    echo '<a href="#" class="hover:text-primary transition-colors">اخبار</a>';
                                }
                            ?>
                        </nav>

                        <!-- Tools (Print, Share) - Hidden in Print -->
                        <div class="flex items-center gap-3 order-2 md:order-2 md:justify-end">
                            <button id="scroll-to-comments" class="flex items-center justify-center w-10 h-10 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-500 dark:text-slate-400 hover:bg-white hover:border-primary hover:text-primary dark:hover:bg-slate-900 dark:hover:border-primary dark:hover:text-primary transition-all duration-300" title="دیدگاه‌ها">
                                <i data-lucide="message-square" width="18"></i>
                            </button>
                            <button id="scroll-to-shortlink" class="flex items-center justify-center w-10 h-10 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-500 dark:text-slate-400 hover:bg-white hover:border-primary hover:text-primary dark:hover:bg-slate-900 dark:hover:border-primary dark:hover:text-primary transition-all duration-300" title="لینک کوتاه">
                                <i data-lucide="link" width="18"></i>
                            </button>
                            <button onclick="window.print()" class="flex items-center justify-center w-10 h-10 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-500 dark:text-slate-400 hover:bg-white hover:border-primary hover:text-primary dark:hover:bg-slate-900 dark:hover:border-primary dark:hover:text-primary transition-all duration-300" title="پرینت">
                                <i data-lucide="printer" width="18"></i>
                            </button>
                            <div class="h-6 w-px bg-slate-200 dark:bg-slate-700 mx-1"></div>
                            <a href="<?php echo esc_url('https://t.me/share/url?url=' . $share_url . '&text=' . $share_title); ?>" class="flex items-center justify-center w-10 h-10 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-500 dark:text-slate-400 hover:bg-white hover:border-primary hover:text-primary dark:hover:bg-slate-900 dark:hover:border-primary dark:hover:text-primary transition-all duration-300" title="تلگرام" target="_blank" rel="noopener noreferrer">
                                <i data-lucide="send" width="18"></i>
                            </a>
                            <a href="<?php echo esc_url('https://twitter.com/intent/tweet?url=' . $share_url . '&text=' . $share_title); ?>" class="flex items-center justify-center w-10 h-10 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-500 dark:text-slate-400 hover:bg-white hover:border-primary hover:text-primary dark:hover:bg-slate-900 dark:hover:border-primary dark:hover:text-primary transition-all duration-300" title="توییتر" target="_blank" rel="noopener noreferrer">
                                <i data-lucide="twitter" width="18"></i>
                            </a>
                            <a href="<?php echo esc_url('https://wa.me/?text=' . $share_text); ?>" class="flex items-center justify-center w-10 h-10 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-500 dark:text-slate-400 hover:bg-white hover:border-primary hover:text-primary dark:hover:bg-slate-900 dark:hover:border-primary dark:hover:text-primary transition-all duration-300" title="واتساپ" target="_blank" rel="noopener noreferrer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                    <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Article Header -->
                    <header class="mb-8">
                        <!-- Category Badge Removed -->

                        <?php if (!(has_post_thumbnail() && $content_type !== 'note' && $content_type !== 'interview' && $content_type !== 'video' && $content_type !== 'photo_report' && $content_type !== 'publication')): ?>
                            <?php if (!empty($rotiter)) : ?>
                                <span class="text-[11px] font-light text-secondary block mb-2"><?php echo esc_html($rotiter); ?></span>
                            <?php endif; ?>
                            <h1 class="text-2xl md:text-4xl lg:text-4xl font-medium text-slate-900 dark:text-white leading-[2] mb-4" style="line-height: 150%;">
                                <?php the_title(); ?>
                            </h1>
                            <div class="flex flex-wrap items-center gap-6 border-b border-slate-100 dark:border-slate-800 pb-6 mb-6 print:border-black">
                                <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-text-light print:text-black">
                                    <?php if ($content_type === 'note' || $content_type === 'interview'): ?>
                                        <div class="w-10 h-10 rounded-full overflow-hidden border border-slate-200 dark:border-slate-700 shrink-0">
                                            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($display_name); ?>" class="w-full h-full object-cover">
                                        </div>
                                    <?php else: ?>
                                        <?php if ($content_type === 'photo_report'): ?>
                                            <i data-lucide="camera" width="16" class="text-primary"></i>
                                        <?php else: ?>
                                            <i data-lucide="user" width="16" class="text-primary"></i>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <div class="flex flex-col">
                                        <?php if ($content_type === 'interview'): ?>
                                            <span class="text-[10px] text-slate-400">گفت‌وگو با:</span>
                                        <?php elseif ($content_type === 'photo_report'): ?>
                                            <span class="text-[10px] text-slate-400">عکاس:</span>
                                        <?php elseif ($content_type === 'note'): ?>
                                            <span class="text-[10px] text-slate-400">یادداشت از:</span>
                                        <?php endif; ?>
                                        <span class="font-bold text-text-main dark:text-slate-200 leading-none mt-1"><?php echo esc_html($display_name); ?></span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-1.5 text-xs text-text-light font-bold">
                                    <i data-lucide="calendar" width="14"></i>
                                    <span><?php echo get_the_date('j F Y'); ?></span>
                                </div>

                                <?php if ($content_type === 'video' && !empty($video_duration)): ?>
                                    <div class="flex items-center gap-1.5 text-rose-500 text-xs font-bold">
                                        <i data-lucide="clock" width="14"></i>
                                        <span><?php echo esc_html($video_duration); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (has_post_thumbnail() && $content_type !== 'note' && $content_type !== 'interview' && $content_type !== 'video' && $content_type !== 'photo_report' && $content_type !== 'publication'): ?>
                            <div class="flex flex-col md:flex-row gap-6 md:gap-8 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-4 md:p-6 shadow-sm mb-6">
                                <div class="w-full md:w-5/12 order-2 md:order-2">
                                    <div class="aspect-[4/3] rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 shadow-md">
                                        <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover" loading="lazy" decoding="async">
                                    </div>
                                </div>
                                <div class="w-full md:w-7/12 order-1 md:order-1">
                                    <?php if (!empty($rotiter)) : ?>
                                        <span class="text-[11px] font-light text-secondary block mb-2"><?php echo esc_html($rotiter); ?></span>
                                    <?php endif; ?>
                                    <h1 class="text-xl md:text-4xl lg:text-4xl font-bold text-slate-900 dark:text-white mb-4" style="line-height: 150%;">
                                        <?php the_title(); ?>
                                    </h1>
                                    <div class="flex flex-wrap items-center gap-4 text-xs text-text-light font-bold mb-4">
                                        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-text-light">
                                            <?php if ($content_type === 'note' || $content_type === 'interview'): ?>
                                                <div class="w-10 h-10 rounded-full overflow-hidden border border-slate-200 dark:border-slate-700 shrink-0">
                                                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($display_name); ?>" class="w-full h-full object-cover">
                                                </div>
                                            <?php else: ?>
                                                <?php if ($content_type === 'photo_report'): ?>
                                                    <i data-lucide="camera" width="16" class="text-primary"></i>
                                                <?php else: ?>
                                                    <i data-lucide="user" width="16" class="text-primary"></i>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <div class="flex flex-col">
                                                <?php if ($content_type === 'interview'): ?>
                                                    <span class="text-[10px] text-slate-400">گفت‌وگو با:</span>
                                                <?php elseif ($content_type === 'photo_report'): ?>
                                                    <span class="text-[10px] text-slate-400">عکاس:</span>
                                                <?php elseif ($content_type === 'note'): ?>
                                                    <span class="text-[10px] text-slate-400">یادداشت از:</span>
                                                <?php endif; ?>
                                                <span class="font-bold text-text-main dark:text-slate-200 leading-none mt-1"><?php echo esc_html($display_name); ?></span>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-1.5">
                                            <i data-lucide="calendar" width="14"></i>
                                            <span><?php echo get_the_date('j F Y'); ?></span>
                                        </div>

                                        <?php if ($content_type === 'video' && !empty($video_duration)): ?>
                                            <div class="flex items-center gap-1.5 text-rose-500">
                                                <i data-lucide="clock" width="14"></i>
                                                <span><?php echo esc_html($video_duration); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-base md:text-md font-medium text-slate-600 dark:text-slate-300 leading-[1.5] text-justify">
                                        <?php echo get_the_excerpt(); ?>
                                    </p>
                                </div>
                            </div>
                        <?php else: ?>
                            <p class="text-base md:text-lg font-medium text-slate-600 dark:text-slate-300 leading-[1.5] text-justify mb-8 print:text-black">
                                <?php echo get_the_excerpt(); ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($content_type === 'video'): ?>
                            <!-- Video Player -->
                            <div class="mb-10">
                                <?php if (!empty($video_embed)): ?>
                                    <div class="relative w-full aspect-video rounded-2xl overflow-hidden shadow-lg bg-black">
                                        <?php echo $video_embed; ?>
                                    </div>
                                <?php elseif (!empty($video_hq) || !empty($video_lq)): ?>
                                    <video controls poster="<?php echo esc_url($thumb_url); ?>" class="w-full rounded-2xl shadow-lg bg-black aspect-video">
                                        <?php if (!empty($video_hq)): ?>
                                            <source src="<?php echo esc_url($video_hq); ?>" type="video/mp4">
                                        <?php endif; ?>
                                        <?php if (!empty($video_lq)): ?>
                                            <source src="<?php echo esc_url($video_lq); ?>" type="video/mp4">
                                        <?php endif; ?>
                                        مرورگر شما از پخش ویدئو پشتیبانی نمی‌کند.
                                    </video>
                                <?php endif; ?>

                                <!-- Download Buttons -->
                                <?php if (!empty($video_hq) || !empty($video_lq)): ?>
                                    <div class="flex items-center gap-4 mt-6 p-4 bg-slate-50 rounded-xl border border-slate-200">
                                        <span class="text-sm font-bold text-slate-700 flex items-center gap-2">
                                            <i data-lucide="download" width="16"></i>
                                            دانلود ویدئو:
                                        </span>
                                        <div class="flex gap-2">
                                            <?php if (!empty($video_hq)): ?>
                                                <a href="<?php echo esc_url($video_hq); ?>" download class="px-4 py-2 bg-primary text-white text-xs font-bold rounded-lg hover:bg-rose-700 transition-colors">
                                                    کیفیت بالا
                                                </a>
                                            <?php endif; ?>
                                            <?php if (!empty($video_lq)): ?>
                                                <a href="<?php echo esc_url($video_lq); ?>" download class="px-4 py-2 bg-slate-200 text-slate-700 text-xs font-bold rounded-lg hover:bg-slate-300 transition-colors">
                                                    کیفیت پایین
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php elseif ($content_type === 'photo_report' && !empty($gallery_images)): ?>
                            <!-- Photo Gallery -->
                            <div class="mb-10">
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4" id="gallery-grid">
                                    <?php 
                                    $gallery_ids = explode(',', $gallery_images);
                                    foreach ($gallery_ids as $index => $img_id):
                                        $img_full = wp_get_attachment_image_src($img_id, 'full');
                                        $img_thumb = wp_get_attachment_image_src($img_id, 'hasht-medium');
                                        if ($img_full):
                                    ?>
                                        <a href="<?php echo esc_url($img_full[0]); ?>" class="gallery-item block rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow relative group aspect-[4/3] bg-slate-100" data-index="<?php echo $index; ?>">
                                            <img src="<?php echo esc_url($img_thumb[0] ?? $img_full[0]); ?>" alt="Gallery Image" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                                <i data-lucide="zoom-in" class="text-white" width="24"></i>
                                            </div>
                                        </a>
                                    <?php 
                                        endif;
                                    endforeach; 
                                    ?>
                                </div>
                            </div>
                        <?php elseif ($content_type === 'publication' && !empty($pub_file_url)): ?>
                            <!-- Publication -->
                            <div class="mb-12 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 md:p-8 shadow-sm mt-8">
                                <div class="flex flex-col md:flex-row gap-8 lg:gap-12 items-center md:items-start">
                                    
                                    <!-- Cover Image -->
                                    <div class="w-48 md:w-56 lg:w-64 shrink-0 shadow-2xl rounded-lg overflow-hidden border border-slate-100 dark:border-slate-700 md:-mt-4 md:-ml-4 rotate-0 md:rotate-2 hover:rotate-0 transition-transform duration-500 bg-slate-200">
                                        <div class="aspect-[3/4] relative">
                                             <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover">
                                        </div>
                                    </div>

                                    <!-- Info & Actions -->
                                    <div class="flex-1 w-full text-center md:text-right pt-4">
                                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mb-4">
                                            <span class="px-3 py-1 rounded-full bg-rose-50 dark:bg-rose-900/30 text-primary dark:text-rose-400 text-xs font-bold">
                                                <?php 
                                                    $pub_labels = [
                                                        'weekly' => 'هفته‌نامه',
                                                        'monthly' => 'ماهنامه',
                                                        'quarterly' => 'فصلنامه',
                                                        'yearbook' => 'سالنامه'
                                                    ];
                                                    echo $pub_labels[$pub_type] ?? 'نشریه';
                                                ?>
                                            </span>
                                            <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-xs font-bold">PDF</span>
                                        </div>

                                        <h2 class="text-xl md:text-2xl font-medium text-slate-800 dark:text-slate-100 mb-4 leading-tight">
                                            دانلود نسخه دیجیتال <?php the_title(); ?>
                                        </h2>
                                        
                                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-7 mb-8 text-justify">
                                            برای مشاهده متن کامل این شماره، می‌توانید نسخه الکترونیکی (PDF) را دریافت کنید. این فایل شامل تمام صفحات، تصاویر و گزارش‌های اختصاصی می‌باشد.
                                        </p>

                                        <div class="flex flex-col sm:flex-row items-center gap-4">
                                            <a href="<?php echo esc_url($pub_file_url); ?>" target="_blank" class="w-full sm:w-auto px-8 py-3.5 bg-primary text-white text-sm font-bold rounded-xl hover:bg-rose-700 transition-all flex items-center justify-center gap-2 shadow-lg shadow-rose-200 dark:shadow-none hover:-translate-y-1">
                                                <i data-lucide="download" width="20"></i>
                                                دانلود فایل کامل
                                            </a>
                                            <div class="text-xs text-slate-400 font-medium flex items-center gap-1">
                                                <i data-lucide="file-check" width="14"></i>
                                                <span>نسخه نهایی و تایید شده</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endif; ?>
                    </header>

                    <!-- Article Body -->
                    <div class="single-content print:text-black">
                        <?php the_content(); ?>
                        
                        <?php if (!empty($source_name)): ?>
                            <div class="mt-8 pt-4 border-t border-slate-100 dark:border-slate-800 text-sm text-slate-500 dark:text-slate-400">
                                <strong>منبع:</strong> 
                                <?php if (!empty($source_link)): ?>
                                    <a href="<?php echo esc_url($source_link); ?>" target="_blank" rel="nofollow noopener" class="text-primary hover:underline">
                                        <?php echo esc_html($source_name); ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo esc_html($source_name); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php
                        $related_company_id = 0;
                        if ($content_type === 'company') {
                            $related_company_id = absint(get_post_meta($post_id, '_news_related_company_id', true));
                            $related_post = $related_company_id ? get_post($related_company_id) : null;
                            if (!$related_post || $related_post->post_type !== 'company') {
                                $related_company_id = 0;
                            }
                        }
                        ?>

                        <?php if ($related_company_id) : ?>
                            <?php
                            $company_title = get_the_title($related_company_id);
                            $company_link = get_permalink($related_company_id);
                            $company_logo = get_the_post_thumbnail_url($related_company_id, 'thumbnail');
                            $company_website = get_post_meta($related_company_id, '_company_website', true);
                            $company_intro = (string) get_post_meta($related_company_id, '_company_intro', true);
                            $company_desc = (string) get_post_meta($related_company_id, '_company_description', true);
                            $company_summary_src = $company_intro ?: $company_desc;
                            $company_summary = wp_trim_words(wp_strip_all_tags((string) $company_summary_src), 28, '…');
                            ?>
                            <div class="mt-10 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 md:p-6 shadow-sm">
                                <div class="flex items-start gap-4">
                                    <div class="w-14 h-14 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden shrink-0 flex items-center justify-center">
                                        <?php if ($company_logo) : ?>
                                            <img src="<?php echo esc_url($company_logo); ?>" alt="<?php echo esc_attr($company_title); ?>" class="w-full h-full object-cover">
                                        <?php else : ?>
                                            <i data-lucide="building" width="22" class="text-slate-400"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between gap-3 flex-wrap">
                                            <div class="flex items-center gap-2">
                                                <i data-lucide="building-2" width="18" class="text-rose-600 dark:text-rose-200"></i>
                                                <h3 class="text-base md:text-lg font-extrabold text-slate-900 dark:text-slate-100">
                                                    <?php echo esc_html($company_title); ?>
                                                </h3>
                                            </div>
                                            <a href="<?php echo esc_url($company_link); ?>" class="px-4 h-10 rounded-xl bg-rose-600 text-white text-sm font-bold inline-flex items-center justify-center gap-2 hover:opacity-90 transition-opacity">
                                                مشاهده پروفایل
                                                <i data-lucide="arrow-left" width="16"></i>
                                            </a>
                                        </div>

                                        <?php if (!empty($company_summary)) : ?>
                                            <p class="mt-3 text-sm text-slate-600 dark:text-slate-300 leading-8 text-justify">
                                                <?php echo esc_html($company_summary); ?>
                                            </p>
                                        <?php endif; ?>

                                        <div class="mt-4 flex items-center gap-4 flex-wrap text-xs text-slate-500 dark:text-slate-400">
                                            <?php if (!empty($company_website)) : ?>
                                                <a href="<?php echo esc_url($company_website); ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 hover:text-rose-600 dark:hover:text-rose-200 transition-colors ltr">
                                                    <i data-lucide="globe" width="14"></i>
                                                    <?php echo esc_html(preg_replace('#^https?://#', '', $company_website)); ?>
                                                </a>
                                            <?php endif; ?>
                                            <a href="<?php echo esc_url($company_link); ?>" class="inline-flex items-center gap-2 hover:text-rose-600 dark:hover:text-rose-200 transition-colors">
                                                <i data-lucide="square-user" width="14"></i>
                                                صفحه اختصاصی شرکت
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Tags -->
                    <?php 
                        $tags = get_the_tags(); 
                        if ($tags): 
                    ?>
                    <div class="flex flex-wrap items-center gap-2 mt-10 pt-6 border-t border-slate-100 dark:border-slate-800 print:hidden">
                        <span class="text-sm font-bold text-slate-500 ml-2">برچسب‌ها:</span>
                        <?php foreach($tags as $tag): ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 rounded-lg text-xs text-slate-600 dark:text-slate-300 hover:bg-primary hover:text-white transition-colors">
                                <?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Author & Short Link Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10 print:hidden">
                        <!-- Author Box -->
                        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 flex items-center gap-4 shadow-sm h-full">
                            <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-slate-100 dark:border-slate-700 shrink-0">
                                <?php echo $box_avatar; ?>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-base font-medium text-slate-800 dark:text-slate-100 mb-1"><?php echo esc_html($box_display_name); ?></h4>
                                <?php if (!empty($box_description)): ?>
                                    <p class="text-xs text-slate-500 dark:text-text-light leading-relaxed mb-2 line-clamp-2">
                                        <?php echo esc_html($box_description); ?>
                                    </p>
                                <?php endif; ?>
                                <a href="<?php echo esc_url($box_link); ?>" class="text-primary text-xs font-bold hover:underline">مشاهده دیگر مطالب</a>
                            </div>
                        </div>

                        <!-- Short Link Box -->
                        <div class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 flex flex-col justify-center items-start gap-3 h-full">
                            <div class="flex items-center gap-2 text-slate-500 dark:text-text-light">
                                <i data-lucide="link" width="16"></i>
                                <span class="text-sm font-bold">لینک کوتاه مطلب:</span>
                            </div>
                            <div class="flex items-center gap-2 w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-3 py-2">
                                <span id="short-link-text" class="text-xs font-mono text-slate-600 dark:text-slate-300 dir-ltr select-all truncate"><?php echo wp_get_shortlink(); ?></span>
                                <button id="copy-link-btn" class="text-text-light hover:text-primary transition-colors shrink-0" title="کپی لینک">
                                    <i data-lucide="copy" width="16"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Toast Notification -->
                    <div id="toast-notification" class="fixed bottom-6 right-6 bg-slate-800 text-white px-4 py-3 rounded-lg shadow-xl transform translate-y-20 opacity-0 transition-all duration-300 z-50 flex items-center gap-2">
                        <i data-lucide="check-circle" class="text-green-400" width="20"></i>
                        <span class="text-sm font-medium">لینک با موفقیت کپی شد!</span>
                    </div>

                    <!-- Related News -->
                    <?php 
                    $show_related = get_theme_mod('hasht_single_related_enable', true);
                    if ($show_related):
                        $related_title = get_theme_mod('hasht_single_related_title', 'اخبار مرتبط');
                        $related_count = get_theme_mod('hasht_single_related_count', 4);
                        $related_query_type = get_theme_mod('hasht_single_related_query', 'category');
                        $related_layout = get_theme_mod('hasht_single_related_layout', 'grid-2');

                        $args = [
                            'post_type' => 'post',
                            'posts_per_page' => $related_count,
                            'post_status' => 'publish',
                            'post__not_in' => [$post_id],
                            'ignore_sticky_posts' => 1,
                            'no_found_rows' => true,
                            'update_post_meta_cache' => true,
                            'update_post_term_cache' => false,
                        ];

                        if ($related_query_type === 'category') {
                            $categories = get_the_category();
                            if ($categories) {
                                $cat_ids = array_column($categories, 'term_id');
                                $args['category__in'] = $cat_ids;
                            }
                        } elseif ($related_query_type === 'tag') {
                            $tags = get_the_tags();
                            if ($tags) {
                                $tag_ids = array_column($tags, 'term_id');
                                $args['tag__in'] = $tag_ids;
                            }
                        } elseif ($related_query_type === 'author') {
                            $args['author'] = get_the_author_meta('ID');
                        } elseif ($related_query_type === 'random') {
                            $args['orderby'] = 'rand';
                        }

                        $related_query = new WP_Query($args);

                        if ($related_query->have_posts()):
                            // Layout Classes
                            $grid_class = 'grid-cols-1 md:grid-cols-2';
                            if ($related_layout === 'grid-3') {
                                $grid_class = 'grid-cols-1 md:grid-cols-3';
                            } elseif ($related_layout === 'list') {
                                $grid_class = 'grid-cols-1';
                            }
                    ?>
                    <section class="mt-12 print:hidden">
                        <!-- Separator -->
                        <div class="w-full h-px bg-slate-200 dark:bg-slate-700 mb-12"></div>

                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-1.5 h-8 flex flex-col  rounded-full overflow-hidden shrink-0">
                                <div class="h-1/3 bg-slate-400"></div>
                                <div class="h-2/3 bg-primary"></div>
                            </div>
                            <h3 class="text-xl font-medium text-slate-800 dark:text-white"><?php echo esc_html($related_title); ?></h3>
                        </div>
                        <div class="grid <?php echo esc_attr($grid_class); ?> gap-6">
                            <?php while ($related_query->have_posts()): $related_query->the_post(); ?>
                                <a href="<?php the_permalink(); ?>" class="group flex items-start gap-4 bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 hover:border-rose-200 dark:hover:border-rose-900/50 transition-all">
                                    <div class="w-24 h-24 rounded-lg overflow-hidden shrink-0">
                                        <?php if (has_post_thumbnail()): ?>
                                            <img src="<?php the_post_thumbnail_url('hasht-small-rect'); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <?php else: ?>
                                            <div class="w-full h-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center">
                                                <i data-lucide="image" class="text-slate-400" width="24"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-bold text-slate-800 dark:text-slate-200 leading-relaxed group-hover:text-primary transition-colors mb-2 line-clamp-2">
                                            <?php the_title(); ?>
                                        </h4>
                                        <div class="flex items-center gap-2 text-xs text-text-light">
                                            <i data-lucide="clock" width="12"></i>
                                            <span><?php echo hasht_time_ago(get_the_ID()); ?></span>
                                        </div>
                                    </div>
                                </a>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </section>
                    <?php endif; endif; ?>

                    <!-- Comments Section -->
                    <?php 
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>

                </article>

                <!-- Sidebar Area (Columns 10-12) -->
                <aside class="lg:col-span-3 print:hidden sticky top-4 h-fit">
                    <?php core_view('partials/sidebar'); ?>
                </aside>

            </div>
        </div>
    

    <!-- Footer Container -->
    

    <!-- Scripts -->
<?php core_end_section(); ?>

<?php core_view('layout/base'); ?>
