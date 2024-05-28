<?php
global $options;
$options = get_option('my_framework');
?>
<footer class="footer_wrap row justify-content-center m-0" style="">
    <div class="col-lg-9 pt-3 px-3 px-lg-0">
        <div class="footer_con">
            <div class="footer_menu_wrap">
                <h3 class="tit">Follow Us</h3>
                <ul class="footer_social_list">
                    <li>
                        <a href="<?php echo $options['fb_link'];?>" target="_blank" class="text-black">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $options['linkedin_link'];?>" target="_blank" class="text-black">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </li>
<!--                    <li>-->
<!--                        <a href="--><?php //echo $options['linkedin_link'];?><!--" target="_blank" class="text-black">-->
<!--                            <i class="fa-brands fa-twitter"></i>-->
<!--                        </a>-->
<!--                    </li>-->
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <?php dynamic_sidebar('footer_widget');?>
                        <?php /*
                        <div class="col-lg-4">
                            <div class="tit_area_wrap">
                                <div class="tit_area">
                                    <h3 class="tit">Join Us</h3>
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                                <ul class="tit_area_menu">
                                    <li>
                                        <a target="_blank" href=""> Careers</a>
                                    </li>
                                    <li>
                                        <a target="_blank" href=""> Recruitment</a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="">Global
                                            Recruitment</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-4 sublist_show">
                            <div class="tit_area_wrap">
                                <div class="tit_area">
                                    <h3 class="tit">Contact Us</h3>
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                                <ul class="tit_area_menu">
                                    <li>
                                        <a target="_blank" href="">Customer
                                            Services</a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="">Partnership</a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="">Procurement</a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="">Media &amp;
                                            Investors</a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="tit_area_wrap">
                                <div class="tit_area">
                                    <h3 class="tit">Legal Information</h3>
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                                <ul class="tit_area_menu">
                                    <li>
                                        <a target="_blank" href="">Service
                                            Agreement</a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="">Privacy
                                            Policy</a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="">Intellectual Property Rights</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <?php */ ?>
                    </div>
                </div>

                <div class="col-lg-4 my-auto text-center">
                    <div class="d-lg-block d-none">
                       <?php /*  <img src="assets/images/mathmozo-logo-square.png"> */ ?>
                        <?php echo $options['footer_right']?>
                    </div>
                </div>
            </div>
            <div class="footer_area py-lg-4">
                <?php
                $footerBottomMenu = load_menu('footer-bottom');
                if($footerBottomMenu):?>
                <ul class="links py-3">
                    <?php
                        foreach($footerBottomMenu as $menu):
                    ?>
                    <li>
                        <a target="" href="<?php echo $menu->url;?>"><?php echo $menu->title;?></a>
                    </li>
                    <?php endforeach;?>
                    <?php /*
                    <li>
                        <a target="" href="">Integrity
                            Policy</a>
                    </li>
                    <li>
                        <a target="" href="">Site Map</a>
                    </li>
                    */ ?>
                </ul>
                <?php endif;?>
                <p class="copyright font-14 text-dark">
                    Copyright © 2022 - <?php echo date('Y');?>. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- ========== END SECONDARY CONTENTS ========== -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- JS Implementing Plugins -->

<script src="<?php echo assets();?>/assets/js/vendor.min.js"></script>

<?php /*
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
*/ ?>
<!-- JS Space -->
<script src="<?php echo assets();?>/assets/js/theme.min.js"></script>

<!-- JS Plugins Init. -->
<script src="<?php echo assets();?>/assets/js/custom.js?"{{rand(0,999)}}></script>

<!--End of Tawk.to Script-->

<?php wp_footer();?>
</body>

</html>