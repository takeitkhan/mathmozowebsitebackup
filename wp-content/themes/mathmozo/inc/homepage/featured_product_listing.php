<div class="row justify-content-center m-0 py-4 xcontent-space-0 content-space-md-1">
    <div class="card card-lg shadow-none col-lg-9 px-lg-0">
        <div class="card-body px-0 pt-1 pb-0">
            <div class="row">

                <div class="col-lg-4 mb-3">
                    <h1 class="fw-300 text-center text-lg-start">We developed some stunning products for you</h1>
                </div>

                <?php
                $co = 4;
                $colors = ['green', 'blue', 'blue', 'info', 'success', 'warning', 'info'];
                for($i = 0; $i < 7; $i++):?>
                <?php
                    $color = $colors[$i];
                    if($i <= 2) : ?>
                <!-- Template 1 -->
                <div
                    class="<?php echo $i == 0 ? 'col-lg-8' : 'col-lg-6'?> mb-3">
                    <!-- Card -->
                    <div
                        class="card card-transition bg-soft-<?php echo $color;?> text-dark h-100  overflow-hidden shadow-none">
                        <div class="card-body py-5">
                            <div
                                class="<?php echo $i == 0 ? 'w-75' : 'w-65'  ?> pe-2">
                                <h4
                                    class="card-title font-19  text-<?php echo $color;?>">
                                    Android Application</h4>
                                <p class="card-text">Create a business with Tritiyo, whether you’ve got a fresh idea .
                                </p>
                                <a class="btn btn-light btn-sm btn-transition link border-<?php echo $color;?>"
                                    href="#">Learn more <i class="fa-solid fa-chevron-right font-9"></i></a>
                            </div>

                            <div
                                class="position-absolute end-0 bottom-0 <?php echo $i == 0 ? 'w-40 w-lg-25' : 'w-40'  ?> mb-n3 me-n7 xd-none">
                                <img class="card-img" src="./assets/images/apps.svg" alt="Image Description">
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <!-- end Template 1 -->
                <!-- Template 2 -->
                <?php  else : ?>
                <div
                    class="col-lg-6 mb-3  <?php echo ($co % 2 == 0) ? 'xmt-lg-0' : '' ?>">
                    <!-- Card -->
                    <div
                        class="card card-transition bg-soft-<?php echo $color;?> shadow-none">
                        <div class="card-body">
                            <div class="mb-5">
                                <img class="img-fluid rounded-2" src="./assets/images/screenshot/front_1.png"
                                    alt="Image Description">
                            </div>

                            <!--                                            <span class="badge bg-primary rounded-pill mb-2">Front-end</span>-->
                            <h3
                                class="card-title text-<?php echo $color;?> mb-3  font-21">
                                Android Application</h3>
                            <p class="card-text text-dark">Create a business with Tritiyo, whether you’ve got a fresh
                                idea .</p>
                            <span class="d-block text-body mb-0">
                                <a class="btn btn-light btn-sm btn-transition link border-<?php echo $color;?>"
                                    href="#">Learn more <i class="fa-solid fa-chevron-right font-9"></i></a>
                            </span>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <?php endif;?>

                <!-- end Template 2 -->
                <?php  $co++; endfor;?>


                <!-- End Col -->
            </div>

        </div>
    </div>
</div>