<?php
// load the config file
require_once('./config.php');

// set the page title
define("TITLE", ( SITE_NAME." - url shortener" ));

// check to see if a code has been supplied and process it
if (isset($_GET['code']) && strlen($_GET['code']) > 0) {

  // set basic header data and redirect the user to the url
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header("Cache-Control: no-cache");
  header("Pragma: no-cache");

  $code = sanitize($_GET['code']);

  // validate the 'code' against the database
  $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  $query = mysqli_query($conn, "SELECT * FROM short_links WHERE code='$code'");
  if (mysqli_num_rows($query) == 1) {

    // retrieve the data from the database
    $data = mysqli_fetch_assoc($query);
    
    $data['hit_count']++; 

    // update the hit coutner in the database
    mysqli_query($conn, "UPDATE short_links SET hit_count='".( $data['hit_count'] )."' WHERE id='".( $data['id'] )."'");

    /* ADD ANY EXTRA STUFF HERE, IF DESIRED */

    // actually redirect the user to their endpoint
    header("Location: " . $data['url']);
  } else
    $error = '<font class="text-danger">hmm... unable to find that url</font>';
}
?>
<!doctype html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Create a short url, quick and free with fii.sh url shortener. Written in php, fiish custom url shortener is open source. Download the php source code on GitHub.">
  <meta name="author" content="nickfrosty, Nick Frostbutter">
  <title><?php echo (defined("TITLE") ? TITLE : SITE_NAME); ?></title>

  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo SITE_LOGO; ?>">
  <link rel="icon" type="image/png" href="<?php echo SITE_LOGO; ?>">

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="<?php echo SITE_ADDR; ?>/assets/vendor/bootstrap/css/bootstrap.min.css">

  <!-- Custom styles for this template -->
  <!-- <link rel="stylesheet" href="<?php echo SITE_ADDR; ?>/assets/css/main.css"> -->
  <style>
    <?php 
      // load the 'main.css' stylesheet inline
      echo file_get_contents(ABSPATH . '/assets/css/main.css');
    ?>
  </style>
  <script>
    var SITE_ADDR = '<?php echo SITE_ADDR; ?>';
    
    // ready the sites javascript for use after the page has loaded
    window.onload = function() {
      
      // select the url text box on page load
      $("#url").focus();

      // process the form submission using javascript
      $("#form").submit(function(event) {
        $("#copy").hide();

        // get the url to be shortened
        var url = $("#url").val();
        if ($.trim(url) != '') {
          // submit all of the required data via post to the processing script
          $.post("./process.php", {
            url: url
          }, function(data) {
            // process the returned data from the post
            if (data.substring(0, 7) == 'http://' || data.substring(0, 8) == 'https://') {
              $("#url").val(data).focus();
              $("#copy").show();

              // display a success message to the user
              $("#message").html('enjoy your short url!');
            } else
              $("#message").html(data);
          });
        } else
          $("#message").text("enter a url to shorten");

        // select the text box after form submission
        $("#url").focus();
        // prevent the form from reloading the page
        return false;
      });

      // remove the 'copy' button after the url is changed
      $("#url").on('input', function(){
        $("#copy").hide();
      });

      // copy the short url to clipboard
      $("#copy").click(function() {
        var copyText = document.getElementById("url");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        $("#message").text("copied to clipboard");
        $("#url").val("");
      });
      $(".question").click(function() {
        $(".question").fadeOut(function() {
          $(".question").text("fsssh...").fadeIn();
        });
      });
    };
  </script>
  <?php if (defined(GOOGLE_ANALYTICS) && GOOGLE_ANALYTICS != '') { ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo GOOGLE_ANALYTICS; ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', '<?php echo GOOGLE_ANALYTICS; ?>');
    </script>
  <?php } ?>

</head>

<body>

  <article>
    <div class="">
      <h1>
        <a href="<?php echo SITE_ADDR; ?>"><img class="logo" alt="fii.sh url shortener" src="<?php echo SITE_LOGO; ?>" width="100" height="100"></img>
          fii.sh - url shortener</a>
      </h1>
      <h2 class="h4">a free, open source, and custom url shortener</h2>
    </div>

    <div class="clearfix"></div>

    <div class="row my-4">
      <div class="offset-sm-1 col-sm-10 col-xs-12 card shadow-sm p-5 bg-orange-light text-center">
        <form action="" method="post" id="form" onSubmit="return false;">
          <div class="input-group">
            <input type="text" id="url" class="form-control" value="" placeholder="enter a url" tabindex="1" active />
            <div class="input-group-prepend" id="copy" style="display:none;">
              <span class="input-group-text bg-orange-dark">copy</span>
            </div>
          </div>
          <br />
          <button type="submit" name="short" class="form-control btn w-75 bg-orange-dark" tabindex="2">make short</button>
        </form>
        <div id="message" class="mt-4"><?php echo (isset($error) ? $error : "let's do this thing");  ?></div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <p class="text-center text-sm question ask">psst... what do you call a fish with no eyes?</p>
      </div>
    </div>


    <div class="row">
      <div class="col-12">
        <h3 class="pb-3">Hi, welcome to <a href="https://fii.sh">fii.sh</a></h3>
        <p class="justify">My hope is that fii.sh will one day become a more complete open source url shortener. But for now, it has basic functionality and can create short urls. So it does what it must. Still being open source of course!</p>
        <p class="justify">If you need to, you can always find me on <a href="https://twitter.com/nickfrosty">twitter</a>. Otherwise, have a wonderful day! :)</p>
        <p class="mx-4">&mdash; Nick (<a href="https://twitter.com/nickfrosty">@nickfrosty</a>, <a href="https://github.com/nickfrosty">GitHub</a>)</p>
      </div>
    </div>

    <hr class="my-3" />
    <div class="row mb-2 text-sm">

      <div class="col-sm-8 col-xs-12">
        &copy; <?php echo date("Y"); ?> <a href="https://frostbutter.com" target="_blank">nick frostbutter</a>
      </div>

      <div class="col-sm-4 col-xs-12 float-right text-right">
        <a href="https://10h.dev/php/make-a-custom-url-shortener-in-php/">view tutorial</a> &bullet;
        <a href="https://github.com/nickfrosty/url-shortener">source code</a>
      </div>


    </div>

  </article>


  <script src="<?php echo SITE_ADDR; ?>/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
</body>
</html>