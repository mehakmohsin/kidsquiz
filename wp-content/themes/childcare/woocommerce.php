<?php
get_header();

childcare_breadcrumbs(); ?>

<div class="clearfix"></div>

<div class="container" style="padding-top:60px;">

<div class="row">

		<div class="col-md-<?php if(is_cart() || is_checkout() || is_product_category() || is_product()){ echo'12'; } else{ echo ( !is_active_sidebar( 'sidebar-data' ) ? '12' :'8' ); } ?>">

		<div class="shopContent">

					<?php

					function childcare_shop_title(){

						return '';

					}

					woocommerce_content(); ?>

	</div>

</div>

<?php

   			 get_sidebar();

         ?>

</div>

</div>

</div>

<?php  get_footer();  ?>