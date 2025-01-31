<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/userDashboard.css') }}" />

    <!-- JS -->
    <script src="{{ asset('js/userDashboard.js') }}" defer></script>

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
  </head>
  <body>
    <!-- MODAL -->
    <div id="modal-logout" class="modal hidden">
      <div class="modal-content">
        <div class="top-content">
          <div class="ic-close">
            <button id="btn-close" class="btn-close">
              <img src="../assets/icons/ic-close.svg" alt="Icon Close" />
            </button>
          </div>
          <div class="warn-text">
            <div class="warn-wrap">
              <img src="../assets/icons/ic-warning.svg" alt="Icon Warning" />
            </div>
            <p class="text-confirm">Are you sure want to logout?</p>
          </div>
        </div>
        <div class="bottom-content">
          <button class="btn-cancel" id="btn-cancel-logout">Cancel</button>
          <button class="btn-confirm" id="btn-confirm-logout">Logout</button>
        </div>
      </div>
    </div>
    <!-- END MODAL -->

    <!-- HEADER -->
    <section class="header" id="header">
      <nav>
        <a href="/user/dashboard"><img src="../assets/images/img-bncc-logo.png" alt="Logo BNCC" class="img-logo" /></a>
        <button class="logout" id="btn-logout">
          <img src="../assets/icons/ic-logout.svg" alt="Logo Logout" class="ic-logout" />
          <p class="text-logout">Logout</p>
        </button>
      </nav>
    </section>
    <div class="separator"></div>
    <!-- END HEADER -->

    <!-- CONTENT -->
    <section class="content" id="content">
      <div class="left-content">
        <div class="team-container container">
          <h1 class="team-name">Team Rocket</h1>

          <div>
            <h5 class="text-leader">Leader Information</h5>

            <div>
              <div class="detail-container"></div>
              <div class="detail-wrap">
                <div class="icon-text">
                  <img src="../assets/icons/ic-file.svg" alt="Icon File" />
                  <p class="detail-name">CV</p>
                </div>
                <button class="detail-desc-input">View CV</button>
              </div>
              <div class="last">
                <div class="icon-text">
                  <img src="../assets/icons/ic-file.svg" alt="Icon File" />
                  <p class="detail-name">ID Card/Flazz</p>
                </div>
                <button class="detail-desc-input">View Card</button>
              </div>
            </div>
          </div>
        </div>

        <div class="member-container container">
          <h1 class="member-name">Member Information</h1>
          <div class="member-list-container">
            <!-- js -->
          </div>
        </div>
      </div>

      <div class="right-content">
        <div class="timeline container">
          <h1 class="team-name">Timeline Information</h1>

          <div>
            <div class="timeline-event">
              <img src="../assets/icons/ic-dot-active.svg" alt="Icon Dot Active" class="ic-dot" />

              <div>
                <h5 class="timeline-heading">Open Registration</h5>
                <p class="timeline-date">01 Dec 2024 ~ 31 Dec 2024</p>
              </div>
            </div>
            <div class="timeline-event">
              <img src="../assets/icons/ic-dot.svg" alt="Icon Dot Active" class="ic-dot" />

              <div>
                <h5 class="timeline-heading">Close Registration</h5>
                <p class="timeline-date">01 Jan 2025</p>
              </div>
            </div>
            <div class="timeline-event">
              <img src="../assets/icons/ic-dot.svg" alt="Icon Dot Active" class="ic-dot" />

              <div>
                <h5 class="timeline-heading">Technical Meetings</h5>
                <p class="timeline-date">05 Jan 2025</p>
              </div>
            </div>
            <div class="timeline-event">
              <img src="../assets/icons/ic-dot.svg" alt="Icon Dot Active" class="ic-dot" />

              <div>
                <h5 class="timeline-heading">Competition Day</h5>
                <p class="timeline-date">10 Jan 2025 ~ 15 Jan 2025</p>
                <p class="timeline-date active">Lomba Desain Poster</p>
                <p class="timeline-date active">Lomba Website</p>
                <p class="timeline-date active">Lomba Coding</p>
              </div>
            </div>
          </div>
        </div>

        <div class="contact-us">
          <div class="icon">
            <img src="../assets/icons/ic-telephone.svg" alt="Icon Telepon" />
          </div>
          <div class="text">
            <h5 class="text-question">Have some question?</h5>
            <p class="text-contact">Contact Us: <span>+62-824-233-4232</span></p>
          </div>
        </div>
      </div>
    </section>
    <!-- END CONTENT -->
  </body>
</html>
