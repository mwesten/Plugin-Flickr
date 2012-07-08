<?php

  class Plugin_flickr extends Plugin {

    var $meta = array(
      'name'       => 'Flickr',
      'version'    => '0.1',
      'author'     => 'Max Westen',
      'author_url' => 'http://dlmax.org'
    );

    function __construct() {
      parent::__construct();
      $this->site_root  = Statamic::get_site_root();
      $this->theme_root = Statamic::get_templates_path();
      $this->plugin_path = $this->getPluginPath();
    }


    function sidebar() {
      $key = $this->fetch_param('key', null, false, false, false); // flickr api key defaults to none
      $user = $this->fetch_param('user', null, false, false, false); // Flickr user ID defaults to none
      $name = $this->fetch_param('name', null, false, false, false); // Flickr username defaults to none
      $count = $this->fetch_param('count', 9, 'is_numeric'); // number of images defaults to 9
      $poolsize = $this->fetch_param('poolsize', 150, 'is_numeric'); // defaults to 150

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

          $(document).ready(function() {
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
      $pluginpath = Statamic_helper::reduce_double_slashes($this->site_root.'/'.$parentdir .'/' . $plugindir."/");

      return $pluginpath;
    }

  }