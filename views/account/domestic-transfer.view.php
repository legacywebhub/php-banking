<div class="row">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4>Domestic Transfer</h4>
      </div>
      <div class="card-body">
        <div class="balance-container">
            <div class="balance-box">
              <span><i class="fa fa-circle text-success"></i> Main Balance</span>
              <span><b><?=$context['user']['currency']; ?><span id="balance"><?=$context['user']['balance']; ?></span></b></span>
            </div>
            <div class="balance-box">
              <span><i class="fa fa-circle text-secondary"></i> Overdraft</span>
              <span><b><?=$context['user']['currency']; ?><span id="overdraft"><?=$context['user']['overdraft']; ?></span></b></span>
            </div>
        </div>
        
        <div class="mb-3 text-center">For Japan Banks Only</div>

        <form class="transfer-form" method="post">
          <div class="form-group">
            <label>Select Account</label>
            <select class="form-control" name="account">
              <option value="balance">Balance</option>
              <option value="overdraft">Overdraft</option>
            </select>
          </div>
          <div class="form-group">
            <label>Bank Name</label>
            <input type="text" name="bank-name" class="form-control" maxlength="60" required>
          </div>
          <div class="form-group">
            <label>Branch Number</label>
            <input type="text" name="branch-number" class="form-control" maxlength="60" required>
          </div>
          <div class="form-group">
            <label>Account Number</label>
            <input type="text" name="account-number" class="form-control" placeholder="51***910" maxlength="10" onkeypress="return onlyNumberKey(event)" required>
          </div>
          <div class="form-group">
            <label>Amount</label>
            <input type="text" name="amount" class="form-control" placeholder="$0.00" maxlength="12" onkeypress="return onlyNumberKey(event)" required>
          </div>
          <div class="form-group">
            <label>Remark</label>
            <textarea name="remark" class="form-control" maxlength="255" placeholder="(Optional)"></textarea>
          </div>
          <div class="form-group">
            <label>Transaction Pin</label>
            <input type="text" maxlength="4" name="pin" class="form-control" placeholder="****" onkeypress="return onlyNumberKey(event)" required>
          </div>
          <div class="card-footer text-left">
            <button class="btn btn-primary mr-1" type="submit"><span class="btn-text">Send</span></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// Variables
let transferForm = document.querySelector('.transfer-form'),
  transferBtn = transferForm.querySelector('.btn'),
  btnText = transferBtn.querySelector('.btn-text');

// Event Listeners
transferForm.addEventListener('submit', (e)=>{
  e.preventDefault()

  // Loading animation
  btnText.innerHTML = `Please wait..<img width='20' src="<?=STATIC_ROOT; ?>/dashboard/img/spinner-white.svg">`;
  transferBtn.disabled = true;

  setTimeout(()=>{
    btnText.innerHTML = `Send`;
    transferBtn.disabled = false;
    swal("Service not available at the moment", {icon: 'warning'});
  }, 5000)
}) 
</script>