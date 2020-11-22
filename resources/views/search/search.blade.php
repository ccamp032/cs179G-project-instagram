@extends('layouts.app', ['activePage' => 'search', 'titlePage' => __('Search List')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      @if($searchUser)
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Search Results</h4>
            <p class="card-category">Users</p>
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
                  @foreach($searchUser as $user)
                  <tr>
                    <td>
                      {{ $user['id'] }}
                    </td>
                    <td>
                      {{ $user['name'] }}
                    </td>
                    <td class="text-primary">
                      View Profile
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      @endif
      @if($searchPosts)
        @foreach($searchPosts as $post)
          <div class="col-md-4">
            <div class="card card-chart">
              <div class="card-header card-header-warning">
                <img style="width: 100%; " src="{{ url($post['post']['img_url']) }}">
              </div>
              <div class="card-body">
                <h4 class="card-title">{{ $post['post']['description'] }}</h4>
              <p class="card-category">Posted By: {{ $post['user_info']['name'] }}<br>Date: {{date('m-d-Y', strtotime($post['post']['created_at']))}}</p>
              </div>
              <div class="card-footer">
                <div class="stats" style="width: 100%; ">
                  <div class="stats-left stats-section">
                    Views ({{$post['post']['views']}})
                  </div>
                  <div class="stats-middle stats-section">
                    Comments ({{count($post['comments'])}})
                  </div>
                  <div class="stats-right stats-section">
                    {{ $post['likes'] }} <i class="material-icons">thumb_up</i>  <i class="material-icons">thumb_down</i> {{ $post['dislikes'] }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</div>
@endsection