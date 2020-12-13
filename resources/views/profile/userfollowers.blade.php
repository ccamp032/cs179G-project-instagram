@extends('layouts.app', ['activePage' => 'user-followers', 'titlePage' => __('User Followers List')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">{{ $userInfo['name'] }}'s Followers</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    ID
                  </th>
                  <th>
                    Name
                  </th>
                  <th>
                  </th>
                </thead>
                <tbody>
                  @foreach($userFollowers as $user)
                    <tr>
                      <td>
                        {{ $user['id'] }}
                      </td>
                      <td>
                        {{ $user['name'] }}
                      </td>
                      <td class="text-primary">
                        <div style="display: inline-block">
                          <a class="nav-link" href="{{ route('profile.getProfile', ['userId' => $user['id'] ]) }}" name ="userId">{{ __('View Profile') }}</a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection