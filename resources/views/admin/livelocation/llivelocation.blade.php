<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description"
        content="SpeakerNet is a public speaker-finder service, full of speakers willing to give free / paid talks to groups such as Rotary, Lions, WI and U3A">
    <meta name="author" content="Novate Ltd">
    <meta name="google-site-verification" content="uvfZabSXiuz1K6EMZCzRwNIawxGgP5S9_bzqwYsZj7A" />
    <link rel="icon" href="../../favicon.ico">
    <title>SpeakerNet - mapping interesting speakers</title>

    <!-- OG: stuff -->
    <meta property="og:title" content="SpeakerNet" />
    <meta property="og:image" content="https://speakernet.co.uk/images/ogcover.png" />
    <meta property="og:description"
        content="SpeakerNet is a public speaker-finder service, full of speakers willing to give free or paid talks to groups such as Rotary, Lions, WI and U3A" />
    <meta property="og:url" content="https://speakernet.co.uk/map" />

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--Font Awesome -->
    <link rel="stylesheet" href="/font-awesome-4.6.3/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">



    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/css/bootstrap-dialog.min.css"
        rel="stylesheet" type="text/css" />

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for speakernet -->
    <link href="/css/app.css?0002" rel="stylesheet">
    <link href="/css/buttons.css?0002" rel="stylesheet">

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="/fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/fav/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/fav/favicon-16x16.png">
    <link rel="manifest" href="/fav/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/fav/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>



    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top header_bar">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">SpeakerNet</a>
                <p class="hidden-sm hidden-xs">Find speakers with interesting talks</p>

            </div>

            <div id="navbar" class="navbar-collapse collapse">

                <ul class="nav navbar-right nav-pills speakernav">
                    <li><a href="/talks">Browse Talks</a></li>
                    <li><a href="/map" class="active">Map Talks</a></li>

                    <li><a href="/pages/speaker">
                            Post a Talk
                        </a></li>
                    <li><a href="/login">
                            Login </a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>


    <div class="container main_content">


        <div class="row">

            <div class="col-md-9">
                <h2>Showing <span id='spkCount'></span><span id="filterText"></span></h2>

                <p id="filterPills"></p>



                <div id="map_canvas" style="height:680px"></div>
                <p
                    style='margin-top:10px; border:1px solid #ddd; border-radius:4px; padding:5px; background-color:#fcfcfc;'>
                    <img src="/images/SpeakernetSymbol_32x32_native.png" /> Speakers in your chosen region
                    &nbsp;&nbsp;&nbsp;<img src="/images/SpeakernetSymbol_32x32_native_red.png" /> Speakers that will
                    come to your chosen region
                </p>

            </div>

            <div class="col-md-3">
                <h2>Filter the Speakers</h2>
                <form class="form-horizontal talks-selector" method="post" action="/talks/filtered">
                    <input type="hidden" name="_token" value="3WvFCltl0eN7ybCmPM5r0n0W8TjgfP5kdIG8lGsL">


                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="category">Category</label>
                        <div class="col-sm-8">
                            <select class="form-control input-sm" id="category" name="category">
                                <option value="">Any</option>
                                <option value='13'>
                                    Business</option>
                                <option value='2'>
                                    Charity</option>
                                <option value='7'>
                                    Entertainment</option>
                                <option value='4'>
                                    Health</option>
                                <option value='1'>
                                    History</option>
                                <option value='8'>
                                    Hobbies</option>
                                <option value='12'>
                                    Humanities</option>
                                <option value='5'>
                                    Life Skills</option>
                                <option value='11'>
                                    Media</option>
                                <option value='10'>
                                    Nature</option>
                                <option value='6'>
                                    Science</option>
                                <option value='3'>
                                    Sports</option>
                                <option value='9'>
                                    Travel</option>
                                <option value='0'>
                                    Uncategorised</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="fee">Fees</label>
                        <div class="col-sm-8">
                            <select class="form-control input-sm" id="fee" name="fee">
                                <option value="">Any</option>
                                <option value='1'>
                                    Free</option>
                                <option value='2'>
                                    Expensed</option>
                                <option value='3'>
                                    Paid</option>
                                <option value='4'>
                                    Unknown</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="region">Region</label>
                        <div class="col-sm-8">
                            <select class="form-control input-sm" id="region" name="region">


                                <option class="level-0" value="" selected="selected">
                                    Anywhere
                                </option>


                                <option class="level-0" value="ENG">
                                    England
                                </option>


                                <option class="level-0" value="SE">
                                    &nbsp;
                                    South East
                                </option>


                                <option class="level-0" value="SW">
                                    &nbsp;
                                    South West
                                </option>


                                <option class="level-0" value="EE">
                                    &nbsp;
                                    East of England
                                </option>


                                <option class="level-0" value="LO">
                                    &nbsp;
                                    London
                                </option>


                                <option class="level-0" value="WM">
                                    &nbsp;
                                    West Midlands
                                </option>


                                <option class="level-0" value="EM">
                                    &nbsp;
                                    East Midlands
                                </option>


                                <option class="level-0" value="YH">
                                    &nbsp;
                                    Yorkshire &amp; Humber
                                </option>


                                <option class="level-0" value="NW">
                                    &nbsp;
                                    North West
                                </option>


                                <option class="level-0" value="NE">
                                    &nbsp;
                                    North East
                                </option>


                                <option class="level-0" value="SC">
                                    Scotland
                                </option>


                                <option class="level-0" value="ESC">
                                    &nbsp;
                                    Eastern Scotland
                                </option>


                                <option class="level-0" value="WSC">
                                    &nbsp;
                                    Western Scotland
                                </option>


                                <option class="level-0" value="WA">
                                    Wales
                                </option>


                                <option class="level-0" value="NI">
                                    Northern Ireland
                                </option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="recency">Updated</label>
                        <div class="col-sm-8">
                            <select class="form-control input-sm" id="recency" name="recency">
                                <option value="">Anytime</option>
                                <option value="30">Last 30 days</option>
                                <option value="180">Last 6 months</option>
                                <option value="365">Last 12 months</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="notice">Notice</label>
                        <div class="col-sm-8">
                            <select class="form-control input-sm" id="notice" name="notice">
                                <option value="">Regular</option>
                                <option value="Short">Short (&lt; 1 month)</option>
                                <option value="Emergency">Emergency (&lt;1 week)</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="notice">Online</label>
                        <div class="col-sm-8">
                            <select class="form-control input-sm" id="online" name="online">
                                <option value="">Any</option>
                                <option value='3'>
                                    Yes, group must organise</option>
                                <option value='4'>
                                    Yes, speaker facilitated</option>
                            </select>
                        </div>
                    </div>
                </form>

                <br />
                <br />
                <h3>Email me</h3>
                <p>Send me talks matching this search to my inbox every month</p>
                <form action="/mailout" method="post">
                    <div class="form-group">
                        <input type="email" class="span12 form-control" disabled="disabled"
                            placeholder="Subscriptions coming soon">
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right ">Email me talks</button>
                        </div>
                    </div>

                </form>
                <br />
                <h3>Pot Luck Tags</h3>
                <p>A random selection of tags</p>
                <a href="https://speakernet.co.uk/tagged/bees-beekeeping">Bees Beekeeping</a>
                | <a href="https://speakernet.co.uk/tagged/cyprus">Cyprus</a>
                | <a href="https://speakernet.co.uk/tagged/winter">Winter</a>
                | <a href="https://speakernet.co.uk/tagged/world-wildlife">World Wildlife</a>
                | <a href="https://speakernet.co.uk/tagged/bounty">Bounty</a>
                | <a href="https://speakernet.co.uk/tagged/funny-poems">| Funny Poems</a>
                | <a href="https://speakernet.co.uk/tagged/travel">Travel</a>
                | <a href="https://speakernet.co.uk/tagged/triathlon">Triathlon</a>
                | <a href="https://speakernet.co.uk/tagged/social-reformers">Social Reformers</a>
                | <a href="https://speakernet.co.uk/tagged/inclusion">Inclusion</a>
                | <a href="https://speakernet.co.uk/tagged/your-purpose">Your Purpose</a>
                | <a href="https://speakernet.co.uk/tagged/vietnam-war">Vietnam War</a>
                | <a href="https://speakernet.co.uk/tagged/kolmanskoppe-ghost-town">Kolmanskoppe Ghost Town</a>
                | <a href="https://speakernet.co.uk/tagged/environmental">Environmental</a>
                | <a href="https://speakernet.co.uk/tagged/carthage">Carthage</a>
                | <a href="https://speakernet.co.uk/tagged/harley-davidson">Harley Davidson</a>
                | <a href="https://speakernet.co.uk/tagged/giantveg">Giantveg</a>
                | <a href="https://speakernet.co.uk/tagged/bees">Bees</a>
                | <a href="https://speakernet.co.uk/tagged/potholing">Potholing</a>
                | <a href="https://speakernet.co.uk/tagged/byzantine">Byzantine</a>
                | <a href="https://speakernet.co.uk/tagged/writer">Writer</a>
                | <a href="https://speakernet.co.uk/tagged/celebrating">Celebrating</a>
                | <a href="https://speakernet.co.uk/tagged/gender">Gender</a>
                | <a href="https://speakernet.co.uk/tagged/marketing">Marketing</a>
                | <a href="https://speakernet.co.uk/tagged/water-colour">Water Colour</a>
                <h4><a href="https://speakernet.co.uk/tagged">List of all tags <i class="fa fa-tag"> </i></a></h4>
                <p>&nbsp;</p>

                <div>
                    <h2>Search database</h2>
                    <form class="form" action="https://speakernet.co.uk/search" method="get"
                        name="combinedsearch" id="combinedsearch">
                        <input type="text" class="form-control" placeholder="search term" name="q" id="q" />
                        <button class="btn btn-default col-md-6" style="margin:8px 8px 0 0;" name="speakers"
                            type="submit">Speakers</button>
                        <button class="btn btn-default col-md-5" style="margin:8px 0 0 8px;" name="talks"
                            type="submit">Talks</button>
                    </form>
                </div>
            </div>
        </div>


    </div>


    </div> <!-- /container -->

    <div class="js-cookie-consent cookie-consent">

        <span class="cookie-consent__message">
            SpeakerNet will be sending cookies to your browser to track your activity on this site
        </span>

        <button class="js-cookie-consent-agree cookie-consent__agree">
            I'm ok with this
        </button>

    </div>

    <script>
        window.laravelCookieConsent = (function() {

            const COOKIE_VALUE = 1;

            function consentWithCookies() {
                setCookie('speakernet_cookie_consent', COOKIE_VALUE, 7300);
                hideCookieDialog();
            }

            function cookieExists(name) {
                return (document.cookie.split('; ').indexOf(name + '=' + COOKIE_VALUE) !== -1);
            }

            function hideCookieDialog() {
                const dialogs = document.getElementsByClassName('js-cookie-consent');

                for (let i = 0; i < dialogs.length; ++i) {
                    dialogs[i].style.display = 'none';
                }
            }

            function setCookie(name, value, expirationInDays) {
                const date = new Date();
                date.setTime(date.getTime() + (expirationInDays * 24 * 60 * 60 * 1000));
                document.cookie = name + '=' + value + '; ' + 'expires=' + date.toUTCString() + ';path=/';
            }

            if (cookieExists('speakernet_cookie_consent')) {
                hideCookieDialog();
            }

            const buttons = document.getElementsByClassName('js-cookie-consent-agree');

            for (let i = 0; i < buttons.length; ++i) {
                buttons[i].addEventListener('click', consentWithCookies);
            }

            return {
                consentWithCookies: consentWithCookies,
                hideCookieDialog: hideCookieDialog
            };
        })();
    </script>

    <footer class="container">
        <div class="row">
            <div class="col-md-6">
                <p>Site by <a href="http://novate.co.uk">Novate</a> | Copyright 2021 © Novate Ltd</p>
            </div>
            <div class="col-md-6 text-right">
                <ul class="list-inline footer-menu">
                    <li><a href="https://donations.speakernet.co.uk">Donate</a></li>
                    <li><a href="/pages/terms">Terms</a></li>
                    <li><a href="/pages/privacy">Privacy</a></li>
                    <li><a href="/pages/contact">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->

    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="/bootstrap/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/js/bootstrap-dialog.min.js"></script>

    <script src="/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
    <!--before yield -->
    <script>
        var map;
        var speaker_markers = new Array();
        var speaker_pins = new Array();
        var infowindow;
        var mapScheme;

        window.onload = function() {
            initMap();
            applyFilter('');
            monitorFilters(map);
        };

        function initMap(details) {

            var myOptions = {
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: true,
                scaleControl: true,
                streetViewControl: false,
                center: {
                    lat: 53.802,
                    lng: -1.261
                },
                zoom: 7,
                draggableCursor: 'default',
                styles: mapScheme,
            };

            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

            infowindow = new google.maps.InfoWindow({
                content: 'Please wait',
                pixelOffset: new google.maps.Size(0, -16),
            });

            recenter(map);
            return map;
        }

        function recenter(map) {
            axios.get('https://speakernet.co.uk/map/recenter')
                .then(function(response) {
                    map.panTo({
                        lat: parseFloat(response.data.lat),
                        lng: parseFloat(response.data.lng)
                    });
                    map.setZoom(parseInt(response.data.z));
                });
        }

        function loadMarkers(map) {
            infowindow.close();

            // clear any current markers
            speaker_pins.forEach(function(marker) {
                marker.setMap(null);
            });
            speaker_pins = [];
            speaker_markers = [];

            axios.get('https://speakernet.co.uk/map/speakers')
                .then(function(response) {

                    response.data.forEach(function(speaker, index) {
                        addSpeakerMarker(speaker, infowindow, index);
                    });

                    updateSpeakerCount(response.data.length);
                })
                .catch(function(response) {
                    console.log(response);
                });

        }

        function updateSpeakerCount(count) {
            document.getElementById('spkCount').textContent = count;
            $('#spkCount').addClass('spkCountChanged');
            setTimeout(function() {
                $('#spkCount').removeClass('spkCountChanged');
            }, 3000);
        }

        function addSpeakerMarker(speaker, infowindow, index) {
            var dodge = new Array(
                [0, 0],
                [+0.006, -0.01],
                [-0.006, +0.01],
                [-0.006, -0.01],
                [+0.006, +0.01],
                [+0.006, 0],
                [+0, +0.01],
                [+0, -0.01],
                [-0.006, 0]
            );

            region = document.getElementById('region').value

            if (region == '' || speaker.regioncode == region) {
                icon = '/images/SpeakernetSymbol_32x32_native.png'

            } else {
                icon = '/images/SpeakernetSymbol_32x32_native_red.png'
            }

            var pin = new google.maps.Marker({
                position: {
                    lat: parseFloat(speaker.latitude) + parseFloat(dodge[index % 9][0]),
                    lng: parseFloat(speaker.longitude) + parseFloat(dodge[index % 9][1])
                },
                map: map,
                icon: icon
            });

            speaker_markers.push(speaker);
            speaker_pins.push(pin);

            google.maps.event.addListener(pin, 'click', function(ev) {
                infowindow.setPosition(ev.latLng);
                infowindow.open(map);
                infowindow.setContent(speaker.speaker.replace(/\b\w/g, function(l) {
                    return l.toUpperCase()
                }));
                fillCard(speaker, map, infowindow);
            }, {
                passive: true
            });

        }

        function fillCard(speaker, map, infowindow) {
            url = '/map/speaker/' + speaker.id + '?lat=' + map.getCenter().lat() + '&lng=' + map.getCenter().lng() + '&z=' +
                map.getZoom();

            axios.get(url)
                .then(function(response) {
                    infowindow.setContent(response.data);
                })
                .catch(function(response) {
                    console.log(response);
                });

        }

        function monitorFilters(map) {
            $('#category').on('change', function() {
                applyFilter('cat=' + this.value);
            });

            $('#fee').on('change', function() {
                applyFilter('fee=' + this.value);
            });

            $('#region').on('change', function() {
                applyFilter('region=' + this.value);
            });

            $('#recency').on('change', function() {
                applyFilter('recency=' + this.value);
            });

            $('#notice').on('change', function() {
                applyFilter('notice=' + this.value);
            });

            $('#online').on('change', function() {
                applyFilter('online=' + this.value);
            });
        }

        function applyFilter(filter) {
            axios.post('/filter?' + filter)
                .then(function(response) {
                    loadMarkers(map);
                    setFilters(response.data);
                    setFilterString(response.data);
                });
        }

        function setFilters(filters) {
            filterItems = (Object.keys(filters));
            var filterString = '';
            filterItems.forEach(function(item) {
                filterString += '<span class="filterpill">' + filters[item] +
                    '<a href="#" onclick="removeFilter(\'' + item + '\')">X</a></span>';
            });

            document.getElementById('filterPills').innerHTML = filterString;
        }

        function setFilterString(filters) {
            if (Object.keys(filters).length > 0) {
                document.getElementById('filterText').innerHTML = ' speakers matching your filters';
            } else {
                document.getElementById('filterText').innerHTML = ' speakers, with no filters applied';
            }
        }

        function removeFilter(filter) {
            axios.delete('/removefilter/' + filter)
                .then(function(response) {
                    loadMarkers(map);
                    setFilters(response.data);
                    setFilterString(response.data);
                    $('#' + filter).get(0).selectedIndex = 0;
                });
        }

        mapScheme = [{
                "featureType": "administrative.country",
                "elementType": "labels.text",
                "stylers": [{
                    "visibility": "off"
                }]
            },
            {
                "featureType": "administrative.land_parcel",
                "elementType": "geometry.fill",
                "stylers": [{
                        "saturation": "100"
                    },
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [{
                        "hue": "#FFBB00"
                    },
                    {
                        "saturation": 43.400000000000006
                    },
                    {
                        "lightness": 37.599999999999994
                    },
                    {
                        "gamma": 1
                    }
                ]
            },
            {
                "featureType": "landscape.natural.landcover",
                "elementType": "geometry.fill",
                "stylers": [{
                        "lightness": "-45"
                    },
                    {
                        "saturation": "-66"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "all",
                "stylers": [{
                        "hue": "#00FF6A"
                    },
                    {
                        "saturation": -1.0989010989011234
                    },
                    {
                        "lightness": 11.200000000000017
                    },
                    {
                        "gamma": 1
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "geometry.fill",
                "stylers": [{
                        "visibility": "on"
                    },
                    {
                        "saturation": "-68"
                    },
                    {
                        "lightness": "35"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers": [{
                        "hue": "#FFC200"
                    },
                    {
                        "saturation": -61.8
                    },
                    {
                        "lightness": 45.599999999999994
                    },
                    {
                        "gamma": 1
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "all",
                "stylers": [{
                        "hue": "#FF0300"
                    },
                    {
                        "saturation": -100
                    },
                    {
                        "lightness": 51.19999999999999
                    },
                    {
                        "gamma": 1
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "all",
                "stylers": [{
                        "hue": "#FF0300"
                    },
                    {
                        "saturation": -100
                    },
                    {
                        "lightness": 52
                    },
                    {
                        "gamma": 1
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "all",
                "stylers": [{
                        "hue": "#0078FF"
                    },
                    {
                        "saturation": -13.200000000000003
                    },
                    {
                        "lightness": 2.4000000000000057
                    },
                    {
                        "gamma": 1
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry.fill",
                "stylers": [{
                        "visibility": "on"
                    },
                    {
                        "saturation": "-40"
                    }
                ]
            }
        ]
    </script>

    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzs0w3oI-Hr_E2NG2wTDUgiSB9hFRMigg&v=3"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-89707455-1', 'auto');
        ga('send', 'pageview');
    </script>

    <!-- Start Responsly Code -->

    <!-- End Responsly Code -->

</body>

</html>
{{-- //*.local, 169.254/16 --}}
