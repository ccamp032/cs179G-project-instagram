@extends('layouts.app', ['activePage' => 'pop-users', 'titlePage' => __('Search List')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Most Popular Users (Top 20)</h4>
            <p class="card-category">by Followers</p>
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
                    Followers
                  </th>
                  <th>
                  </th>
                </thead>
                <tbody>
                  @foreach($popularUsers as $user)
                  <tr>
                    <td>
                      {{ $user[0]['id'] }}
                    </td>
                    <td>
                      {{ $user[0]['name'] }}
                    </td>
                    <td>
                      {{ $user[1]['follower_count'] }}
                    </td>
                    <td class="text-primary">
                      <div style="display: inline-block">
                        <a class="nav-link" href="{{ route('profile.getProfile', ['userId' => $user[0]['id'] ]) }}" name ="userId">{{ __('View Profile') }}</a>
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