# wp-graphql-comments-gravatar
This plugin adds a authorGravatarUrl field to comments when fetched using the WPGraphQL plugin.

## Why?
The official WP-GraphQL does its best (correctly) to ensure that private data is not exposed through calls. The Gravatar URL uses the commenters e-mail address to create a hash that is used to index a graphic file on their servers. This e-mail address though isn't a publicly available piece of data - with good privacy reasons. But that means you can't get a Gravatar image for comments through GraphQL unless you're authenticated and authorized. I couldn't be bothered to authenticate against my GraphQL endpoint for just this one piece of information that's actually publicly available in my comments section, so I added this.

To my knowledge this does not expose any information that isn't already available on a WordPress website with comments.

# Installation
Clone this repository into your WordPress plugins folder, then activate it via the WordPress dashboard.

# Configuration
There's currently no configuration available from the WordPress dashboard - but the plugin is so tiny that you should be able to edit it to adjust which Avatar you want returned and sizes and so on.

# Issues
I have absolutely no idea if this is the right way to do it. I've taken inspiration from the WP-GraphQL-Dad-Jokes plugin. It's likely there's some reason that the authorGravatarUrl shouldn't appear where I've put it within the schema. But it works for me. If you're a WP-GraphQL officianado and would like it changed please let me know :)

