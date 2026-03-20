<?php
/**
 * Custom Trending Posts Widget
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class MDS_Pro_Trending_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'mds_pro_trending_widget',
			esc_html__( 'MDS Pro: Tendencias', 'mundialdesalsa-pro' ),
			array( 'description' => esc_html__( 'Muestra los posts más vistos de la semana con estilo brutalista.', 'mundialdesalsa-pro' ) )
		);
	}

	/**
	 * Front-end display of widget.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$count = ! empty( $instance['count'] ) ? absint( $instance['count'] ) : 5;

		$query_args = array(
			'post_type'      => 'post',
			'posts_per_page' => $count,
			'meta_key'       => 'mds_pro_views_count',
			'orderby'        => 'meta_value_num',
			'order'          => 'DESC',
			'date_query'     => array(
				array(
					'after' => '1 week ago',
				),
			),
		);

		$trending_query = new WP_Query( $query_args );

		if ( $trending_query->have_posts() ) :
			echo '<div class="space-y-4">';
			$i = 1;
			while ( $trending_query->have_posts() ) : $trending_query->the_post();
				?>
				<a href="<?php the_permalink(); ?>" class="group flex items-start gap-4 p-3 border-2 border-black dark:border-white hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-all duration-200 transform hover:-translate-y-1 hover:translate-x-1 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)]">
					<div class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-black text-white dark:bg-white dark:text-black font-black text-lg italic">
						<?php echo str_pad( $i, 2, '0', STR_PAD_LEFT ); ?>
					</div>
					<div class="flex-grow">
						<h4 class="text-sm font-bold leading-tight line-clamp-2 uppercase tracking-tighter">
							<?php the_title(); ?>
						</h4>
						<div class="flex items-center gap-2 mt-1 text-[10px] font-bold opacity-60">
							<span><?php echo get_the_date(); ?></span>
							<span>•</span>
							<span><?php echo mds_pro_get_reading_time( get_the_content() ); ?> MIN</span>
						</div>
					</div>
				</a>
				<?php
				$i++;
			endwhile;
			echo '</div>';
			wp_reset_postdata();
		else :
			echo '<p class="text-xs opacity-60 italic">' . esc_html__( 'No hay tendencias esta semana.', 'mundialdesalsa-pro' ) . '</p>';
		endif;

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Tendencias', 'mundialdesalsa-pro' );
		$count = ! empty( $instance['count'] ) ? $instance['count'] : 5;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Título:', 'mundialdesalsa-pro' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_attr_e( 'Número de posts:', 'mundialdesalsa-pro' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="number" step="1" min="1" max="10" value="<?php echo esc_attr( $count ); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? absint( $new_instance['count'] ) : 5;

		return $instance;
	}

}

/**
 * Register the widget.
 */
function mds_pro_register_trending_widget() {
	register_widget( 'MDS_Pro_Trending_Widget' );
}
add_action( 'widgets_init', 'mds_pro_register_trending_widget' );
