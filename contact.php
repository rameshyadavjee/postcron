<?php include("header.php");?>
        <!-- Page Title -->
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <i class="icon-envelope-alt page-title-icon"></i>
                        <h2>Contact Us /</h2>
                        <p>Here is how you can contact us</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Us -->
        <div class="contact-us container">
            <div class="row">
                <div class="contact-form span12">                    
                    <form method="post" action="assets/sendmail.php">
                        <label for="name" class="nameLabel">Name</label>
                          <input id="name" type="text" name="name" placeholder="Enter your name...">
                        <label for="email" class="emailLabel">Email</label>
                          <input id="email" type="text" name="email" placeholder="Enter your email...">
                        <label for="subject">Subject</label>
                          <input id="subject" type="text" name="subject" placeholder="Your subject...">
                        <label for="message" class="messageLabel">Message</label>
                          <textarea id="message" name="message" placeholder="Your message..."></textarea>
                        <button type="submit">Send</button>
                    </form>
                </div>                
            </div>
        </div>
 
<?php include("footer.php");?>