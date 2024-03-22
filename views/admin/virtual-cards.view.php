<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Virtual Card List </h4>
                
                <div class="card-header-form">
                    <form action="" method="get">
                      <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="Search card info">
                        <div class="input-group-btn">
                          <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
            
            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                    <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                <?php endif ?>

                <div class="table-responsive">
                    <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th class="text-center">
                            <div class="custom-checkbox custom-checkbox-table custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                            </div>
                        </th>
                        <th>User</th>
                        <th>Card Type</th>
                        <th>Card Number</th>
                        <th>CVV</th>
                        <th>Card Pin</th>
                        <th>Valid Till</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php if (empty($context['virtual_cards']['result'])): ?>
                        <tr>
                            <td>No Virtual Cards Yet</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($context['virtual_cards']['result'] as $virtual_card): ?>
                            <tr class="mt-2" style="margin-top: 10px !important;">
                                <td class="p-0 text-center">
                                    <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                                    <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td><?=fetch_user($virtual_card['user_id'])['fullname'] ?? "Invalid User"; ?></td>
                                <td><?=$virtual_card['card_type'] ?? "-"; ?></td>
                                <td><?=$virtual_card['card_number'] ?? "-"; ?></td>
                                <td><?=$virtual_card['cvv'] ?? "-"; ?></td>
                                <td><?=$virtual_card['card_pin'] ?? "-"; ?></td>
                                <td><?=$virtual_card['valid_till'] ?? "-"; ?></td>
                                <td class="align-middle">
                                    <?php if($virtual_card['status'] == null): ?>
                                        -
                                    <?php elseif($virtual_card['status'] == "active"): ?>
                                        <div class="badge badge-success">Active</div>
                                    <?php elseif($virtual_card['status'] == "pending"): ?>
                                        <div class="badge badge-warning">Pending</div>
                                    <?php else: ?>
                                        <div class="badge badge-danger"><?=ucfirst($virtual_card['status']); ?></div>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <?php if($virtual_card['status'] == "pending"): ?>
                                        <a href="approve-virtual_card?id=<?=$virtual_card['id']; ?>" class="btn btn-secondary btn-action" title="Approve">Approve</a>
                                        <a href="decline-virtual_card?id=<?=$virtual_card['id']; ?>" class="btn btn-secondary btn-action" title="Decline">Decline</a>
                                    <?php else: ?>
                                        -
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                    </table>
                </div>

                <div class="pagination-container my-3">
                <span style="margin: 0px 10px;">Showing Page <b><?=$context['virtual_cards']['page'] ?></b> 0f <b><?=$context['virtual_cards']['num_of_pages'] ?></b></span>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($context['virtual_cards']['has_previous']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['virtual_cards']['previous_page'] ?>" aria-label="Previous">
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

                        <li class="page-item active"><a class="page-link" href="javascript:void(0)"><?=$context['virtual_cards']['page'] ?></a></li>


                        <?php if ($context['virtual_cards']['has_next']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['virtual_cards']['next_page'] ?>" aria-label="Next">
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
                    <span style="margin: 0px 10px;"><b>Total (<?=$context['virtual_cards']['total'] ?>)</b></span>
                </div>
            </div>
        </div>
    </div>
</div>