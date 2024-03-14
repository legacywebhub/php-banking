<div class="card">
    <div class="card-header">
      <h4>Request For A Loan</h4>
    </div>
    <div class="card-body">
      <form class="loan-form" method="post">
          <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="<?=$context['user']['fullname']; ?>" disabled>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="amount">Amount (<?=$context['user']['currency']; ?>)</label>
              <input type="number" class="form-control" name="amount" maxlength="12" onkeypress="return onlyNumberKey(event)" required>
            </div>
            <div class="form-group col-md-6">
              <label for="duration">Duration In Months</label>
              <select class="form-control" name="duration_in_months" required>
              <option value="">Select Duration</option>
                <option value=1>1 Month</option>
                <option value=2>2 Months</option>
                <option value=3>3 Months</option>
                <option value=4>4 Months</option>
                <option value=6>6 Months</option>
                <option value=9>9 Months</option>
                <option value=12>12 Months</option>
                <option value=18>18 Months</option>
                <option value=24>24 Months</option>
                <option value=36>36 Months</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Remark</label>
            <textarea class="form-control" maxlength="755" name="remark" placeholder="Purpose of loan" required></textarea>
          </div>
          <div class="form-group">
            <label for="name">Approximated Monthly Income (<?=$context['user']['currency']; ?>)</label>
            <select class="form-control" name="user_monthly_income" required>
              <option value=2500>Less than 5000</option>
              <option value=5000>5000-10000</option>
              <option value=10000>10000-20000</option>
              <option value=20000>20000-30000</option>
              <option value=30000>30000-40000</option>
              <option value=40000>40000-50000</option>
              <option value=50000>50000-100000</option>
              <option value=100000>100000-1000000</option>
              <option value=1000000>Greater than 1000000</option>
            </select>
          </div>
          <div class="form-group mb-0">
            <div class="form-check">
              <input name="terms" class="form-check-input" type="checkbox" id="terms" required>
              <label class="form-check-label" for="terms">
                I agree to the loan terms
              </label>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary"><span class="btn-text">Submit</span></button>
        </div>
      </form>

  </div>

  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12">
      <div class="card">
        <div class="card-header">
          <h4>Your Previous Requests</h4>
        </div>
        
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th>Loan ID</th>
                  <th>Amount</th>
                  <th>Duration (in months)</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if($context['recent_loans']): ?>
                  <?php foreach($context['recent_loans'] as $loan): ?>
                  <tr>
                    <td><?=$loan['loan_id']; ?></td>
                    <td><?=$loan['currency'].$loan['amount']; ?></td>
                    <td><?=$loan['duration_in_months']; ?></td>
                    <td>
                      <?php if($loan['status']=="active"): ?>
                      <div class="badge badge-success text-capitalize"><?=ucwords($loan['status']); ?></div>
                      <?php elseif($loan['status']=="pending"): ?>
                      <div class="badge badge-warning text-capitalize"><?=ucwords($loan['status']); ?></div>
                      <?php elseif($loan['status']=="declined"): ?>
                      <div class="badge badge-danger text-capitalize"><?=ucwords($loan['status']); ?></div>
                      <?php elseif($loan['status']=="closed"): ?>
                      <div class="badge badge-secondary text-capitalize"><?=ucwords($loan['status']); ?></div>
                      <?php endif ?>
                    </td>
                    <td><a href="loan?loan_id=<?=$loan['loan_id']; ?>" class="btn btn-outline-primary">View</a></td>
                  </tr>
                  <?php endforeach ?>
                <?php else: ?>
                  <tr class="no-loan-row">
                    <td class="p-0 text-center">No Loans Yet</td>
                  </tr>
                <?php endif ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


<script type="text/javascript">
  // Variables
  let loanForm = document.querySelector('.loan-form'),
  loanBtn = document.querySelector('.btn'),
  loanTable = document.querySelector('tbody'),
  noLoanRow = document.querySelector('.no-loan-row'); // Row that displays when no loan
  console.log(noLoanRow);

  // Event Listeners
  loanForm.addEventListener('submit', (e)=>{
    e.preventDefault()

    let terms = loanForm["terms"].value,
    btnText = loanBtn.querySelector('.btn-text');

    if (!terms) {
      swal('Please accept loan terms and condition', {icon: 'warning'});
    } else {
      // Loading animation
      btnText.innerHTML = `Submitting request...<img width='20' src="<?=STATIC_ROOT; ?>/dashboard/img/spinner-white.svg">`;
      loanBtn.disabled = true;

      fetch(window.location.href, {
        method: "POST",
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          'csrf_token': loanForm['csrf_token'].value,
          'user_monthly_income': loanForm['user_monthly_income'].value,
          'amount': parseInt(loanForm['amount'].value),
          'duration_in_months': parseInt(loanForm['duration_in_months'].value),
          'remark': loanForm['remark'].value
        })
      })
      .then((response)=>{
        return response.json()
      })
      .then((data)=>{
        console.log(data);
        if (data['status'] == "success") {
          setTimeout(()=>{
            btnText.innerHTML = "Success";
            loanBtn.disabled = true;
            // Checking and deleting no loan row
            if (noLoanRow != null) {
              noLoanRow.innerHTML = "";
            }
            // Appending new loan request to loan table
            let loanRow = document.createElement('tr'); // 
            loanRow.innerHTML = `
                <td>${data['loan']['loan_id']}</td>
                <td>${data['loan']['currency']}${data['loan']['amount']}</td>
                <td>${data['loan']['duration_in_months']}</td>
                <td>
                  <div class="badge badge-warning text-capitalize">${data['loan']['status']}</div>
                </td>
                <td><a href="loan?loan_id=${data['loan']['id']}" class="btn btn-outline-primary">View</a></td>
              `;
            loanTable.appendChild(loanRow);
            setTimeout(()=>{
              swal("Loan request was successfully placed and waiting approval", {icon:'success'});
            }, 2000)
          }, 5000)
        } else {
          setTimeout(()=>{
            btnText.innerHTML = 'Submit';
            loanBtn.disabled = false;
            swal('Sorry.. Could not place loan request', {icon: 'danger'});
          }, 3000)
        }
      })
      .catch((err)=>{
        setTimeout(()=>{
          console.log(err);
          btnText.innerHTML = 'Submit';
          loanBtn.disabled = false;
          swal('Service temporarily unavailable at the moment');
        }, 3000)
      })
    }
  })
</script>