<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?=$context['title']; ?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/style.css">
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href="<?=STATIC_ROOT; ?>/dashboard/img/favicon.ico" />
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
          <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
              <i data-feather="bell" class="bell"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                {% for notification in notifications %}
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <span class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-envelope-square"></i>
                  </span>
                  <span class="dropdown-item-desc"> {{notification.message}}
                    <span class="time">{{notification.date|timezone:request.user.timezone|timesince}} AGO</span>
                  </span>
                </a>
                {% endfor %}
              </div>
              <div class="dropdown-footer text-center">
                <a href="{% url 'banking:notifications">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="<?=STATIC_ROOT; ?>/dashboard/img/default.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">{{request.user.full_name}}</div>
              <a href="{% url 'banking:profile" class="dropdown-item has-icon"> <i class="far fa-user"></i> 
                Profile
              </a>
              <a href="{% url 'banking:virtual_card" class="dropdown-item has-icon"> <i class="fas fa-credit-card"></i>
                My Card
              </a> 
              <a href="{% url 'banking:change_pin" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="auth-login.html" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{% url 'banking:account"> <img alt="image" src="<?=STATIC_ROOT; ?>/dashboard/img/logo2.png" class="header-logo" /> <span
                class="logo-name">Bank</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="dropdown active">
              <a href="{% url 'banking:account" class="nav-link"><i data-feather="home"></i><span>Home</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Actions</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{% url 'banking:fund_account">Fund Account</a></li>
                <li><a class="nav-link" href="{% url 'banking:internal_transfer">Internal Transfer</a></li>
                <li><a class="nav-link" href="{% url 'banking:domestic_transfer">Domestic Transfer</a></li>
                <li><a class="nav-link" href="{% url 'banking:international_transfer">International Transfer</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="list"></i><span>Transactions</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{% url 'banking:credit_history">Credit History</a></li>
                <li><a class="nav-link" href="{% url 'banking:debit_history">Debit History</a></li>
                <li><a class="nav-link" href="{% url 'banking:transfer_history">Transfer History</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="dollar-sign"></i><span>Loan</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{% url 'banking:loan_request">Loan Request</a></li>
                <li><a class="nav-link" href="{% url 'banking:loan_history">Loan History</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="{% url 'banking:virtual_card" class="nav-link"><i data-feather="credit-card"></i><span>My Card</span></a>
            </li>
            <li class="menu-header">Utilities</li>
            <li class="dropdown">
              <a href="{% url 'banking:profile" class="nav-link"><i data-feather="user"></i><span>Profile</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="settings"></i><span>Account Settings</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{% url 'banking:change_pin">Change Pin</a></li>
                <li><a class="nav-link" href="#">Update Password</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="{% url 'banking:notifications" class="nav-link"><i data-feather="bell"></i><span>Notifications</span></a>
            </li>
            <li class="dropdown">
              <a href="{% url 'banking:logout" class="nav-link"><i data-feather="log-out"></i><span>Logout</span></a>
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
          <a href="templateshub.net">Templateshub</a></a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="<?=STATIC_ROOT; ?>/dashboard/js/app.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?=STATIC_ROOT; ?>/dashboard/js/page/index.js"></script>
  <!-- Template JS File -->
  <script src="<?=STATIC_ROOT; ?>/dashboard/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="<?=STATIC_ROOT; ?>/dashboard/js/custom.js"></script>
  <!-- Sweet Alert -->
  <script src="<?=STATIC_ROOT; ?>/dashboard/bundles/sweetalert/sweetalert.min.js"></script>
  <!-- InPage Js -->
    <!-- Return only number keystrokes -->
    <script>
      // This functions only allows input fields to accept numbers
      function onlyNumberKey(evt) {
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false; 
        return true;
        // use  onkeypress="return onlyNumberKey(event)" on the input field
      }
    </script>

    <!-- Copy texts js -->
    <script>
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
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->
</html>