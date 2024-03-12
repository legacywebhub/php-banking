{% extends 'dashboard/base.html' %}
{% load static %}

{% block title %}
<title>My Profile</title>
{% endblock %}

{% block style %}
<link rel="stylesheet" href="{% static 'dashboard/bundles/summernote/summernote-bs4.css' %}">
<link rel="stylesheet" href="{% static 'dashboard/bundles/jquery-selectric/selectric.css' %}">
<link rel="stylesheet" href="{% static 'dashboard/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css' %}">
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
{% endblock %}

{% block content %}
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
                    <img alt="user" src="{% static 'dashboard/img/users/user-12.jpg' %}" class="rounded-circle user-image">
                    <div class="clearfix"></div>
                    <div class="mb-2 mt-4 author-box-name">
                    <h3>Paulson Legacy Bosah</h3>
                    </div>
                    <h6>0061070643</h6>
                    <p>Savings Account</p>
                    {% if request.user.is_verified %}
                    <div><a href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i>Verified</a></div>
                    {% else %}
                    <div><a href="#" class="btn btn-icon icon-left btn-danger"><i class="fas fa-times"></i> Not verified</a></div>
                    {% endif %}
                </div>
                <div class="balance-container">
                    <div class="balance-box">
                        <span><i class="fa fa-circle text-success"></i> Main Balance</span>
                        <span><b>{{user.currency}}{{user.balance}}</b></span>
                    </div>
                    <div class="balance-box">
                        <span><i class="fa fa-circle text-secondary"></i> Overdraft</span>
                        <span><b>{{user.currency}}{{user.overdraft}}</b></span>
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
                            {{request.user.full_name}}
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Mobile
                        </span>
                        <span class="float-right text-muted">
                            +234 916 075 5152
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Email
                        </span>
                        <span class="float-right text-muted">
                            legacywebhub@gmail.com
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Location
                        </span>
                        <span class="float-right text-muted">
                            303 Ifite Road Awka
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Country
                        </span>
                        <span class="float-right text-muted">
                            Nigeria
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
                        {% csrf_token %}
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
{% endblock %}

{% block script %}
<!-- JS Libraies -->
<script src="{% static 'dashboard/bundles/summernote/summernote-bs4.js' %}"></script>
<script src="{% static 'dashboard/bundles/jquery-selectric/jquery.selectric.min.js' %}"></script>
<script src="{% static 'dashboard/bundles/upload-preview/jquery.uploadPreview.min.js' %}"></script>
<script src="{% static 'dashboard/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js' %}"></script>
<!-- Page Specific JS File -->
<script src="{% static 'dashboard/js/page/create-post.js' %}"></script>

<script>
let kycForm = document.getElementById('kyc-form'),
kycBtn = kycForm.querySelector('.btn'),
url = "{% url 'banking:process_kyc' %}";


kycForm.addEventListener('submit', (e)=>{
    e.preventDefault();

    // Creating a form object from our form
    // containing our form data and images
    var formData = new FormData(kycForm);

    // Loading animation
    let btnText = kycBtn.querySelector('.btn-text');
    btnText.innerHTML = `Please wait...<img width='20' src="{% static 'dashboard/img/spinner-white.svg' %}">`;
    kycBtn.disabled = true;


    fetch(url, {
        method: "POST",
        headers: {
            'X-CSRFToken': csrftoken,
        },
        body: formData
    })
    .then((response)=>{
        return response.json()
    })
    .then((data)=>{
        console.log(data);
        if (data == "success") {
            btnText.innerHTML = `Submit`;
            kycBtn.disabled = true;
            swal("KYC proposal was placed successfully", {icon:'success'});
        } else {
            btnText.innerHTML = `Submit`;
            kycBtn.disabled = false;
            swal(data, {icon: 'error'});
        }
    })
    .catch((err)=>{
        console.log(err);
        btnText.innerHTML = `Submit`;
        kycBtn.disabled = false;
        swal('Unknown error while placing kyc proposal', {icon:'error'});
    })
})
</script>
{% endblock %}