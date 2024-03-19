<div class="card">
    <div class="card-header">
      <h4>Change Transaction Pin</h4>
    </div>

    <div class="card-body">
        <div class="mb-3 mt-3">
            <h4>Get OTP</h4>
            <p>Hello <?=$context['user']['fullname']; ?>, click the send button below to receive an OTP mail to complete your request<br>
              <button class="btn btn-warning btn-round otp-btn"><span class="otp-btn-text">Send <i data-feather="mail"></i></span></button>
            </p>
        </div>
        <form class="pin-form" method="post">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                  <input name="otp" type="text" class="form-control" minlength="4" maxlength="4"  placeholder="Enter OTP" onkeypress="return onlyNumberKey(event)" required>
                </div>
            </div>
              <div class="form-group">
                <input name="pin1" type="text" class="form-control" minlength="4" maxlength="4" placeholder="Enter New Pin" onkeypress="return onlyNumberKey(event)" required>
              </div>
              <div class="form-group">
                <input name="pin2" type="text" class="form-control" minlength="4" maxlength="4" placeholder="Re-type New Pin" onkeypress="return onlyNumberKey(event)" required>
              </div>
              <div class="card-footer">
                <button class="btn btn-lg btn-primary pin-btn"><span class="pin-btn-text">Save</span></button>
              </div>
        </form>
    </div>
</div>

<!-- Script for sending OTP -->
<script type="text/javascript">
  // OTP variables
  var otpBtn = document.querySelector('.otp-btn'),
  otpBtnText = document.querySelector('.otp-btn-text'),
  otp = null,
  // Form variables
  pinForm = document.querySelector('.pin-form'),
  pinBtn = document.querySelector('.pin-btn'),
  pinBtnText = document.querySelector('.pin-btn-text');

  // Disabling form button till OTP has been confirmed
  //pinBtn.disabled = true;

  otpBtn.addEventListener('click', (e)=>{
    e.preventDefault();

    // Generating new OTP on button click
    otp = String(Math.round(Math.random() * 10000));

    // Loading animation
    otpBtnText.innerHTML = `Please wait...<img width='20' src="<?=STATIC_ROOT; ?>/dashboard/img/spinner-white.svg">`;
    otpBtn.disabled = true;

    setTimeout(()=> {
      // Sending ajax request
      fetch("<?=ROOT; ?>/account/send-otp", {
        method: "POST",
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({'csrf_token': pinForm['csrf_token'].value, 'otp': otp})
      })
      .then((response)=>{
        return response.json()
      })
      .then((data)=>{
        console.log(data);
        if (data['status'] == "success") {
          // Resetting OTP button
          otpBtnText.innerHTML = `Send <i data-feather="mail"></i>`; 
          swal("An OTP has been forwarded to your email", {icon:'success'});
          // waiting 10 seconds to reactivate OTP button again
          setTimeout(()=>{ otpBtn.disabled = false; }, 10000);
        } else if (data['status'] == "failed") {
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
  
    // Checking if correct OTP was entered
    if (pinForm["otp"].value == otp) {
      // Checking if pins match
      if (pinForm["pin1"].value == pinForm["pin2"].value) {
        // Loading animation
        pinBtnText.innerHTML = `Resetting pin...<img width='20' src="<?=STATIC_ROOT; ?>/dashboard/img/spinner-white.svg">`;
        pinBtn.disabled = true; 

        setTimeout(()=>{
          fetch(window.location.href, {
            method: "POST",
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({'csrf_token': pinForm['csrf_token'].value, 'new_pin': pinForm["pin2"].value})
          })
          .then((response)=>{
            return response.json()
          })
          .then((data)=>{
            console.log(data);
            if (data['status'] == "success") {
              // Resetting form button
              pinForm.reset();
              pinBtnText.innerHTML = `Success`;
              pinBtn.disabled = true;
              swal("Your pin was successfully updated", {icon:'success'});
            } else {
              // Resetting form button
              pinBtnText.innerHTML = `Save`;
              pinBtn.disabled = false;
              swal("Sorry.. cannot update pin at the moment", {icon:'warning'});
            }
          })
          .catch((err)=>{
            console.log(err);
            // Resetting form button
            pinBtnText.innerHTML = `Save`;
            pinBtn.disabled = false;
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