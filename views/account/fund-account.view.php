<style>
.balance-container {
    margin: 40px 0px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.balance-box {
    margin: 0px 50px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>

<div class="section-body">
  <div class="row">
    <div class="col-12 col-md-9 col-lg-6">
      <div class="card">
        <div class="card-header">
          <h4>Top Up Account</h4>
        </div>
        <div class="card-body">
          <form class="fund-form" method="post">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
            <div class="form-group">
              <div class="form-group">
                  <label>Amount (<?=$context['user']['currency']; ?>) <span class="text-danger">*</span></label>
                  <input type="number" maxlength="12" name="amount" class="form-control" onkeypress="return onlyNumberKey(event)" required>
              </div>
              <label>Select Method <span class="text-danger">*</span></label>
              <select class="form-control" name="method" required>
                <option value="bank transfer">Bank Transfer</option>
                <option value="bitcoin">Bitcoin</option>
                <option value="usdt">USDT</option>
              </select>
            </div>
            <div class="form-group">
              <input type="hidden" value="funding" name="purpose" class="form-control" disabled>
            </div>
            <div class="card-footer text-left">
              <button class="btn btn-primary mr-1"><span class="btn-text">Proceed</span></button>
            </div>
          </form>
      </div>
  </div>
</div>

<script>
  // Variables
  let fundForm = document.querySelector('.fund-form'),
  fundBtn = fundForm.querySelector('.btn'),
  btnText = fundBtn.querySelector('.btn-text');
  
  // Event Listeners
  fundForm.addEventListener('submit', (e)=>{
    e.preventDefault();

    // Loading animation
    btnText.innerHTML = `Please wait...<img width='20' src="<?=STATIC_ROOT; ?>/dashboard/img/spinner-white.svg">`;
    fundBtn.disabled = true;

    fetch(window.location.href, {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          'csrf_token': fundForm['csrf_token'].value,
          'amount': fundForm['amount'].value,
          'purpose': fundForm['purpose'].value,
          'method': fundForm['method'].value,
        })
    })
    .then((response)=>{
        return response.json()
    })
    .then((data)=>{
        console.log(data);
        if (data['status'] == "success") {
            setTimeout(()=>{
              btnText.innerHTML = `Success`;
              fundBtn.disabled = true;
              setTimeout(()=>{
                window.location.href = data['payment_url'];
              }, 2000);
            }, 3000);
        } else {
          setTimeout(()=>{
            btnText.innerHTML = `Proceed`;
            fundBtn.disabled = false;
            swal(data['message'], {icon: 'error'});
          }, 3000);
        }
    })
    .catch((err)=>{
        console.log(err);
        btnText.innerHTML = `Proceed`;
        fundBtn.disabled = false;
        swal('Service is temporarily down');
    })


  })
</script>