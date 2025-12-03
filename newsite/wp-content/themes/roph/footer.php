    <!-- Footer -->
    <footer id="footer">
        <div class="container">
            <div class="row">
                <?php if (class_exists('lcThemeToolkit') && cs_get_option('social_links_options')): ?>
                <div class="col-md-6 col-sm-12 order-first order-md-2 footer-socials">
                    <?php foreach (cs_get_option('social_links_options') as $social_link): ?>
                    <a target="_blank" href="<?php echo esc_url($social_link['social_url']); ?>"><?php echo esc_html($social_link['social_name']); ?></a>
                    <?php endforeach ?>
                </div>
                <?php endif ?>
                <div class="col-md-6 col-sm-12 copyrights">
                    <p>
                    <?php
                    if (class_exists('lcThemeToolkit')) {
                        echo wp_kses_post(cs_get_option('copyright_text'));
                    } 
                    else {
                        echo esc_html__('&copy; 2019 Roph', 'roph');
                    }
                    ?>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Ends -->
    <a class="scrolltotop">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 104 104" enable-background="new 0 0 104 104" xml:space="preserve">
          <circle class="scrolltotop-circle" fill="none" stroke="#141414" stroke-width="4" stroke-miterlimit="10" cx="52" cy="52" r="50"/>
        </svg>
        <span class="scrolltotop-outline"></span> 
        <i class="ion-ios-arrow-thin-up"></i>
    </a>
    <!-- Custom Cursor -->
    <div class="cursor"></div>
<?php wp_footer(); ?>
</body>
</html>