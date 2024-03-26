<!-- breadcrumb begin -->
<div class="breadcrumb-oitila">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-8">
                <div class="part-txt">
                    <h1>faq</h1>
                    <ul>
                        <li>home</li>
                        <li>faq details page</li>
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

<!-- faq begin -->
<div class="faq">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-3 col-lg-3 col-md-4">
                <div class="faq-sidebar">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="general-questions-tab" data-toggle="pill" href="#general-questions" role="tab" aria-controls="general-questions" aria-selected="true">General Questions</a>
                        <a class="nav-link" id="loan-questions-tab" data-toggle="pill" href="#loan-questions" role="tab" aria-controls="loan-questions" aria-selected="false">Loan Questions</a>
                        <a class="nav-link" id="contact-questions-tab" data-toggle="pill" href="#contact-questions" role="tab" aria-controls="contact-questions" aria-selected="false">Contact Questions</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8">
                <div class="faq-content">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="general-questions" role="tabpanel" aria-labelledby="general-questions-tab">
                            <div class="single-faq">
                                <h4>What is <?=$context['setting']['domain']; ?>?</h4>
                                <p>A few years ago, a small team of people determined to transform banking launched a savings app for everyone. That app was the first step toward <?=ucwords($context['setting']['name']); ?> Bank. Today, we’re even more determined and we’ve built a Central Bank-licensed, microfinance bank to help you get the best out of your money without overcharging you. <?=$context['setting']['domain']; ?> includes tools for tracking your spending habits, saving more and making the right money moves. So no matter who you are or where you live, we’re here because of you. We know the pain that comes with using a regular bank and we will make things work better for everyone.</p>
                            </div>
                            <div class="single-faq">
                                <h4>What Is Bank Account?</h4>
                                <p>A bank account is a financial account maintained by a bank or other financial institution in which the financial transactions between the bank and a customer are recorded.</p>
                            </div>
                            <div class="single-faq">
                                <h4>How do I create my account?</h4>
                                <p>Registration process is very easy and will take a few moments to complete Simply click CREATE ACCOUNT button and fill in all the required fields</p>
                            </div>
                            <div class="single-faq">
                                <h4>How do I make a deposit?</h4>
                                <p>To deposit funds in your trading account is quick and simple. For your convenience you may choose one of the several available deposit methods To make a successful deposit. Please follow the steps below Login to your account Click on the DEPOSITS button in the DASHBOARD section, choose the deposit option And follow the steps to complete your transaction</p>
                            </div>
                            <div class="single-faq">
                                <h4>How long does my deposit take before it can reflect on my <?=$context['setting']['domain']; ?> account dashboard?</h4>
                                <p>Your deposit will be reflected immediately once it is confirmed on the blockchain network</p>
                            </div>
                            <div class="single-faq">
                                <h4>Can I have more than two accounts?</h4>
                                <p>We do not allow multiple accounts except only for business purposes</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="loan-questions" role="tabpanel" aria-labelledby="loan-questions-tab">
                            <div class="single-faq">
                                <h4>How do I apply for a loan with <?=ucwords($context['setting']['name']); ?>?</h4>
                                <p>To apply for a loan with <?=ucwords($context['setting']['name']); ?>, simply visit our website or access our online application portal. Complete the application form with accurate information and upload any required documents securely through the portal. Our team will review your application and notify you of the status within a few business days.</p>
                            </div>
                            <div class="single-faq">
                                <h4>What documents do I need to provide when applying for a loan?</h4>
                                <p>The documents required may vary depending on the type of loan you're applying for. Generally, you'll need:</p>
                                <p>- Personal identification (e.g., driver's license, passport)</p>
                                <p>- Business documentation (for business loans), such as business registration, financial statements, and tax returns</p>
                                <p>- Proof of income (e.g., pay stubs, bank statements)</p>
                                <p>- Collateral documentation (if applicable)</p>
                            </div>
                            <div class="single-faq">
                                <h4> What are the eligibility requirements for a <?=ucwords($context['setting']['name']); ?> loan?</h4>
                                <p>Eligibility requirements vary depending on the loan product. In general, we consider factors such as credit history, income, employment status, and business performance (for business loans). We strive to provide financing options to a wide range of borrowers, so we encourage you to apply even if you're unsure about your eligibility</p>
                            </div>
                            <div class="single-faq">
                                <h4>How long does it take to receive a loan decision?</h4>
                                <p>The time it takes to receive a loan decision can vary based on factors such as the type of loan, the completeness of you application, and our current processing volume. Typically, you can expect to receive a decision within a few business days after submitting your application.</p>
                            </div>
                            <div class="single-faq">
                                <h4>What are my repayment options?</h4>
                                <p><?=ucwords($context['setting']['name']); ?> offers flexible repayment options tailored to your financial situation. You can typically choose between monthly, bi-weekly, or weekly payments, depending on the loan product. We also offer the convenience of setting up automatic payments to ensure timely repayment.</p>
                            </div>
                            <div class="single-faq">
                                <h4>Are there any fees associated with <?=ucwords($context['setting']['name']); ?> loans?</h4>
                                <p>Yes, there may be fees associated with our loans, including origination fees, late payment fees, and prepayment penalties (if applicable). The specific fees vary depending on the loan product and your individual circumstances. We disclose all fees upfront, so you'll know exactly what to expect before accepting the loan offer.</p>
                            </div>
                            <div class="single-faq">
                                <h4>Can I pay off my loan early?</h4>
                                <p>Yes, you can typically pay off your <?=ucwords($context['setting']['name']); ?> loan early without incurring prepayment penalties. Paying off your loan ahead of schedule can help you save on interest costs and become debt-free sooner. We encourage responsible borrowing and offer flexible repayment options to accommodate your financial goals.</p>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="contact-questions" role="tabpanel" aria-labelledby="contact-questions-tab">
                            <div class="single-faq">
                                <h4>How can I contact <?=ucwords($context['setting']['name']); ?> for support?</h4>
                                <p>Thank you for considering <?=ucwords($context['setting']['name']); ?> for your financing needs. We're here to assist you every step of the way. Below are multiple channels for you to reach out to us:</p>
                                <p>For general inquiries and loan assistance, please email our customer support team at: <strong><?=$context['setting']['email']; ?></strong> <br></p>
                                <p>We strive to respond to all email inquiries within 24-48 hours.</p>
                            </div>

                            <div class="single-faq">
                                <h4>Live Chat</h4>
                                <p>Our live chat feature on the website allows you to chat with a customer support representative in real-time. Simply look for the chat icon in the bottom corner to start a conversation.</p>
                            </div>

                            <div class="single-faq">
                                <h4>Social Media</h4>
                                <p>Connect with us on social media for updates, news, and tips: <br>- Facebook: <a href="https://www.facebook.com/<?=ucwords($context['setting']['name']); ?>?mibextid=LQQJ4d" target="_blank">https://www.facebook.com/<?=ucwords($context['setting']['name']); ?>?mibextid=LQQJ4d</a></p>
                            </div>

                            <div class="single-faq">
                                <h4>Hours of Operation</h4>
                                <p>Our customer support team is available during the following hours:</p>
                                <p>- Monday to Friday: 8am - 6pm</p>
                                <p>- Saturday and Sunday: 10am - 4pm</p>
                                <p>For urgent matters outside of business hours, please leave a voicemail or send an email, and we'll get back to you as soon as possible.</p>
                            </div>

                            <div class="single-faq">
                                <h4><?=ucwords($context['setting']['name']); ?> Headquarters</h4>
                                <p>- <?=ucwords($context['setting']['name']); ?> Inc.</p>
                                <p>- [Insert Office Address]</p>
                                <p>- [Insert City, State, Zip Code]</p>
                                <p>- [Insert Country]</p>
                                <p>We're committed to providing excellent customer support and are here to assist you with any questions or concerns you may have. Don't hesitate to reach out to us through any of the channels listed above. Your satisfaction is our priority. Thank you for choosing <?=ucwords($context['setting']['name']); ?>!</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- faq end -->