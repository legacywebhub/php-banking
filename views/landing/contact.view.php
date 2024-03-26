<!-- breadcrumb begin -->
<div class="breadcrumb-oitila">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-8">
                <div class="part-txt">
                    <h1>contact</h1>
                    <ul>
                        <li>home</li>
                        <li>contact page</li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-4 d-flex align-items-center">
                <div class="part-img">
                    <img src="<?=STATIC_ROOT; ?>/landing/img/breadcrumb-img.png" alt="image">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<!-- contact begin -->
<div class="contact contact-page mb-5" id="contact">
    <div class="container container-contact">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8">
                <div class="section-title">
                    <span class="sub-title">
                        Contact Us
                    </span>
                    <h2>
                        Get in touch<span class="special"> with us</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="bg-tamim">
            <div class="row justify-content-around">
                <div class="col-xl-6 col-lg-6 col-sm-10 col-md-6">
                    <div class="part-form">
                        <form name="contact-form" method="post">
                            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                            <input type="text" name="name" placeholder="Name">
                            <input type="text" name="email" placeholder="Email">
                            <input type="text" name="subject" placeholder="Subject">
                            <textarea name="message" placeholder="Write to Us..."></textarea>
                            <p class="my-2 message text-light"></p>
                            <button class="submit-btn def-btn"><span class="btn-text">Submit</span></button>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-10 col-md-6">
                    <div class="part-address">
                        <div class="addressing">
                            <?php if ($context['setting']['address']): ?>
                            <div class="single-address">
                                <h4>Our Office</h4>
                                <p><?=$context['setting']['address']; ?></p>
                            </div>
                            <?php endif ?>
                            <div class="single-address">
                                <h4>Email</h4>
                                <p><?=$context['setting']['email']; ?></p>
                            </div>
                            <?php if ($context['setting']['address']): ?>
                            <div class="single-address">
                                <h4>Phone</h4>
                                <p><?=$context['setting']['phone']; ?></p>
                            </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact end -->

<script>
    let contactForm = document.forms['contact-form'],
    contactBtn = document.querySelector('.submit-btn'),
    msgBox = document.querySelector('.message');


    contactForm.addEventListener('submit', (e)=> {
        e.preventDefault()

        let data = {
            'name': contactForm['name'].value,
            'email': contactForm['email'].value,
            'subject': contactForm['subject'].value,
            'message': contactForm['message'].value,
            'csrf_token': contactForm['csrf_token'].value,
        };

        console.log(data);

        // Loading animation
        let btnText = contactBtn.querySelector('.btn-text');
        btnText.innerHTML = `Sending...<img width='30px' src="<?=STATIC_ROOT; ?>/dashboard/img/spinner-white.svg">`;
        contactBtn.disabled = true;

        setTimeout(()=>{
            // Sending AJAX Request
            fetch(window.location.href, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then((response)=>{
                return response.json()
            })
            .then((data)=>{
                console.log(data);
                if (data['status'] == 'success') {
                    contactForm.reset();
                    contactBtn.disabled = false;
                    msgBox.innerText = data['message'];
                    setTimeout(()=>{
                        msgBox.innerText = "";
                    }, 10000)
                } else {
                    btnText.innerHTML = `Submit`;
                    contactBtn.disabled = false;
                    msgBox.innerText = data['message'];
                    alert(data['message']);
                }
            })
            .catch((err)=>{
                console.log(err);
                btnText.innerHTML = `Submit`;
                contactBtn.disabled = false;
                alert("Service not available at the moment");
            })
        }, 3000);



    });

</script>