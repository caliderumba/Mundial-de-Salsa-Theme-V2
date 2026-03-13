<?php
/**
 * Custom Widget: Popular Posts
 */

class MDS_Popular_Posts_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'mds_popular_posts',
            __( 'MDS: Popular Posts', 'mundialdesalsa-pro' ),
            [ 'description' => __( 'Displays popular posts based on comment count.', 'mundialdesalsa-pro' ) ]
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        $query = new WP_Query([
            'posts_per_page' => $instance['count'] ?? 5,
            'orderby'        => 'comment_count',
            'post_status'    => 'publish'
        ]);

        if ( $query->have_posts() ) :
            echo '<ul class="popular-posts-list">';
            while ( $query->have_posts() ) : $query->the_post();
                ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) the_post_thumbnail('thumbnail'); ?>
                        <span class="post-title"><?php the_title(); ?></span>
                    </a>
                </li>
                <?php
            endwhile;
            echo '</ul>';
            wp_reset_postdata();
        endif;

        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Popular Posts', 'mundialdesalsa-pro' );
        $count = ! empty( $instance['count'] ) ? $instance['count'] : 5;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of posts:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="number" value="<?php echo esc_attr( $count ); ?>">
        </p>
        <?php
    }
}

function mds_register_widgets() {
    register_widget( 'MDS_Popular_Posts_Widget' );
}
add_action( 'widgets_init', 'mds_register_widgets' );
