<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?=$context['title']; ?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/app.min.css">
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/bundles/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/bundles/jquery-selectric/selectric.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/style.css">
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href="<?=STATIC_ROOT; ?>/landing/img/favicon.png" />
  <!-- InPage style CSS -->
  <style>
    .text-capitalize {
      text-transform: capitalize;
    }
    .balance-container {
        margin: 40px 0px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .balance-box {
        margin: 0px 50px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .pagination-container {
      display: flex;
      justify-content:center;
      align-items: center;
    }
  </style>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> 
                <i data-feather="align-justify"></i>
              </a>
            </li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
        <?php if(!empty($context['recent_notifications'])): ?>  
          <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
              <i data-feather="bell" class="bell"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifications
                <div class="float-right">
                  <a href="javascript:void(0);">Mark All As Read</a>
                </div>
              </div>

              <div class="dropdown-list-content dropdown-list-icons">
                <?php foreach($context['recent_notifications'] as $notification): ?>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <span class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-envelope-square"></i>
                  </span>
                  <span class="dropdown-item-desc"> <?=$notification['message']; ?>
                  <span class="time"><?=format_datetime_timesince($notification['date'], $context['user']['timezone']); ?> AGO</span>
                  </span>
                </a>
                <?php endforeach ?>
              </div>
              
              <div class="dropdown-footer text-center">
                <a href="notifications">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <?php endif ?>
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> 
            <?php if($context['user']['is_verified']): ?>
            <img alt="image" src="<?=MEDIA_ROOT; ?>/documents/<?=$context['user']['kyc']['passport']; ?>" class="user-img-radious-style">
            <?php else: ?>
            <img alt="image" src="<?=STATIC_ROOT; ?>/dashboard/img/default_user.png" class="user-img-radious-style">
            <?php endif ?>
            <span class="d-sm-none d-lg-inline-block"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title"><?=$context['user']['fullname']; ?></div>
              <a href="profile" class="dropdown-item has-icon"> <i class="far fa-user"></i> 
                Profile
              </a>
              <a href="virtual-card" class="dropdown-item has-icon"> <i class="fas fa-credit-card"></i>
                My Card
              </a> 
              <a href="change-pin" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a>
              <a href="support" class="dropdown-item has-icon"> <i class="fas fa-comments"></i>
                Support
              </a>
              <div class="dropdown-divider"></div>
              <a href="logout" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="dashboard"> 
              <!-- <img alt="image" src="<?=STATIC_ROOT; ?>/landing/img/logo3.png" class="header-logo" />  -->
              <span class="logo-name"><?=strtoupper($context['setting']['name']); ?></span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="dropdown active">
              <a href="dashboard" class="nav-link"><i data-feather="home"></i><span>Home</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Actions</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="fund-account">Fund Account</a></li>
                <li><a class="nav-link" href="internal-transfer">Internal Transfer</a></li>
                <li><a class="nav-link" href="domestic-transfer">Domestic Transfer</a></li>
                <li><a class="nav-link" href="international-transfer">International Transfer</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="list"></i><span>Transactions</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="credit-history">Credit History</a></li>
                <li><a class="nav-link" href="debit-history">Debit History</a></li>
                <li><a class="nav-link" href="transfer-history">Transfer History</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="dollar-sign"></i><span>Loan</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="loan-request">Loan Request</a></li>
                <li><a class="nav-link" href="loan-history">Loan History</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="virtual-card" class="nav-link"><i data-feather="credit-card"></i><span>My Card</span></a>
            </li>
            <li class="menu-header">Utilities</li>
            <li class="dropdown">
              <a href="profile" class="nav-link"><i data-feather="user"></i><span>Profile</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="settings"></i><span>Account Settings</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="change-pin">Change Pin</a></li>
                <li><a class="nav-link" href="update-password">Update Password</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="notifications" class="nav-link"><i data-feather="bell"></i><span>Notifications</span></a>
            </li>
            <li class="dropdown">
              <a href="logout" class="nav-link"><i data-feather="log-out"></i><span>Logout</span></a>
            </li>
          </ul>
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <!-- Content Goes Here -->
          <?php require("$name.view.php"); ?>
          <!-- End Content -->
        </section>
        <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          <span>Copyright &copy; <?=$context['setting']['name']." ".date("Y"); ?></span></a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?=STATIC_ROOT; ?>/dashboard/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?=STATIC_ROOT; ?>/dashboard/bundles/sweetalert/sweetalert.min.js"></script>
  <script src="<?=STATIC_ROOT; ?>/dashboard/bundles/summernote/summernote-bs4.js"></script>
  <script src="<?=STATIC_ROOT; ?>/dashboard/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="<?=STATIC_ROOT; ?>/dashboard/bundles/upload-preview/jquery.uploadPreview.min.js"></script>
  <!-- Template JS File -->
  <script src="<?=STATIC_ROOT; ?>/dashboard/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="<?=STATIC_ROOT; ?>/dashboard/js/custom.js"></script>
  <!-- InPage Js -->
  <script>
    function displayMessageElement(element, messageType, message = "") {
      // Get all the classes of the element
      let classes = element.className.split(" ");

      // Filter out classes that start with 'text-'
      classes = classes.filter(c => !c.startsWith('text-'));

      // Join the filtered classes back and add the new class
      element.className = classes.join(" ") + " " + `text-${messageType}`;

      // Adding message to element
      element.innerText = message;

      setTimeout(()=>{
        // Hide message element after given time
        element.innerText = "";
      }, 5000); 

      // Example usage: Assuming you have an element with the id 'message'
      // displayMessageElement(document.getElementById('message'), 'success', 'Hello world');
    }
  </script>

  <script>
    // This functions enforce input fields to only accept number keystrokes
    function onlyNumberKey(evt) {
      // Only ASCII character in that range allowed
      var ASCIICode = (evt.which) ? evt.which : evt.keyCode
      if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) {
          return false; 
      } else {
          return true;
      }
      // use onkeypress="return onlyNumberKey(event)" on the input field
    }
  </script>

  <script>
    // This functions enforce input fields to only accept alphabet keystrokes
    function onlyAlphabeticalKey(evt) {
      // Only ASCII character in that range allowed
      var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
      if ((ASCIICode >= 65 && ASCIICode <= 90) || (ASCIICode >= 97 && ASCIICode <= 122)) {
        return true; // Allow alphabetical characters
      } else {
        return false; // Block other characters
      }
      // Use onkeypress="return onlyAlphabeticalKey(event)" on the input field
    }
  </script>

  <script>
  // Copy texts js
  function copyText(arg) {
    console.log('clicked a button');
    // Get the input or text field
    //var copyText = document.getElementById("myInput");

    // Select the text field
    arg.select();
    arg.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(arg.value).then(()=>{
      // Alert the copied text
      alert("Copied");
    }).catch(()=>{
      // Alert the copied text
      alert("Something went wrong");
    });
  }
  </script>

  <!-- File validation js -->
  <script>
    function validateDocumentFileType(fileInputField) {
      
      /* If we are expecting files from an optional field, 
        we return null if nothing was inputed 
      */
      
      if (fileInputField == undefined || fileInputField == null) { // Skip validation if file input field is not provided
        
        return null;
      
      } else {

        let files = fileInputField.files, // Input field files
        maxSizeInBytes = 10 * 1024 * 1024, // 10 MB (adjust as needed)
        allowedTypes = [ // Allowed file types 
          'image/jpg', 'image/jpeg', 'image/png', 'application/pdf', 
          'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ], 
        errorMessage = '';

        for (let i = 0; i < files.length; i++) {
          let file = files[i];

          if (allowedTypes.indexOf(file.type.toLowerCase()) === -1) {
            errorMessage = `${file.name} has an invalid file type. Please select a valid file (PDF, DOC, DOCX, JPEG, or PNG)`;
          } else if (file.size > maxSizeInBytes) {
            errorMessage = `${file.name} exceeds the maximum file size limit`;
          }
        }

        // Return true if no errors, errorMessage otherwise
        return errorMessage === '' ? true : errorMessage;

      }
    }
  </script>

  <!-- Security js -->
  <script>
    if (window.history.replaceState){
      window.history.replaceState(null, null, window.location.href);
    }
  </script>

  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/660538851ec1082f04dc5bf1/1hq269ji1';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
    })();
  </script>
  <!--End of Tawk.to Script-->
</body>

</html>