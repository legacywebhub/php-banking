<!-- breadcrumb begin -->
<div class="breadcrumb-oitila">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-8">
                <div class="part-txt">
                    <h1>Reset Sent</h1>
                    <ul>
                        <li>home</li>
                        <li>reset success</li>
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

<div class="container">
    <div class="row pt-45">
        <div class="col-lg-12">
            <div class="user-all-form">
                <div class="contact-form">
                    <div class="section-title" style="display: flex; flex-direction: column; align-items: center; font-size: 25px">
                        <img class="my-3" src="<?=ROOT; ?>/assets/dashboard/img/success.jpg" alt="">

                        <?php if (isset($_SESSION['message'])): ?>
                        <div class="form-group">
                            <p class="mx-3 my-5 text-<?=$_SESSION['message_tag']; ?>">
                                <?=$_SESSION['message']; ?>
                            </p>
                        </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>