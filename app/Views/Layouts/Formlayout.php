<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title><?= $this->_siteTitle?></title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/css/intlTelInput.css"
    />
    <link
      rel="stylesheet"
      href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
    />
    <link rel="stylesheet" href="<?=PROOT?>assets/css/style.css" />

    <?= $this->content('head');?>

    <style>
        .loader {
        border: 7px solid #f3f3f3; /* Light grey */
        border-top: 7px solid black; /* Blue */
        border-radius: 50%;
        width: 40px;
        height: 40px;
        margin: 10px;
        animation: spin 2s linear infinite;
        }

        @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
        }

        #submit_new{
            background: #5cb85c;
            color: white;
            border: 0 none;
            border-radius: 5px;
            cursor: pointer;
            min-width: 130px;
            font: 700 14px/40px "Roboto", sans-serif;
            border: 1px solid #5cb85c;
            margin: 0 5px;
            text-transform: uppercase;
            display: inline-block;
        }

        .error{
            color:red;
        }
    </style>
  </head>
  <body>
    <!-- partial:index.partial.html -->
    <!-- Multi step form -->
    <?= $this->content('body');?>
    <!-- End Multi step form -->
   
  </body>
</html>
