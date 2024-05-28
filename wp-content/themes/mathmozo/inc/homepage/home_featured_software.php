<div class="row justify-content-center m-0 py-4 xcontent-space-0 content-space-md-1">
    <div class="card card-lg shadow-none col-lg-9 px-lg-0">
        <div class="card-body px-0 pt-1 pb-0">
            <div class="row">

                <div class="col-lg-4 mb-3">
                    <h1 class="fw-300 text-center text-lg-start"><?php echo $options['home_softwares_heading'];?></h1>
                </div>

                <?php
                $featuredSoftwares = $options['home_softwares'];
//                var_dump($featuredSoftwares);
                $co = 4;
                $colors = ['green', 'blue', 'blue', 'info', 'success', 'warning', 'info'];
                $i = 0;
               foreach($featuredSoftwares as $item):?>
                    <?php
                    $post = get_post($item);
//                    var_dump($post);
                    $color = $colors[$i];
                    if($i <= 2) : ?>
                        <!-- Template 1 -->
                        <div
                            class="<?php echo $i < 2 ? 'col-lg-4' : 'col-lg-4'?> mb-3">
                            <!-- Card -->
                            <div
                                class="card card-transition bg-soft-<?php echo $color;?> text-dark h-100  overflow-hidden shadow-none">
                                <div class="card-body py-5">
                                    <div
                                        class="<?php echo $i == 0 ? 'w-75' : 'w-75'  ?> pe-2">
                                        <h4
                                            class="card-title font-19  text-<?php echo $color;?>">
                                            <?php echo $post->post_title;?>
                                        </h4>
                                        <p class="card-text">
                                            <?php echo wpautop($post->post_excerpt);?>
                                        </p>
                                        <a class="btn btn-light btn-sm btn-transition link border-<?php echo $color;?>"
                                           href="<?php echo get_permalink($post->ID) ?>">Learn more <i class="fa-solid fa-chevron-right font-9"></i></a>
                                    </div>

                                    <div
                                        class="position-absolute end-0 top-0 <?php echo $i == 0 ? 'w-40 w-lg-25' : 'w-40'  ?> mb-n3 me-n7 xd-none">
                                        <img class="card-img" src="<?php echo get_the_post_thumbnail_url($post->ID)?>">
                                    </div>
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                        <!-- end Template 1 -->
                        <!-- Template 2 -->
                    <?php  else : ?>
                        <div
                            class="col-lg-4 mb-3  <?php echo ($co % 2 == 0) ? 'xmt-lg-0' : '' ?>">
                            <!-- Card -->
                            <div
                                class="card card-transition bg-soft-<?php echo $color;?> shadow-none">
                                <div class="card-body">
                                    <div class="mb-5">
                                        <img class="img-fluid rounded-2" src="<?php echo get_the_post_thumbnail_url($post->ID)?>" alt="">
                                    </div>
                                    <h3
                                        class="card-title text-<?php echo $color;?> mb-3  font-21">
                                        <?php echo $post->post_title;?>
                                    </h3>
                                    <p class="card-text text-dark">
                                        <?php echo wpautop($post->post_excerpt);?>
                                    </p>
                                    <span class="d-block text-body mb-0">
                                <a class="btn btn-light btn-sm btn-transition link border-<?php echo $color;?>"
                                   href="<?php echo get_permalink($post->ID) ?>">Learn more <i class="fa-solid fa-chevron-right font-9"></i></a>
                            </span>
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                    <?php endif;?>

                    <!-- end Template 2 -->
                    <?php  $co++; $i++;  endforeach; ?>


                <!-- End Col -->
            </div>

        </div>
    </div>
</div>