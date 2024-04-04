<div class="row">
    <div class="col-12 col-md-9 col-lg-9">
        <div class="card">
            <div class="card-header">
            <h4>Add Setting</h4>
            </div>

            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                    <h6 class="col-12 my-3 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                <?php endif ?>
                <form action="" method="post">
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                    <div class="form-group">
                        <label>Site Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" maxlength="30" class="form-control" aria-describedby="nameHelpBlock" required>
                        <small id="nameHelpBlock" class="form-text text-muted">i.e mysite</small>
                    </div>
                    <div class="form-group">
                        <label>Domain Name <span class="text-danger">*</span></label>
                        <input type="text" name="domain" maxlength="60" class="form-control" aria-describedby="domainHelpBlock" required>
                        <small id="domainHelpBlock" class="form-text text-muted">i.e mysite.com</small>
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" maxlength="60" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Phone </label>
                        <input type="text" name="phone" maxlength="20" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Address </label>
                        <input type="text" name="address" maxlength="100" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Interest rate <span class="text-danger">*</span></label>
                        <input type="number" name="interest_rate" maxlength="3" class="form-control" value=0.1 required>
                    </div>
                    <div class="form-group">
                        <label>Bitcoin wallet address</label>
                        <input type="text" name="bitcoin_address" maxlength="200" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Usdt(TRC20) wallet address</label>
                        <input type="text" name="usdt_address" maxlength="200" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Facebook Link</label>
                        <input type="text" name="facebook_link" maxlength="500" class="form-control">
                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-lg btn-primary mr-1">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>