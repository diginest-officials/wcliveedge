<div class="my-5">
    <div class="d-flex align-items-center justify-content-between">
        <?php
            if ( function_exists( 'display_product_count' ) ) {
                display_product_count();
            } else {
                echo '<p>Error: Function "display_product_count" is not defined.</p>';
            }
        ?>
    </div>
</div>