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

	// Make sure we have input
	if ( empty( $atts ) ) {
		exit;
	}

	// go get all the terms for this post from the given taxonomy
	$term = get_the_terms( get_the_ID(), $atts['tax'] );

	// if we got any, only take the first one
	if ( ! empty( $term ) ) {
		$term = $term[0];
	}

	// if they ask for name, add that to the output
	if( ! empty( $atts['tax_field'] ) && 'name' == $atts['tax_field'] ) {
    		$output .= esc_html( $term->name );
	}

	// if they ask for description add that to the output
	if( ! empty( $atts['tax_field'] ) && 'description' == $atts['tax_field'] ) {
    		$output .= esc_html( $term->description );
	}

	// if they ask for image get the ACF image field and add an image tag to the output
	if( ! empty( $atts['tax_field'] ) && 'image' == $atts['tax_field'] ) {
		$image = get_field('instructor_image', $term);
    		$output .= '<img src="' . esc_url( $image['sizes'][ $atts['image_size'] ] ) . '"  alt="' . esc_attr( $image['alt'] ) . '" width="' . esc_attr( $image['sizes'][ $atts['image_size'] . '-width' ] ) . '" height=' . esc_attr( $image['sizes'][ $atts['image_size'] . '-height' ] ) . '">';
	}

	return $output;
}
add_shortcode( 'acftts', 'acf_taxonomy_term_shortcode' );
