<?php

$section_heading = $settings['section_heading'];
$selected_icon = $settings['selected_icon'];
$share_icons = $settings['share_icons'];

// $section_heading_toggle = $settings['section_heading_toggle'];

$url = urlencode(get_the_permalink());
$title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
$media = urlencode(get_the_post_thumbnail_url(get_the_ID(), 'full'));

$email = 'mailto:?subject=' . $title . '&body=Check out this site: ' . $url . '" title="Share by Email';

?>
<div class="ippi-container-wrapper <?php echo ($share_icons == 'lite') ? 'ippi-share-icon-lite' : ''; ?>">
    <div class="ippi-share-this-page-wrapper">
        <?php if ($share_icons == 'default') { ?>
            <div class="ippi-share-page-custom">
                <div class="ippi-share-page-heading">
                    <?php _e($section_heading, 'ippi'); ?>
                </div>
            </div>
        <?php } ?>
        <div class="ippi-share-icon">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank">
                <div data-network="facebook" class="fab fa-facebook-f st-custom-button"></div>
            </a>
             <a href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $url; ?>" target="_blank">
                <div data-network="twitter" class="fab fa-twitter st-custom-button"></div>
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $url; ?>&title=<?php echo $title; ?>" target="_blank">
                <div data-network="linkedin" class="fab fa-linkedin-in st-custom-button"></div>
            </a>
            <a href="<?php echo $email; ?>" target="_blank">
                <div data-network="email" class="fas fa-envelope st-custom-button"></div>
            </a>
            <a href="#" class="print_current_page">
                <div data-network="print" class="fas fa-print st-custom-button"></div>
            </a>
        </div>
    </div>

</div>

<style>
    .ippi-share-this-page-wrapper {
        display: flex;
        align-items: center;
        padding: 33px 33px;
        border: 2px solid #000;
    }

    .ippi-share-page-heading {
        font: normal normal 600 36px/46px Gibson;
        letter-spacing: 0.72px;
        color: #231E1D;
        text-transform: capitalize;
        opacity: 1;
        margin: 0;
    }

    .ippi-share-this-page-wrapper .ippi-share-icon a {
        font-size: 36px;
        color: #000;
        padding: 0 20px;
    }

    .ippi-share-this-page-wrapper .ippi-share-icon {
        margin-left: 50px;
    }

    .ippi-share-this-page-wrapper .ippi-share-icon a:hover {
        color: var(--e-global-color-secondary);
    }

    .ippi-share-icon-lite .ippi-share-this-page-wrapper {
        border: 0;
        padding: 0px;
        margin-top: 57px;
        margin-bottom: 58px;
    }

    .ippi-share-icon-lite .ippi-share-this-page-wrapper .ippi-share-icon {
        margin: 0;
    }

    .ippi-share-icon-lite .ippi-share-this-page-wrapper a {
        font-size: 24px;
    }

    @media only screen and (max-width: 1024px) {
        .ippi-share-this-page-wrapper {
            padding: 20px;
        }

        .ippi-share-page-heading h2 {
            font-size: 22px;
            line-height: 1.4;
        }

        .ippi-share-this-page-wrapper .ippi-share-icon {
            margin: 0;
        }

        .ippi-share-this-page-wrapper .ippi-share-icon a {
            font-size: 25px;
            padding: 0 9px;
        }

    }

    @media only screen and (max-width: 960px) {
        .ippi-share-page-custom {
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
        }

        .ippi-share-this-page-wrapper {
            flex-wrap: wrap;
            justify-content: center;
        }

        .ippi-share-this-page-wrapper .ippi-share-icon {
            width: 100%;
            text-align: center;
        }
    }
</style>

<script>
    (function(document) {
        var shareButtons = document.querySelectorAll(".st-custom-button[data-network]");
        for (var i = 0; i < shareButtons.length; i++) {
            var shareButton = shareButtons[i];

            shareButton.addEventListener("click", function(e) {
                var elm = e.target;
                var network = elm.dataset.network;

                console.log("share click: " + network);
            });
        }

        jQuery('.print_current_page').click(function(e) {
            e.preventDefault();
            window.print();
            return false;
        });
    })(document);
</script>