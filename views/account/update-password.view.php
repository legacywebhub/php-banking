<div class="card">
    <div class="card-header">
      <h4>Change Password</h4>
    </div>

    <div class="card-body">
        <form method="post" class="password-update-form">
          <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
          <div class="form-row">
              <div class="form-group col-md-6">
              <input type="password" class="form-control" name="old_password" placeholder="Enter Old Password" required>
              </div>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password1" placeholder="Enter New Password" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password2" placeholder="Re-type New Password" required>
          </div>
          <p class="my-2 mx-2 message"></p>
          <div class="card-footer">
            <button class="btn btn-primary btn-bg"><span class="btn-text">Save</span></button>
          </div>
        </form>
    </div>
</div>

<script>
  // Variables
  let updateForm = document.querySelector('.password-update-form'),
  updateBtn = updateForm.querySelector('.btn'),
  btnText = updateBtn.querySelector('.btn-text'),
  msg = updateForm.querySelector('.message');
  
  // Event Listeners
  updateForm.addEventListener('submit', (e)=>{
    e.preventDefault();

    // Loading animation
    btnText.innerHTML = `Please wait...<img width='20' src="<?=STATIC_ROOT; ?>/dashboard/img/spinner-white.svg">`;
    updateBtn.disabled = true;

    setTimeout(()=>{
      fetch(window.location.href, {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          'csrf_token': updateForm['csrf_token'].value,
          'old_password': updateForm['old_password'].value,
          'password1': updateForm['password1'].value,
          'password2': updateForm['password2'].value,
        })
      })
      .then((response)=>{
          return response.json()
      })
      .then((data)=>{
          //console.log(data);
          if (data['status'] == "success") {
            btnText.innerHTML = `Success`;
            updateBtn.disabled = true;
            updateForm.reset();
            displayMessageElement(msg, 'success', data['message']);
            swal(data['message'], {icon: 'success'});
          } else {
            btnText.innerHTML = `Save`;
            updateBtn.disabled = false;
            displayMessageElement(msg, 'danger', data['message']);
            swal(data['message'], {icon: 'error'});
          }
      })
      .catch((err)=>{
        //console.log(err);
        btnText.innerHTML = `Save`;
        updateBtn.disabled = false;
        displayMessageElement(msg, 'danger', 'Service is temporarily unavailable');
        swal('Service is temporarily unavailable');
      })
    }, 2000);

  })
</script>