<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Payment History</h4>
        <div class="card-header-form">
          <form>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search Payment ID">
              <div class="input-group-btn">
                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="card-body p-0">
        <?php if($context['payments']['result']): ?>
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
                <th>Payment ID</th>
                <th>Amount</th>
                <th>Purpose</th>
                <th>Payment Method</th>
                <th>Status</th>
              </tr>
              <?php foreach($context['payments']['result'] as $payment): ?>
              <tr>
                <td class="p-0 text-center">
                  <div class="custom-checkbox custom-control">
                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                      id="checkbox-1">
                    <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                  </div>
                </td>
                <td><?=format_datetime_timezone($payment['date'], $context['user']['timezone']); ?></td>
                <td><?=ucwords($payment['payment_id']); ?></td>
                <td><?=$context['user']['currency'].$payment['amount']; ?></td>
                <td><?=ucwords($payment['purpose']); ?></td>
                <td><?=ucwords($payment['method']); ?></td>
                <td class="status">
                  <?php if($payment['status'] == 'pending' && !is_null($payment['status'])): ?>
                    <div class="badge badge-warning">Processing</div>
                  <?php elseif($payment['status'] == 'successful'): ?>
                    <div class="badge badge-success">Successful</div>
                  <?php elseif($payment['status'] == 'pending'): ?>
                    <div class="badge badge-secondary">Pending</div>
                  <?php else: ?>
                    <div class="badge badge-danger">Failed</div>
                  <?php endif ?>
                </td>
              </tr>
              <?php endforeach ?>
            </table>
          </div>

          <div class="pagination-container">
            <div class="buttons" style="text-align: right !important;">
              <nav aria-label="Page navigation example">
                <span>Showing Page <b><?=$context['payments']['page']; ?></b> 0f <b><?=$context['payments']['num_of_pages']; ?></b></span>
                <ul class="pagination">

                <?php if ($context['payments']['has_previous']): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?=$context['payments']['previous_page']; ?>" aria-label="Previous">
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

                  <li class="page-item active"><a class="page-link" href="javascript:void(0)"><?=$context['payments']['page'] ?></a></li>

                  <?php if ($context['payments']['has_next']): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?=$context['payments']['next_page']; ?>" aria-label="Next">
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
            No Records Yet
          </div>
        <?php endif ?>

    </div>
  </div>
</div>