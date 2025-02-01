<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/adminDashboard.css') }}" />

    <!-- JS -->
    <script src="{{ asset('js/adminDashboard.js') }}" defer></script>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
  </head>
  <body>

    <!-- LOGOUT -->
    <div class="logout-section">
      <button class="logout" id="btn-logout">
        <img src="../assets/icons/ic-logout.svg" alt="Logo Logout" class="ic-logout" />
        <p class="text-logout">Logout</p>
      </button>
    </div>
    <!-- END LOGOUT -->

    <!-- MODAL DELETE-->
    <div id="modal-delete" class="modal hidden">
      <div class="modal-content-delete">
        <div class="top-content">
          <div class="ic-close">
            <button id="btn-close" class="btn-close">
              <img src="../assets/icons/ic-close.svg" alt="Icon Close" id="btn-close" />
            </button>
          </div>
          <div class="warn-text">
            <div class="warn-wrap">
              <img src="../assets/icons/ic-warning.svg" alt="Icon Warning" />
            </div>
            <p class="text-confirm">Are you sure want to <span>delete</span> Team <span id="team-to-delete">?</span>?</p>
          </div>
        </div>
        <div class="bottom-content">
          <button class="btn-confirm" id="btn-confirm-delete">Yes</button>
        </div>
      </div>
    </div>
    <!-- END MODAL DELETE -->

    <!-- MODAL EDIT -->
    <div id="modal-edit" class="modal hidden">
        <div class="modal-content-edit">
            <div class="top-content">
                <p class="sub-text">Edit Team</p>
                <button id="btn-close-edit" class="btn-close-edit">
                    <img src="../assets/icons/ic-close.svg" alt="Icon Close" id="btn-close" />
                </button>
            </div>
            <p class="team-name" id="edit-team-name">Team Name</p>

            <div class="edit-container">
                <div class="edit-team-container">
                    <span>Team Name: <span id="edit-team-name-display"></span></span>
                    <input type="text" id="edit-team" class="edit-team" placeholder="Editable text field">
                </div>

                <div class="edit-leader-container">
                    <span>Leader: <span id="edit-leader-name-display"></span></span>
                    <input type="text" id="edit-leader" class="edit-leader" placeholder="Editable text field">
                </div>

                <div class="edit-member-container">
                    <span>Members:</span>
                    <ul id="edit-member-list">
                        <!-- Members will be inserted here -->
                    </ul>
                </div>
            </div>

            <button id="btn-save" class="btn-save">Save Changes</button>

        </div>
    </div>
    <!-- END MODAL EDIT -->

    <!-- MODAL VIEW-->
    <div id="modal-view" class="modal hidden">
      <div class="modal-content-view">
       <div class="head-content">
        <p class="sub-text">View Team Details</p>
          <button id="btn-close-view" class="btn-close">
            <img src="../assets/icons/ic-close.svg" alt="Icon Close" id="btn-close" />
          </button>
       </div>

       <div class="mid-content">
        <h4 class="main-text">Team Name: <span id="view-team-name"></span></h4>
        <div class="member">
          <h4 class="main-text">Members:</h4>
          <p id="view-members" class="memb-text"></p>
        </div>
       </div>

       <div class="regist-on">
       <p class="sub-text">Register on <span id="view-registration-date">12 December 2024</span></p>
       </div>
      </div>
    </div>
    <!-- END MODAL VIEW -->

    <!-- CONTAINER -->
     <div class="content">
      <div>
        <img src="../assets/images/img-bncc-logo.png" alt="Logo BNCC" class="img-logo-bncc" />
        <div class="container">
          <!-- Search Bar -->
          <div class="search-bar">
            <div class="left">
              <img src="../assets/icons/ic-search.svg" alt="Icon Search" id="ic-search" />
              <input type="text" placeholder="Search:" class="search-input" id="search-input" />
            </div>
            <img src="../assets/icons/ic-chevron-down.svg" alt="Icon Arrow" id="ic-arrow" />
          </div>

          <!-- Content List -->
          <div class="title-list">
            <div class="left-list">
              <h1 class="title">Team Name</h1>
              <h1 class="title">Registration Time</h1>
            </div>
            <div class="right-list">
              <h1 class="title">Action</h1>
            </div>
          </div>

          <div class="list-container">
            @foreach ($teams as $team)
            <div class="list-team">
              <h2 class="team-name" id="team-name">{{ $team->team_name }}</h2>
              <h2 class="regist-time" id="regist-time">{{ $team->created_at->format('d M Y') }}</h2>
              <div class="btn-control">
                <button class="btn-view" id="btn-view" onclick="openViewModal('{{ $team->team_name }}', '{{ $team->members->pluck('name')->join(', ') }}', '{{ $team->created_at->format('d M Y') }}')">View</button>
                <button class="btn-edit" id="btn-edit"
                    onclick="openEditModal(
                        '{{ $team->team_name }}',
                        {{ json_encode($team->members->where('is_leader', 0)->pluck('name')) }},
                        '{{ $team->leader->name ?? 'No Leader' }}'
                    )">
                    Edit
                </button>
                <button class="btn-delete" onclick="openDeleteModal('{{ $team->team_name }}', '{{ $team->id }}')">Delete</button>

              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <!-- END CONTAINER -->
  </body>
</html>
