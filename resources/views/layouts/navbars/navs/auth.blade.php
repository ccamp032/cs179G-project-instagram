<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <!-- <a class="navbar-brand" href="#">{{ $activePage }}</a> -->
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <form class="navbar-form" method="post" action="{{ route('search.search') }}">
        @csrf
        @method('put')
        <div class="input-group no-border">
          <div class="row" style="padding-top: 10px; padding-right: 50px">
            <div>
              <select id="search_method_1" name="search_method_1" style="margin-right: 20px; background: #00ffff00; color: grey; border-top: none; border-left: 1px solid grey;
                width: 100%; border-left:none; border-right:none;">
                <option value="users">Users</option>
                <option value="posts">Posts</option>
              </select>
            </div>
            <div style="padding-left: 30px; padding-right: 30px">
              by
            </div>
            <div>
              <select id="search_method_2" name="search_method_2" style="background: #00ffff00; color: grey; border-top: none; border-left: 1px solid grey;
                width: 100%; border-left:none; border-right:none;">
                  <option value="name">Name</option>
                  <option value="post_description">Post Description</option>
                  <option value="follower_count">Follower Count</option>
                  <option value="like_count">Like Count</option>
                  <option value="post_count">Post Count</option>
                  <option value="user_tags">User Tags</option>
                  <option value="misc_tags">Misc Tags</option>
              </select>
            </div>
            <div>
              <select id="search_method_3" name="search_method_3" style="display: none; margin-left: 30px; background: #00ffff00; color: grey; border-top: none; border-left: 1px solid grey;
                width: 50%; border-left:none; border-right:none;">
                  <option value="less_than"><</option>
                  <option value="equal_to">=</option>
                  <option value="greater-than">></option>
              </select>
            </div>
          </div>
        <input type="date" id="post_date" name="post_date" style="display: none; margin-right: 30px"> 
        <input type="text" id="search" value="" class="form-control" name ="search" placeholder="Search...">
        <button type="submit" class="btn btn-white btn-round btn-just-icon">
          <i class="material-icons">search</i>
          <div class="ripple-container"></div>
        </button>
        </div>
      </form>
      <script>
        $('#search_method_1').change(function() {
          if($(this).val() == "users") {
            options = '<option value="name">Name</option> \
                       <option value="post_description">Post Description</option> \
                       <option value="follower_count">Follower Count</option> \
                       <option value="like_count">Like Count</option> \
                       <option value="post_count">Post Count</option> \
                       <option value="user_tags">User Tags</option> \
                       <option value="misc_tags">Misc Tags</option>';
                       $('#search_method_2').css('margin-right', '0px');
                       $('#search_method_3').css('display', 'none');
                       $('#post_date').css('display', 'none');
                       $('#search').css('display', '');
          }
          else if($(this).val() == "posts") {
            options = '<option value="description">Description</option> \
                       <option value="user_name">User Name</option> \
                       <option value="user_tags">User Tags</option> \
                       <option value="misc_tags">Misc Tags</option> \
                       <option value="post_views">Views</option> \
                       <option value="post_date">Date</option> \
                       <option value="like_count">Like Count</option> \
                       <option value="comments_count">Comments Count</option>';
            $('#search_method_2').css('margin-right', '37px');
            $('#search_method_3').css('display', 'none');
            $('#post_date').css('display', 'none');
            $('#search').css('display', '');
          }
          $('#search_method_2').html(options);
        });

        $('#search_method_2').change(function() {
          if($(this).val() == "follower_count") {
            $('#search_method_3').css('display', '');
            $('#search').css('display', '');
          }
          else if($(this).val() == "like_count") {
            $('#search_method_3').css('display', '');
            $('#search').css('display', '');
          }
          else if($(this).val() == "post_count") {
            $('#search_method_3').css('display', '');
            $('#search').css('display', '');
          }
          else if($(this).val() == "post_views") {
            $('#search_method_3').css('display', '');
            $('#search').css('display', '');
          }
          else if($(this).val() == "comments_count") {
            $('#search_method_3').css('display', '');
            $('#search').css('display', '');
          }
          else if($(this).val() == "post_date") {
            $('#search_method_3').css('display', 'none');
            $('#search').css('display', 'none');
            $('#post_date').css('display', '');
          }
          else {
            $('#search_method_3').css('display', 'none');
            $('#post_date').css('display', 'none');
            $('#search').css('display', '');

          }
        });
      </script>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">
            <i class="material-icons">dashboard</i>
            <p class="d-lg-none d-md-block">
              {{ __('Stats') }}
            </p>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">person</i>
            <p class="d-lg-none d-md-block">
              {{ __('Account') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
            <a class="dropdown-item" href="#">{{ __('Settings') }}</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
