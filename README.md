Plugin-Flickr
=============

Statamic plugin that adds a random flickr images block to your site


# Installation
## Copy the files to their destination
Download or clone this project on your system.
Add the contents of the folder to the `_add-ons/flickr` folder.

## Add the config values
Add the following info to the `_config/globals.yaml`

	# Flickr Random Images
	# Get your API key here: http://www.flickr.com/services/apps
	flickr_api_key: xxxxxxxxxxxxxxxxxx
	flickr_api_user: yyyyyyyyyy
	flickr_api_user_name: mwesten
	flickr_api_count: 9

Then fill the `flickr_api_user` by looking up your `flickr_api_user_name` on [this page](http://www.adamwlewis.com/articles/what-is-my-flickr-id).

Now create an API key on [http://www.flickr.com/services/apps](http://www.flickr.com/services/apps) and past the generated **private key** as the `flickr_api_key`.

## Add the flickr block to your template
Open the theme file (for example) `_themes/london-wild/partials/sidebar.html`
Add the following code in the location you want the random flickr images displayed:

    {{ flickr:sidebar key="{{flickr_api_key}}" user="{{flickr_api_user}}" name="{{flickr_api_user_name}}" count="{{flickr_api_count}}" }}



# Disclaimer
I've 'written' this plugin for my own use. It comes without any guarantee, so your mileage may vary in using it. If you find bugs or have great additions you'd like to share, use github to fork the project and share your improvements by initiating pull requests.