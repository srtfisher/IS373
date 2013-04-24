<?php
error_reporting(-1)
ini_set('display_errors', 'on');

if (isset($_GET['url'])) :
  require('dom.php');
  
  $dom = file_get_html($_GET['url']);
  $meta = $dom->find('meta[property="entity-share:video"]', 0);

  if ($meta == NULL)
    die( json_encode(['error' => 'Invalid URL']));
  var_dump($meta->content);
  exit;
  $json = file_get_contents('./video.json');
  $json = json_decode($json);

  $video_html = '<video width="400" preload="metadata" controls>';
  foreach($json->video as $v)
    $video_html .= '<source src="'.$v->url.'" type="'.$v->type.'" />';
    
  $video_html .= '</video>';

  $json->video = $video_html;

  echo json_encode($json);
  exit;
endif;
?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Video Standard Example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="entity-share:video" content="/video.json">

    <!-- Le styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/js/html5shiv.js"></script>
    <![endif]-->
  <style type="text/css"></style><meta name="chromesniffer" id="chromesniffer_meta" content="{&quot;Bootstrap&quot;:-1}"><script type="text/javascript" src="chrome-extension://homgcnaoacgigpkkljjjekpignblkeae/detector.js"></script></head>

  <body class=" hasGoogleVoiceExt">

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          
          <a class="brand" href="/">IS 373 Group 5</a>
        </div>
      </div>
    </div>

    <div class="container">

      <h1>Improve Video Embedding Standard: Server Side</h1>
      <p>We're going to demonstrate the standard in a real-world situation.</p>

      <p><a href="/" class="btn btn-primary btn-large">Article Example</a></p>

      <!-- .row -->

      <hr />
      <div class="container">
        <form>
          <input type="text" placeholder="http://" disabled value="http://<?php echo $_SERVER['HTTP_HOST']; ?>/video.php" id="video-input" class="span8" />

          <button type="submit" class="btn btn-primary btn-large" id="form-btn">Get Videos</button>
        </form>
      </div>

      <div class="container" id="results-container" style="display:none;">
        <hr />
        <div class="well">
          <table class="table">
            <tr>
              <th>Video Title</th>
              <td id="video-title"></td>
            </tr>

            <tr>
              <th>Video Description</th>
              <td id="video-description"></td>
            </tr>

            <tr>
              <th>Video Thumbnail</th>
              <td id="video-thumbnail"></td>
            </tr>

            <tr>
              <th>Video</th>
              <td id="video-embed"></td>
            </tr>
          </table>
        </div>
      </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

  
    <script type="text/javascript">
    $(document).ready(function()
    {
      $('form').submit(function(d)
      {
        d.preventDefault();

        $.get('/ssi-example.php', {
          url: $('#video-input').val()
        }, function(result)
        {
          $('#video-title').html(result.title);
          $('#video-description').html(result.description);
          $('#video-thumbnail').html(result.thumbnail);
          $('#video-embed').html(result.video);

          $('#results-container').slideDown();
        }, 'json');
      });
    });
    </script>
</body></html>