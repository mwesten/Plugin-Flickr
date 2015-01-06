Plugin-Flickr
=============

Statamic plugin that adds a random flickr images block to your site.
Uses JS for the api-calls, and image-injection; so even if you [generate static
HTML pages](http://statamic.com/learn/advanced-features/html-caching) from your statamic site, it just works.

Tested with Statamic version v1.9.2


# Installation
## Clone or Copy the files to their destination
Clone this project on your system:

    cd webfolder/_add-ons
    git clone git://github.com/mwesten/Plugin-Flickr.git flickr

Or download the project and add the contents of archive to the `_add-ons/flickr` folder.

## Add the config file
Then copy the contents from the plugin ```_config/add-ons/flickr``` folder to the ```_config/add-ons/flickr``` folder from your statamic site.

The file `_config/add-ons/flickr/flickr.yaml` then contains:

	# Flickr Random Images
	# Get your API key here: http://www.flickr.com/services/apps
	flickr_api_key: xxxxxxxxxxxxxxxxxx
	flickr_api_user: yyyyyyyyyy
	flickr_api_user_name: mwesten
	flickr_api_count: 9


Then fill the `flickr_api_user` by looking up your `flickr_api_user_name` on [this page](http://idgettr.com/).
Then enter your user page: `https://www.flickr.com/photos/mwesten` and press the Find button.
The returned *id* must be filled in the `flickr_api_user` field.

Now create an API key on [http://www.flickr.com/services/apps](http://www.flickr.com/services/apps) and paste the generated **private key** as the `flickr_api_key`.

## Add the flickr block to your template
Open the theme file (for example) `_themes/acadia/partials/keep-in-touch.html`
Add the following code in the location you want the random flickr images displayed:

    {{ flickr:sidebar key="{ flickr_api_key }" user="{ flickr_api_user }" name="{ flickr_api_user_name }" count="{ flickr_api_count }" }}



# Disclaimer
I've 'written' this plugin for my own use. It comes without any guarantee, so your mileage may vary in using it. If you find bugs or have great additions you'd like to share, use github to fork the project and share your improvements by initiating pull requests.
