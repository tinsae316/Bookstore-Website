<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>

<section class="mb-4">
    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within a matter of hours to help you.</p>

    <div class="row">
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="submit-to-google-sheet">
                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="name" class="">Your name</label>
                            <input type="text" id="name" name="Name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="email" class="">Your email</label>
                            <input type="email" id="email" name="Email" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="subject" class="">Subject</label>
                            <input type="text" id="subject" name="Subject" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                            <label for="message">Your message</label>
                            <textarea type="text" id="message" name="Message" rows="2" class="form-control md-textarea" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center text-md-left mt-4">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
                <div class="status mt-3" id="msg"></div>
            </form>
        </div>
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fas fa-map-marker-alt fa-2x"></i>
                    <p>Adama, Ethiopia</p>
                </li>
                <li><i class="fas fa-phone mt-4 fa-2x"></i>
                    <p>+ 251 948 625 981</p>
                </li>
                <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                    <p>contact@example.com</p>
                </li>
            </ul>
        </div>
    </div>
</section>

<?php require "includes/footer.php"; ?>




<script>
    const scriptURL = 'https://script.google.com/macros/s/AKfycbz3rx1jA1dHkLrhrDhslWUcmiaRZ98iIwKnD_0787qVrc9MlX5MyamJeE8UMylDbPUa/exec';
    const form = document.forms['submit-to-google-sheet'];
    const msg = document.getElementById("msg");

    form.addEventListener('submit', e => {
        e.preventDefault();
        msg.innerHTML = "Sending message...";
        fetch(scriptURL, { method: 'POST', body: new FormData(form)})
            .then(response => {
                if (response.ok) {
                    msg.innerHTML = "Message sent successfully!";
                    setTimeout(() => {
                        msg.innerHTML = "";
                    }, 5000);
                    form.reset();
                } else {
                    msg.innerHTML = "Failed to send message. Please try again.";
                }
            })
            .catch(error => {
                msg.innerHTML = 'Error: ' + error.message;
            });
    });
</script>
