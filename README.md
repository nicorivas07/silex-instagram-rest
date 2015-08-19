silex-instagram-rest
====================
This API returns information about the location of an Instagram media id.
It connected to Instagram API to get the coordinates, name and location id through the media id. If it got the coordinates, the app connects to Google Place API for get additional information about de location.

Request
-------
```sh
GET /locations/instagram/{media_id}
```

Response
--------
```
{
    "id": instagram_media_id,
    "location": {
        "geopoint": {
            "latitude": latitude,
            "longitude": longitude
        },
        "reference": google_reference,
        "address": google_address,
        "id": instagram_location_id,
        "name": instagram_location_name
    }
}
```

Setup
-----
This Application is built with [Silex](http://silex.sensiolabs.org/) and needs [Composer](http://getcomposer.org/) to run.

```sh
$ git clone https://github.com/nicorivas07/silex-instagram-rest.git
$ cd silex-instagram-rest
$ sudo composer update #It may take a few minutes
```
Composer will create the project under the path/to/install directory.

Turn on a test enviroment server

```sh
$ cd path/to/install
$ composer run
```

Try endpoint
```
localhost:8888/locations/instagram/{media_id}
```
