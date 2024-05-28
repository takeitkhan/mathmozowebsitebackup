<!DOCTYPE html>
<html lang="en" dir="">
<?php
    global $options;
    $options = get_option('my_framework');
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        <?php
        if (is_home()) {
            bloginfo('name');
            echo ' | ';
            bloginfo('description');
        } else {
            bloginfo('name');
            wp_title();
        }?>
    </title>
    <!-- Favicon -->
    <link rel="shortcut icon"
        href="<?php echo apply_filters('jetpack_photon_url', $options['favicon']['url']);?>">
    <link rel="icon" type="image/x-icon"
        href="<?php echo apply_filters('jetpack_photon_url', $options['favicon']['url']);?>" />
    <!-- Font -->
    <link rel="stylesheet"
        href="<?php echo assets();?>/assets/css/bootstrap-mod.css?v=<?php echo rand(0, 9999); ?>">

      <link rel="stylesheet" href="<?php echo assets();?>/assets/css/bootstrap.min.css">

    <link rel="stylesheet"
        href="<?php echo assets();?>/assets/css/all.min.css?v=1.0">
    <link rel="stylesheet"
        href="<?php echo assets();?>/assets/css/main.css?v=1.0">
    <link rel="stylesheet"
        href="<?php echo assets();?>/assets/css/custom.css?v=<?php echo rand(0, 9999); ?>">
<!--    <link rel="stylesheet" type="text/css" href="--><?php //echo assets();?><!--/assets/css/init.php?--><?php //echo rand(0, 9999); ?><!--"/>-->
    <meta name="theme-color" content="#2467F4">


    <?php
    $css_editor = "<style>{$options['css_editor']}</style>";
    echo $css_editor;
    if ( is_user_logged_in() && is_admin_bar_showing())
    {?>
        <style>
            header#header{
                position: sticky !important;
                top: 32px !important;
            }
        </style>
    <?php }
    ?>

    <?php if (\Elementor\Plugin::$instance->preview->is_preview_mode() )  {
        echo '<style>
               header#header{
                position: unset !important;
            }
          </style>';
        }
        echo $css_editor;
    ?>

    <?php wp_head();?>
</head>

<body>
    <!-- ========== HEADER ========== -->
    <?php 
            $header_left_menu = load_menu('header-left');
            $header_right_menu = load_menu('header-right');
            $menuDesign = function ($menu_id) {
                return get_field('menu_design', $menu_id);
            };
            $menuField = function($field,$menu_id){
                return get_field($field, $menu_id);
            }
            // echo '<pre>';
            // print_r($header_left_menu);?>
    <header id="header"
        class="justify-content-center navbar navbar-expand-lg navbar-light navbar-end bg-white position-fixed top-0 w-100 py-lg-0 py-0">
        <div class="col-lg-9 col-11">
            <nav class="js-mega-menu navbar-nav-wrap">
                <!-- Default Logo -->
                <?php
                    $logo = $options['upload-logo']['url'];
                ?>
                <a class="navbar-brand py-sm-3 me-2 <?php echo $logo ? 'mt-n2' : ''; ?>"
                    href="<?php echo home_url();?>"
                    aria-label="MathMozo">
                    <span class="<?php echo $logo ? '' : 'font-23'; ?>">
                        <span class="text-blue">
                            <?php
                                if($logo):
                                    echo "<img src='{$logo}' alt='{$options['website_name']}' />";
                                else:
                                    echo $options['website_name'];
                                endif;
                            ?>

                        </span>
                    </span>
                </a>
                <!-- End Default Logo -->

                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-default">
                        <i class="fa-solid fa fa-bars"></i>
                    </span>
                    <span class="navbar-toggler-toggled">
                        <i class="fa-solid fa fa-x"></i>
                    </span>
                </button>
                <!-- End Toggler -->

                <!-- Collapse -->
                <div class="collapse navbar-collapse mx-sm-n5 l-navbar" id="navbarNavDropdown">
                    <ul class="navbar-nav py-sm-0 py-lg-0 ms-md-0">
                        <li class="nav-divider d-md-block d-none"></li>
                        <?php if($header_left_menu) : foreach($header_left_menu as $menu):?>
                            <?php if(get_field('visibility', $menu->id) != 'hide') : ?>
                            <li
                            class="nav-item px-sm-3 px-lg-0<?php echo $menuDesign($menu->id) == 'mega-menu' ? ' hs-has-mega-menu' : null ?><?php echo $menuDesign($menu->id) == 'single-sub-menu' ? ' hs-has-sub-menu' : null ?>">
                            <a href="<?php echo $menuDesign($menu->id) != 'normal' ? 'javascript:void(0)' : $menu->url; ?>"
                                id="<?php echo $menuDesign($menu->id) != 'normal' ? 'pagesMegaMenu'.$menu->id : null ?>"
                                class="nav-link<?php echo $menu->children ? ' dropdown-toggle hs-mega-menu-invoker' : null ?>">
                                <?php echo $menu->title;?></a>
                                <?php if($menu->children) : ?>
                                    <?php if($menuDesign($menu->id) == 'mega-menu'):?>
                                        <div class="hs-mega-menu hs-position-right p-sm-0 dropdown-menu w-100" aria-labelledby="<?php echo 'pagesMegaMenu'.$menu->id;?>" style="min-width: 42rem;">
                                        <!-- Main Content -->
                                            <div class="navbar-dropdown-menu-inner">
                                                <div class="row">
                                                    <?php if($menu->children) : foreach($menu->children as $submenu): //Submenu?>
                                                        <?php if(get_field('visibility', $submenu->id) != 'hide') : ?>
                                                            <?php if($menuField('menu_template',$menu->id) =='one-column-product' ){ ?>
                                                                <div class="col-sm-6 col-md-3">
                                                                    <?php
                                                                        $imgLink = get_field('menu_image', $submenu->id)['url'] ?? null;
                                                                    ?>
                                                                    <a class="dropdown-item <?php echo $imgLink ? 'font-20': null ?>" href="<?php echo $submenu->url;?>">
                                                                        <div class="d-flex">
                                                                            <?php if($imgLink) : ?>
                                                                                <div class="flex-shrink-0">
                                                                                            <span class="svg-icon svg-icon-sm text-primary">
                                                                                                <img style="width:50px; margin-right: 5px;" src="<?php echo $imgLink;?>" class="" alt="">
                                                                                            </span>
                                                                                </div>
                                                                            <?php endif;?>

                                                                            <div class="flex-grow-1 <?php echo $imgLink ? ' ms-3' : null ?>">
                                                                                        <span class="xnavbar-dropdown-menu-media-title">
                                                                                            <?php echo $submenu->title;?>
                                                                                        </span>
                                                                                <?php if($submenu->description) : ?>
                                                                                    <div class="xnavbar-dropdown-menu-media-desc xtext-dark font-14"><?php echo $submenu->description; ?></div>
                                                                                <?php endif;?>
                                                                            </div>
                                                                        </div>
                                                                    </a>

                                                                </div>
                                                            <?php } else{ ?>


                                                                <div class="col-sm-6 col-md-3">
                                                                    <?php if($submenu->id) { ?>
                                                                        <?php echo $menuField('menu_template',$menu->id) =='product' ?  null : "<span class='dropdown-header'>{$submenu->title}</span>"?>

                                                                        <?php if($submenu->children) : foreach($submenu->children as  $subsubmenu):?>
                                                                            <?php if(get_field('visibility', $subsubmenu->id) != 'hide') : ?>
                                                                            <?php
                                                                                $imgLink = get_field('menu_image', $subsubmenu->id)['url'] ?? null;
                                                                            ?>
                                                                            <a class="dropdown-item <?php echo $imgLink ? 'font-20': null ?>" href="<?php echo $subsubmenu->url;?>">
                                                                                <div class="d-flex">
                                                                                    <?php if($imgLink) : ?>
                                                                                        <div class="flex-shrink-0">
                                                                                            <span class="svg-icon svg-icon-sm text-primary">
                                                                                                <img style="width:50px; margin-right: 5px;" src="<?php echo $imgLink;?>" class="" alt="">
                                                                                            </span>
                                                                                        </div>
                                                                                    <?php endif;?>

                                                                                    <div class="flex-grow-1 <?php echo $imgLink ? ' ms-3' : null ?>">
                                                                                        <span class="xnavbar-dropdown-menu-media-title">
                                                                                            <?php echo $subsubmenu->title;?>
                                                                                        </span>
                                                                                        <?php if($subsubmenu->description) : ?>
                                                                                            <div class="xnavbar-dropdown-menu-media-desc xtext-dark font-14"><?php echo $subsubmenu->description; ?></div>
                                                                                        <?php endif;?>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                            <?php endif;?>
                                                                        <?php endforeach;endif; }else{?>
                                                                            <a class="dropdown-item" href="<?php echo $submenu->url;?>"><?php echo $submenu->title;?></a>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>
                                                        <?php endif;?>
                                                    <?php endforeach; endif;  //Submenu?>
                                                </div>
                                                <!-- End Row -->
                                            </div>
                                        <!-- End Main Content -->
                                        </div>
                                    <?php endif; // Mega menu?>

                                    <?php if($menuDesign($menu->id) == 'single-sub-menu'):?>
                                        <div class="hs-sub-menu dropdown-menu" aria-labelledby="<?php echo 'pagesMegaMenu'.$menu->id;?>"
                                            style="min-width: 12rem;">
                                            <?php if($menu->children): foreach($menu->children as $submenu): //Submenu?>
                                            <?php if(get_field('visibility', $submenu->id) != 'hide') : ?>
                                                <a class="dropdown-item" href="<?php echo $submenu->url;?>"><?php echo $submenu->title;?></a>
                                            <?php endif;?>
                                            <?php endforeach; endif;?>
                                        </div>
                                    <?php endif; //Single-submenu?>

                                <?php endif;?>
                        </li>
                            <?php endif;?>
                        <?php endforeach; endif; //top end foreach?>
                    </ul>

                    <ul class="navbar-nav py-sm-0 py-lg-0 ">
                    <?php foreach($header_right_menu as $menu):?>
                            <li
                            class="nav-item px-sm-3 px-lg-0<?php echo $menuDesign($menu->id) == 'mega-menu' ? ' hs-has-mega-menu' : null ?><?php echo $menuDesign($menu->id) == 'single-sub-menu' ? ' hs-has-sub-menu' : null ?>">
                            <a href="<?php echo $menuDesign($menu->id) != 'normal' ? 'javascript:void(0)' : $menu->url; ?>"
                                id="<?php echo $menuDesign($menu->id) != 'normal' ? 'pagesMegaMenu'.$menu->id : null ?>"
                                class="nav-link<?php echo $menu->children ? ' dropdown-toggle hs-mega-menu-invoker' : null ?>">
                                <?php echo $menu->title;?></a>
                                <?php if($menu->children) : ?>
                                    <?php if($menuDesign($menu->id) == 'mega-menu'):?>
                                        <div class="hs-mega-menu hs-position-right p-sm-0 dropdown-menu w-100" aria-labelledby="<?php echo 'pagesMegaMenu'.$menu->id;?>" style="min-width: 42rem;">
                                        <!-- Main Content -->
                                            <div class="navbar-dropdown-menu-inner">
                                                <div class="row">
                                                    <?php foreach($menu->children as $submenu): //Submenu?>
                                                    <div class="col-sm-6 col-md-3">
                                                        <?php if($submenu->id) { ?>
                                                            <span class="dropdown-header"><?php echo $submenu->title;?></span> 
                                                            <?php foreach($submenu->children as  $subsubmenu):?>
                                                                <a class="dropdown-item" href="<?php echo $subsubmenu->url;?>"><?php echo $subsubmenu->title;?></a>
                                                            <?php endforeach; }else{?>
                                                                <a class="dropdown-item" href="<?php echo $submenu->url;?>"><?php echo $submenu->title;?></a>
                                                        <?php } ?>
                                                    </div>
                                                    <?php endforeach;  //Submenu?>
                                                </div>
                                                <!-- End Row -->
                                            </div>
                                        <!-- End Main Content -->
                                        </div>
                                    <?php endif; // Mega menu?>

                                    <?php if($menuDesign($menu->id) == 'single-sub-menu'):?>
                                        <div class="hs-sub-menu dropdown-menu" aria-labelledby="<?php echo 'pagesMegaMenu'.$menu->id;?>"
                                            style="min-width: 12rem;">
                                            <?php foreach($menu->children as $submenu): //Submenu?>
                                            <a class="dropdown-item" href="<?php echo $submenu->url;?>"><?php echo $submenu->title;?></a>
                                            <?php endforeach;?>
                                        </div>
                                    <?php endif; //Single-submenu?>

                                <?php endif;?>
                        </li>
                        <?php endforeach; //top end foreach?>
                    </ul>
                </div>
                <!-- End Collapse -->
            </nav>
        </div>
    </header>