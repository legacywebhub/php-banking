<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Loan History</h4>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-center">
                      <div class="custom-checkbox custom-checkbox-table custom-control">
                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                      </div>
                    </th>
                    <th>Date/Time</th>
                    <th>Loan ID</th>
                    <th>Amount</th>
                    <th>Duration</th>
                    <th>Paid</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php if(!empty($context['loans']['result'])): ?>
                      <?php foreach($context['loans']['result'] as $loan): ?>
                      <tr>
                          <td class="p-0 text-center">
                            <div class="custom-checkbox custom-control">
                              <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                              <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                            </div>
                          </td>
                          <td><?=format_datetime_timezone($loan['date'], $context['user']['timezone']); ?></td>
                          <td><?=$loan['loan_id']; ?></td>
                          <td><?=$loan['currency'].$loan['amount']; ?></td>
                          <td><?=$loan['duration_in_months']; ?> Months</td>
                          <td><?=$loan['currency'].$loan['paid']; ?></td>
                          <td class="status">
                              <?php if($loan['status']=='active'): ?>
                              <div class="badge badge-success">Active</div>
                              <?php elseif($loan['status']=='pending'): ?>
                              <div class="badge badge-warning">Pending</div>
                              <?php elseif($loan['status']=='closed'): ?>
                              <div class="badge badge-secondary">Closed</div>
                              <?php else: ?>
                              <div class="badge badge-danger">Declined</div>
                              <?php endif ?>
                          </td>
                          <td>
                            <?php if($loan['status']=='pending'): ?>
                              <a href="process-loan?loan_id=<?=$loan['loan_id']; ?>" class="btn btn-outline-warning">Process</a>
                            <?php else: ?>
                              <a href="loan?loan_id=<?=$loan['loan_id']; ?>" class="btn btn-outline-primary">View</a>
                            <?php endif ?>
                          </td>
                      </tr>
                      <?php endforeach ?>
                  <?php else: ?>
                    <tr>
                      <td class="p-0 text-center">No Loans</td>
                    </tr>
                  <?php endif ?>
                </tbody>
            </table>
          </div>
        </div>

        
        <div class="card-body pagination-container">
            <div class="buttons" style="text-align: right !important;">
              <nav aria-label="Page navigation example">
                <span>Showing Page <b><?=$context['loans']['page']; ?></b> 0f <b><?=$context['loans']['num_of_pages']; ?></b></span>
                <ul class="pagination">

                <?php if ($context['loans']['has_previous']): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?=$context['loans']['previous_page']; ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <?php else: ?>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <?php endif ?>


                  <li class="page-item active"><a class="page-link" href="javascript:void(0)"><?=$context['loans']['page'] ?></a></li>

                  <?php if ($context['loans']['has_next']): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?=$context['loans']['next_page']; ?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                  <?php else: ?>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                  <?php endif ?>
                </ul>
              </nav>
            </div>
        </div>
        
      </div>
    </div>
</div>