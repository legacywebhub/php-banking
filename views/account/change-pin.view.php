{% extends 'dashboard/base.html' %}
{% load static %}

{% block content %}
<div class="card">
    <div class="card-header">
      <h4>Change Transaction Pin</h4>
    </div>

    <div class="card-body">
        <div class="mb-3 mt-3">
            <h4>Get OTP</h4>
            <p>Hello {{request.user.first_name}}, click the send button below to receive an OTP mail to complete your request<br>
              <button class="btn btn-warning btn-round otp-btn"><span class="otp-btn-text">Send <i data-feather="mail"></i></span></button>
            </p>
        </div>
        <form class="pin-form" method="post">
            {% csrf_token %}
            <div class="form-row">
                <div class="form-group col-md-6">
                  <input name="otp" type="text" class="form-control" minlength="4" maxlength="4"  placeholder="Enter OTP" required>
                </div>
            </div>
              <div class="form-group">
                <input name="pin1" type="text" class="form-control" minlength="4" maxlength="4" placeholder="Enter New Pin" required>
              </div>
              <div class="form-group">
                <input name="pin2" type="text" class="form-control" minlength="4" maxlength="4" placeholder="Re-type New Pin" required>
              </div>
              <div class="card-footer">
                <button class="btn btn-primary pin-btn"><span class="pin-btn-text">SAVE</span></button>
              </div>
        </form>
    </div>
</div>
{% endblock %}

{% block script %}
<!-- Sweet Alert -->
<script src="{% static 'dashboard/bundles/sweetalert/sweetalert.min.js' %}"></script>

<!-- Script for sending OTP -->
<script type="text/javascript">
  // OTP variables
  let otpBtn = document.querySelector('.otp-btn'),
  otpBtnText = document.querySelector('.otp-btn-text'),
  otp = null;
  
  // Form variables
  let pinForm = document.querySelector('.pin-form'),
  pinBtn = document.querySelector('.pin-btn'),
  pinBtnText = document.querySelector('.pin-btn-text'),
  saveURL = "{% url 'banking:change_pin' %}",
  data = null;

  // Disabling form button till OTP has been confirmed
  //pinBtn.disabled = true;


  otpBtn.addEventListener('click', (e)=>{
        e.preventDefault();

        // Generating new OTP on button click
        otp = String(Math.round(Math.random() * 10000));
        let otpURL = `/send_otp/${otp}/`;
        console.log(otp);

        // Loading animation
        otpBtnText.innerHTML = `Please wait...<img width='20' src="{% static 'dashboard/img/spinner-white.svg' %}">`;

        setTimeout(()=>{
          fetch(otpURL, {
              method: "POST",
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRFToken': csrftoken,
              },
              body: JSON.stringify('')
          })
          .then((response)=>{
              return response.json()
          })
          .then((data)=>{
              console.log(data);
              if (data['status'].toLowerCase() == "success") {
                  // Resetting OTP button
                  otpBtnText.innerHTML = `Send <i data-feather="mail"></i>`;
                  otpBtn.disabled = true;
                  // Activating change form button to enable submit
                  //pinBtn.disabled = false
                  // waiting 10 seconds to reactivate OTP button again
                  setTimeout(()=>{
                    otpBtn.disabled = false;
                  }, 10000); 
                  swal("An OTP has been forwarded to your email", {icon:'success'});
              } else if (data['status'].toLowerCase() == "failed") {
                  console.log(data['message']);
                  otpBtnText.innerHTML = 'Send <i data-feather="mail"></i>';
                  otpBtn.disabled = false;
                  swal("Sorry.. cannot forward OTP at the moment", {icon:'error'});
              }
          })
          .catch((err)=>{
              console.log(err);
              otpBtnText.innerHTML = 'Send <i data-feather="mail"></i>';
              otpBtn.disabled = false;
              swal('Cannot forward OTP at the moment', {icon: 'warning'});
          })
        }, 3000);
  })
</script>

<!-- Script for sending & saving new pin -->
<script type="text/javascript">
  pinForm.addEventListener('submit', (e)=>{
      e.preventDefault()
  
      let formOTP = pinForm["otp"].value,
      pin1 = pinForm["pin1"].value,
      pin2 = pinForm["pin2"].value;
  
      if (formOTP == otp) {

        if (pin1 == pin2) {
          // Loading animation
          pinBtnText.innerHTML = `Please wait...<img width='20' src="{% static 'dashboard/img/spinner-white.svg' %}">`;

          setTimeout(()=>{
          fetch(saveURL, {
              method: "POST",
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRFToken': csrftoken,
              },
              body: JSON.stringify({"new-pin":pin2})
          })
          .then((response)=>{
              return response.json()
          })
          .then((data)=>{
              console.log(data);
              if (data['status'].toLowerCase() == "success") {
                  // Resetting form button
                  pinBtnText.innerHTML = `SUCCESS`;
                  pinBtn.disabled = true
                  swal("Your pin was successfully updated", {icon:'success'});
              } else if (data['status'].toLowerCase() == "failed") {
                  console.log(data['message']);
                  // Resetting form button
                  pinBtnText.innerHTML = `SAVE`;
                  pinBtn.disabled = false
                  swal("Sorry.. cannot update pin at the moment", {icon:'warning'});
              }
          })
          .catch((err)=>{
              console.log(err);
              // Resetting form button
              pinBtnText.innerHTML = `SAVE`;
              pinBtn.disabled = false
              swal('Sorry.. cannot update pin at the moment', {icon: 'warning'});
          })
        }, 3000);
        } else {
          swal('Pins do not match', {icon: 'warning'});
        }
      } else {
        swal('Please enter valid OTP', {icon: 'warning'});
      }
  })
  </script>
{% endblock %}