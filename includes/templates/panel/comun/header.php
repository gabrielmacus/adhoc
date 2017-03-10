<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    html,body
    {
        height: 100%;
    }
    .body
    {
        min-height: 100%;
    }
</style>
<script src="js/mustache.min.js"></script>
<script
    src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
<link rel="stylesheet" href="css/estilo.css">

<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,900" rel="stylesheet">

<meta charset="UTF-8">
<title><?php echo $config["name"] ?></title>
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link href="css/animate.css">
<link href="css/hover-min.css">
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvx6X4xIXCsdiOtDRBge3DuO7i4FgMyc8&callback=initMap">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<link rel="stylesheet" href="css/lity.min.css">
<script src="js/lity.min.js"></script>

<script src="js/helpers.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.min.js"></script>
<link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript">
    $(document).ready(function() {

            $('select').material_select();

        $('.modal').modal();



        var fbox= $(".fancybox").fancybox(
            {
                helpers : {
                    overlay : {
                        css : {
                            'background' : 'rgba(58, 42, 45, 0.95)'
                        }
                    }
                },
                openEffect:"fade"
            }
        );

        $('audio,video').mediaelementplayer({
            success: function(player, node) {
                

                // More code
            }
        });
    });
</script>
<link rel="stylesheet" href="css/materialize.min.css">
<script src="js/materialize.min.js"></script>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="js/fileReader.js"></script>

<style>
    /* Center the loader */
    #loader {
        position: fixed;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Add animation to "page content" */
    .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
        from { bottom:-100px; opacity:0 }
        to { bottom:0px; opacity:1 }
    }

    @keyframes animatebottom {
        from{ bottom:-100px; opacity:0 }
        to{ bottom:0; opacity:1 }
    }

    #myDiv {
        display: none;
        text-align: center;
    }
    .zoomOnHover
    {


        -webkit-transition: all 300ms linear;
        -moz-transition: all 300ms linear;
        -ms-transition: all 300ms linear;
        -o-transition: all  300ms linear;
        transition: all 300ms linear;
    }
    .zoomOnHover:hover
    {
        -webkit-transform: scale(1.2);
        -moz-transform: scale(1.2);
        -ms-transform: scale(1.2);
        -o-transform: scale(1.2);
        transform: scale(1.2);


    }




</style>
<div   class="loader" style=" display:none;position: fixed;top: 0px;left: 0px;z-index: 10000;background-color: rgba(0,0,0,0.7);height: 100%;width: 100%">

    <div id="loader"></div>



</div>

<script>
    $( document ).ajaxSend(function() {
       $(".loader").fadeIn();
    });
    $( document ).ajaxStop(
        function()
        {
            $(".loader").fadeOut();
        }
    );
</script>
<script src="https://cdn.jsdelivr.net/mediaelement/latest/mediaelement-and-player.min.js"></script>
<link href="https://cdn.jsdelivr.net/mediaelement/latest/mediaelementplayer.css" rel="stylesheet">
<script src="js/jscolor.min.js"></script>
<script src="js/js.cookie.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.js"></script>
