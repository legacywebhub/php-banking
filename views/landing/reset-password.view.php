<!-- breadcrumb begin -->
<div class="breadcrumb-oitila">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-8">
                <div class="part-txt">
                    <h1>Password Reset</h1>
                    <ul>
                        <li>home</li>
                        <li>Reset Password</li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-4 d-flex align-items-center">
                <div class="part-img">
                    <img src="<?=STATIC_ROOT; ?>/landing/img/breadcrumb-img.png" alt="image">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<!-- login begin -->
<div class="login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10 col-md-7 col-sm-9">
                <div class="form-area">
                    <div class="row no-gutters">
                        <div class="col-xl-6 col-lg-6">
                            <div class="login-form">
                                <script language=javascript>
                                    function checkform() {
                                        if (document.mainform.password1.value == '') {
                                            alert("Please enter your new password!");
                                            document.mainform.password1.focus();
                                            return false;
                                        }
                                        return true;
                                        if (document.mainform.password2.value == '') {
                                            alert("Please retype your new password!");
                                            document.mainform.password2.focus();
                                            return false;
                                        }
                                        return true;
                                        if (document.mainform.password1.value != document.mainform.password2.value) {
                                            alert("Passwords do not match!");
                                            document.mainform.password2.focus();
                                            return false;
                                        }
                                        return true;
                                    }
                                </script>
                                <form name="mainform" method="post" autocomplete="off">
                                    <?php if (isset($_SESSION['message'])): ?>
                                        <h6 class="col-12 my-2 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                                            <?=$_SESSION['message']; ?>
                                        </h6>
                                    <?php endif ?>
                                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                                    <div class="form-group">
                                        <label for="password1">Enter new password</label>
                                        <input type="password" name="password1" class="form-control" id="password1" minlength="5" maxlength="60" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password2">Confirm password</label>
                                        <input type="password" name="password2" class="form-control" id="password2" minlength="5" maxlength="60" required>
                                    </div>
                                    <div class="form-group form-check">
                                        <button class="btn-form">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 d-xl-block d-lg-block d-none">
                            <div class="blank-space"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login end -->