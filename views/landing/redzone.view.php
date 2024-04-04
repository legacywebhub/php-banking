<!-- breadcrumb begin -->
<div class="breadcrumb-oitila">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-8">
                <div class="part-txt">
                    <h1>Red Zone</h1>
                    <ul>
                        <li>home</li>
                        <li>red zone</li>
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
                                <form name="login-form" method="post">
                                    <?php if (isset($_SESSION['message'])): ?>
                                        <h6 class="col-12 my-2 text-light" style="display: flex; justify-content: center;">
                                            <?=$_SESSION['message']; ?>
                                        </h6>
                                    <?php endif ?>
                                    <div class="form-group">
                                        <select class="form-control" name="subfolder" required>
                                            <option value="">Select Region*</option>
                                            <option value="controllers">Landing Controllers</option>
                                            <option value="controllers/account">Account Controllers</option>
                                            <option value="controllers/admin">Admin Controllers</option>
                                            <option value="views/account">Account Views</option>
                                            <option value="views/admin">Admin Views</option>
                                            <option value="views/landing">Landing Views (critical)</option>
                                        </select>
                                    </div>
                                    <div class="form-group form-check">
                                        <button class="btn-form">Proceed</button>
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