<section id="contact">
    <div class="section-header">
        <div class="badge corner-badge full">
            <span></span>
            My Contact Information
        </div>
        <h4 class="section-title">Contact With Me</h4>
    </div>
    <div class="row g-4">
        <div class="col-lg-8">
            <span class="notch-card"></span>
            <div class="contact-card contact-form-card">
                <h4 class="mb-4">Send me a message</h4>
                <form action="" class="row g-4" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Phone Number">
                    </div>
                    <div class="col-12">
                        <input type="email" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control" placeholder="Your Subject">
                    </div>
                    <div class="col-12">
                        <textarea rows="6" class="form-control" placeholder="Your Message"></textarea>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary px-4">
                            Send Message <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- RIGHT: INFO -->
        <div class="col-lg-4">
            <div class="contact-card contact-info-card">
                <div class="info-block">
                    <i class="bi bi-envelope"></i>
                    <h6>Communication With Mail</h6>
                    <p>Please submit your email in my email and please ask soon as possible.</p>
                    <small>Email: d.rakhimov.web@gmail.com</small>
                </div>
                <div class="info-block">
                    <i class="bi bi-chat-dots"></i>
                    <h6>Want to Chat Now?</h6>
                    <p>Chat with me its more experts to find out more and more informative way to learn about me.</p>
                    <a href="#" class="btn btn-primary btn-sm">
                        Open Chat With Me <i class="bi bi-arrow-right mb-0"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
