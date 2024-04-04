<!DOCTYPE html>
<html lang="en">


<!-- errors-404.html  21 Nov 2019 04:05:02 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>404 Error</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/style.css">
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='<?=STATIC_ROOT; ?>/dashboard/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="page-error">
          <div class="page-inner">
            <h1>404</h1>
            <div class="page-description">
              The page you were looking for could not be found.
            </div>
            <div class="page-search">
              <form name="search-form">
                <div class="form-group floating-addon floating-addon-not-append">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-search"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                      <button class="btn btn-primary btn-lg">
                        Search
                      </button>
                    </div>
                  </div>
                </div>
              </form>
              <div class="mt-3">
                <a class="text-info" onclick="goBack()" style="cursor: pointer;">Back to Home</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="<?=STATIC_ROOT; ?>/dashboard/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="<?=STATIC_ROOT; ?>/dashboard/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="<?=STATIC_ROOT; ?>/dashboard/js/custom.js"></script>
  <!-- Go Back Function -->
  <script>
    function goBack() {
      // Check if the referring page is not the current page itself to avoid redirecting to the same page
      if (document.referrer !== window.location.href) {
        window.history.back();
      } else {
        // If the referring page is the same as the current page, simply redirect to a desired page
        window.location.href = 'dashboard';
      }
    }
  </script>
  <script>
    let searchForm = document.forms['search-form'];

    searchForm.addEventListener('submit', (e)=>{
      e.preventDefault();
    })
  </script>
</body>


<!-- errors-404.html  21 Nov 2019 04:05:02 GMT -->
</html>