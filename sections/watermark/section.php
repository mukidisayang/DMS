<?php
/*
	Section: Watermark
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: Displays your most popular, and latest posts as well as comments and tags in a tabbed format.
	Class Name: PLWatermark
	Filter: widgetized
	Loading: active
*/

class PLWatermark extends PageLinesSection {

	function section_persistent(){
	
	}

	function section_opts(){
		$opts = array(
			array(
				'type' 	=> 	'multi',
				'title' 		=> __( 'Website Watermark', 'pagelines' ),
				'help' 		=> __( 'The website watermark is a small version of your logo for your footer. Recommended width/height is 90px.', 'pagelines' ),

				'opts'	=> array(
					array(
						'key'			=> 'watermark_image',
						'type' 			=> 'image_upload',
						'label' 		=> __( 'Watermark Image', 'pagelines' ),
						'default'		=> $this->base_url . '/default-watermark.png',
						'imgsize'			=> '44'
					),
					array(
						'key'			=> 'watermark_link',
						'type' 			=> 'text',
						'label'			=> __( 'Watermark Link (Blank for None)', 'pagelines' ),
						'default' 		=> 'http://www.pagelines.com'
					),
					array(
						'key'			=> 'watermark_alt',
						'type' 			=> 'text',
						'label' 		=> __( 'Watermark Link alt text', 'pagelines' ),
						'default' 		=> __( 'Build a website with PageLines', 'pagelines' )
					),
					array(
						'key'			=> 'watermark_hide',
						'type' 			=> 'check',
						'label'		 	=> __( "Hide Watermark", 'pagelines' )
					)
				),

			),
			array(
				'type' 	=> 	'help',
				'col'	=> 2,
				'title' 		=> __( 'Setting Up Social Shares', 'pagelines' ),
				'help' 		=> __( 'To set up social, you need to set your global social user names under "options" > "social &amp; local"<br/><br/> After you have done that, these values will fill automatically.', 'pagelines' ),


			),
		); 
		
		return $opts;
	}


   function section_template() {
		
		$home = home_url();
		$twitter = $this->opt('twittername'); 
		$facebook = $this->opt('facebook_name');
		
		$twitter = ($twitter) ? $twitter : 'pagelines';
		$facebook = ($facebook) ? $facebook : 'pagelines';
	
		$twitter_url = sprintf('https://twitter.com/%s', $twitter); 
		$facebook_url = sprintf('https://www.facebook.com/%s', $facebook); 
	
		$powered = sprintf(
			'%s %s <a href="http://www.pagelines.com">PageLines DMS</a>',
			get_bloginfo('name'), 
			__('was created with', 'pagelines')
		
		); 
		
		$watermark_image = $this->opt('watermark_image') ? $this->opt('watermark_image') : $this->base_url.'/default-watermark.png'; 
		$watermark_link = $this->opt('watermark_link') ? $this->opt('watermark_link') : 'http://www.pagelines.com'; 
		$watermark_alt = $this->opt('watermark_alt') ? $this->opt('watermark_alt') : 'Build a website with PageLines'; 
		
		if(!$this->opt('watermark_hide')){
			$watermark = sprintf(
				'<div class="the-watermark stack-element"><a href="%s"><img src="%s" alt="%s"/></a></div>', 
				$watermark_link,
				$watermark_image, 
				$watermark_alt
			);
		} else 
			$watermark = '';
		
		
	?>
	<div class="pl-watermark">
		<div class="pl_global_social stack-element">

			<?php 
			
				if( pl_setting( 'facebook_name' ) )
					echo do_shortcode( sprintf( '[like_button url="http://www.facebook.com/%s"]', $facebook ));
			
				if( ! has_action( 'pl_watermark_no_gplus' ) ) 
					echo do_shortcode('[googleplus]');
				
				if( pl_setting( 'twittername' ) )
					echo do_shortcode('[twitter_button type="follow"]');
			
			?>
		</div>
	
		<?php echo $watermark; ?>
	</div>
	<?php
	}
}