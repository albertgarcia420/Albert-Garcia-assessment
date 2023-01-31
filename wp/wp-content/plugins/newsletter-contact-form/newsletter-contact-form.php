<?php
/**
 * Plugin Name: Newsletter plugin
 * Description: Newsletter contact form code test
 * Author: Albert Garcia
 * Author URI: https://albertgarcia420.github.io/devportfolio/
 * Version: 1.0.0
 * Text Domain: newsletter-form-plugin
 */

 function newsletter_plugin()
 {
    $content ='';
    $content .= '<!-- Trigger/Open The Modal -->
                <button id="myBtn" class="mybtn">Open Modal</button>
                <input type="hidden" id="showModal" />
                    <!-- The Modal -->
                    <div id="myModal" class="modal hidden">
                        <!-- Modal content -->
                        <div class="modal-content"> 
                            <!--<span id="close1" class="close">&times;</span>-->  
                            <h2>PRUNDERGROUND NEWSLETTER</h2>
                            <div class="divider"></div>
                                <form method="post" name="myForm" id="newsletter-form">
                                    <input type="text" class="form-control input-group" id="your_name" name="your_name" placeholder="Your Name" onkeyup="validateName()" required>
                                       
                                    <input type="email" class="form-control input-group" id="your_email" name="your_email" placeholder="Email Address" required>
                                    
                                    <input type="submit" id="submit" class="form-btn close input-group" name="newsletter_form_submit" value="Signup" />
                                </form>
                        </div>
                    </div>
                    <script>
                    // Get the modal
                    var modal = document.getElementById("myModal");

                    // Get the button that opens the modal
                    window.addEventListener("load", function(){
                        this.setTimeout(
                            function open(event){
                                document.querySelector("#myModal").style.display="block";
                            },
                            500
                        )

                        

                    });
                    

                    // Get the <span> element that closes the modal
                    window.hideModal = function () {
                       document.getElementById("myModal").style.display = "none";
                     }


                     
                    </script>

                    ';

    
    return $content;
 }
add_shortcode('newsletter_form', 'newsletter_plugin');

function newsletter_form_capture()
{
    if(isset($_POST['newsletter_form_submit']))
    {

        $name=$_POST['your_name'];
        $email=$_POST['your_email'];

            global $wpdb;

            $sql=$wpdb->insert("newsletter", array("name"=>$name, "email"=>$email));


    }
}
add_action('wp_head','newsletter_form_capture');

function add_shortcode_in_footer() {

	echo do_shortcode('[newsletter_form]');
}

add_action( 'wp_footer', 'add_shortcode_in_footer' );

function load_plugin_assets(){
    wp_enqueue_style('main-style',plugins_url().'/newsletter-contact-form/css/style.css');
    wp_enqueue_style('cookie-style',plugins_url().'/newsletter-contact-form/css/cookie.scss');
    wp_enqueue_script('main-script',plugins_url().'/newsletter-contact-form/js/main.js','','',true);
    
}
add_action('wp_enqueue_scripts','load_plugin_assets');


?>