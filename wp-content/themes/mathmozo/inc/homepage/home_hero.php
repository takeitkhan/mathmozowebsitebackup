<!-- Hero -->
<div class="position-relative row justify-content-center m-0 mt-4 mt-lg-0">
    <div class="col-lg-9 px-lg-0">
        <div class="js-swiper swiper js-swiper-home-hero">
            <div class="swiper-wrapper">
                <?php
                $slideritems = new WP_Query(array(
                    'post_type' => 'slider',
                    'posts_per_page' => '-1',
                ));
                if ($slideritems->have_posts()) : while ($slideritems->have_posts()) : $slideritems->the_post();
                        $animatetext =  (string) get_field('slider_animation_title');
                        if ($animatetext) {
                            $animatetext =  explode('|',  $animatetext);
                            $animatetext = array_merge([''], $animatetext);
                            $json = [
                                "strings" => $animatetext,
                                "typeSpeed" => 90,
                                "loop" => true,
                                "backSpeed" => 30,
                                "backDelay" => 2500
                            ];
                            $json = json_encode($json);
                        }
                ?>
                        <div class="swiper-slide">
                            <div class="row justify-content-lg-between">
                                <div class="col-lg-7 position-relative zi-1 content-space-0 content-space-md-1 my-auto">
                                    <div class="mx-auto ms-sm-auto w-100 w-lg-auto">
                                        <!-- Heading -->
                                        <div class="mb-3">
                                            <h1 class="display-4 text-dark fw-300">
                                                <?php echo get_the_title(); ?>
                                                <span class="text-blue">
                                                    <span class="js-typedjs" data-hs-typed-options='<?php echo  $json ?? null; ?>'>
                                                    </span>
                                                </span>
                                            </h1>
                                        </div>
                                        <!-- End Heading -->

                                        <div class="w-lg-85">
                                            <div class="font-16 text-dark-16">
                                                <?php the_content(); ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Col -->

                                <div class="col-lg-5 xbanner-half-end my-auto text-center text-lg-end py-3 pb-3">
                                    <!-- Images -->
                                    <div class="d-none d-lg-block bg-img-center h-100 xhome-hero xzi-3" xstyle="background-image: url(assets/images/home-hero.jpg);">
                                        <img class="img-fluid home-hero my-0 shadow-none zi-3 " src="<?php echo apply_filters('jetpack_photon_url', get_the_post_thumbnail_url());  ?>" style="" alt="Image Description">
                                    </div>
                                    <div class="d-lg-none w-100 mx-auto ms-sm-auto"><!-- Mobile -->
                                        <img class="img-fluid home-hero zi-3" src="<?php echo apply_filters('jetpack_photon_url', get_the_post_thumbnail_url());  ?>" alt="Image Description">
                                    </div>
                                    <!-- End Images -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                <?php endwhile;
                endif; ?>
            </div>
        </div><!-- js-swiper  swiper-->
    </div>
    <!-- Pagination -->
    <div class="js-swiper-pagination swiper-pagination d-lg-grid justify-content-lg-end bottom-0 top-lg-25 bottom-lg-50">
    </div>
</div>
<!-- End Hero -->

<!-- Icon Blocks -->
<div class="bg-soft-grey home-hero-icon-block  row justify-content-center m-0 content-space-md-0">
    <div id="scrollToContent" class="col-lg-9  py-lg-3 py-4 px-lg-0">

        <div class="row align-items-md-center col-md-divider">
            <div class="col-md-2 text-center text-md-start text-lg-start">
                <span class="ls-1_5 font-16">
                    <?php echo $options['home_service_items_heading'];?>
                </span>
            </div>
            <!-- End Col -->

            <div class="col-md-10 pt-md-0">
                <div class="ps-lg-0">
                    <div class="row">
                        <?php
//                        $topServices = [
//                            ['name' => 'Web Application Developemnt', 'icon' => 'fa-light fa-browsers fa-2xs'],
//                            ['name' => 'Mobile Application Developemnt', 'icon' => 'fa-light fa-mobile fa-2xs'],
//                            ['name' => 'Ecommerce Development', 'icon' => 'fa-light fa-shopping-cart fa-2xs'],
//                            ['name' => 'IOT System', 'icon' => 'fa-sharp fa-light fa-usb-drive fa-rotate-270 fa-2xs'],
//                            ['name' => 'Server Management', 'icon' => 'fa-light fa-server fa-2xs'],
//                            ['name' => 'Technical Support', 'icon' => 'fa-light fa-face-smiling-hands fa-2xs'],
//                        ];
                        $topServices = $options['home_service_items'];
                        ?>
                        <?php foreach ($topServices as $item) { ?>
                            <div class="col-lg-2 col-6  text-center py-1 py-lg-0  pb-lg-1 home_service_block">
                                <span class="h4 text-secondary">
                                    <i class=" <?php echo $item['home_service_items_icon'];?>"></i>
                                </span>
                                <div class="font-16">
                                    <a href="<?php echo $item['home_service_items_url'];?>" class="text-dark-16">
                                        <?php echo $item['home_service_items_title'];?>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>
            </div>
        </div>

        <?php /*
        <div class="row">
            <?php for($i = 0; $i <3; $i++): ?>
            <div class="col-lg-4 col-md-6 mb-5 mb-md-3">
                <div class="bg-white x-shadow-sm border-grey d-flex home-hero-icon-block-col">
                    <div class="home-hero-icon-block-img-wrap">
                        <img src="assets/images/home-hero-icon-block.jpg" alt="">
                    </div>
                    <div class="home-hero-icon-block-content-wrap py-4 font-15 text-dark">
                        <p>Create a business with Tritiyo, whether you’ve got a fresh idea .</p>
                        <a class="link" href="">Learn about our services <i
                                class="fa-solid fa-chevron-right font-10"></i></a>
                    </div>
                </div>
            </div>
            <?php endfor;?>
            <!-- End Col -->
        </div>
        */ ?>
        <!-- End Row -->
    </div>
</div>
<!-- End Icon Blocks -->