<?php
/*
Plugin Name: ACF Taxonomy Shortcode Extended
Description: Enables shortcode for Taxonomy field type of Advanced Custom Fields plugin.  Based on Azur Avdic's work.
Version: 1.0
Author: Topher
Author URI: https://www.heropress.com/
*/


function acf_taxonomy_term_shortcode( $atts = [] ) {

	$output = '';

	if ( empty( $atts ) ) {
		exit;
	}

	$term = get_the_terms( get_the_ID(), $atts['tax'] );

	if ( ! empty( $term ) ) {
		$term = $term[0];
	}

	if( ! empty( $atts['tax_field'] ) && 'name' == $atts['tax_field'] ) {
    		$output .= esc_html( $term->name );
	}

	if( ! empty( $atts['tax_field'] ) && 'description' == $atts['tax_field'] ) {
    		$output .= esc_html( $term->description );
	}

	if( ! empty( $atts['tax_field'] ) && 'image' == $atts['tax_field'] ) {
		$image = get_field('instructor_image', $term);
    		$output .= '<img src="' . esc_url( $image['sizes'][ $atts['image_size'] ] ) . '"  alt="' . esc_attr( $image['alt'] ) . '" width="' . esc_attr( $image['sizes'][ $atts['image_size'] . '-width' ] ) . '" height=' . esc_attr( $image['sizes'][ $atts['image_size'] . '-height' ] ) . '">';
	}

	return $output;
}
add_shortcode( 'acftts', 'acf_taxonomy_term_shortcode' );
