<div class="row justify-content-center m-0 content-space-0 content-space-md-1 pt-lg-1">
    <div class="col-lg-9 card py-8 py-lg-3 pt-0">

        <div class="row align-items-sm-center col-lg-divider">
            <div class="col-lg-3 order-lg-1 order-1">
                <div class="text-lg-start text-center py-lg-5 py-2">
                    <h2 class="fw-300">Trusted by leading companies</h2>
                    <!-- End List Checked -->
                </div>
            </div>
            <div class="col-lg-9 order-lg-2 order-2">
                <div class="row">
                    <?php $clients = [];
                    $clients = ['vision',  'rfl', 'u-cleaners', 'shopnopari', 'medico',   'sensor'];
                    foreach ($clients as $client) : ?>
                        <div class="col-lg-2 col-4 py-6 text-center">
                            <img class="avatar avatar-xxl avatar-4x3 img-fluid" src="./assets/images/clients/<?php echo $client; ?>.jpg" alt="Logo">
                        </div>
                        <!-- End Col -->
                    <?php endforeach; ?>

                </div>
            </div>
            <!-- End Col -->


            <!-- End Col -->
        </div>

    </div>
</div>