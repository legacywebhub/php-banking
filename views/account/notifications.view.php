<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="boxs mail_listing">
            <div class="inbox-center table-responsive">
                <table class="table table-hover">
                <thead>
                    <tr>
                    <th class="text-center">
                        <label class="form-check-label">
                        <input type="checkbox">
                        <span class="form-check-sign"></span>
                        </label>
                    </th>
                    <th colspan="3">
                        <div class="inbox-header">
                        <div class="mail-option">
                            <div class="email-btn-group m-l-15">
                            <a href="#" class="col-dark-gray waves-effect m-r-20" title="" data-toggle="tooltip" data-original-title="back">
                                <i class="material-icons">keyboard_return</i>
                            </a>
                            <a href="#" class="col-dark-gray waves-effect m-r-20" title="" data-toggle="tooltip" data-original-title="Archive">
                                <i class="material-icons">archive</i>
                            </a>
                            <div class="p-r-20">|</div>
                            <a href="#" class="col-dark-gray waves-effect m-r-20" title="" data-toggle="tooltip" data-original-title="Error">
                                <i class="material-icons">error</i>
                            </a>
                            <a href="#" class="col-dark-gray waves-effect m-r-20" title="" data-toggle="tooltip" data-original-title="Tag">
                                <i class="material-icons">local_offer</i>
                            </a>
                            </div>
                        </div>
                        </div>
                    </th>
                    <th class="hidden-xs" colspan="2">
                        <div class="pull-right">
                        <div class="email-btn-group m-l-15">
                        <?php if ($context['notifications']['has_previous']): ?>
                            <a href="?page=<?=$context['notifications']['previous_page'] ?>" class="col-dark-gray waves-effect m-r-20" title="" data-toggle="tooltip" data-original-title="previous">
                            <i class="material-icons">navigate_before</i>
                            </a>
                            <?php else: ?>
                            <a href="javascript:void(0);" class="col-dark-gray waves-effect m-r-20" title="" data-toggle="tooltip" data-original-title="previous">
                            <i class="material-icons">navigate_before</i>
                            </a>
                            <?php endif ?>

                            <?php if ($context['notifications']['has_next']): ?>
                                <a href="?page=<?=$context['notifications']['next_page'] ?>" class="col-dark-gray waves-effect m-r-20" title="" data-toggle="tooltip" data-original-title="next">
                                <i class="material-icons">navigate_next</i>
                                </a>
                            <?php else: ?>
                                <a href="javascript:void(0);" class="col-dark-gray waves-effect m-r-20" title="" data-toggle="tooltip" data-original-title="next">
                                <i class="material-icons">navigate_next</i>
                                </a>
                            <?php endif ?>
                        </div>
                        </div>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($context['notifications']['result'])): ?>
                        <tr>
                            <td>No new notification</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($context['notifications']['result'] as $notification): ?>
                        <tr class="unread">
                            <td class="tbl-checkbox">
                            <label class="form-check-label">
                                <input type="checkbox">
                                <span class="form-check-sign"></span>
                            </label>
                            </td>
                            <td class="hidden-xs">
                            <i class="material-icons">star_border</i>
                            </td>
                            <td class="hidden-xs"> <?=format_datetime($notification['date']); ?></td>
                            <td style="word-wrap: break-word !important;">
                                <?php if (check_new($notification['date'])): ?><span class="badge badge-success mr-3">New</span><?php endif ?>
                                <?=$notification['message']; ?>
                            </td>
                            <td class="hidden-xs">
                                <i class="fas fa-trash text-danger cursor-pointer" data-id=<?=$notification['id']; ?>></i>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                <p class="p-15">Showing page <?=$context['notifications']['page'] ?> - <?=$context['notifications']['num_of_pages'] ?> <b>Total(<?=$context['notifications']['total'] ?>)</b></p>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<script>
  let trashBtns = document.querySelectorAll('.fa-trash');

  Array.from(trashBtns).forEach((btn)=>{

    btn.addEventListener('click', ()=>{
      // Fetching Notification id tied to button
      let notificationId = btn.dataset.id,
      // Fetching row of deleted notification
      tableRow = btn.parentElement.parentElement;

      // Sending id for delete
      fetch(window.location.href, {
        method: "POST",
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({'id':notificationId})
      })
      .then((response)=>{
        return response.json();
      })
      .then((data)=>{
        // Consoling response data
        console.log(data);
        
        if (data['status'] == "success") {
          // Deleting row from DOM
          tableRow.innerHTML = "";
        } else {
          swal('Service is temporarily down', {icon: 'error'});
        }
      })
      .catch((err)=>{
        console.log(err);
        swal('Service is temporarily down', {icon: 'error'});
      })
    })

  })
</script>