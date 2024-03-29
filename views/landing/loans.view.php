<!-- breadcrumb begin -->
<div class="breadcrumb-oitila">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-8">
                <div class="part-txt">
                    <h1>loans</h1>
                    <ul>
                        <li>home</li>
                        <li>our loans</li>
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
                        <a class="nav-link active" id="personal-loans-tab" data-toggle="pill" href="#personal-loans" role="tab" aria-controls="personal-loans" aria-selected="true">Personal Loans</a>
                        <a class="nav-link" id="business-loans-tab" data-toggle="pill" href="#business-loans" role="tab" aria-controls="business-loans" aria-selected="false">Business Loans</a>
                        <a class="nav-link" id="how-to-apply-tab" data-toggle="pill" href="#how-to-apply" role="tab" aria-controls="how-to-apply" aria-selected="false">How To Apply</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8">
                <div class="faq-content">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="personal-loans" role="tabpanel" aria-labelledby="personal-loans-tab">
                            <div class="single-faq">
                                <h4>About our loans</h4>
                                <p>Here's a breakdown of <?=ucwords($context['setting']['name']); ?>'s different types of personal loans, including their features, benefits, eligibility requirements, terms, conditions, rates, and fees. Please note that the information provided is for illustrative purposes and may vary based on <?=ucwords($context['setting']['name']); ?>'s specific policies and offerings</p>
                            </div>

                            <div class="single-faq">
                                <h4>Unsecured Personal Loans</h4>
 
                                <p><strong>Features:</strong><p>
                                <p>
                                - No collateral required.<br>
                                - Flexible use of funds.<br>
                                - Fixed or variable interest rates.<br>
                                - Typically fixed monthly payments.<br>
                                <p>

                                <p><strong>Benefits:</strong></p>
                                <p>
                                - Quick access to funds.<br>
                                - Suitable for various personal expenses.<br>
                                - Ideal for borrowers with good credit history.<br>
                                </p>

                                <p><strong>Eligibility Requirements:</strong><p>
                                <p>
                                - Good to excellent credit score (typically 670 or higher).<br>
                                - Stable income and employment history.<br>
                                - Debt-to-income ratio within acceptable limits.<br>
                                <p>
                                
                                <p><strong>Terms and Conditions:</strong><p>
                                <p>
                                - Loan amounts: $1,000 to $50,000.<br>
                                - Repayment terms: 1 to 7 years.<br>
                                - APR (Annual Percentage Rate): Starting from 6.99%.<br>
                                - Origination fees: Up to 5% of loan amount.<br>
                                - Late payment fees: Typically $25 to $35.<br>
                                - No prepayment penalties.
                                </p>
                            </div>
                            <div class="single-faq">
                                <h4>Secured Personal Loans</h4>

                                <p><strong>Features:</strong></p>
                                <p>
                                - Requires collateral (e.g., car, savings account).<br>
                                - Lower interest rates compared to unsecured loans.<br>
                                - Higher borrowing limits.<br>
                                - Fixed repayment terms.<br>
                                </p>

                                <p><strong>Benefits:</strong></p>
                                <p>
                                - Access to larger loan amounts.<br>
                                - Lower interest rates due to collateral.<br>
                                - Opportunity to improve credit with timely payments.<br>
                                </p>

                                <p><strong>Eligibility Requirements:</strong></p>
                                <p>
                                - Collateral of sufficient value.<br>
                                - Credit history may be less important due to collateral.<br>
                                - Stable income to support loan payments.<br>
                                </p>

                                <p><strong>Terms and Conditions:</strong></p>
                                <p>
                                - Loan amounts: Up to the value of collateral.<br>
                                - Repayment terms: Varies based on collateral and loan amount.<br>
                                - APR: Starting from 4.99%.<br>
                                - Origination fees: Up to 3% of loan amount.<br>
                                - Collateral appraisal fees may apply.<br>
                                - Late payment fees: Similar to unsecured loans.<br>
                                - No prepayment penalties.<br>
                                </p>
                            </div>

                            <div class="single-faq">
                                <h4>Debt Consolidation Loans</h4>
                                
                                <p><strong>Features:</strong></p>
                                <p>
                                - Combines multiple debts into one loan.<br>
                                - Potential for lower interest rates.<br>
                                - Simplified repayment with a single monthly payment.<br>
                                </p>

                                <p><strong>Benefits:</strong></p>
                                <p>
                                - Reduced interest costs.<br>
                                - Streamlined debt management.<br>
                                - Potential credit score improvement.<br>
                                </p>

                                <p><strong>Eligibility Requirements:</strong></p>
                                <p>
                                - Good credit score is preferred.<br>
                                - Sufficient income to cover consolidated payments.<br>
                                - Demonstrate financial responsibility.<br>
                                </p>

                                <p><strong>Terms and Conditions:</strong></p>
                                <p>
                                - Loan amounts: Varies based on total debt.<br>
                                - Repayment terms: 2 to 7 years.<br>
                                - APR: Starting from 5.99%.<br>
                                - Origination fees: Up to 4% of loan amount.<br>
                                - Late payment fees: Similar to other loan types.<br>
                                - No prepayment penalties.<br>
                                </p>
                            </div>

                            <div class="single-faq">
                                <h4>Rates and Fees</h4>
                                <p>
                                - APR: Annual Percentage Rate based on creditworthiness and market conditions.<br>
                                - Origination Fees: Percentage of loan amount, typically 2% to 5%.<br>
                                - Late Payment Fees: Typically $25 to $35.<br>
                                - Prepayment Penalties: None.<br>
                                - Other Fees: Possible application fees, insufficient funds fees, etc.<br>
                                </p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="business-loans" role="tabpanel" aria-labelledby="business-loans-tab">
                            <div class="single-faq">
                                <h4>Term Loans</h4>
                                <p><strong>Features:</strong></p>
                                <p>
                                - Fixed lump sum loan amount.<br>
                                - Fixed or variable interest rates.<br>
                                - Fixed repayment term with regular payments.<br>
                                - Can be used for various business purposes.<br>
                                </p>

                                <p><strong>Benefits:</strong></p>
                                <p>
                                - Predictable repayment structure.<br>
                                - Suitable for long-term investments.<br>
                                - Competitive interest rates based on creditworthiness.<br>
                                </p>

                                <p><strong>Eligibility Requirements:</strong></p>
                                <p>
                                - Established business with a history of operations (typically 1 year or more).<br>
                                - Good to excellent credit score.<br>
                                - Stable revenue and cash flow.<br>
                                </p>

                                <p><strong>Terms and Conditions:</strong></p>
                                <p>
                                - Loan amounts: $10,000 to $500,000.<br>
                                - Repayment terms: 1 to 5 years.<br>
                                - APR: Starting from 7.99%.<br>
                                - Origination fees: Up to 3% of loan amount.<br>
                                - Late payment fees: Typically $20 to $40.<br>
                                - No prepayment penalties.<br>
                                </p>
                            </div>

                            <div class="single-faq">
                                <h4>SBA Loans</h4>

                                <p><strong>Features:</strong></p>
                                <p>
                                - Partially guaranteed by the Small Business Administration.<br>
                                - Competitive interest rates.<br>
                                - Longer repayment terms.<br>
                                - Various programs available (e.g., 7(a), 504).<br>
                                </p>

                                <p><strong>Benefits:</strong></p>
                                <p>
                                - Lower down payment requirements.<br>
                                - Longer repayment terms (up to 25 years).<br>
                                - Flexible use of funds for business needs.<br>
                                </p>

                                <p><strong>Eligibility Requirements:</strong></p>
                                <p>
                                - Meet SBA size standards.<br>
                                - Good personal and business credit history.<br>
                                - Detailed business plan for certain programs.<br>
                                </p>

                                <p><strong>Terms and Conditions:</strong></p>
                                <p>
                                - Loan amounts: Up to $5 million.<br>
                                - Repayment terms: Up to 25 years.<br>
                                - APR: Starting from 5.5%.<br>
                                - Guarantee fees: Percentage of guaranteed portion.<br>
                                - Origination fees: Up to 3.5% of loan amount.<br>
                                - Late payment fees: Similar to other loan types.<br>
                                - No prepayment penalties.<br>
                                </p>
                            </div>

                            <div class="single-faq">
                                <h4>Business Lines of Credit</h4>
                                
                                <p><strong>Features:</strong></p>
                                <p>
                                - Revolving credit facility.<br>
                                - Access to funds as needed.<br>
                                - Pay interest only on the amount borrowed.<br>
                                - Flexible repayment terms.<br>
                                </p>
                                
                                <p><strong>Benefits:</strong></p>
                                <p>
                                - Quick access to funds for short-term needs.<br>
                                - Interest charged only on funds used.<br>
                                - Helps manage cash flow fluctuations.<br>
                                </p>

                                <p><strong>Eligibility Requirements:</strong></p>
                                <p>
                                - Established business with consistent revenue.<br>
                                - Good credit history.<br>
                                - Collateral may be required for higher credit limits.<br>
                                </p>

                                <p><strong>Terms and Conditions:</strong></p>
                                <p>
                                - Credit limits: $10,000 to $250,000.<br>
                                - Repayment terms: Flexible.<br>
                                - APR: Starting from 6.99%.<br>
                                - Annual fee: Typically $100 to $500.<br>
                                - Late payment fees: Similar to other loan types.<br>
                                - No prepayment penalties.<br>
                                </p>
                            </div>

                            <div class="single-faq">
                                <h4>Rates and Fees</h4>
                                <p>
                                - APR: Annual Percentage Rate based on creditworthiness and market conditions.<br>
                                - Origination Fees: Percentage of loan amount, typically 2% to 3%.<br>
                                - Guarantee Fees (for SBA loans): Percentage of guaranteed portion.<br>
                                - Annual Fees (for business lines of credit): Flat fee.<br>
                                - Late Payment Fees: Typically $20 to $40.<br>
                                - Other Fees: Possible application fees, transaction fees, etc.<br>
                                </p>
                                <p><strong>Note:</strong> All fees are disclosed upfront, ensuring transparency and clarity for borrowers.</p>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="how-to-apply" role="tabpanel" aria-labelledby="how-to-apply-tab">
                            <div class="single-faq">
                                <h4>Step 1: Explore Loan Options</h4>
                                <p>Before applying, take some time to explore <?=ucwords($context['setting']['name']); ?>'s range of loan products. Consider factors such as loan amount, repayment terms, interest rates, and eligibility requirements to find the best fit for your needs.</p>
                            </div>

                            <div class="single-faq">
                                <h4>Step 2: Pre-Application Preparation</h4>
                                <p>Gather the necessary documents before starting your application:<br><br>
                                    <b>- Personal identification (e.g., driver's license, passport)<br>
                                    - Business documentation (for business loans), such as business registration, financial statements, and tax returns<br>
                                    - Proof of income (e.g., pay stubs, bank statements)<br>
                                    - Collateral documentation (if applicable)<br><br>
                                    </b>
                                    Having these documents ready will streamline the application process.
                                </p>
                            </div>

                            <div class="single-faq">
                                <h4>Step 3: Online Application</h4>
                                <p>Visit the <?=ucwords($context['setting']['name']); ?> website or access our loan application portal to begin your application. Complete the online application form, providing accurate information about yourself and your business (if applicable). Make sure to upload all required documents securely through the online portal.</p>
                            </div>

                            <div class="single-faq">
                                <h4>Step 4: Loan Review and Approval</h4>
                                <p>Once you've submitted your application, our underwriting team will review your information and documentation. This process typically takes a few business days but may vary depending on the loan type and complexity.</p>
                            </div>

                            <div class="single-faq">
                                <h4>Step 5: Loan Offer</h4>
                                <p>If your application is approved, you'll receive a loan offer outlining the terms of the loan, including the loan amount, interest rate, repayment terms, and any applicable fees. Review the offer carefully to ensure it aligns with your financial goals.</p>
                            </div>

                            <div class="single-faq">
                                <h4>Step 6: Acceptance and Funding</h4>
                                <p>If you decide to accept the loan offer, you'll need to sign the loan agreement electronically depending on <?=ucwords($context['setting']['name']); ?>'s procedures. Once the agreement is signed, fees are paid, funds will be disbursed according to the agreed-upon timeline.</p>
                            </div>

                            <div class="single-faq">
                                <h4>Step 7: Repayment</h4>
                                <p>Make timely payments according to the terms of the loan agreement. Setting up automatic payments can help ensure on-time payments and avoid late fees. If you encounter any difficulties or have questions about repayment, don't hesitate to reach out to our customer support team for assistance</p>
                            </div>

                            <div class="single-faq">
                                <h4>Required Documents</h4>
                                <p>
                                - Personal identification (e.g., driver's license, passport)<br>
                                - Business documentation (for business loans), such as business registration, financial statements, and tax returns<br>
                                - Proof of income (e.g., pay stubs, bank statements)<br>
                                - Collateral documentation (if applicable)<br>
                                </p>
                            </div>

                            <div class="single-faq">
                                <h4>Application Timeline</h4>
                                <p>
                                - Application processing time: Typically a few business days <br>
                                - Loan approval and funding timeline: Varies depending on loan type and complexity.
                               </p>
                            </div>

                            <div class="single-faq">
                                <h4>Additional Information</h4>
                                <p>
                                - Ensure all information provided in the application is accurate and up-to-date.<br>
                                - Review loan terms and conditions carefully before accepting the loan offer.<br>
                                - Contact <?=ucwords($context['setting']['name']); ?>'s customer support for assistance or clarification at any stage of the application process.<br>
                               </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- faq end -->