@extends('layouts.app', ['activePage' => 'create-post', 'titlePage' => __('Create Post')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('post.createPost') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Profile') }}</h4>
                <p class="card-category">{{ __('User information') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <form runat="server">
                    <img style="display:block; margin:auto; text-align: center;" id="blah" src="#" alt="" />
                  </form>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Image') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                      <input style="width:85%;" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" id="input-image" type="file" required />
                      @if ($errors->has('image'))
                        <span id="image-error" class="error text-danger" for="input-image">{{ $errors->first('image') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                      <input style="width:85%;" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="input-description" type="text" placeholder="{{ __('Description') }}" value="" required="true" aria-required="true"/>
                      @if ($errors->has('description'))
                        <span id="description-error" class="error text-danger" for="input-name">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('MiscTags') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('misc_tags') ? ' has-danger' : '' }}">
                      <input style="width:85%" class="" name="misc_tags_name" id="misc_input-tags" type="text" placeholder="{{ __('Misc Tags') }}" value="" />
                      @if ($errors->has('misc_tags'))
                        <span id="misc_tags-error" class="error text-danger" for="misc_input-tags">{{ $errors->first('tags') }}</span>
                      @endif
                      <input type="hidden" id="misc_tags_id" name="misc_tags_id" value="" />
                      <button style="margin:0px; padding:0px; top:-11px;" type="button" rel="tooltip" title="" class="btn btn-primary btn-link btn-sm" data-original-title="Comma Separated">
                        <i class="material-icons">help</i>
                      <div class="ripple-container"></div></button>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('User_Tags') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('user_tags') ? ' has-danger' : '' }}">
                      <input style="width:85%;" class="" name="user_tags_name" id="user_input-tags" type="text" placeholder="{{ __('User Tags') }}" value="" />
                      @if ($errors->has('user_tags'))
                        <span id="user_tags-error" class="error text-danger" for="user_input-tags">{{ $errors->first('user_tags') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <script>
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $( function() {
                    function split( val ) {
                      return val.split( /,\s*/ );
                    }
                    function extractLast( term ) {
                      return split( term ).pop();
                    }

                    $( "#user_input-tags" )
                      // don't navigate away from the field on tab when selecting an item
                      .on( "keydown", function( event ) {
                        if ( event.keyCode === $.ui.keyCode.TAB &&
                            $( this ).autocomplete( "instance" ).menu.active ) {
                          event.preventDefault();
                        }
                      })
                      .autocomplete({
                        minLength: 0,
                        source: function( request, response ) {
                          // delegate back to autocomplete, but extract the last term
                          $.ajax({
                            url:"{{route('post.getUserNames')}}",
                            type: 'post',
                            dataType: "json",
                            data: {
                               _token: CSRF_TOKEN,
                               search: extractLast( request.term )
                            },
                            success: function( data ) {
                               currentInput = $( "#user_input-tags" ).val();
                               if (currentInput == "") {
                                 $("#submit_post").attr("disabled", false);
                               } else {
                                 $("#submit_post").attr("disabled", true);
                                response( data );
                               }
                            }
                          });
                        },
                        focus: function() {
                          // prevent value inserted on focus
                          return false;
                        },
                        select: function( event, ui ) {
                          console.log(this.value)
                          var names = split( this.value );
                          // remove the current input
                          names.pop();
                          // add the selected item
                          names.push( ui.item.label );
                          // add placeholder to get the comma-and-space at the end
                          names.push( "" );
                          this.value = names.join( ", " );

                          $("#submit_post").attr("disabled", false);
                          return false;
                        }
                      });
                  } );
                    function readURL(input) {
                      if (input.files && input.files[0]) {
                          var reader = new FileReader();

                          reader.onload = function(e) {
                            $('#blah').attr('src', e.target.result);
                          }

                          reader.readAsDataURL(input.files[0]); // convert to base64 string
                        }
                    }

                      $("#input-image").change(function() {
                        readURL(this);

                      });
                </script>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button id="submit_post" type="submit" class="btn btn-primary">{{ __('Post') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
