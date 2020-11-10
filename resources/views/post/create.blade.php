@extends('layouts.app', ['activePage' => 'create-post', 'titlePage' => __('Create Post')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal">
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
                      <input class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" id="input-image" type="file" required />
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
                      <input class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="input-description" type="text" placeholder="{{ __('Description') }}" value="" required="true" aria-required="true"/>
                      @if ($errors->has('description'))
                        <span id="description-error" class="error text-danger" for="input-name">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Tags') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('tags') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="tags" id="input-tags" type="text" placeholder="{{ __('Tags') }}" value="" required />
                      @if ($errors->has('tags'))
                        <span id="tags-error" class="error text-danger" for="input-tags">{{ $errors->first('tags') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <script>
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $(document).ready(function(){

                      $( "#input-tags" ).autocomplete({
                        source: function( request, response ) {
                          // Fetch data
                          $.ajax({
                            url:"{{route('post.getUserNames')}}",
                            type: 'post',
                            dataType: "json",
                            data: {
                               _token: CSRF_TOKEN,
                               search: request.term
                            },
                            success: function( data ) {
                               response( data );
                            }
                          });
                        },
                        select: function (event, ui) {
                           // Set selection
                           $('#employee_search').val(ui.item.label); // display the selected text
                           $('#employeeid').val(ui.item.value); // save selected id to input
                           return false;
                        }
                      });

                    });

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
                <button type="submit" class="btn btn-primary">{{ __('Post') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
