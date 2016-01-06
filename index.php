<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="jcrop/css/jquery.Jcrop.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  
  <style type="text/css">
    /* Apply these styles only when #preview-pane has
       been placed within the Jcrop widget */
    .jcrop-holder #preview-pane {
      display: block;
      position: absolute;
      z-index: 2000;
      top: 10px;
      right: -580px;
      padding: 6px;
      border: 1px rgba(0,0,0,.4) solid;
      background-color: white;

      -webkit-border-radius: 6px;
      -moz-border-radius: 6px;
      border-radius: 6px;

      -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
      -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
      box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
    }

    /* The Javascript code will set the aspect ratio of the crop
       area based on the size of the thumbnail preview,
       specified here */
    #preview-pane .preview-container {
      width: 400px;
      height: 400px;
      overflow: hidden;
    }

  </style>

  <title>Jcrop</title>
</head>
<body>
  <div class="container">
      <div class="row">
          <div id="preview-pane">
              <div class="preview-container">
                  <img src="images/na4.jpg" class="jc-image jcrop-preview" alt="Preview" id="image-preview" />
              </div>
          </div>
      </div>
      <div class="row">
          <div class="span12">
              <div class="jc-demo-box">

                  <div class="page-header">
                  </div>

                  <!-- This is the image we're attaching Jcrop to -->
                  <div class="row">
                    <img src="" id="crop-image" />
                  </div>

                  
                    
                  <div class="col-md-12">
                    <!-- This is the form that our event handler fills -->
                    <form id="jcrop-from" method="post">
                        <input type="file" id="select-image" name="image" accept="image/jpeg" />
                        <input type="hidden" id="x" name="x" value="0"/>
                        <input type="hidden" id="y" name="y" value="0"/>
                        <input type="hidden" id="w" name="w" value="0"/>
                        <input type="hidden" id="h" name="h" value="0"/>
                        <input type="submit" value="Crop Image" class="btn btn-large btn-inverse" />
                    </form>
                  </div>
              </div>
          </div>
      </div>
  </div>


  <script type="text/javascript" src="jcrop/js/jquery.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="jcrop/js/jquery.color.js"></script>
  <script type="text/javascript" src="jcrop/js/jquery.Jcrop.min.js"></script>
  
  <script type="text/javascript" src="custom.js"></script>
  <script type="text/javascript">
    $(function() {
      imagePreview()
      setEventSubmitForm(); 
    })
  </script>

  <script type="text/javascript">
    // Create variables (in this scope) to hold the API and image size
      var jcrop_api,
          boundx,
          boundy,

          // Grab some information about the preview pane
          $preview = $('#preview-pane'),
          $pcnt = $('#preview-pane .preview-container'),
          $pimg = $('#image-preview'),

          xsize = $pcnt.width(),
          ysize = $pcnt.height();
      
      console.log('init',[xsize,ysize]);
      

      function updatePreview(c)
      {
        if (parseInt(c.w) > 0)
        {
          var rx = xsize / c.w;
          var ry = ysize / c.h;

          $pimg.css({
            width: Math.round(rx * boundx) + 'px',
            height: Math.round(ry * boundy) + 'px',
            marginLeft: '-' + Math.round(rx * c.x) + 'px',
            marginTop: '-' + Math.round(ry * c.y) + 'px'
          });
        }
      $('#x').val(c.x);
      $('#y').val(c.y);
      $('#w').val(c.w);
      $('#h').val(c.h);
      };
  </script>
</body>
</html>