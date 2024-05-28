<div class="position-relative row justify-content-center m-0">
    <div class="col-lg-9 px-lg-0">

        <div class="row justify-content-lg-between">
                            <div class="col-lg-7 position-relative zi-1 content-space-0 content-space-md-1 my-auto">
                                <div class="mx-auto ms-sm-auto w-100 w-lg-auto">
                                    <!-- Heading -->
                                    <div class="mb-3">
                                        <h1 class="display-5 text-dark fw-300">
                                            <?php echo get_the_title(); ?>
                                        </h1>
                                    </div>
                                    <!-- End Heading -->

                                    <div class="w-lg-85">
                                        <div class="font-17 text-dark-16">
                                            <?php the_excerpt(); ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End Col -->

                            <div class="col-lg-5 xbanner-half-end my-auto text-center text-lg-end py-3 pb-3">
                                <!-- Images -->
                                <div class="d-none d-lg-block bg-img-center h-100 xhome-hero xzi-3">
                                    <img class="img-fluid home-hero my-0 shadow-none zi-3 " src="<?php the_post_thumbnail_url(); ?>" style="">
                                </div>
                                <div class="d-lg-none w-100 mx-auto ms-sm-auto"><!-- Mobile -->
                                    <img class="img-fluid home-hero zi-3" src="<?php the_post_thumbnail_url(); ?>" alt="Image Description">
                                </div>
                                <!-- End Images -->
                            </div>
                            <!-- End Col -->
                        </div>
    </div>

</div>
