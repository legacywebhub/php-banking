<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Transaction List </h4>
                
                <div class="card-header-form">
                    <form action="" method="get">
                      <div class="input-group">
                        <input name="search" type="text" class="form-control" maxlength="24" placeholder="Search transaction id" required>
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
                        <th>Date</th>
                        <th>transaction ID</th>
                        <th>Description</th>
                        <th>From User</th>
                        <th>To User</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                    <?php if (empty($context['transactions']['result'])): ?>
                        <tr>
                            <td>No transactions Yet</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($context['transactions']['result'] as $transaction): ?>
                            <?php $from_user = fetch_user($transaction['from_user']); ?>
                            <tr class="mt-2" style="margin-top: 10px !important;">
                                <td><?=format_datetime($transaction['date']); ?></td>
                                <td><?=$transaction['transaction_id']; ?></td>
                                <td><?=ucfirst($transaction['description']); ?></td>
                                <td><?=$from_user['fullname']; ?></td>
                                <td><?=fetch_user($transaction['to_user'])['fullname']; ?></td>
                                <td><?=$from_user['currency'].$transaction['amount']; ?></td>
                                <td class="align-middle">
                                    <?php if($transaction['status'] == "pending"): ?>
                                        <div class="badge badge-warning">Pending</div>
                                    <?php elseif($transaction['status'] == "successful"): ?>
                                        <div class="badge badge-success">Successful</div>
                                    <?php else: ?>
                                        <div class="badge badge-danger">Failed</div>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                    </table>
                </div>

                <div class="pagination-container my-3">
                <span style="margin: 0px 10px;">Showing Page <b><?=$context['transactions']['page'] ?></b> 0f <b><?=$context['transactions']['num_of_pages'] ?></b></span>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($context['transactions']['has_previous']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['transactions']['previous_page'] ?>" aria-label="Previous">
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
                            <a class="page-link" href="?page=<?=$context['transactions']['next_page'] ?>" aria-label="Next">
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
                    <span style="margin: 0px 10px;"><b>Total (<?=$context['transactions']['total'] ?>)</b></span>
                </div>
            </div>
        </div>
    </div>
</div>