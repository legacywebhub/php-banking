

<style>
.user-profile {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.user-image {
    width: 70%;
}
.balance-container {
    margin: 40px 0px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.balance-box {
    margin: 0px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>


<div class="section-body">
    <div class="row mt-sm-4">
      <div class="col-12 col-md-9 col-lg-8">
        <div class="card">
          <div class="padding-20">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                  aria-selected="true">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                  aria-selected="false">KYC</a>
              </li>
            </ul>
            <div class="tab-content tab-bordered" id="myTab3Content">
              <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                <div class="user-profile text-center">
                    <?php if ($context['user']['is_verified']): ?>
                        <img alt="user" src="<?=MEDIA_ROOT; ?>/images/users/<?=$context['user']['kyc']['passport']; ?>" class="rounded-circle user-image">
                    <?php else: ?>
                        <img alt="user" src="<?=STATIC_ROOT; ?>/dashboard/img/default_user.png" class="rounded-circle user-image">
                    <?php endif ?>
                    <div class="clearfix"></div>
                    <div class="mb-2 mt-4 author-box-name">
                        <h3><?=$context['user']['fullname']; ?></h3>
                    </div>
                    <h6><?=$context['user']['account_number']; ?></h6>
                    <p><?=$context['user']['account_type']; ?> Account</p>
                    <?php if ($context['user']['is_verified']): ?>
                        <div><a href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i>Verified</a></div>
                    <?php else: ?>
                        <div><a href="#" class="btn btn-icon icon-left btn-danger"><i class="fas fa-times"></i> Not verified</a></div>
                    <?php endif ?>
                </div>
                <div class="balance-container">
                    <div class="balance-box">
                        <span><i class="fa fa-circle text-success"></i> Main Balance</span>
                        <span><b><?=$context['user']['currency'].$context['user']['balance']; ?></b></span>
                    </div>
                    <div class="balance-box">
                        <span><i class="fa fa-circle text-secondary"></i> Overdraft</span>
                        <span><b><?=$context['user']['currency'].$context['user']['overdraft']; ?></b></span>
                    </div>
                </div>
                <div class="w-100 d-sm-none"></div>
                <div class="card-header">
                    <h4>Personal Details</h4>
                </div>
                <div class="card-body">
                    <div class="py-4">
                        <p class="clearfix">
                        <span class="float-left">
                            Full Name
                        </span>
                        <span class="float-right text-muted">
                            <?=$context['user']['fullname']; ?>
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Mobile
                        </span>
                        <span class="float-right text-muted">
                            <?=$context['user']['phone']; ?>
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Email
                        </span>
                        <span class="float-right text-muted">
                            <?=$context['user']['email']; ?>
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Location
                        </span>
                        <span class="float-right text-muted">
                            <?=$context['user']['address']; ?>
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Country
                        </span>
                        <span class="float-right text-muted">
                            <?=$context['user']['country']; ?>
                        </span>
                        </p>
                    </div>
                </div>
                <div class="w-100 d-sm-none"></div>
                <div class="card-header">
                    <h4>Account Limits</h4>
                </div>
                <div class="card-body">
                    <div class="py-4">
                        <p class="clearfix">
                        <span class="float-left">
                            Sending (Per Transaction)
                        </span>
                        <span class="float-right text-muted">
                            $1,000,000
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Receiving (Per Transaction)
                        </span>
                        <span class="float-right text-muted">
                            $500,000
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Daily Transaction Limit
                        </span>
                        <span class="float-right text-muted">
                            $500,000
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Debit Card Limit
                        </span>
                        <span class="float-right text-muted">
                            $500,000
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Maximum Balance
                        </span>
                        <span class="float-right text-muted">
                            Unlimited
                        </span>
                        </p>
                    </div>
                </div>
             </div>

              <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                <div class="card-header">
                    <h4>KYC</h4>
                </div>
                <div class="card-body">
                    <ul>
                        <li>National I.D Card</li>
                        <li>Drivers License</li>
                        <li>International Passport</li>
                    </ul>

                    <div>

                    </div>
                    <form class="kyc-form" id="kyc-form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                        <div class="section-title">Upload Passport <span class="text-danger">*</span></div>
                        <div class="form-group mb-4">
                            <div class="col-sm-12 col-md-7">
                              <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Choose Image</label>
                                <input type="file" name="passport" id="image-upload" required>
                              </div>
                            </div>
                          </div>     
                        <div class="form-group">
                            <div class="section-title">ID Type <span class="text-danger">*</span></div>
                            <select class="form-control selectric" name="id-type" required>
                                <option value="">Select</option>
                                <option value="national id">National ID</option>
                                <option value="drivers license">Drivers License</option>
                                <option value="int'l passport">Int'l Passport</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="section-title">ID Number <span class="text-danger">*</span></div>
                            <input type="number" maxlength="25" name="id-number" class="form-control" required>
                        </div>
                        <div class="section-title">Upload ID <span class="text-danger">*</span></div>
                        <div class="form-group mb-4">
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview2" class="image-preview">
                                <label for="image-upload2" id="image-label2">Choose Image</label>
                                <input type="file" name="id-image" id="image-upload2" required>
                                </div>
                            </div>
                        </div>
                        <p class="my-3 message" style="text-align: center;"></p>
                        <div class="text-center">
                            <button class="btn btn-lg btn-primary"><span class="btn-text">Submit</span></button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<script>
let kycForm = document.getElementById('kyc-form'),
    kycBtn = kycForm.querySelector('.btn'),
    btnText = kycBtn.querySelector('.btn-text'),
    msg = kycForm.querySelector('.message');


kycForm.addEventListener('submit', (e)=>{
    e.preventDefault();

    // Creating a form object from our form
    // containing our form data and images
    var formData = new FormData(kycForm);

    // Loading animation
    btnText.innerHTML = `Submitting data...<img width='20' src="<?=STATIC_ROOT; ?>/dashboard/img/spinner-white.svg">`;
    kycBtn.disabled = true;

    setTimeout(()=>{
        fetch(window.location.href, {
            method: "POST",
            headers: {},
            body: formData
        })
        .then((response)=>{
            return response.json()
        })
        .then((data)=>{
            console.log(data);
            if (data['status'] == "success") {
                btnText.innerHTML = `Application successful`;
                kycBtn.disabled = true;
                kycForm.reset();
                displayMessageElement(msg, 'success', data['message']);
                swal("KYC proposal was placed successfully", {icon:'success'});
            } else {
                btnText.innerHTML = `Submit`;
                kycBtn.disabled = false;
                displayMessageElement(msg, 'danger', data['message']);
                swal(data, {icon: 'error'});
            }
        })
        .catch((err)=>{
            console.log(err);
            btnText.innerHTML = `Submit`;
            kycBtn.disabled = false;
            displayMessageElement(msg, 'danger', data['message']);
            swal('Unknown error while placing kyc proposal', {icon:'error'});
        })
    }, 2000);

})
</script>