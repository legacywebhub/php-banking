<style>
    .payment-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        visibility: hidden;
    }
    .card-details {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>


<div class="card">
    <div class="card-header">
      <h4>Virtual Card</h4>
    </div>

    <div class="card-body">
        <!-- Card container starts -->
        <div class="card-container">
            <!-- This is where the card starts -->
            <div class="creditcard" style="width: 350px;">
                <style>
                    .card-container {
                        text-align: center !important;
                        margin: 30px 0;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }
                    .bigger-rectangle {
                        fill:"#bdbdbd";
                    }
                    .smaller-rectangle {
                        fill:"#616161";
                    }
                    .chip-box, .card-text, .arrow-right {
                        font-size: 20px;
                        font-weight:bold;
                        fill: #fafafa;
                    }
                    .card-number {
                        font-size: 40px;
                    }
                    .card-name, .card-expire {
                        font-size: 30px;
                    }
                </style>
                <div class="front">
                    <div id="ccsingle"></div>
                    <svg version="1.1" id="cardfront" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
                        <g id="Front">
                            <g id="CardBackground">
                                <g id="Page-1_1_">
                                    <g id="amex_1_">
                                        <path class="bigger-rectangle" id="Rectangle-1_1_" fill="#bdbdbd" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40C0,17.9,17.9,0,40,0z"></path>
                                    </g>
                                </g>
                                <g> <rect x="169.81" y="31.89" width="143.72" height="234.42" fill="#ff5f00"></rect> <path d="M317.05,197.6A149.5,149.5,0,0,1,373.79,80.39a149.1,149.1,0,1,0,0,234.42A149.5,149.5,0,0,1,317.05,197.6Z" transform="translate(-132.74 -48.5)" fill="#eb001b"></path> <path d="M615.26,197.6a148.95,148.95,0,0,1-241,117.21,149.43,149.43,0,0,0,0-234.42,148.95,148.95,0,0,1,241,117.21Z" transform="translate(-132.74 -48.5)" fill="#f79e1b"></path> </g>
                                <path class="smaller_rectangle" fill="#616161" d="M750,431V193.2c-217.6-57.5-556.4-13.5-750,24.9V431c0,22.1,17.9,40,40,40h670C732.1,471,750,453.1,750,431z"></path>
                            </g>
                            <?php if($context['user']['has_active_card']): ?>
                            <text transform="matrix(1 0 0 1 60.106 295.0121)" id="card-number" class="card-number card-text"><?=$context['user']['virtual_card']['card_number']; ?></text>
                            <text transform="matrix(1 0 0 1 54.1064 428.1723)" id="svgname" class="card-name card-text"><?=strtoupper($context['user']['fullname']); ?></text>
                            <text transform="matrix(1 0 0 1 54.1074 389.8793)" class="card-text">Cardholder name</text>
                            <text transform="matrix(1 0 0 1 479.7754 388.8793)" class="card-text">expiration</text>
                            <text transform="matrix(1 0 0 1 65.1054 241.5)" class="card-text">card number</text>
                            <?php else: ?>
                            <text transform="matrix(1 0 0 1 60.106 295.0121)" id="card-number" class="card-number card-text">**** **** **** ****</text>
                            <text transform="matrix(1 0 0 1 54.1064 428.1723)" id="svgname" class="card-name card-text">**MASTER CARD**</text>
                            <text transform="matrix(1 0 0 1 54.1074 389.8793)" class="card-text">Cardholder name</text>
                            <text transform="matrix(1 0 0 1 479.7754 388.8793)" class="card-text">expiration</text>
                            <text transform="matrix(1 0 0 1 65.1054 241.5)" class="card-text">card number</text>
                            <?php endif ?>
                            <g>
                                <?php if($context['user']['has_active_card']): ?>
                                <text transform="matrix(1 0 0 1 574.4219 433.8095)" id="svgexpire" class="card-expire card-text"><?=$context['user']['virtual_card']['valid_till']; ?></text>
                                <?php else: ?>
                                <text transform="matrix(1 0 0 1 574.4219 433.8095)" id="svgexpire" class="card-expire card-text">0*/**</text>
                                <?php endif ?>
                                <text transform="matrix(1 0 0 1 479.3848 417.0097)" class="card-text">VALID</text>
                                <text transform="matrix(1 0 0 1 479.3848 435.6762)" class="card-text">THRU</text>
                                <polygon class="arrow-right" points="554.5,421 540.4,414.2 540.4,427.9"></polygon>
                            </g>
                            <g id="cchip">
                                <g>
                                    <path class="chip-box" d="M168.1,143.6H82.9c-10.2,0-18.5-8.3-18.5-18.5V74.9c0-10.2,8.3-18.5,18.5-18.5h85.3c10.2,0,18.5,8.3,18.5,18.5v50.2C186.6,135.3,178.3,143.6,168.1,143.6z"></path>
                                </g>
                                <g>
                                    <g>
                                        <rect x="82" y="70" class="st12" width="1.5" height="60"></rect>
                                    </g>
                                    <g>
                                        <rect x="167.4" y="70" class="st12" width="1.5" height="60"></rect>
                                    </g>
                                    <g>
                                        <path class="st12" d="M125.5,130.8c-10.2,0-18.5-8.3-18.5-18.5c0-4.6,1.7-8.9,4.7-12.3c-3-3.4-4.7-7.7-4.7-12.3
                                c0-10.2,8.3-18.5,18.5-18.5s18.5,8.3,18.5,18.5c0,4.6-1.7,8.9-4.7,12.3c3,3.4,4.7,7.7,4.7,12.3
                                C143.9,122.5,135.7,130.8,125.5,130.8z M125.5,70.8c-9.3,0-16.9,7.6-16.9,16.9c0,4.4,1.7,8.6,4.8,11.8l0.5,0.5l-0.5,0.5
                                c-3.1,3.2-4.8,7.4-4.8,11.8c0,9.3,7.6,16.9,16.9,16.9s16.9-7.6,16.9-16.9c0-4.4-1.7-8.6-4.8-11.8l-0.5-0.5l0.5-0.5
                                c3.1-3.2,4.8-7.4,4.8-11.8C142.4,78.4,134.8,70.8,125.5,70.8z"></path>
                                    </g>
                                    <g>
                                        <rect x="82.8" y="82.1" class="st12" width="25.8" height="1.5"></rect>
                                    </g>
                                    <g>
                                        <rect x="82.8" y="117.9" class="st12" width="26.1" height="1.5"></rect>
                                    </g>
                                    <g>
                                        <rect x="142.4" y="82.1" class="st12" width="25.8" height="1.5"></rect>
                                    </g>
                                    <g>
                                        <rect x="142" y="117.9" class="st12" width="26.2" height="1.5"></rect>
                                    </g>
                                </g>
                            </g>
                        </g>
                        <g id="Back">
                        </g>
                    </svg>
                </div>
            </div>
            <!-- This is where the card ends -->
        </div>
        <!-- Card container ends -->
        <?php if($context['user']['has_active_card']): ?>
        <div class="card-details mt-5">
            <div class="col-md-9 col-lg-9">
                <div class="card">
                    <div class="card-header">
                    <h4>Card Details</h4>
                    <div class="card-header-form toggle-eye show">
                        <i class="fas fa-eye text-secondary"></i>
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="py-4">
                        <p class="clearfix">
                        <span class="float-left">
                            Status
                        </span>
                        <span class="float-right text-muted">
                            <?=strtoupper($context['user']['virtual_card']['status']); ?>
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Card Type
                        </span>
                        <span class="float-right text-muted">
                            <?=strtoupper($context['user']['virtual_card']['card_type']); ?>
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Card Name
                        </span>
                        <span class="float-right text-muted">
                            <?=strtoupper($context['user']['fullname']); ?>
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Card Number
                        </span>
                        <span class="float-right text-muted card-number2">
                            <?=$context['user']['virtual_card']['card_number']; ?>
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            CVV
                        </span>
                        <span class="float-right text-muted card-cvv">
                            <?=$context['user']['virtual_card']['cvv']; ?>
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Valid Till
                        </span>
                        <span class="float-right text-muted card-valid">
                            <?=$context['user']['virtual_card']['valid_till']; ?>
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Card Pin
                        </span>
                        <span class="float-right text-muted card-pin">
                            <?=$context['user']['virtual_card']['card_pin']; ?>
                        </span>
                        </p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="text-center text-danger">Purchase a virtual mastercard**</div>
        <form class="card-form" method="post">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
            <div class="form-group">
                <label>Payment System *</label>
                <select class="form-control" name="method" required>
                <option value="balance">Balance</option>
                <option value="transfer">Bank Transfer</option>
                <option value="usdt">USDT</option>
              </select>
            </div>
            <div class="form-group">
                <label>Enter Amount (<?=$context['user']['currency']; ?>) *</label>
                <input type="number" class="form-control" name="amount" value=3000 required readonly>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary"><span class="btn-text">PAY</span></button>
            </div>
        </form>
        <?php endif ?>

        <div class="mt-5 mb-5 text-center payment-box">
            <div class="text-center">
                <div class="alert alert-info">
                    You are to make payment of <?=$context['user']['currency']; ?>3000.
                </div>
            </div>
            <div class="mt-2">
                <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?=$context['setting']['usdt_address']; ?>&choe=UTF-8" width="150" alt="">
                <p>Wallet Address(ERC20)<br><strong style="margin: 3px 0px !important; font-size: 17px;"><?=$context['setting']['usdt_address']; ?></strong></p>
                <form class="proof-form my3" method="post">
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="payment_id" value="">
                    <div class="custom-file form-group">
                      <input type="file" name="proof" class="custom-file-input" id="customFile" required>
                      <label class="custom-file-label" for="customFile">Insert Proof</label>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-lg btn-primary"><span class="btn-text"><i data-feather="camera"></i> Upload</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if($context['user']['has_active_card']): ?>

<script>
// This script functions for show/hide card details
let toggleEye = document.querySelector('.toggle-eye'),
cardNumber = document.querySelector('.card-number2'),
cardCVV = document.querySelector('.card-cvv'),
cardValid = document.querySelector('.card-valid'),
cardPin = document.querySelector('.card-pin');


if (toggleEye.className.includes("show")) {
    cardNumber.innerHTML = "**** **** **** ****";
    cardCVV.innerHTML = "***";
    cardValid.innerHTML = "**/**";
    cardPin.innerHTML = "****";
    toggleEye.innerHTML = `<i class="fa fa-eye text-secondary"></i>`
} else {
    cardNumber.innerHTML = "<?=$context['user']['virtual_card']['card_number']; ?>";
    cardCVV.innerHTML = "<?=$context['user']['virtual_card']['cvv']; ?>";
    cardValid.innerHTML = "<?=$context['user']['virtual_card']['valid_till']; ?>";
    cardPin.innerHTML = "<?=$context['user']['virtual_card']['card_pin']; ?>";
    toggleEye.innerHTML = `<i class="fa fa-eye-slash text-secondary"></i>`
}

toggleEye.addEventListener('click', function (e) {
    // Checking the toggle container and replacing the necessary class
    toggleEye.className.includes("show") ? toggleEye.classList.replace("show", "hide") : toggleEye.classList.replace("hide", "show");

    if (toggleEye.className.includes("hide")) {
        cardNumber.innerHTML = "<?=$context['user']['virtual_card']['card_number']; ?>";
        cardCVV.innerHTML = "<?=$context['user']['virtual_card']['cvv']; ?>";
        cardValid.innerHTML = "<?=$context['user']['virtual_card']['valid_till']; ?>";
        cardPin.innerHTML = "<?=$context['user']['virtual_card']['card_pin']; ?>";
        toggleEye.innerHTML = `<i class="fa fa-eye-slash text-secondary"></i>`
    } else {
        cardNumber.innerHTML = "**** **** **** ****";
        cardCVV.innerHTML = "***";
        cardValid.innerHTML = "**/**";
        cardPin.innerHTML = "****";
        toggleEye.innerHTML = `<i class="fa fa-eye text-secondary"></i>`
    }

});
</script>

<?php else: ?>

<script type="text/javascript">

// VARIABLES
let balance = parseFloat(<?=$context['user']['balance']; ?>),
    cardForm = document.querySelector('.card-form'),
    cardBtn = cardForm.querySelector('.btn'),
    cardBtnText = cardBtn.querySelector('.btn-text'),
    paymentContainer = document.querySelector('.payment-box'),
    proofForm = document.querySelector('.proof-form'),
    proofBtn = proofForm.querySelector('.btn'),
    proofBtnText = proofBtn.querySelector('.btn-text');

// EVENT LISTENERS

// Card form event listener
cardForm.addEventListener('submit', (e)=>{
    e.preventDefault()

    // Creating a form object from our form
    var cardFormData = new FormData(cardForm);

    if (cardForm['method'].value == "balance") {
        if (balance < parseInt(cardForm['amount'].value)) {
            console.log('Insufficient Funds');
            swal("Insufficient funds to place order", {icon: 'warning'});
        } else {
            swal('Feature not yet implemented', {icon: 'warning'});
        }
    } else if (cardForm['method'].value == "transfer") {
        swal("Not available at the moment", {icon: 'warning'});
    } else {
        // Loading animation
        cardBtnText.innerHTML = `Placing card request...<img width='20' src="<?=STATIC_ROOT; ?>/dashboard/img/spinner-white.svg">`;
        cardBtn.disabled = true; 

        setTimeout(()=>{
            fetch(window.location.href, {
                method: "POST",
                headers: {},
                body: cardFormData
            })
            .then((response)=>{
                return response.json()
            })
            .then((data)=>{
                console.log(data);
                if (data['status'] == "success") {
                    cardBtnText.innerHTML = `SUCCESS`;
                    cardBtn.disabled = true;
                    paymentContainer.style.visibility = 'visible';
                    // Inserting payment id to the proof of payment form
                    proofForm['payment_id'].value = data['payment_id'];
                } else {
                    cardBtnText.innerHTML = `PAY`;
                    cardBtn.disabled = false;
                    swal(data['message'], {icon: 'warning'});
                }
            })
            .catch((err)=>{
                console.log(err);
                cardBtnText.innerHTML = `PAY`;
                cardBtn.disabled = false;
                swal('Could not place virtual card order', {icon: 'error'});
            })
        }, 3000)
    }
})

// Proof from event listener
proofForm.addEventListener('submit', (e)=>{
    e.preventDefault()

    // Creating a form object from our form
    var proofFormData = new FormData(proofForm);

    // Loading animation
    proofBtnText.innerHTML = `Please wait...<img width='20' src="<?=STATIC_ROOT; ?>/dashboard/img/spinner-white.svg">`;
    proofBtn.disabled = true; 

    setTimeout(()=>{
        fetch(window.location.href, {
            method: "POST",
            headers: {},
            body: proofFormData
        })
        .then((response)=>{
            return response.json()
        })
        .then((data)=>{
            console.log(data);
            if (data['status'] == "success") {
                proofBtnText.innerHTML = `SUCCESS`;
                proofBtn.disabled = true;
                swal(data['message'], {icon:'success'});
            } else {
                proofBtnText.innerHTML = `<i data-feather="camera"></i> Upload`;
                proofBtn.disabled = false;
                swal(data['message'], {icon: 'warning'});
            }
        })
        .catch((err)=>{
            console.log(err);
            proofBtnText.innerHTML = `<i data-feather="camera"></i> Upload`;
            proofBtn.disabled = false;
            swal('Service time out', {icon: 'warning'});
        })
    }, 3000);

})
</script>

<?php endif ?>