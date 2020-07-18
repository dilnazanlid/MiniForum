@if ($errors->any())
  <div class="flex text-center mt-4 justify-center items-center">
      <ul>
          @foreach ($errors->all() as $error)
              <li class="bg-red-200 py-2 px-2 rounded">{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
@if(Session::has('success'))
  <div class="flex text-center mt-4 justify-center items-center">
    <h4 class="bg-green-300 py-2 px-2 rounded">{{ Session::get('success') }}</h4>
  </div>
@endif
@if(Session::has('failed'))
  <div class="flex text-center mt-4 justify-center items-center">
    <h4 class="bg-red-300 py-2 px-2 rounded">{{ Session::get('failed') }}</h4>
  </div>
@endif
@if($errors->has('commentable_type'))
    <div class="alert alert-danger" role="alert">
        {{ $errors->first('commentable_type') }}
    </div>
@endif
@if($errors->has('commentable_id'))
    <div class="alert alert-danger" role="alert">
        {{ $errors->first('commentable_id') }}
    </div>
@endif
