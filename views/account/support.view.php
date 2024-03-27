<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4>Send us a message</h4>
            </div>

            <div class="card-body p-0">
                <form method="post" class="composeForm support-form" autocomplete="off">
                    <h4>Support</h4>
                    <P class="my-3">For inquiries, suggestions or complaints, mail us at</P>
                    <h5 class="mb-3"><?=$context['setting']['email']; ?></h5>

                    <div class="form-group">
                        <label>Message <span class="text-danger">*</span></label>
                        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                        <textarea name="message" maxlength="2999" class="form-control" required></textarea>
                    </div>

                    <button class="btn btn-primary btn-lg">
                        <span class="btn-text">Send <i class="fas fa-paper-plane"></i></span>
                    </button>
                </form>
            </div>
                
        </div>
    </div>
</div>

<script>
  let supportForm = document.querySelector('.support-form'),
  supportBtn = document.querySelector('.btn'),
  btnText = supportBtn.querySelector('.btn-text');
  

  supportForm.addEventListener('submit', (e)=>{
    e.preventDefault();

    // Loading animation
    btnText.innerHTML = `Submitting...<img width='20px' src="<?=ROOT; ?>/assets/dashboard/img/spinner-white.svg">`;
    supportBtn.disabled = true;

    fetch(window.location.href, {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            'csrf_token':supportForm['csrf_token'].value,
            'message':supportForm['message'].value
        })
    })
    .then((response)=>{
        return response.json();
    })
    .then((data)=>{
        console.log(data);
        if (data['status'] == "success") {
            btnText.innerHTML = `Success`;
            supportForm.reset();
            swal("Message sent", {icon: 'success'})
        } else {
            btnText.innerHTML = `Send <i class="fas fa-paper-plane">`;
            supportBtn.disabled = false;
            swal('Service is temporarily down', {icon: 'error'});
        }
    })
    .catch((err)=>{
        console.log(err);
        btnText.innerHTML = `Send <i class="fas fa-paper-plane">`;
        supportBtn.disabled = false;
        swal('Service is temporarily down', {icon: 'error'});
    })

  })
</script>