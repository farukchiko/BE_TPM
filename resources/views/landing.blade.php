<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="{{ asset('css/landing.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Itim&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="{{ asset('js/landing.js')}}" defer></script>
</head>
<body>
    <section class="nav-header">
        <img src="{{ asset('assets/images/bncc-logo.svg')}}" alt="BNCC Logo">
        <div class="nav-href">
            <a href="#home-section">Home</a>
            <a href="#champion-section">Champion Prizes</a>
            <a href="#mentor-section">Mentor & Jury</a>
            <a href="#about-section">About</a>
            <a href="#FAQ-section">FAQ</a>
            <a href="#timeline-section">Timeline</a>
        </div>
        <a href="{{ route('login') }}">
            <button>Login &#8594</button>
        </a>
    </section>

    <section class="home-section" id="home-section">
        <h1>BNCC Hackathon</h1>
        <h1>(BNCC Techno Career)</h1>
        <p>Bridging the Digital Divide:</p>
        <p>Building Solutions for a better world</p>
        <a href="{{ route('register-group') }}">
            Register Now &#8594
        </a>

    </section>

    <div class="home-image">
        <img src="{{ asset('assets/images/company-visit.svg')}}" alt="Dummy Image">
    </div>

    <section class="mentor-section" id="mentor-section">
        <h2>Mentors & Jurys</h2>

        <div class="mentors-element">
            <h3>Mentors</h3>
            <div class="profile-group">
                <div class="mentor-group">
                    <img src="{{ asset('assets/images/dummy-mentor.svg')}}" alt="Dummy Mentor">
                    <p>Gojo Satoru</p>
                    <span>CEO Jujutsu</span>
                </div>
                <div class="mentor-group">
                    <img src="{{ asset('assets/images/dummy-mentor.svg')}}" alt="Dummy Mentor">
                    <p>Gojo Satoru</p>
                    <span>CEO Jujutsu</span>
                </div>
                <div class="mentor-group">
                    <img src="{{ asset('assets/images/dummy-mentor.svg')}}" alt="Dummy Mentor">
                    <p>Gojo Satoru</p>
                    <span>CEO Jujutsu</span>
                </div>
                <div class="mentor-group">
                    <img src="{{ asset('assets/images/dummy-mentor.svg')}}" alt="Dummy Mentor">
                    <p>Gojo Satoru</p>
                    <span>CEO Jujutsu</span>
                </div>
                <div class="mentor-group">
                    <img src="{{ asset('assets/images/dummy-mentor.svg')}}" alt="Dummy Mentor">
                    <p>Gojo Satoru</p>
                    <span>CEO Jujutsu</span>
                </div>
                <div class="mentor-group">
                    <img src="{{ asset('assets/images/dummy-mentor.svg')}}" alt="Dummy Mentor">
                    <p>Gojo Satoru</p>
                    <span>CEO Jujutsu</span>
                </div>
            </div>

            <div class="second-line">
                <div class="mentor-group">
                    <img src="{{ asset('assets/images/dummy-mentor.svg')}}" alt="Dummy Mentor">
                    <p>Gojo Satoru</p>
                    <span>CEO Jujutsu</span>
                </div>
                <div class="mentor-group">
                    <img src="{{ asset('assets/images/dummy-mentor.svg')}}" alt="Dummy Mentor">
                    <p>Gojo Satoru</p>
                    <span>CEO Jujutsu</span>
                </div>
                <div class="mentor-group">
                    <img src="{{ asset('assets/images/dummy-mentor.svg')}}" alt="Dummy Mentor">
                    <p>Gojo Satoru</p>
                    <span>CEO Jujutsu</span>
                </div>
                <div class="mentor-group">
                    <img src="{{ asset('assets/images/dummy-mentor.svg')}}" alt="Dummy Mentor">
                    <p>Gojo Satoru</p>
                    <span>CEO Jujutsu</span>
                </div>
            </div>
        </div>

        <div class="jurys-element">
            <h3>Jurys</h3>
            <div class="profile-group">
                <div class="jury-group">
                    <img src="{{ asset('assets/images/dummy-mentor.svg')}}" alt="Dummy Mentor">
                    <p>Gojo Satoru</p>
                    <span>CEO Jujutsu</span>
                </div>
                <div class="jury-group">
                    <img src="{{ asset('assets/images/dummy-mentor.svg')}}" alt="Dummy Mentor">
                    <p>Gojo Satoru</p>
                    <span>CEO Jujutsu</span>
                </div>
                <div class="jury-group">
                    <img src="{{ asset('assets/images/dummy-mentor.svg')}}" alt="Dummy Mentor">
                    <p>Gojo Satoru</p>
                    <span>CEO Jujutsu</span>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section" id="about-section">
        <div class="about-heading">
            <h2>About Hackathon</h2>
            <img src="{{ asset('assets/icons/vector.svg')}}" alt="">
        </div>
        <p>hackathon is the peak event of TechnoScape that forms a 36-hour coding competition. It challenges participants to create innovative applications or websites to solve real-world problems. Participants will have the opportunity to get insights from mentors in the business, technology, and design mentoring sessions.</p>
        <div class="download-button">
            <a href="{{ asset('guidebooks/dummy_guidebook.pdf') }}" target="_blank">
                Download Guidebook (PDF) &#8594
            </a>
        </div>
    </section>

    <section class="champion-section" id="champion-section">
        <h2>Champion Prize</h2>

        <div class="champion-element">
            <div class="champion-box" id="champion-2">
                <h3>Juara 2</h3>
                <div class="description" id="gift-row">
                    <img src="{{ asset('assets/icons/gift.svg')}}" alt="Prize Money">
                    <p>Rp5.000.000</p>
                </div>
                <div class="description" id="bag-row">
                    <img src="{{ asset('assets/icons/shopping-bag.svg')}}" alt="Merchandise">
                    <p>Merchandise</p>
                </div>
                <div class="description" id="certi-row">
                    <img src="{{ asset('assets/icons/sertifikat.svg')}}" alt="Certificate">
                    <p>Sertifikat</p>
                </div>
            </div>

            <div class="champion-box" id="champion-1">
                <h3>Juara 1</h3>
                <div class="description" id="gift-row">
                    <img src="{{ asset('assets/icons/gift.svg')}}" alt="Prize Money">
                    <p>Rp8.000.000</p>
                </div>
                <div class="description" id="bag-row">
                    <img src="{{ asset('assets/icons/shopping-bag.svg')}}" alt="Merchandise">
                    <p>Merchandise</p>
                </div>
                <div class="description" id="bag-row">
                    <img src="{{ asset('assets/icons/sertifikat.svg')}}" alt="Certificate">
                    <p>Sertifikat</p>
                </div>
            </div>

            <div class="champion-box" id="champion-3">
                <h3>Juara 3</h3>
                <div class="description" id="gift-row">
                    <img src="{{ asset('assets/icons/gift.svg')}}" alt="Prize Money">
                    <p>Rp3.000.000</p>
                </div>
                <div class="description" id="bag-row">
                    <img src="{{ asset('assets/icons/shopping-bag.svg')}}" alt="Merchandise">
                    <p>Merchandise</p>
                </div>
                <div class="description" id="certi-row">
                    <img src="{{ asset('assets/icons/sertifikat.svg')}}" alt="Certificate">
                    <p>Sertifikat</p>
                </div>
            </div>
        </div>
    </section>

    <section class="reason-section" id="reason-section">
        <div class="reason-heading">
            <h2>Why You <br>Should Join?</h2>
            <img src="{{ asset('assets/images/group-photo.svg')}}" alt="dummy-group">
        </div>

        <div class="reason-content">

            <div class="reason-box" id="networking">
                <h3>Networking</h3>
                <div class="divider"></div>
                <p>Mendapat wawasan tentang Artificial Intelligence dan financial technology</p>
            </div>

            <div class="reason-box" id="hard-skill">
                <h3>Hard skill</h3>
                <div class="divider"></div>
                <p>Mendapat wawasan tentang Artificial Intelligence dan financial technology</p>
            </div>

            <div class="reason-box" id="mentoring">
                <h3>Mentoring</h3>
                <div class="divider"></div>
                <p>Mendapat wawasan tentang Artificial Intelligence dan financial technology</p>
            </div>

            <div class="reason-box" id="portofolio">
                <h3>Portofolio</h3>
                <div class="divider"></div>
                <p>Mendapat wawasan tentang Artificial Intelligence dan financial technology</p>
            </div>

        </div>
    </section>

    <section class="FAQ-section" id="FAQ-section">
        <h2>Frequently Asked Questions</h2>

        <div class="accordion">
            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <span class="accordion-icon">+</span>
                    <span>Apa saja persyaratan untuk mengikuti Hackathon?</span>
                </div>
                <div class="accordion-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <span class="accordion-icon">+</span>
                    <span>Apa saja persyaratan untuk mengikuti Hackathon?</span>
                </div>
                <div class="accordion-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <span class="accordion-icon">+</span>
                    <span>Apa saja persyaratan untuk mengikuti Hackathon?</span>
                </div>
                <div class="accordion-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <span class="accordion-icon">+</span>
                    <span>Apa saja persyaratan untuk mengikuti Hackathon?</span>
                </div>
                <div class="accordion-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
            </div>
        </div>
    </section>

    <section class="timeline-section" id="timeline-section">
        <h2>Timeline Hackachton</h2>

        <div class="timeline-content">
            <div class="timeline-box" id="open-registration">
                <img src="{{ asset('assets/images/group-photo.svg')}}" alt="dummy-group">
                <div class="timeline-box-content">
                    <h3>Open Registration</h3>
                    <span>Thursday, 20 June 2025</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>

            <div class="timeline-box" id="close-registration">
                <img src="{{ asset('assets/images/group-photo.svg')}}" alt="dummy-group">
                <div class="timeline-box-content">
                    <h3>Close Registration</h3>
                    <span>Thursday, 20 June 2025</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>

            <div class="timeline-box" id="technical-meeting">
                <img src="{{ asset('assets/images/group-photo.svg')}}" alt="dummy-group">
                <div class="timeline-box-content">
                    <h3>Technical Meeting</h3>
                    <span>Thursday, 20 June 2025</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>

            <div class="timeline-box" id="competition-day">
                <img src="{{ asset('assets/images/group-photo.svg')}}" alt="dummy-group">>
                <div class="timeline-box-content">
                    <h3>Competition Day</h3>
                    <span>Thursday, 20 June 2025</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </div>

    </section>

    <section class="sponsor-section" id="sponsor-section">

        <div class="sponsor-heading">
            <h2>Our Sponsors</h2>
        </div>

        <div class="sponsor-container">
            <div class="sponsor-row" id="platinum">
                <div class="sponsor-name">
                    <h3>Platinum Sponsors</h3>
                </div>
                <div class="sponsor-logos" id="teleperformance">
                    <img src="{{ asset('assets/images/teleperformance.svg')}}" alt="teleperformance">
                </div>
            </div>

            <div class="sponsor-row" id="gold">
                <div class="sponsor-name">
                    <h3>Gold Sponsors</h3>
                </div>
                <div class="sponsor-logos" id="gold-sponsor">
                    <img src="{{ asset('assets/images/line.svg')}}" alt="LINE" id="line">
                    <img src="{{ asset('assets/images/goks.svg')}}" id="goks">
                </div>
            </div>

            <div class="sponsor-row" id="silver">
                <div class="sponsor-name">
                    <h3>Silver Sponsors</h3>
                </div>
                <div class="sponsor-logos" id="silver-sponsor">
                    <img src="{{ asset('assets/images/cloudhost.svg')}}" alt="CloudHost" id="cloudhost">
                    <img src="{{ asset('assets/images/mekari.svg')}}" alt="mekari" id="mekari">
                    <img src="{{ asset('assets/images/cakap.svg')}}" alt="cakap" id="cakap">
                </div>
            </div>
        </div>
    </section>

    <section class="media-section" id="media-section">
        <h2>Media Partners</h2>
        <div class="media-gallery">
            <img src="{{ asset('assets/images/dummy-sponsor.svg')}}" alt="Dummy sponsor">
            <img src="{{ asset('assets/images/dummy-sponsor.svg')}}" alt="Dummy sponsor">
            <img src="{{ asset('assets/images/dummy-sponsor.svg')}}" alt="Dummy sponsor">
            <img src="{{ asset('assets/images/dummy-sponsor.svg')}}" alt="Dummy sponsor">
            <img src="{{ asset('assets/images/dummy-sponsor.svg')}}" alt="Dummy sponsor">
            <img src="{{ asset('assets/images/dummy-sponsor.svg')}}" alt="Dummy sponsor">
        </div>
    </section>

    <section class="contact-section" id="contact-section">
        <div class="contact-content">
            <h2>Contact Us</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        <div class="contact-form">
            <div class="input-data" id="input-name">
                <label for="nama">Name</label>
                <input type="text" id="name" name="name" placeholder="Name">
            </div>

            <div class="input-data" id="input-email">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email">
            </div>

            <div class="input-data" id="input-subject">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" placeholder="Subject">
            </div>

            <div class="input-data" id="input-message">
                <label for="message">Message</label>
                <textarea name="message" id="message" placeholder="Message"></textarea>
            </div>

            <button type="submit">Send Message</button>
        </div>
    </section>

    <section class="nav-footer">
        <div class="first-line">
            <img src="{{ asset('assets/images/BNCC-logo-bw.svg')}}" alt="BNCC logo">
            <div class="nav-href">
                <a href="#home-section">Home</a>
                <a href="#champion-section">Champion Prizes</a>
                <a href="#mentor-section">Mentor & Jury</a>
                <a href="#about-section">About</a>
                <a href="#FAQ-section">FAQ</a>
                <a href="#timeline-section">Timeline</a>
            </div>
            <div class="nav-media">
                <a href="https://www.instagram.com/bnccbinus/?hl=en"><img src="{{ asset('assets/icons/instagram.svg')}}" alt="instagram"></a>
                <a href="https://student-activity.binus.ac.id/bncc/contact/"><img src="{{ asset('assets/icons/mail.svg')}}" alt="mail"></a>
                <a href="https://x.com/BNCC_Binus"><img src="{{ asset('assets/icons/twitter.svg')}}" alt="X"></a>
                <a href="https://www.facebook.com/bina.nusantara.computer.club/?locale=id_ID"><img src="{{ asset('assets/icons/facebook.svg')}}" alt="facebook"></a>
                <a href="https://www.linkedin.com/company/bnccbinus/?originalSubdomain=id"><img src="{{ asset('assets/icons/linkedin.svg')}}" alt="linkedin"></a>
            </div>
        </div>

        <div class="footer-divider"></div>

        <div class="second-line">

            <div class="right-content">
                <p>Powered and Organized by BNCC</p>
            </div>

            <div class="left-content">
                <p>Privacy Policy</p>
                <p>Terms of Service</p>
            </div>

        </div>

    </section>

</body>
</html>
