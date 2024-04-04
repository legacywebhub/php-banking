<div class="card">
    <div class="card-header">
      <h4>Request For A Loan</h4>
    </div>
    <div class="card-body">
      <form class="loan-form" method="post">
          <h5 class="my-3">Personal Information</h5>
          
          <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
          <div class="form-group">
            <label for="name">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="<?=$context['user']['fullname']; ?>" disabled>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="amount">Amount (<?=$context['user']['currency']; ?>)<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="amount" maxlength="12" onkeypress="return onlyNumberKey(event)" required>
            </div>
            <div class="form-group col-md-6">
              <label for="duration">Duration In Months<span class="text-danger">*</span></label>
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
            <label>Remark <span class="text-danger">*</span></label>
            <textarea class="form-control" maxlength="755" name="remark" placeholder="Purpose of loan" required></textarea>
          </div>
          <div class="form-group">
            <label for="name">Approximated Monthly Income (<?=$context['user']['currency']; ?>)<span class="text-danger">*</span></label>
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

          <h5 class="my-5">Loan Information & Documents</h5>
          
          <div class="form-group">
              <label>Loan Type<span class="text-danger">*</span></label>
              <select class="form-control" name="loan_type" required>
              <option value="">Select</option>
                <option value="Unsecured Personal Loans">Unsecured Personal Loans</option>
                <option value="Secured Personal Loans">Secured Personal Loans</option>
                <option value="Debt Consolidation Loans">Debt Consolidation Loans</option>
                <option value="Term Loans">Term Loans</option>
                <option value="SBA Loans">SBA Loans</option>
                <option value="Business Lines of Credit">Business Lines of Credit</option>
              </select>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Personal identification<span class="text-danger">*</span></label>
              <input type="file" class="form-control" name="personal_identification" required>
              <small class="text-danger ml-2">e.g., driver's license, passport</small>
            </div>
            <div class="form-group col-md-6">
              <label>Business documentation (Compulsory for business loans)</label>
              <input type="file" class="form-control" name="business_documentation">
              <small class="text-danger ml-2">e.g., business registration, financial statements, tax returns</small>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Proof of income<span class="text-danger">*</span></label>
              <input type="file" class="form-control" name="proof_of_income" required>
              <small class="text-danger ml-2">e.g., pay stubs, bank statements</small>
            </div>
            <div class="form-group col-md-6">
              <label>Collateral documentation (if applicable)</label>
              <input type="file" class="form-control" name="collateral_documentation">
            </div>
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
                  <th>Loan Type</th>
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
                    <td><?=$loan['loan_type']; ?></td>
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
  btnText = loanBtn.querySelector('.btn-text'),
  loanTable = document.querySelector('tbody'),
  noLoanRow = document.querySelector('.no-loan-row'); // Row that displays when no loan

  // Event Listeners
  loanForm.addEventListener('submit', (e)=>{
    e.preventDefault(); 

    // Variables
    let terms = loanForm["terms"].value,
    personalIDField = validateDocumentFileType(loanForm["personal_identification"]),
    businessDocField = validateDocumentFileType(loanForm["business_documentation"]),
    poiField = validateDocumentFileType(loanForm["proof_of_income"]),
    collateralField = validateDocumentFileType(loanForm["collateral_documentation"]);

    if (!terms) {
      swal('Please accept loan terms and condition', {icon: 'warning'});
    } else if(personalIDField !== true) {
      swal(personalIDField, {icon: 'error'});
    }  else if(poiField !== true) {
      swal(poiField, {icon: 'error'});
    } else {
      // Creating a form object from our form
      // containing our form data and images
      let formData = new FormData(loanForm);
      // Loading animation
      btnText.innerHTML = `Submitting request...<img width='20' src="<?=STATIC_ROOT; ?>/dashboard/img/spinner-white.svg">`;
      loanBtn.disabled = true;

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
            loanForm.reset();
            btnText.innerHTML = "Success";
            // Checking and deleting no loan row
            if (noLoanRow != null) {
              noLoanRow.innerHTML = "";
            }
            // Appending new loan request to loan table
            let loanRow = document.createElement('tr'); // 
            loanRow.innerHTML = `
              <td>${data['loan']['loan_id']}</td>
              <td>${data['loan']['loan_type']}</td>
              <td>${data['loan']['currency']}${data['loan']['amount']}</td>
              <td>${data['loan']['duration_in_months']}</td>
              <td>
                <div class="badge badge-warning text-capitalize">${data['loan']['status']}</div>
              </td>
              <td><a href="process-loan?loan_id=${data['loan']['loan_id']}" class="btn btn-outline-warning">Proceed</a></td>
            `;
            loanTable.appendChild(loanRow);
            // Show success message
            swal("Loan request was successfully placed and waiting approval", {icon:'success'});
            setTimeout(()=>{
              window.location.href = `process-loan?loan_id=${$data['loan_id']}`;
            }, 3000);
          } else {
            btnText.innerHTML = 'Submit';
            loanBtn.disabled = false;
            swal(data['message'], {icon: 'error'});
          }
        })
        .catch((err)=>{
          console.log(err);
          btnText.innerHTML = 'Submit';
          loanBtn.disabled = false;
          swal('Service temporarily unavailable at the moment', {icon: 'error'});
        })
      }, 3000)
    }
  })
</script>