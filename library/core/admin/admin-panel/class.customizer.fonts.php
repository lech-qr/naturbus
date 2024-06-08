<?php 

if( class_exists( 'WP_Customize_Control' ) ) :
	class Autozone_Google_Fonts_Control extends WP_Customize_Control {
 
		public function render_content() {

		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?> class="pix-google-font" data-value="<?php echo esc_attr( $this->value() ) ?>">
					<option value=""><?php esc_html_e('Select Google Font', 'autozone') ?></option>
				</select>
			</label>
		<?php
		}
	}
endif;

if( class_exists( 'WP_Customize_Control' ) ) :
	class Autozone_Google_Font_Weight_Control extends WP_Customize_Control {

		public $hidden_class = '';
		public $container_class = '';

		public function render_content() {

		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<input type="text" <?php $this->link(); ?> id="<?php echo esc_attr( $this->hidden_class ) ?>" value="<?php echo esc_attr( $this->value() ) ?>">
			</label>
			<div id="<?php echo esc_attr( $this->container_class ) ?>" class="pix-font-wight-content"></div>
		<?php
		}
	}
endif;

if( class_exists( 'WP_Customize_Control' ) ) :
	class Autozone_Google_Font_Weight_Single_Control extends WP_Customize_Control {

		public $container_class = '';

		public function render_content() {

		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?> id="<?php echo esc_attr( $this->container_class ) ?>_weight" data-value="<?php echo esc_attr( $this->value() ) ?>">
					<option value=""><?php esc_html_e('Default', 'autozone') ?></option>
				</select>
			</label>
		<?php
		}
	}
endif;