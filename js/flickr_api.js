
// Insert the scripttag to call the Flickr API in the Head of the page
function flickrApiFetchScript(url) {
    (function(){
        var flickrJsonCall = document.createElement("script");
        flickrJsonCall.type = "text/javascript";
        flickrJsonCall.async = true;
        flickrJsonCall.src = url;
        document.getElementsByTagName("head")[0].appendChild(flickrJsonCall);
    })();
}


// The callback function that calls the Flickr_Api object
function flickrNS_show_images(r) {
    var fsi = new Flickr_Api();
    fsi.set_photos(r);
    fsi.show_images();
}

// The Flickr_Api object
function Flickr_Api() {
    var retdata;

    this.set_photos = function(i) {
        this.retdata = i;
    }

    this.show_images = function() {
        if (this.retdata.stat == "ok"){
            flickr_api_loaded = true;
            pickedItems = this.flickrApiGetRandom(this.retdata.photos.photo.length, flickr_api_show);
            this.flickrApiGetImageBlock (pickedItems);
        }
    }

    // returns an array containing [itemsToShow] numbers from the [total] number of images
    this.flickrApiGetRandom = function (total, itemsToShow) {
        var array = [], // array with all avaiilable numbers
            rnd, value, i,
            returnArray = []; // The array we return with unique random entries

        for (i = 0; i < total; i++) { // arrays are zero based, for 21 elements you want to go from index 0 to 20.
            array[i] = i + 1;
        }

        for (i = 0; i < itemsToShow; i++) { // pick numbers
            rnd = Math.floor(Math.random() * array.length);
            value = array.splice(rnd,1)[0]; // remove the selected number from the array and get it in another variable
            returnArray.push(value);
        }
        return returnArray;
    }
    // Inserts the images into the page
    this.flickrApiGetImageBlock = function (pickedItems) {
        var imageBlock = [];
        for (i=0; i < pickedItems.length; i++) {
            imageBlock.push("<div class=\"flickr_badge_image\" id=\"flickr_badge_image"+( i+1 ) +"\">");
            photo = this.retdata.photos.photo[pickedItems[i]];
            img_base = "http://farm"+photo.farm+".staticflickr.com/"+photo.server+"/"+photo.id+"_"+photo.secret;
            square_image = img_base+"_s.jpg";
            medium_image = img_base+"_m.jpg";
            big_image = img_base+"_b.jpg";
            subImage = "<img src=\""+square_image+"\" alt=\"A Flickr thumbnail image.\" title=\""+photo.title+"\" height=\"70\" width=\"70\"/>";
            link = "<a href=\""+big_image+"\" class=\"flickr_api_link lightbox\" rel=\"flickr_images\" title=\""+photo.title+"\">"+subImage+"</a>";
            imageBlock.push(link);
            imageBlock.push("</div>");
        }
        document.getElementById(flickr_api_wrapper).innerHTML = imageBlock.join("\n");
    }

}



Flickr_Api.prototype = new Flickr_Api();
flickrApiFetchScript("http://"+flickr_api_base_url+"/?method=flickr.photos.search&api_key="+flickr_api_key+"&user_id="+flickr_api_user+"&privacy_filter=1&per_page="+flickr_api_poolsize+"&format=json&jsoncallback=flickrNS_show_images");
