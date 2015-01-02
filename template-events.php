<script>
	var flag = 0;
	var offset = 0;
	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	function async_infinite_load() {
		jQuery.post (
			ajaxurl, 
			{
 			       'action': 'infinite_scroll',
				'off'  :  offset,
			}, 
			function( response ) {
				jQuery("#ofe_events ul").append(response);
				flag = 0;
				offset = offset + 1;
			}
		);

	}

	jQuery(window).scroll( function() {
		
   		if( jQuery(window).scrollTop() + jQuery(window).height() > ( jQuery('#ofe_events').height() + jQuery('#ofe_events').offset().top -10 ) && !flag ) {	
				flag = flag + 1;
				async_infinite_load();
   		}
	} );

</script>
<div id="ofe_events">
	<ul>
		<?php foreach ( $events as $event ) : ?>

			<li>
				<a href="<?php echo esc_attr( esc_url( $event->url ) ); ?>">
					<?php echo esc_html( $event->title ); ?>
				</a><br />

				<?php echo esc_html( date( 'l, F jS | g:i a', (int) $event->start_timestamp ) ); ?><br />

				<?php echo esc_html( $event->location ); ?>
			</li>

		<?php endforeach; ?>
	</ul>
</div> <!-- end #ofe_events -->
