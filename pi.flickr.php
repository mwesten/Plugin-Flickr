<?php

  class Plugin_flickr extends Plugin {

    var $meta = array(
      'name'       => 'Flickr',
      'version'    => '0.2',
      'author'     => 'Max Westen',
      'author_url' => 'http://dlmax.org'
    );

    function __construct() {
      parent::__construct();
      $this->site_root  = Config::getSiteRoot();
      $this->theme_root = Config::getTemplatesPath();
      $this->plugin_path = $this->getPluginPath();
    }


    function sidebar() {
      $key = $this->fetchParam('key', $this->config['flickr_api_key'], false, false, false); // flickr api key defaults to none
      $user = $this->fetchParam('user', $this->config['flickr_api_user'], false, false, false); // Flickr user ID defaults to none
      $name = $this->fetchParam('name', $this->config['flickr_api_user_name'], false, false, false); // Flickr username defaults to none
      $count = $this->fetchParam('count', $this->config['flickr_api_count'], 'is_numeric'); // number of images defaults to 9
      $poolsize = $this->fetchParam('poolsize', 150, 'is_numeric'); // defaults to 150

      $output = '
      <style type="text/css">
        #flickr_badge_wrapper {padding:10px 0 10px 0;}
        .flickr_badge_image {margin: 0 0px 2px 0px;display: inline-block;}
      </style>
      <div id="flickr_api_uber_wrapper">
        <div class="flickr_api_images" id="flickr_wrapper">
          Fetching images...
        </div>
      </div>
      <p><a href="http://flickr.com/photos/'.$name.'">More Flickr images &raquo;</a></p>
      ';

      $script = '
        <script type="text/javascript">
          var flickr_api_key = "'.$key.'";
          var flickr_api_user = "'.$user.'";
          var flickr_api_poolsize = '.$poolsize.';
          var flickr_api_show = '.$count.';
          var flickr_api_wrapper = "flickr_wrapper"; // id target for imagelist
          var flickr_api_base_url	= "api.flickr.com/services/rest";

          document.addEventListener("DOMContentLoaded", function(event) {
            (function(){
              var flickrapiInit = document.createElement("script");
              flickrapiInit.type = "text/javascript";
              flickrapiInit.async = true;
              flickrapiInit.src = "'.$this->plugin_path.'/js/flickr_api.js";
              document.getElementsByTagName("head")[0].appendChild(flickrapiInit);
            })();
          });
        </script>
      ';

      return $output . $script;
    }


    /**
     * Returns the path of this plugin folder.
     * @return string
     */
    private function getPluginPath() {
      $plugindir = basename(dirname(__FILE__));
      $parentdir = basename(dirname(dirname(__FILE__)));
      $pluginpath = Path::trimSlashes($this->site_root.'/'.$parentdir .'/' . $plugindir."/");

      return $pluginpath;
    }

  }
