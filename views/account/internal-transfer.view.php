<div class="section-body">
  <div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4>Internal Transfer</h4>
        </div>
        <div class="card-body">
          <div class="balance-container">
              <div class="balance-box">
                  <span><i class="fa fa-circle text-success"></i> Main Balance</span>
                  <span><b><?=$context['user']['currency']; ?><span id="balance"><?=$context['user']['balance']; ?></span></b></span>
              </div>
              <div class="balance-box">
                  <span><i class="fa fa-circle text-secondary"></i> Overdraft</span>
                  <span><?=$context['user']['currency']; ?><span id="overdraft"><?=$context['user']['overdraft']; ?></span></b></span>
              </div>
          </div>
          <form class="transfer-form" method="post">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
            <div class="form-group">
              <label>Select Account <span class="text-danger">*</span></label>
              <select class="form-control" name="account" required>
                <option value="balance">Balance</option>
                <option value="overdraft">Overdraft</option>
              </select>
            </div>
            <div class="form-group">
              <label>Bank Name <span class="text-danger">*</span></label>
              <input type="text" value="<?=ucwords($context['settings']['name']); ?>" name="bank-name" class="form-control" readonly disabled>
            </div>
            <div class="form-group">
                <label>Account Number <span class="text-danger">*</span></label>
                <input type="text" maxlength="10" placeholder="51***910" name="account-number" class="form-control">
                <div id="validate-div">&nbsp;&nbsp;Validating..</div>
            </div>
            <div class="form-group">
                <label>Amount (<?=$context['user']['currency']; ?>) <span class="text-danger">*</span></label>
                <input type="number" maxlength="12" placeholder="$0.00" name="amount" class="form-control">
            </div>
            <div class="form-group">
                <label>Remark</label>
                <textarea class="form-control" maxlength="255" name="remark" placeholder="(Optional)"></textarea>
            </div>
            <div class="form-group">
                <label>Transaction Pin <span class="text-danger">*</span></label>
                <input type="password" maxlength="4" placeholder="****" name="pin" class="form-control">
            </div>
            <div class="card-footer text-left">
              <button class="btn btn-primary mr-1" type="submit"><span class="btn-text">Send</span></button>
            </div>
          </form>
      </div>
  </div>
</div>

<script>
  let userBalance = document.querySelector('#balance'),
  userOverdraft = document.querySelector('#overdraft'),
  transferForm = document.querySelector('.transfer-form'),
  transferBtn = transferForm.querySelector('.btn'),
  btnText = transferBtn.querySelector('.btn-text');
  

  transferForm.addEventListener('submit', (e)=>{
    e.preventDefault();

    if (String(transferForm['pin'].value) == "<?=$context['user']['pin']; ?>") {
      swal({
        title: 'Proceed?',
        text: 'Once transaction is performed, it may not be reversed!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
      .then((arg) => {
        if (arg) {
          // Loading animation
          btnText.innerHTML = `Please wait...<img width='20' src="<?=STATIC_ROOT; ?>/dashboard/img/spinner-white.svg">`;
          transferBtn.disabled = true;

          fetch(window.location.href, {
            method: "POST",
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({
              "account": transferForm["account"].value,
              "amount": parseInt(transferForm["amount"].value),
              "account_number": transferForm["account-number"].value,
              "remark": transferForm["remark"].value,
              "pin": transferForm["pin"].value,
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
                transferBtn.disabled = true;
                userBalance.innerText = data['account']['new_balance'];
                userOverdraft.innerText = data['account']['new_overdraft'];
                swal(data['message'], {icon:'success'});
              }, 3000)
            } else {
              setTimeout(()=>{
                btnText.innerHTML = `Send`;
                transferBtn.disabled = false;
                swal(data['message'], {icon: 'error'});
              }, 3000)
            }
          })
          .catch((err)=>{
            setTimeout(()=>{
              console.log(err);
              btnText.innerHTML = `Send`;
              transferBtn.disabled = false;
              swal('Could not perform transfer');
            }, 3000)
          })
        } else {
          swal('Could not perform transfer');
        }
      });
    } else {
      swal('Incorrect Pin', { icon: 'error',});
    }
  })
</script>