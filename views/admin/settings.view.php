<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Company Settings</h4>
                
                <?php if (empty($context['settings'])): ?>
                <div class="card-header-form">
                    <a href="add-setting" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> Add Setting</a>
                </div>
                <?php endif ?>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                <div class="form-group">
                    <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                </div>
                <?php endif ?>

                <div class="table-responsive">
                    <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th>Name</th>
                        <th>Domain</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    <?php if (empty($context['settings'])): ?>
                        <tr>
                            <td>
                                No site settings
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($context['settings'] as $setting): ?>
                        <tr class="mt-2" style="margin-top: 10px !important;">
                            <td><?=$setting['name']; ?></td>
                            <td><?=$setting['domain']; ?></td>
                            <td><?=$setting['email']; ?></td>
                            <td>
                                <span class="action-btns">
                                <a href="edit-setting?id=<?=$setting['id']; ?>" class="btn btn-primary btn-action" data-toggle="tooltip" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                <a href="javascript:void(0);" class="btn btn-danger btn-action"><i class="fas fa-trash"></i></a>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>