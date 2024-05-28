<?php

// Control core classes for avoid errors
if(class_exists('CSF')) {

    //
    // Set a unique slug-like ID
    $prefix = 'my_framework';

    //
    // Create options
    CSF::createOptions($prefix, array(
      'menu_title' => 'Configuration',
      'menu_slug'  => 'configuration',
      'menu_position'   =>  2,
      'ajax_save'       => true,
      'show_reset_all'  => false,
      'framework_title' => 'Software Control <small>by Riptware</small>',
      'theme'  => 'light',
    ));


    // Custom


    CSF::createSection($prefix, array(

      'title'  => 'Header section',
      'fields' => array(

        //Field Start

        array(
          'id'    => 'website_name',
          'type'  => 'text',
          'title' => 'Website name',
        ),

        array(
          'id'    => 'favicon',
          'type'  => 'media',
          'title' => 'Upload Favicon',
          'desc'  => '',
          //'url'   => false,
          'default' => array(
             'url'  => 'images/favicon.png',
          ),
       ),
          array(
           'id'    => 'upload-logo',
           'type'  => 'media',
           'title' => 'Upload Logo',
           'desc'  => '',
           //'url'   => false,
           'default' => array(
              'url'  => 'images/logo.png',
           ),
        ),

        array(
           'id'    => 'fb_link',
           'type'  => 'text',
           'title' => 'Facebook Link',
           'default' => 'http://facebook.com/',
        ),

        // array(
        //    'id'    => 'twitter-link',
        //    'type'  => 'text',
        //    'title' => 'Twitter Link',
        //    'default' => 'http://twitter.com/',
        // ),

        array(
           'id'    => 'linkedin_link',
           'type'  => 'text',
           'title' => 'Linkedin Link',
           'default' => 'http://linkedin.com/',
        ),


        // array(
        //    'id'    => 'insagram-link',
        //    'type'  => 'text',
        //    'title' => 'Instagram Link',
        //    'default' => 'http://instagram.com/',
        // ),

        // array(
        //    'id'    => 'pinterest-link',
        //    'type'  => 'text',
        //    'title' => 'Pinterest Link',
        //    'default' => 'http://pinterest.com/',
        // ),

         array(
           'id'    => 'youtube_link',
           'type'  => 'text',
           'title' => 'Youtube Link',
           'default' => 'http://youtube.com/',
        ),

        // array(
        //    'id'    => 'skype-link',
        //    'type'  => 'text',
        //    'title' => 'Skype Link',
        //    'default' => 'skype:live.',
        // ),

        // array(
        //    'id'    => 'behnace-link',
        //    'type'  => 'text',
        //    'title' => 'Behance Link',
        //    'default' => '',
        // ),

        // array(
        //    'id'    => 'whatsapp-link',
        //    'type'  => 'text',
        //    'title' => 'Whatsapp Link',
        //    'default' => '',
        // ),


      //   array(
      //     'id'    => 'phone',
      //     'type'  => 'text',
      //     'title' => 'Phone Number',
      //  ),

      //  array(
      //     'id'    => 'free_trial_link',
      //     'type'  => 'text',
      //     'title' => 'Free Trial Link',
      // ),

      // array(
      //     'id'    => 'contact_link',
      //     'type'  => 'text',
      //     'title' => 'Contact Link',
      // ),

      // array(
      //     'id'    => 'quote_link',
      //     'type'  => 'text',
      //     'title' => 'Quote Link',
      // ),

       array(
         'id'    => 'footer_right',
         'type'  => 'wp_editor',
         'title' => 'Footer Right',
     ),



    )



    ));



    // Homepage

    CSF::createSection($prefix, array(
    'id'    => 'homepage_fields',
    'title' => 'Homepage Section',
    'icon'  => 'fa fa-plus-circle',
    ));

    //SubOption


    //Slider Section
/*
    CSF::createSection($prefix, array(
       'parent' => 'homepage_fields',
       'title'  => 'Home Slider section',
       'fields' => array(

         [
           'id' => 'home_slider_heading',
           'title' => 'Heading',
           'type'  => 'text',
         ],
         [
           'id' => 'home_slider_heading_animated',
           'title' => 'Animated heading',
           'type'  => 'text',
           'desc' => 'For Nultiple use | sign. Example: Retouching | Masking'
         ],
         [
           'id' => 'home_slider_summary',
           'title' => 'Summary',
           'type'  => 'textarea',
         ],

         array(
           'id'    => 'home_slider_image',
           'desc' => 'Image Size must be 1600px*400px',
           'type'  => 'gallery',
           'title' => 'Image',
           'add_title' => 'Add Image',
           'edit_title' => 'Edit Image',
         ),
       )
     ));

*/


    // Home Service Item
    CSF::createSection($prefix, array(
      'parent' => 'homepage_fields',
      'title'  => 'Service Item',
      'fields' => array(
        [
          'id' => 'home_service_items_heading',
          'title' => 'Heading',
          'type'  => 'text',
          'media_buttons' => false,
        ],
        array(
        'id'        => 'home_service_items',
        'type'      => 'group',
        'title'     => 'Service Items',
        'fields'    => array(

           //Work Process

            array(
              'id'    => 'home_service_items_title',
              'type'  => 'text',
              'title' => 'Title',
            ),

            array(
                'id'    => 'home_service_items_url',
                'type'  => 'text',
                'title' => 'Page Url',
            ),
            array(
                'id'    => 'home_service_items_icon',
                'type'  => 'text',
                'title' => 'Font Awesome Icon',
                'desc'  => 'Font Awesome 6 pro <a target="_blank" href="https://fontawesome.com/search">Link</a>',
            ),

//            array(
//              'id'    => 'home_our_strength_logo',
//              'type'  => 'media',
//              'title' => 'Upload Image',
//              'desc'  => 'Image size 80x80',
//              'url'   => false,
//            ),

          ),
        ),
      ),
    ));


    // Home Product Item
    CSF::createSection($prefix, array(
        'parent' => 'homepage_fields',
        'title'  => 'Featured Software',
        'fields'   => [
            [
                'id' => 'home_softwares_heading',
                'title' => 'Heading',
                'type'  => 'text',
                'media_buttons' => false,
            ],
            [
                'id'        => 'home_softwares',
                'type'      => 'select',
                'title'     => 'Select Software',
                'desc'      => 'You can select multiple softwares',
                'type'      => 'select',
                'sortable' =>   true,
                'chosen'      => true,
                //'ajax'        => true,
                'multiple'    => true,
                'options'     => 'posts',
                'query_args'  => [
                    'post_type'  => 'software',
                    'order'     => 'DESC',
                    'posts_per_page' => '-1'
                ]
            ],
        ]
    ));

    // Home Product Item
    CSF::createSection($prefix, array(
        'parent' => 'homepage_fields',
        'title'  => 'Industries We Serve',
        'fields'   => [
            [
                'id' => 'home_industries_heading',
                'title' => 'Heading',
                'type'  => 'text',
                'media_buttons' => false,
            ],
            [
                'id'        => 'home_industries',
                'type'      => 'select',
                'title'     => 'Select Industry',
                'desc'      => 'You can select multiple Industries',
                'type'      => 'select',
                'sortable' =>   true,
                'chosen'      => true,
                //'ajax'        => true,
                'multiple'    => true,
                'options'     => 'posts',
                'query_args'  => [
                    'post_type'  => 'industry',
                    'order'     => 'DESC',
                    'posts_per_page' => '-1'
                ]
            ],

            [
                'id' => 'home_industries_last_column_heading',
                'title' => 'Last Column Heading',
                'type'  => 'text',
                'media_buttons' => false,
            ],
            [
                'id' => 'home_industries_last_column_url',
                'title' => 'Last Column Link',
                'type'  => 'text',
                'media_buttons' => false,
            ],
        ]
    ));


    //Code Editor
    // Homepage

    CSF::createSection($prefix, array(
        'id'    => 'code_editor_fields',
        'title' => 'Code Editor',
        'icon'  => 'fa fa-plus-circle',
    ));
    CSF::createSection($prefix, array(
        'parent' => 'code_editor_fields',
        'fields'   => [
            [
                'id'       => 'css_editor',
                'type'     => 'code_editor',
                'title'    => 'CSS Editor',
                'settings' => array(
                    'theme'  => 'mbo',
                    'mode'   => 'css',
                ),
                'default'  => '.element{ color: #ffbc00; }',
            ],

        ]
    ));
    //Home Service
/*
    CSF::createSection($prefix, array(
      'parent' => 'homepage_fields',
      'title'  => 'Home Service section',
      'fields'   => [
            [
              'id'        => 'home_service_category',
              'type'      => 'select',
              'title'     => 'Select Service',
              'desc'      => 'You can select multiple services',
              'type'      => 'select',
              'sortable' =>   true,
              'chosen'      => true,
              //'ajax'        => true,
              'multiple'    => true,
              'options'     => 'posts',
              'query_args'  => [
                'post_type'  => 'service',
                'order'     => 'DESC',
                'posts_per_page' => '-1'
              ]
            ],
        ]
    ));
*/
    /*
      //Home Top Custom Service Section

      CSF::createSection( $prefix, array(
        'parent' => 'homepage_fields',
        'title'  => 'Home Top Custom Service section',
        'fields' => array(
          array(
            'id' => 'homepage-top-service-grid',
            'title' => 'Grid column',
            'type'  => 'text',
            'default' => '3',
          ),
          array(
          'id'        => 'home-top-custom-service',
          'type'      => 'group',
          'title'     => 'Custom Service',
          'fields'    => array(

             //Service Article
              array(
                  'id'    => 'home-top-custom-service-title',
                  'type'  => 'text',
                  'title' => 'Title',
                ),
                array(
                  'id'    => 'home-top-custom-service-desc',
                  'type'  => 'textarea',
                  'title' => 'Description',
                  'media_buttons' => false,
                  'quicktags' => false,
                  'wpautop' => true,
                ),
                array(
                  'id'    => 'home-top-custom-service-link',
                  'type'  => 'text',
                  'title' => 'Link',
                ),
                array(
                  'id'    => 'home-top-custom-service-icon',
                  'type'  => 'icon',
                  'title' => 'Use Font Awesome Icon',
                ),
              ),
            ),
          ),
      ));


      //Tab & Accodion Section
      CSF::createSection( $prefix, array(
        'parent' => 'homepage_fields',
        'title'  => 'Company profile Section',
        'fields' => array(
          //Tab
          array(
          'id'        => 'home-tab-col',
          'type'      => 'group',
          'title'     => 'Tab Column',
          'fields'    => array(

               //Tab
                array(
                  'id'    => 'tab-menu-title',
                  'type'  => 'text',
                  'title' => 'Title',
                ),
                array(
                  'id'    => 'tab-menu-desc',
                  'type'  => 'wp_editor',
                  'title' => 'Description',
                  'media_buttons' => true,
                ),

                array(
                  'id'    => 'tab-menu-icon',
                  'type'  => 'icon',
                  'title' => 'Font Awesome Icon',
                ),
              ),
          ), // End Tab

           //Accorsion
          array(
          'id'        => 'home-accordion-col',
          'type'      => 'group',
          'title'     => 'Accordion Column',
          'fields'    => array(

               //
                array(
                  'id'    => 'accordion-menu-title',
                  'type'  => 'text',
                  'title' => 'Title',
                ),
                array(
                  'id'    => 'accordion-menu-desc',
                  'type'  => 'wp_editor',
                  'title' => 'Description',
                  'media_buttons' => true,
                ),

                array(
                  'id'    => 'accordion-menu-icon',
                  'type'  => 'icon',
                  'title' => 'Font Awesome Icon',
                ),
              ),
          ), // End Accordion


        )

     ));

     */

//    Special Content
     CSF::createSection( $prefix, array(
       'parent' => 'homepage_fields',
       'title'  => 'Special Content section',
       'fields' => array(
           [
            'id'  => 'home_special_content',
            'type' => 'wp_editor',
           ],

           [
               'id'  => 'home_special_content_btn_text',
               'type' => 'text',
               'title' => 'Button text',
           ],

           [
               'id'  => 'home_special_content_btn_url',
               'type' => 'text',
               'title' => 'Button Url',
           ],
        ),
     ));

/*

    //  Home Partner

    CSF::createSection($prefix, array(
      'parent' => 'homepage_fields',
      'title'  => 'Home Partner section',
      'fields' => array(
        [
          'id'  => 'home_partner_content',
          'type' => 'wp_editor',
          'title' => 'Summary',
          'media_buttons' => false,
         ],
        array(
        'id'        => 'home-partner',
        'type'      => 'group',
        'title'     => 'Partner Logo',
        'fields'    => array(

           //Partner Logo

            array(
              'id'    => 'home-partner-name',
              'type'  => 'text',
              'title' => 'Partner Name',
            ),


            array(
              'id'    => 'home-partner-logo',
              'type'  => 'media',
              'title' => 'Upload Logo',
              'desc'  => 'Logo size 175x50',
              'url'   => false,
              'default' => array(
                 'url' => 'images/default.png',
                ),
              ),
            ),
          ),
        ),
    ));



    // Portfolio
    CSF::createSection($prefix, array(
      'parent' => 'homepage_fields',
      'title'  => 'Home Portfolio section',
      'fields' => array(
          [
           'id'  => 'home_portfolio_content',
           'type' => 'wp_editor',
           'title' => 'Summary',
           'media_buttons' => false,
          ],
       ),
    ));

    //  Home Work Proccess
    /*
      CSF::createSection( $prefix, array(
        'parent' => 'homepage_fields',
        'title'  => 'Work Process section',
        'fields' => array(
          array(
          'id'        => 'home-work-processs',
          'type'      => 'group',
          'title'     => 'Work Process',
          'fields'    => array(

             //Work Process

              array(
                'id'    => 'home-work-process-title',
                'type'  => 'text',
                'title' => 'Title',
              ),

              array(
                  'id'    => 'home-work-process-icon',
                  'type'  => 'icon',
                  'title' => 'Font Awesome Icon',
              ),

              array(
                'id'    => 'home-work-process-logo',
                'type'  => 'media',
                'title' => 'Upload Logo',
                'desc'  => 'Image size 80x80',
                'url'   => false,
                ),
              ),
            ),
          ),
      ));
    */


    //Home Custom Service Price
/*
    CSF::createSection($prefix, array(
      'parent' => 'homepage_fields',
      'title'  => 'Price section',
      'fields'   => [
          [
            'id'  => 'home_price_content',
            'type' => 'wp_editor',
            'title' => 'Summary',
            'media_buttons' => false,
          ],

            [
              'id'        => 'home_price',
              'type'      => 'select',
              'title'     => 'Select Service Category',
              'desc'      => 'You can select multiple category',
              'type'      => 'select',
              'sortable' =>   true,
              'chosen'      => true,
              //'ajax'        => true,
              'multiple'    => true,
              'options'     => 'posts',
              'query_args'  => [
                'post_type'  => 'service',
                'order'     => 'DESC',
                'posts_per_page' => '-1'
              ]
            ],

          //Pricing Option style 2
          array(
              'id'        => 'home_price_table',
              'type'      => 'group',
              'title'     => 'Price Table',
              'fields'    => array(

                  //Work Process

                  array(
                      'id'    => 'service_name',
                      'type'  => 'text',
                      'title' => 'Service Name',
                  ),

                  array(
                      'id'    => 'service_offer_price',
                      'type'  => 'text',
                      'title' => 'Offer Price',
                  ),

                  array(
                      'id'    => 'production_capacity',
                      'type'  => 'text',
                      'title' => 'Production Capacity',
                  ),

                  array(
                      'id'    => 'sample_image',
                      'type'  => 'media',
                      'title' => 'Upload Sample Image',
                      'desc'  => '',
                      'url'   => false,
                  ),

              ),
          ),


        ]
    ));

    //Our Story

    CSF::createsection($prefix, array(
      'parent' => 'homepage_fields',
      'title'  =>'Our Story', //Second Section
      'fields' => array(
        [
          'id'  => 'home_strory_section_content',
          'type' => 'wp_editor',
          'title' => 'Summary',
          'media_buttons' => false,
         ],
          // array(
          // 'title'   => 'Title',
          // 'id'      => 'home_strory_section_title',
          // 'type'    => 'textarea',
          // 'default' => 'Our Story',
          // ), // End  title

          // array(
          // 'title'   => 'Sub Title',
          // 'id'      => 'home_strory_section_subtitle',
          // 'type'    => 'textarea',
          // 'default' => 'Who we are and how we came to be',
          // ), // End  title

          array(
            'id'    => 'home_strory_section_page_id',
            'type'  => 'select',
            'multiple' => false,
            'title' =>  'Select page',
            'options' => 'pages',
            'chosen' => true,
            'width'  => '200px',
            'query_args' => array(
                'hide_empty' => false,
            ),
            //'desc'  => 'you can select multiple category',
          ), // End page

      ) // End field
 )); // End Section
*/

    //Conatct
    /*
     CSF::createsection( $prefix, array(
      'parent' => 'homepage_fields',
      'title'  =>'Contact us', //Second Section
      'fields' => array(
          array(
          'title'   => 'Conatct Information',
          'id'      => 'home_contact_information',
          'type'    => 'wp_editor',
          'default' => '',
          ), // End  title

          array(
            'title'   => 'Conatct Form Shortcode',
            'id'      => 'home_contact_form_shortcode',
            'type'    => 'textarea',
            'default' => '',
            ), // End  title

      ) // End field
    )); // End Section

    */


/*
    CSF::createsection($prefix, array(
      'title'  =>'Form Settings', //Second Section
      'fields' => array(
         array(
            'title'   => 'Quote Form Shortcode',
            'id'      => 'quote_form_shortcode',
            'type'    => 'textarea',
            'default' => '',
            ), // End  title

          array(
            'title'   => 'Free Trial Form Shortcode',
            'id'      => 'free_trial_form_shortcode',
            'type'    => 'textarea',
            'default' => '',
            ), // End  title

            array(
              'title'   => 'Contact Form Shortcode',
              'id'      => 'contact_form_shortcode',
              'type'    => 'textarea',
              'default' => '',
              ), // End  title

      ) // End field
    )); // End Section

*/
}
