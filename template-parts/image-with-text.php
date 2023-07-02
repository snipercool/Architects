<section class="text-w-image">
    <div class="px-6 py-7 mx-auto">
        <div class="flex-lg align-center-lg<?php echo get_field('twi_reverse')?" flex-d-row-r" : ""; ?>">
            <img src="<?php echo get_field('twi_fi'); ?>"alt="">

            <div class=" w-1/2-lg mx-4-lg twi-content">
                <?php echo get_field('twi_content'); ?>
                <?php $link = get_field('twi_button'); ?>
                <a href="<?php echo $link['url']; ?>" class="button button-primary outlined arrowed"><?php echo $link['title']; ?></a>

            </div>
        </div>
    </div>
</section>