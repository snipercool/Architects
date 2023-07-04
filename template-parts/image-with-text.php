<section class="text-w-image">
    <div class="px-10 py-7 mx-auto">
        <div class="flex-lg gap-8 align-center-lg<?php echo get_field('twi_reverse')?" flex-d-row-r" : ""; ?>">
            <img src="<?php echo get_field('twi_fi'); ?>"alt="">

            <div class=" w-1/2-lg mx-4-lg twi-content">
                <?php
                if(get_field('twi_content')):
                echo get_field('twi_content');
                $link = get_field('twi_button'); ?>
                <a href="<?php echo $link['url']; ?>" class="button button-primary outlined arrowed"><?php echo $link['title']; ?></a>
                <?php else: ?>
                    <?php $room_count = get_field('twi_apps_rooms'); ?>
                    <h2><?php echo $room_count; ?> Slaapkamer<?php echo ($room_count != '1')? 's' : '' ?></h2>
                    <p class="fs-4"><span class="fw-b"><?php echo get_field('twi_apps_sold') ?></span>/<?php echo get_field('twi_apps_total'); ?> appartementen verkocht</p>
                    <p class="fs-4"><?php echo get_field('twi_apps_size'); ?> m²</p>
                    <p class="fs-4">Vanaf €<?php echo get_field('twi_apps_price'); ?></p>
                    <a href="#" id="btn-rooms-<?php echo $room_count; ?>" class="button button-primary outlined arrowed button-modal">Maak een afspraak</a>
                    <script>
                        jQuery(document).ready(function($) {
                            jQuery('#btn-rooms-<?php echo $room_count; ?>').on('click', function(){
                                console.log('<?php echo $room_count; ?> Slaapkamer<?php echo ($room_count != '1')? 's' : '' ?>');
                                $('#field_vw8pb').val('<?php echo $room_count; ?> Slaapkamer<?php echo ($room_count != '1')? 's' : '' ?>');
                            });
                        });
                    </script>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>