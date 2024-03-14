<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Credit History</h4>
        <div class="card-header-form">
          <form>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search Transaction ID">
              <div class="input-group-btn">
                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="card-body p-0">
        <?php if($context['transactions']['result']): ?>
          <div class="table-responsive">
            <table class="table table-striped">
              <tr>
                <th class="text-center">
                  <div class="custom-checkbox custom-checkbox-table custom-control">
                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                      class="custom-control-input" id="checkbox-all">
                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                  </div>
                </th>
                <th>Date/Time</th>
                <th>Amount</th>
                <th>Transaction Type</th>
                <th>Description</th>
                <th>Issuer</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              <?php foreach($context['transactions']['result'] as $transaction): ?>
              <tr>
                <td class="p-0 text-center">
                  <div class="custom-checkbox custom-control">
                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                      id="checkbox-1">
                    <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                  </div>
                </td>
                <td><?=format_datetime_timezone($transaction['date'], $context['user']['timezone']); ?></td>
                <td><?=$context['user']['currency'].$transaction['amount']; ?></td>
                <td>
                  <?php if($transaction['from_user']==$context['user']['id']): ?>
                  Debit
                  <?php elseif($transaction['to_user']==$context['user']['id']): ?>
                  Credit
                  <?php endif ?>
                </td>
                <td><?=ucfirst($transaction['description']); ?></td>
                <td>
                  <?php if($transaction['from_user']): ?>
                    <?=ucwords(fetch_user($transaction['from_user'])['fullname']); ?>
                  <?php else: ?>
                    -
                  <?php endif ?>
                </td>
                <td class="status">
                  <?php if($transaction['status'] == 'successful'): ?>
                  <div class="badge badge-success">Successful</div>
                  <?php elseif($transaction['status'] == 'pending'): ?>
                  <div class="badge badge-warning">Pending</div>
                  <?php else: ?>
                  <div class="badge badge-danger">Failed</div>
                  <?php endif ?>
                </td>
                <td><a href="transaction?transaction_id=<?=$transaction['transaction_id']; ?>" class="btn btn-outline-primary">View</a></td>
              </tr>
              <?php endforeach ?>
            </table>
          </div>

          <div class="pagination-container">
            <div class="buttons" style="text-align: right !important;">
              <nav aria-label="Page navigation example">
                <span>Showing Page <b><?=$context['transactions']['page']; ?></b> 0f <b><?=$context['transactions']['num_of_pages']; ?></b></span>
                <ul class="pagination">

                <?php if ($context['transactions']['has_previous']): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?=$context['transactions']['previous_page']; ?>" aria-label="Previous">
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


                  <li class="page-item active"><a class="page-link" href="javascript:void(0)"><?=$context['transactions']['page'] ?></a></li>

                  <?php if ($context['transactions']['has_next']): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?=$context['transactions']['next_page']; ?>" aria-label="Next">
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
        <?php else: ?>
          <div class="my-3 mx-4 mb-5">
            No Credit Transactions Yet
          </div>
        <?php endif ?>

    </div>
  </div>
</div>