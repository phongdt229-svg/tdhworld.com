<?php
/*
 Template Name: Landing Quà Tết
 */

/* ------------------------------------------------------------------
 * Cấu hình nhanh — chỉnh nội dung landing tại đây
 * ------------------------------------------------------------------ */
$tet_year_label = 'Xuân Đinh Mùi 2027';
$tet_date       = '2027-02-06T00:00:00+07:00'; // Mùng 1 Tết Đinh Mùi
$tet_hotline    = '0900 000 000';              // TODO: thay số hotline thật
$tet_zalo       = 'https://zalo.me/0900000000'; // TODO: thay link Zalo thật
$tet_contact    = get_permalink(get_page_by_path('lien-he'));
if (!$tet_contact) {
    $tet_contact = home_url('/lien-he/');
}

// Ảnh lấy từ sản phẩm WooCommerce sẵn có (theo ID sản phẩm)
$tet_img = function ($product_id, $size = 'medium_large') {
    $url = get_the_post_thumbnail_url($product_id, $size);
    return $url ? $url : '';
};

$tet_collections = array(
    array('id' => 'hop-qua',      'icon' => '🎁', 'title' => 'Hộp quà hạt dinh dưỡng', 'desc' => 'Điều, macca rang củi đóng hộp sơn mài sang trọng.', 'img' => 3623),
    array('id' => 'gio-qua',      'icon' => '🧺', 'title' => 'Giỏ quà Tết sum vầy',     'desc' => 'Giỏ mây tre đan với nông sản Việt tuyển chọn.',   'img' => 1617),
    array('id' => 'ca-phe',       'icon' => '☕', 'title' => 'Quà Tết cà phê',          'desc' => 'Cà phê Robusta, Arabica nguyên chất cho người sành.', 'img' => 1618),
    array('id' => 'gao-dac-san',  'icon' => '🌾', 'title' => 'Gạo đặc sản biếu Tết',    'desc' => 'Gạo ST, gạo cẩm — lộc đầy bồ, no đủ quanh năm.',    'img' => 3587),
);

// price: số VND; tier dùng cho bộ lọc theo ngân sách
$tet_gift_sets = array(
    array(
        'name'  => 'Hộp Lộc Xuân',
        'badge' => 'Bán chạy',
        'tier'  => 'duoi-500',
        'price' => 390000,
        'old'   => 450000,
        'img'   => 1617,
        'items' => array('Hạt điều rang muối 250g', 'Hạt macca nứt vỏ 250g', 'Thiệp chúc Tết'),
    ),
    array(
        'name'  => 'Hộp Phát Tài',
        'badge' => '',
        'tier'  => 'duoi-500',
        'price' => 450000,
        'old'   => 0,
        'img'   => 1618,
        'items' => array('Cà phê Robusta rang mộc 500g', 'Hạt điều 200g', 'Túi giấy đỏ in chữ Phúc'),
    ),
    array(
        'name'  => 'Giỏ An Khang',
        'badge' => 'Mới',
        'tier'  => '500-1tr',
        'price' => 790000,
        'old'   => 890000,
        'img'   => 3623,
        'items' => array('Hạt macca 500g', 'Hạt điều 500g', 'Tiêu đen Phú Quốc 200g', 'Giỏ mây tre đan'),
    ),
    array(
        'name'  => 'Hộp Sum Vầy',
        'badge' => '',
        'tier'  => '500-1tr',
        'price' => 950000,
        'old'   => 0,
        'img'   => 3587,
        'items' => array('Gạo ST25 5kg', 'Gạo cẩm 1kg', 'Hạt điều 300g', 'Hộp carton cao cấp'),
    ),
    array(
        'name'  => 'Hộp Phú Quý',
        'badge' => 'Cao cấp',
        'tier'  => 'tren-1tr',
        'price' => 1450000,
        'old'   => 1650000,
        'img'   => 3623,
        'items' => array('Macca Đắk Lắk 500g', 'Điều Bình Phước 500g', 'Cà phê Arabica 500g', 'Tiêu trắng 200g', 'Hộp sơn mài'),
    ),
    array(
        'name'  => 'Rương Vạn Phúc',
        'badge' => 'Biếu sếp',
        'tier'  => 'tren-1tr',
        'price' => 2490000,
        'old'   => 0,
        'img'   => 1618,
        'items' => array('Bộ 3 hạt dinh dưỡng 1,5kg', 'Cà phê đặc sản 1kg', 'Gạo ST25 5kg', 'Tiêu đen & trắng', 'Rương gỗ khắc chữ'),
    ),
);

$tet_tiers = array(
    'all'      => 'Tất cả',
    'duoi-500' => 'Dưới 500K',
    '500-1tr'  => '500K – 1 triệu',
    'tren-1tr' => 'Trên 1 triệu',
);

// Sản phẩm lẻ để khách tự mix quà
$tet_product_ids = array(3623, 1617, 715, 3657, 1618, 3587, 3650, 3645);

$tet_price = function ($amount) {
    return number_format($amount, 0, ',', '.') . '₫';
};

/* ------------------------------------------------------------------
 * Layout: ép full-width, nạp CSS/JS riêng cho landing
 * ------------------------------------------------------------------ */
$GLOBALS['apr_layout'] = 'wide';

$tet_theme_uri = get_template_directory_uri();
$tet_theme_dir = get_template_directory();
wp_enqueue_style('tet-landing-fonts', 'https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Playfair+Display:wght@600;700;800&display=swap&subset=vietnamese', array(), null);
wp_enqueue_style('tet-landing', $tet_theme_uri . '/css/tet-landing.css', array(), filemtime($tet_theme_dir . '/css/tet-landing.css'));
wp_enqueue_script('tet-landing', $tet_theme_uri . '/js/tet-landing.js', array(), filemtime($tet_theme_dir . '/js/tet-landing.js'), true);
add_filter('body_class', function ($classes) {
    $classes[] = 'tet-landing-page';
    return $classes;
});

get_header();
?>
<div class="tet-landing">

    <!-- ============ HERO ============ -->
    <section class="tet-hero">
        <div class="tet-petals" aria-hidden="true"></div>
        <div class="tet-lantern tet-lantern--left" aria-hidden="true"><span>福</span></div>
        <div class="tet-lantern tet-lantern--right" aria-hidden="true"><span>祿</span></div>
        <div class="container">
            <div class="tet-hero__inner">
                <p class="tet-hero__eyebrow"><?php echo esc_html($tet_year_label); ?></p>
                <h1 class="tet-hero__title">Quà Tết Nông Sản Việt<br><span>Trao lộc xuân – Gửi trọn yêu thương</span></h1>
                <p class="tet-hero__lead">Hộp quà hạt dinh dưỡng, cà phê đặc sản và gạo thơm từ những vùng đất trù phú nhất Việt Nam. Gói quà miễn phí, in logo doanh nghiệp, giao toàn quốc trước Tết.</p>
                <div class="tet-hero__actions">
                    <a class="tet-btn tet-btn--gold" href="#tet-gift-sets">Xem hộp quà Tết</a>
                    <a class="tet-btn tet-btn--ghost" href="#tet-corporate">Quà Tết doanh nghiệp</a>
                </div>
                <div class="tet-countdown" data-target="<?php echo esc_attr($tet_date); ?>">
                    <p class="tet-countdown__label">Còn lại đến Giao thừa</p>
                    <div class="tet-countdown__grid">
                        <div><strong data-unit="days">--</strong><span>Ngày</span></div>
                        <div><strong data-unit="hours">--</strong><span>Giờ</span></div>
                        <div><strong data-unit="minutes">--</strong><span>Phút</span></div>
                        <div><strong data-unit="seconds">--</strong><span>Giây</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ ƯU ĐÃI ============ -->
    <section class="tet-perks">
        <div class="container">
            <ul class="tet-perks__list">
                <li><span class="tet-perks__icon">🚚</span><div><strong>Miễn phí giao hàng</strong><small>Đơn từ 500.000₫ nội thành</small></div></li>
                <li><span class="tet-perks__icon">🎀</span><div><strong>Gói quà miễn phí</strong><small>Hộp, túi, thiệp chúc Tết</small></div></li>
                <li><span class="tet-perks__icon">🧧</span><div><strong>Tặng lì xì may mắn</strong><small>Cho mọi đơn hàng Tết</small></div></li>
                <li><span class="tet-perks__icon">🧾</span><div><strong>Xuất hóa đơn VAT</strong><small>Hỗ trợ doanh nghiệp</small></div></li>
            </ul>
        </div>
    </section>

    <!-- ============ BỘ SƯU TẬP ============ -->
    <section class="tet-section tet-collections">
        <div class="container">
            <header class="tet-heading">
                <span class="tet-heading__script">Bộ sưu tập</span>
                <h2>Quà Tết Cho Mọi Tấm Lòng</h2>
                <p>Chọn dòng quà phù hợp để biếu ông bà, cha mẹ, đối tác và người thân yêu.</p>
            </header>
            <div class="tet-collections__grid">
                <?php foreach ($tet_collections as $col) : $img = $tet_img($col['img']); ?>
                    <a class="tet-collection" href="#tet-gift-sets">
                        <div class="tet-collection__media"<?php if ($img) : ?> style="background-image:url('<?php echo esc_url($img); ?>')"<?php endif; ?>>
                            <span class="tet-collection__icon"><?php echo $col['icon']; ?></span>
                        </div>
                        <div class="tet-collection__body">
                            <h3><?php echo esc_html($col['title']); ?></h3>
                            <p><?php echo esc_html($col['desc']); ?></p>
                            <span class="tet-link">Khám phá →</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ HỘP QUÀ TẾT ============ -->
    <section class="tet-section tet-gifts" id="tet-gift-sets">
        <div class="container">
            <header class="tet-heading tet-heading--light">
                <span class="tet-heading__script">Hộp quà Tết <?php echo esc_html(substr($tet_date, 0, 4)); ?></span>
                <h2>Chọn Quà Theo Ngân Sách</h2>
                <p>Mỗi hộp quà đều được đóng gói thủ công, kèm thiệp chúc Tết và lì xì may mắn.</p>
            </header>
            <div class="tet-tabs" role="tablist">
                <?php foreach ($tet_tiers as $key => $label) : ?>
                    <button type="button" class="tet-tab<?php echo $key === 'all' ? ' is-active' : ''; ?>" data-filter="<?php echo esc_attr($key); ?>" role="tab"><?php echo esc_html($label); ?></button>
                <?php endforeach; ?>
            </div>
            <div class="tet-gifts__grid">
                <?php foreach ($tet_gift_sets as $set) : $img = $tet_img($set['img']); ?>
                    <article class="tet-gift" data-tier="<?php echo esc_attr($set['tier']); ?>">
                        <?php if ($set['badge']) : ?><span class="tet-gift__badge"><?php echo esc_html($set['badge']); ?></span><?php endif; ?>
                        <div class="tet-gift__media"<?php if ($img) : ?> style="background-image:url('<?php echo esc_url($img); ?>')"<?php endif; ?>></div>
                        <div class="tet-gift__body">
                            <h3><?php echo esc_html($set['name']); ?></h3>
                            <ul>
                                <?php foreach ($set['items'] as $item) : ?><li><?php echo esc_html($item); ?></li><?php endforeach; ?>
                            </ul>
                            <div class="tet-gift__foot">
                                <div class="tet-gift__price">
                                    <strong><?php echo esc_html($tet_price($set['price'])); ?></strong>
                                    <?php if ($set['old']) : ?><del><?php echo esc_html($tet_price($set['old'])); ?></del><?php endif; ?>
                                </div>
                                <a class="tet-btn tet-btn--red tet-btn--sm" href="<?php echo esc_url($tet_zalo); ?>" target="_blank" rel="noopener">Đặt ngay</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ TỰ MIX QUÀ ============ -->
    <?php
    $tet_products = function_exists('wc_get_products')
        ? wc_get_products(array('include' => $tet_product_ids, 'status' => 'publish', 'limit' => count($tet_product_ids), 'orderby' => 'post__in'))
        : array();
    ?>
    <?php if ($tet_products) : ?>
    <section class="tet-section tet-products">
        <div class="container">
            <header class="tet-heading">
                <span class="tet-heading__script">Tự tay chọn quà</span>
                <h2>Nông Sản Tuyển Chọn Để Mix Hộp Quà</h2>
                <p>Chọn sản phẩm yêu thích, chúng tôi đóng hộp Tết miễn phí theo ý bạn.</p>
            </header>
            <div class="tet-products__grid">
                <?php foreach ($tet_products as $product) : ?>
                    <a class="tet-product" href="<?php echo esc_url($product->get_permalink()); ?>">
                        <div class="tet-product__media">
                            <?php echo $product->get_image('woocommerce_thumbnail'); ?>
                        </div>
                        <h3><?php echo esc_html($product->get_name()); ?></h3>
                        <?php if ($product->get_price_html()) : ?>
                            <div class="tet-product__price"><?php echo wp_kses_post($product->get_price_html()); ?></div>
                        <?php else : ?>
                            <div class="tet-product__price tet-product__price--contact">Liên hệ</div>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ============ QUÀ TẾT DOANH NGHIỆP ============ -->
    <section class="tet-section tet-corporate" id="tet-corporate">
        <div class="container">
            <div class="tet-corporate__inner">
                <div class="tet-corporate__intro">
                    <span class="tet-heading__script">Dành cho doanh nghiệp</span>
                    <h2>Quà Tết Tri Ân Đối Tác &amp; Nhân Viên</h2>
                    <p>Thiết kế hộp quà mang dấu ấn thương hiệu: in logo, thiệp chúc Tết riêng, giao tận nơi từng địa chỉ trên toàn quốc.</p>
                    <ol class="tet-steps">
                        <li><strong>Tư vấn</strong><span>Chọn mẫu quà theo ngân sách và số lượng</span></li>
                        <li><strong>Thiết kế</strong><span>Duyệt mẫu hộp, thiệp in logo trong 48h</span></li>
                        <li><strong>Sản xuất</strong><span>Đóng gói thủ công, kiểm tra từng hộp</span></li>
                        <li><strong>Giao hàng</strong><span>Giao đúng hẹn trước Tết, xuất hóa đơn VAT</span></li>
                    </ol>
                </div>
                <div class="tet-corporate__table">
                    <h3>Chiết khấu theo số lượng</h3>
                    <table>
                        <thead><tr><th>Số lượng</th><th>Ưu đãi</th></tr></thead>
                        <tbody>
                            <tr><td>20 – 49 hộp</td><td><strong>Giảm 5%</strong></td></tr>
                            <tr><td>50 – 99 hộp</td><td><strong>Giảm 8%</strong> + in logo</td></tr>
                            <tr><td>100 – 299 hộp</td><td><strong>Giảm 12%</strong> + thiệp riêng</td></tr>
                            <tr><td>Từ 300 hộp</td><td><strong>Báo giá riêng</strong></td></tr>
                        </tbody>
                    </table>
                    <a class="tet-btn tet-btn--gold" href="#tet-contact">Nhận báo giá</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ CAM KẾT ============ -->
    <section class="tet-section tet-promise">
        <div class="container">
            <header class="tet-heading">
                <span class="tet-heading__script">Vì sao chọn TDH World</span>
                <h2>Trọn Vẹn Chữ Tín Ngày Xuân</h2>
            </header>
            <div class="tet-promise__grid">
                <div class="tet-promise__item"><span>🌱</span><h3>Nguồn gốc rõ ràng</h3><p>Nông sản thu mua trực tiếp từ vùng trồng, có chứng nhận chất lượng.</p></div>
                <div class="tet-promise__item"><span>✨</span><h3>Mới – Sạch – Thơm</h3><p>Rang, đóng gói theo mẻ nhỏ sát Tết để giữ trọn hương vị.</p></div>
                <div class="tet-promise__item"><span>🏮</span><h3>Bao bì đậm chất Tết</h3><p>Hộp đỏ – vàng hoa mai, sang trọng và ý nghĩa khi trao tặng.</p></div>
                <div class="tet-promise__item"><span>🔄</span><h3>Đổi trả dễ dàng</h3><p>Đổi mới 1–1 nếu sản phẩm lỗi hoặc hư hỏng khi vận chuyển.</p></div>
            </div>
        </div>
    </section>

    <!-- ============ HỎI ĐÁP ============ -->
    <section class="tet-section tet-faq">
        <div class="container">
            <header class="tet-heading">
                <span class="tet-heading__script">Hỏi đáp</span>
                <h2>Câu Hỏi Thường Gặp</h2>
            </header>
            <div class="tet-faq__list">
                <details open>
                    <summary>Hạn chót đặt quà Tết để kịp giao là khi nào?</summary>
                    <p>Đơn lẻ nên đặt trước 23 tháng Chạp; đơn doanh nghiệp số lượng lớn nên đặt trước 15 tháng Chạp để kịp thiết kế và in logo.</p>
                </details>
                <details>
                    <summary>Tôi có thể thay đổi sản phẩm trong hộp quà không?</summary>
                    <p>Hoàn toàn được. Bạn có thể đổi món hoặc tự mix hộp quà từ các sản phẩm lẻ, giá tính theo sản phẩm đã chọn.</p>
                </details>
                <details>
                    <summary>Có giao quà tận tay người nhận kèm lời chúc không?</summary>
                    <p>Có. Chúng tôi viết thiệp tay theo lời chúc của bạn và giao trực tiếp đến người nhận trên toàn quốc.</p>
                </details>
                <details>
                    <summary>Hạn sử dụng của các sản phẩm hạt và cà phê?</summary>
                    <p>Hạt dinh dưỡng từ 6–9 tháng, cà phê rang từ 9–12 tháng kể từ ngày đóng gói, in rõ trên bao bì.</p>
                </details>
            </div>
        </div>
    </section>

    <!-- ============ LIÊN HỆ / ĐẶT HÀNG ============ -->
    <section class="tet-section tet-contact" id="tet-contact">
        <div class="container">
            <div class="tet-contact__inner">
                <div class="tet-contact__text">
                    <span class="tet-heading__script">Đặt quà ngay hôm nay</span>
                    <h2>Xuân Sang Lộc Đến – An Khang Thịnh Vượng</h2>
                    <p>Để lại thông tin hoặc gọi hotline, tư vấn viên sẽ liên hệ trong 15 phút.</p>
                    <div class="tet-contact__actions">
                        <a class="tet-btn tet-btn--gold" href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $tet_hotline)); ?>">📞 <?php echo esc_html($tet_hotline); ?></a>
                        <a class="tet-btn tet-btn--ghost" href="<?php echo esc_url($tet_zalo); ?>" target="_blank" rel="noopener">Chat Zalo</a>
                        <a class="tet-btn tet-btn--ghost" href="<?php echo esc_url($tet_contact); ?>">Trang liên hệ</a>
                    </div>
                </div>
                <?php
                // Nội dung soạn trong trình sửa trang (vd: shortcode Contact Form 7) sẽ hiển thị tại đây
                while (have_posts()) : the_post();
                    if (trim(get_the_content()) !== '') : ?>
                        <div class="tet-contact__form"><?php the_content(); ?></div>
                    <?php endif;
                endwhile;
                ?>
            </div>
        </div>
    </section>

</div>
<?php get_footer(); ?>
