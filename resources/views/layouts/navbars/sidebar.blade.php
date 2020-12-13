<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <!-- <a href="https://creative-tim.com/" class="simple-text logo-normal">
      {{ __('Creative Tim') }}
    </a> -->
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('My Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'my-profile' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('profile.myprofile') }}">
          <i class="material-icons">account_circle</i>
            <p>{{ __('My Profile') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'create-post' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('post.create') }}">
          <i class="material-icons">post_add</i>
            <p>{{ __('Create Post') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#popular" aria-expanded="false">
          <i class="material-icons">pages</i>
          <p>{{ __('Popular') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse hide" id="popular">
          <ul class="nav" style="padding-left: 20px">
            <li class="nav-item{{ $activePage == 'pop-users' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('popular.users') }}">
                <i class="material-icons">person</i>
                <span class="sidebar-normal"> {{ __('Users') }} </span>
              </a>
            </li>
          </ul>
          <ul class="nav" style="padding-left: 20px">
            <li class="nav-item{{ $activePage == 'pop-posts' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('popular.posts') }}">
                <i class="material-icons">class</i>
                <span class="sidebar-normal"> {{ __('Posts') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('icons') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Icons') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>
