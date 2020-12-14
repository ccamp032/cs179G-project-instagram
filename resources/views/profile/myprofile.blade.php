@extends('layouts.app', ['activePage' => 'my-profile', 'titlePage' => __('My Profile')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row" style="padding-left:15px; padding-right:15px;">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">person</i>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-6 col-sm-6" style="max-width: 100%; flex: 0 0 40%">
                <div class="card card-stats">
                  <p class="card-category" style="text-align: left; padding-left:15px; padding-top: 15px;">Name</p>
                  <h3 class="card-title" style="text-align: left; padding-left:15px; padding-bottom: 15px; padding-right: 15px;">{{ $myInfo['name'] }}</h3>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6" style="max-width: 100%; flex: 0 0 40%">
                <div class="card card-stats">
                  <p class="card-category" style="text-align: left; padding-left:15px; padding-top: 15px;">Email</p>
                  <h3 class="card-title" style="text-align: left; padding-left:15px; padding-bottom: 15px; padding-right: 15px;">{{ $myInfo['email'] }}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">amp_stories</i>
              </div>
              <p class="card-category">Total Posts</p>
              <h3 class="card-title">{{count($myPosts ?? '')}}
                @if(count($myPosts ?? '') == 0 || count($myPosts ?? '') > 1)
                  <small>Post(s)</small>
                @else
                  <small>Post</small>
                @endif
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger"></i>
                <a href="#pablo"></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <a href="{{ route('profile.myfollowers') }}" name ="myFollowers">
                <div class="card-icon" style="color: white">
                  <i class="material-icons">supervisor_account</i>
                </div>
              </a>
              <p class="card-category" style="padding-top: 10px;">Followers</p>
              <h3 class="card-title">{{count($myFollowers)}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-icon">
              <a href="{{ route('profile.myfollowing') }}" name ="myFollowing">
                <div class="card-icon" style="background: linear-gradient(60deg, #2196f3, #005da7); color: white; box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px #2196f3;">
                  <i class="material-icons">redo</i>
                </div>
              </a>
              <p class="card-category" style="padding-top: 10px;">Following</p>
              <h3 class="card-title">{{count($myFollowings)}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-icon">
              <div class="card-icon" style="background: linear-gradient(60deg, #9c27b0, #8a1e9c); box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px #9c27b0;">
                <i class="material-icons">grade</i>
              </div>
              <p class="card-category">H.C.A.Y</p>
              <h3 class="card-title">{{$mySocialScore}}
                <small>: {{$myRating}}</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger"></i>
                <a href="#pablo"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      @if (session('status'))
          <div style="text-align: center; font-size:24px;" class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
      <div class="row">
        @foreach($myPosts ?? '' as $post)
          <div class="col-md-4">
            <div class="card card-chart">
              <div class="card-header card-header-warning">
                <a href="#" data-toggle="modal" data-target="#post{{ $post['post']['id'] }}">
                  <img style="width: 100%; " src="{{ url($post['post']['img_url']) }}">
                </a>
              </div>
              <div class="card-body">
                <h4 class="card-title">{{ $post['post']['description'] }}</h4>
                <p class="card-category">Posted By: <a style="padding:0px; margin:auto; display:inline;" class="nav-link" href="{{ route('profile.getProfile', ['userId' => $post['user_info']['id'] ]) }}" name ="userId">{{ $post['user_info']['name'] }}</a><br>Date: {{date('m-d-Y', strtotime($post['post']['created_at']))}}</p>
              </div>
              <div class="card-footer">
                <div class="stats" style="width: 100%; ">
                  <div class="post{{ $post['post']['id'] }}Views stats-left stats-section">
                    Views ({{$post['post']['views']}})
                  </div>
                  <div class="stats-middle stats-section">
                    Comments ({{count($post['comments'])}})
                  </div>
                  <div class="stats-right stats-section">
                    <p style="display:inline" id="post{{ $post['post']['id'] }}LikeCountMain">{{ $post['likes'] }}</p>
                    <i class="material-icons">thumb_up</i>
                    <i class="material-icons">thumb_down</i>
                    <p style="display:inline" id="post{{ $post['post']['id'] }}DislikeCountMain">{{ $post['dislikes'] }}</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="post{{ $post['post']['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content" style="width:120%;">
                <div class="modal-header">
                  <h5 class="modal-title" style="font-size:25px;" id="post{{ $post['post']['id'] }}lLabel">{{ $post['post']['description'] }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <p style="font-size:13px; margin-left:16px;">
                  Post Tags: {{ $post['post']['misc_tags'] }}
                </p>
                <div class="modal-body">
                  <div style="width:70%; text-align:center; margin:auto;">
                    <img style="width: 100%; " src="{{ url($post['post']['img_url']) }}">
                  </div>
                  <br>
                  @foreach($post['user_tags'] as $user)
                    <button style="margin:0px; padding:0px; top:-11px;" type="button" rel="tooltip" title="" class="btn btn-primary btn-link btn-sm" data-original-title="{{ $user['name'] }}">
                      <i class="material-icons">account_circle</i>
                    <div class="ripple-container"></div></button>
                   @endforeach
                  <a href='{{ url($post['post']['img_url']) }}' download='InstagramImage' class="button">
                    <i style="float:right; margin-bottom:20px; cursor:pointer;" class="material-icons">cloud_download</i>
                  </a>
                  <br>
                  <div style="width:100%; display:flex;">
                    <div class="stats" style="width: 100%; display:flex;">
                      <div class="post{{ $post['post']['id'] }}Views stats-left stats-section">
                        Views ({{$post['post']['views']}})
                      </div>
                      <div class="stats-middle stats-section">
                        <a href="#" id="post{{ $post['post']['id'] }}commentsToggle" >Comments ({{count($post['comments'])}})</a>
                      </div>
                      <br>
                      <div class="stats-right stats-section">
                        <p style="display:inline" id="post{{ $post['post']['id'] }}LikeCount">{{ $post['likes'] }}</p>
                        @if($post['likedImage'] == 1)
                          <a style="color:#2196f3;" href="#" id="post{{ $post['post']['id'] }}Like">
                            <i style="vertical-align: text-bottom;" class="material-icons">thumb_up</i>
                          </a>
                          <a style="color:#6c757d;" href="#" id="post{{ $post['post']['id'] }}Dislike">
                            <i style="vertical-align: text-bottom;" class="material-icons">thumb_down</i>
                          </a>
                        @elseif($post['likedImage'] == 0)
                          <a style="color:#6c757d;" href="#" id="post{{ $post['post']['id'] }}Like">
                            <i style="vertical-align: text-bottom;" class="material-icons">thumb_up</i>
                          </a>
                          <a style="color:#f44336;" href="#" id="post{{ $post['post']['id'] }}Dislike">
                            <i style="vertical-align: text-bottom;" class="material-icons">thumb_down</i>
                          </a>
                        @else
                          <a style="color:#6c757d;" href="#" id="post{{ $post['post']['id'] }}Like">
                            <i style="vertical-align: text-bottom;" class="material-icons">thumb_up</i>
                          </a>
                          <a style="color:#6c757d;" href="#" id="post{{ $post['post']['id'] }}Dislike">
                            <i style="vertical-align: text-bottom;" class="material-icons">thumb_down</i>
                          </a>
                        @endif
                        <p style="display:inline" id="post{{ $post['post']['id'] }}DislikeCount">{{ $post['dislikes'] }}</a>
                      </div>
                    </div>
                  </div>
                  <div class="container" id="post{{ $post['post']['id'] }}spacer" style="display: none; padding-top: 10px"></div>
                  <div style="display:none; overflow: auto; min-height: 0px; max-height:420px; padding: 5px;" id="post{{ $post['post']['id'] }}commentsBox">
                    @foreach($post['comments'] ?? '' as $comment)
                    <br>
                    <div style="word-wrap: break-word; border-style: dashed; border-color:grey; border-width: 1px; padding: 5px; border-radius: 10px;">
                      <p style="float:left;">
                         <div style="word-wrap: break-word;"> <bold style="font-weight:bold;">{{ $comment['userName'] }}: </bold> {{ $comment['comment'] }}</div>
                      </p>
                      <p style="float:right; padding-top: 5px">
                        Date: {{date('m-d-Y', strtotime($comment['postDate']))}}
                      </p>
                    </div>
                    <br>
                    @endforeach
                    </div><br>
                    <input style="display:none; width:80%;" id="post{{ $post['post']['id'] }}newComment" type="text" value="" name ="comment" placeholder="Comment..." style="width: 83%;">
                    <button style="display:none;" id="post{{ $post['post']['id'] }}submitComment" type="submit" class="btn btn-primary">{{ __('Post') }}</button>
                    <div class="row" id="post{{ $post['post']['id'] }}editPostContainer" style="width: 100%; padding-top: 10px; text-align:center; margin:auto;">
                      <div class="container">
                        <div>
                          <a href="{{ route('post.edit') }}?id={{ $post['post']['id'] }}">
                            <button style="background-color: #2196f3;" id="post{{ $post['post']['id'] }}editPost" type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
                          </a>
                        </div>
                      </div>
                    </div>
                  <script>
                    $("#post{{ $post['post']['id'] }}commentsToggle").click(function(){
                      if ($("#post{{ $post['post']['id'] }}commentsBox").is(':visible')) {
                        $("#post{{ $post['post']['id'] }}commentsBox").slideUp();
                        $("#post{{ $post['post']['id'] }}newComment").slideUp();
                        $("#post{{ $post['post']['id'] }}submitComment").slideUp();
                        $("#post{{ $post['post']['id'] }}spacer").slideUp();
                      } else {
                        $("#post{{ $post['post']['id'] }}commentsBox").slideDown();
                        $("#post{{ $post['post']['id'] }}newComment").slideDown();
                        $("#post{{ $post['post']['id'] }}submitComment").slideDown();
                        $("#post{{ $post['post']['id'] }}spacer").slideDown();
                      }
                    });
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $("#post{{ $post['post']['id'] }}").on('show.bs.modal', function (request, response) {
                      $.ajax({
                         type:'POST',
                         url:"{{route('post.incrementViews')}}",
                         data: {
                            _token: CSRF_TOKEN,
                            post_id: "{{ $post['post']['id'] }}"
                         },
                         success:function(data) {
                            newViewsString = "Views (" + data + ")";
                            $(".post{{ $post['post']['id'] }}Views").text(newViewsString);
                         }
                      });
                    });

                    $("#post{{ $post['post']['id'] }}Like").click(function(){
                      $.ajax({
                         type:'POST',
                         url:"{{route('post.likePhoto')}}",
                         data: {
                            _token: CSRF_TOKEN,
                            post_id: "{{ $post['post']['id'] }}"
                         },
                         success:function(data) {
                          $("#post{{ $post['post']['id'] }}LikeCount").text(data.likes)
                          $("#post{{ $post['post']['id'] }}DislikeCount").text(data.dislikes);
                          $("#post{{ $post['post']['id'] }}LikeCountMain").text(data.likes)
                          $("#post{{ $post['post']['id'] }}DislikeCountMain").text(data.dislikes);

                          $("#post{{ $post['post']['id'] }}Like").css("color", "#2196f3");
                          $("#post{{ $post['post']['id'] }}Dislike").css("color", "#6c757d");
                         }
                      });
                    });

                    $("#post{{ $post['post']['id'] }}Dislike").click(function(){
                      $.ajax({
                         type:'POST',
                         url:"{{route('post.dislikePhoto')}}",
                         data: {
                            _token: CSRF_TOKEN,
                            post_id: "{{ $post['post']['id'] }}"
                         },
                         success:function(data) {
                           $("#post{{ $post['post']['id'] }}LikeCount").text(data.likes);
                           $("#post{{ $post['post']['id'] }}DislikeCount").text(data.dislikes);
                           $("#post{{ $post['post']['id'] }}LikeCountMain").text(data.likes);
                           $("#post{{ $post['post']['id'] }}DislikeCountMain").text(data.dislikes);

                           $("#post{{ $post['post']['id'] }}Like").css("color", "#6c757d");
                           $("#post{{ $post['post']['id'] }}Dislike").css("color", "#f44336");
                         }
                      });
                    })

                    $("#post{{ $post['post']['id'] }}newComment").on('keyup', function (e) {
                        if (e.key === 'Enter' || e.keyCode === 13) {
                            $("#post{{ $post['post']['id'] }}submitComment").click();
                        }
                    });

                    $("#post{{ $post['post']['id'] }}submitComment").click(function(){
                      newComment = $("#post{{ $post['post']['id'] }}newComment").val();
                      $.ajax({
                         type:'POST',
                         url:"{{route('post.addComment')}}",
                         data: {
                            _token: CSRF_TOKEN,
                            post_id: "{{ $post['post']['id'] }}",
                            comment: newComment,
                         },
                         success:function(data) {
                           // console.log(data);
                           $("#post{{ $post['post']['id'] }}newComment").val('');
                           $("#post{{ $post['post']['id'] }}commentsBox").empty();
                           data.forEach(function (item, index) {
                             console.log(item, index);
                             console.log(item['id']);
                             date = new Date(item['postDate']);
                             $("#post{{ $post['post']['id'] }}commentsBox").append("\
                             <br>\
                             <div style='word-wrap: break-word; border-style: dashed; border-color:grey; border-width: 1px; padding: 5px; border-radius: 10px;'>\
                             <p style='float:left;'>\
                              <div style='word-wrap: break-word;'> <bold style='font-weight:bold;'>" + item['userName'] + ": </bold>"+ item['comment'] + "</div>\
                             </p>\
                             <p style='float:right; padding-top: 5px'>\
                               Date: " + ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '-' + (((date.getDate()) > 9) ? (date.getDate()) :
                               ('0' + (date.getDate()))) + '-' + date.getFullYear() + "\
                             </p>\
                             </div>\
                             <br>")
                           });

                         }
                      });
                    })
                  </script>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush
