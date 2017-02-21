<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    html,body
    {
        height: 100%;
    }
</style>
<script src="js/mustache.min.js"></script>
<script
    src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>

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

<script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript">
    $(document).ready(function() {
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


    });
</script>
<link rel="stylesheet" href="css/materialize.min.css">
<script src="js/materialize.min.js"></script>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
