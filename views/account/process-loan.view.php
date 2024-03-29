<style>
    .row {
        font-family: Arial, sans-serif;
        padding: 0;
        background-color: #f4f4f4;
        color: #333;
    }
    .success-message {
        color: #4CAF50; /* Green */
        margin-bottom: 20px;
    }
    .success-icon {
        width: 50px;
        height: 50px;
        background-color: #ccc;
        border-radius: 50%;
        display: inline-block;
        vertical-align: middle;
        margin-right: 10px;
        background-image: url('your-icon-or-image-url-here');
        background-size: cover;
    }
    .contact-info {
        margin-top: 20px;
    }
</style>


<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card card-primary">
      <div class="card-body">
        <div class="success-message">
            <img class="success-icon" src="<?=STATIC_ROOT; ?>/dashboard/img/success.jpg" alt=""> <!-- Replace 'your-icon-or-image-url-here' with your actual image URL -->
            Congrats! Your are few steps from acquiring your loan.
        </div>
        <p>Your Loan ID is: <strong id="loan-id"><?=$context['loan']['loan_id']; ?></strong> <i class="fas fa-copy text-secondary"></i></p>
        <p>Using your loan ID, proceed to contact our support team using our live chat or message directly us via our Facebook link below to further process your loan.</p>
        <div class="contact-info">
            <p>Contact Support: <a href="mailto:<?=$context['setting']['email']; ?>"><?=$context['setting']['email']; ?></a></p>
            <p>Visit us on Facebook: <a href="<?=$context['setting']['facebook_link']; ?>" target="_blank">Our Facebook Page</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.querySelector('.fa-copy').addEventListener('click', () => {
    // Select the text inside the span element
    let loanID = document.querySelector('#loan-id'),
        range = document.createRange();
        
    range.selectNode(loanID);
    window.getSelection().removeAllRanges(); // Clear previous selections
    window.getSelection().addRange(range); // Select the span's text

    // Copy the selected text
    try {
        document.execCommand('copy');
        alert("Copied");
    } catch (err) {
        alert("Something went wrong");
    }

    // Deselect the text
    window.getSelection().removeAllRanges();
});
</script>