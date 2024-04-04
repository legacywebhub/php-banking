<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Loan List </h4>
                
                <div class="card-header-form">
                    <form action="" method="get">
                      <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="Search loan id">
                        <div class="input-group-btn">
                          <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
            
            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                    <h6 class="col-12 my-3 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                <?php endif ?>

                <div class="table-responsive">
                    <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th>Application Date</th>
                        <th>Loan ID</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Duration (in months)</th>
                        <th>Calculated Interest</th>
                        <th>Calculated Returns</th>
                        <th>Paid</th>
                        <th>Last Payment Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php if (empty($context['loans']['result'])): ?>
                        <tr>
                            <td>No loans Yet</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($context['loans']['result'] as $loan): ?>
                            <?php $user = fetch_user($loan['user_id']) ?? []; ?>
                            <tr class="mt-2" style="margin-top: 10px !important;">
                                <td><?=format_datetime_timezone($loan['date'], $context['admin']['timezone']); ?></td>
                                <td><?=$loan['loan_id']; ?></td>
                                <td><?=$user['fullname'] ?? "Invalid User"; ?></td>
                                <td><?=$user['currency'].$loan['amount']; ?></td>
                                <td><?=$loan['duration_in_months']." Months"; ?></td>
                                <td><?=$user['currency'].$loan['interest']; ?></td>
                                <td><?=$user['currency'].$loan['total_returns']; ?></td>
                                <td><?=$user['currency'].$loan['paid']; ?></td>
                                <td>
                                    <?php if($loan['last_payment_date']): ?>
                                    <?=format_datetime_timezone($loan['last_payment_date'], $context['admin']['timezone']); ?>
                                    <?php endif ?>    
                                </td>
                                <td class="align-middle">
                                    <?php if($loan['status'] == "active"): ?>
                                        <div class="badge badge-success">Active</div>
                                    <?php elseif($loan['status'] == "pending"): ?>
                                        <div class="badge badge-warning">Pending</div>
                                    <?php elseif($loan['status'] == "declined"): ?>
                                        <div class="badge badge-danger">Declined</div>
                                    <?php elseif($loan['status'] == "closed"): ?>
                                        <div class="badge badge-secondary">Closed</div>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <span class="action-btns">
                                    <a href="loan?loan_id=<?=$loan['loan_id']; ?>" class="btn btn-primary btn-action" title="View">View</a>
                                    <?php if($loan['status'] == "pending"): ?>
                                        <a href="approve-loan?loan_id=<?=$loan['loan_id']; ?>" class="btn btn-info btn-action" title="Approve">Approve</a>
                                        <a href="decline-loan?loan_id=<?=$loan['loan_id']; ?>" class="btn btn-danger btn-action" title="Decline">Decline</a>
                                    <?php endif ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                    </table>
                </div>

                <div class="pagination-container my-3">
                <span style="margin: 0px 10px;">Showing Page <b><?=$context['loans']['page'] ?></b> 0f <b><?=$context['loans']['num_of_pages'] ?></b></span>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($context['loans']['has_previous']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['loans']['previous_page'] ?>" aria-label="Previous">
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
                            <a class="page-link" href="?page=<?=$context['loans']['next_page'] ?>" aria-label="Next">
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
                    <span style="margin: 0px 10px;"><b>Total (<?=$context['loans']['total'] ?>)</b></span>
                </div>
            </div>
        </div>
    </div>
</div>