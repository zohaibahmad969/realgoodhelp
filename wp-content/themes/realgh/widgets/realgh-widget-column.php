<?php
/*
 * Adds column widget.
*/
class Realgh_Column_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'realgh_column_widget', // Base ID
			esc_html__( 'Column Links', 'realgh' ), // Name
			array( 'description' => esc_html__( 'Creates a column with a header and list of links', 'realgh' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		?>
		<div class="footer__column footer__item">
			<p class="subtitle footer__title c-white">
				<?php
				if ( !empty( $instance['realgh_title'] ) ) {
					echo apply_filters('widget_column_title', $instance['realgh_title']);
				}
				?>
			</p>
			<div class="footer__links">
			<?php
			if ( isset($instance['realgh_texts']) ) {
				for ($i = 0; $i < count($instance['realgh_texts']); $i++) {
				?>
					<a
						href="<?php echo $instance['realgh_values'][$i]; ?>"
						class="link footer__link text footer__text"
					>
						<?php echo esc_html__($instance['realgh_texts'][$i], 'realgh'); ?>
					</a>
				<?php
				}
			}
			?>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = isset($instance['realgh_title']) ? $instance['realgh_title'] : '';
		$values = isset($instance['realgh_values']) ? $instance['realgh_values'] : array();
		$texts = isset($instance['realgh_texts']) ? $instance['realgh_texts'] : array();

		?>
		<label for="<?php echo esc_attr( $this->get_field_id( 'realgh_title' ) ); ?>">
			<?php esc_html_e( 'Column title:', 'realgh' ); ?>
		</label> 
		<input
			style="margin-bottom: 10px;"
			id="<?php echo esc_attr( $this->get_field_id( 'realgh_title' ) ); ?>"
			name="<?php echo esc_attr( $this->get_field_name( 'realgh_title' ) ); ?>"
			type="text"
			value="<?php echo esc_attr__( $title ); ?>"
		>

		<table
			class="realgh_widget_link_list"
			width="100%"
			style="border-collapse: collapse;margin-bottom: 10px;"
		>
			<tbody>
				<tr>
					<td style="width: 50%; border: 1px solid #000;">
						<p class="title text--fz-18"><?php echo esc_html__('Enter the page to which the link leads', 'realgh'); ?></p>
					</td>
					<td style="width: 50%; border: 1px solid #000;">
						<p class="title text--fz-18"><?php echo esc_html__('Enter link text', 'realgh'); ?></p>
					</td>
				</tr>
				<?php
				if ( $texts ) :
					for ($i = 0; $i < count($texts); $i++) {
						?>
						<tr>
							<td>
								<input
									type="text"
									name="<?php echo $this->get_field_name('realgh_values') ?>[]"
									value="<?php echo esc_attr__( $values[$i] ); ?>"
									placeholder="<?php echo esc_attr__('Link value', 'realgh'); ?>"
								/>
							</td>
							<td>
								<input
									type="text"
									name="<?php echo $this->get_field_name('realgh_texts') ?>[]"
									value="<?php echo esc_attr__( $texts[$i] ); ?>"
									placeholder="<?php echo esc_attr__('Link text', 'realgh'); ?>"
									/>
							</td>
							<td>
								<button class="button remove-row">
									<?php echo esc_html__('Remove', 'realgh'); ?>
								</button>
							</td>
						</tr>
						<?php
					}
				endif; ?>
				<template class="empty-row custom-repeter-text">
					<tr>
						<td>
							<input
								type="text"
								name="<?php echo $this->get_field_name('realgh_values') ?>[]"
								placeholder="<?php echo esc_attr__('Link value', 'realgh'); ?>"
							/>
						</td>
						<td>
							<input
								type="text"
								name="<?php echo $this->get_field_name('realgh_texts') ?>[]"
								placeholder="<?php echo esc_attr__('Link text', 'realgh'); ?>"
							/>
						</td>
						<td>
							<button class="button remove-row">
								<?php echo esc_html__('Remove', 'realgh'); ?>
							</button>
						</td>
					</tr>
				</template>
			</tbody>
		</table>
		<button class="button add-row">
			<?php echo esc_html__('Add', 'realgh'); ?>
		</button>

		<?php
	}

	/**
	 * Sanitize widget form values as they are saved. onclick="widgetColumnBtnsInit(event)"
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['realgh_title'] = ( ! empty( $new_instance['realgh_title'] ) ) ? sanitize_text_field( $new_instance['realgh_title'] ) : '';

		if (!empty($new_instance['realgh_texts'])) {
			for ($i = 0; $i < count($new_instance['realgh_texts']); $i++) { 
				$instance['realgh_texts'][$i] =
					( !empty($new_instance['realgh_texts'][$i]) ) ?
					sanitize_text_field( $new_instance['realgh_texts'][$i] ) :
					'';
				$instance['realgh_values'][$i] =
					( !empty( $new_instance['realgh_values'][$i]) ) ?
					sanitize_text_field( $new_instance['realgh_values'][$i] ) :
					'';
			}
		}

		return $instance;
	}
}