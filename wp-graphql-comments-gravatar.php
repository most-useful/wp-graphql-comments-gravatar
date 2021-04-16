<?php
/**
 * Plugin Name:     WPGraphQL Generate Gravatar URL For Comments
 * Plugin URI:      https://github.com/snibbo71/wp-graphql-comments-gravatar
 * Description:     A WPGraphQL Extension that adds a field to comments which will generate
 * 					a Gravatar URL using your WordPress installation.
 * Author:          Steve Brown
 * Author URI:      https://www.most-useful.com/
 * Version:         1.0.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Note that unless you have Jason Bahl's WPGraphQL WordPress plugin, this will do nothing */
add_action( 'graphql_register_types', function() {

	register_graphql_field( 'Comment', 'authorGravatarUrl', [
		'type' => 'String',
		'description' => 'Adds a Gravatar URL to the Comment Author',
		'resolve' => function( \WPGraphQL\Model\Comment $comment, $args, $context, $info ) {

			// Note, this looks cumbersome, but we do not have access to the actual WPComment object inside
			// the $comment variable, and we cannot get the comment author's email address through the GraphQL
			// Model if we're not authenticated. Which is right and correct. But we can get the commentId and then
			// fetch the comment for ourselves. So it is cumbersome but necessary.
			$commentId = $comment->__get('commentId');
			$wp_comment = get_comment($commentId);
			// Change these if you want different options for your Gravatars
			$args = [
				"size" => "60",
				"default" => "robohash",
				"rating" => "g"
			];
			$gravUrl = get_avatar_url($wp_comment, $args);
			if ( $gravUrl === false ) {
				// Some comments don't seem to have an email address it seems and come back
				// as false. This traps that and returns a default URL because my use case could not
				// deal with a null or false return.
			    $gravUrl = 'https://www.gravatar.com/avatar/00000000000000000000000000000000?s=60';
			}
			return $gravUrl;
		},
	]);

} );