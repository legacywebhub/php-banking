<style>
    .pagination-container {
      display: flex;
      justify-content:center;
      align-items: center;
    }
</style>



<div class="row">
    <div class="col-12">
      <div class="card">

        <div class="card-header">
          <h4>Transaction History</h4>
        </div>

        <div class="card-body p-0">
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
                <th>Transaction ID</th>
                <th>Amount</th>
                <th>Transaction Type</th>
                <th>Description</th>
                <th>Recipient</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              <?php if(!empty($context['transactions']['result'])): ?>
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
                  <td><?=$transaction['amount']; ?><td>
                  <td>
                    <?php if ($transaction['from_user']==$context['user']['id']): ?>
                    Debit
                    <?php elseif ($transaction['to_user']==$context['user']['id']): ?>
                    Credit
                    <?php endif ?>
                  </td>
                  <td><?=ucfirst($transaction['description']); ?></td>
                  <td>
                    <?php if ($transaction['to_user']): ?>
                      <?=ucwords($transaction['to_user']); ?>
                    <?php else: ?>
                    -
                    <?php endif ?>
                  </td>
                  <td class="status">
                    <?php if($transaction['status']=='successful'): ?>
                    <div class="badge badge-success">SUCCESSFUL</div>
                    <?php elseif($transaction['status']=='pending'): ?>
                    <div class="badge badge-warning">PENDING</div>
                    <?php else: ?>
                    <div class="badge badge-danger"><?=ucwords($transaction['status']); ?></div>
                    <?php endif ?>
                  </td>
                  <td><a href="transaction' transaction.id" class="btn btn-outline-primary">View</a></td>
                </tr>
                <?php endforeach ?>
              <?php else: ?>
                <tr>
                  <td class="p-0 text-center">No Transactions Yet!</td>
                </tr>
              <?php endif ?>
            </table>
          </div>
        </div>

        
        <div class="card-body pagination-container">
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
      </div>
    </div>
  </div>