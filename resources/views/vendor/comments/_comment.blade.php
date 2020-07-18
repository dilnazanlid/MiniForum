@inject('markdown', 'Parsedown')
@php($markdown->setSafeMode(true))

@if(isset($reply) && $reply === true)
  <div id="comment-{{ $comment->getKey() }}" class="media ml-32">
@else
  <li id="comment-{{ $comment->getKey() }}" class="media">
@endif
    <img class="mr-3 w-16" src="https://www.pngkey.com/png/full/114-1149847_avatar-unknown-dp.png ">
    <div class="media-body">
      <div class="container bg-gray-600 my-4 mx-4 py-2 px-3 rounded-md border-2 border-black text-left">
        <h5 class="mt-0 mb-1">{{ $comment->commenter->name ?? $comment->guest_name }} <small class="text-muted">- {{ $comment->created_at->diffForHumans() }}</small></h5>
        <div style="white-space: pre-wrap;">{!! $markdown->line($comment->comment) !!}</div>
      </div>

        <div>
            @can('reply-to-comment', $comment)
                <button data-toggle="modal" id="reply-button-{{ $comment->getKey() }}" data-target="#reply-modal-{{ $comment->getKey() }}" class="focus:outline-none bg-gray-900 my-2 py-2 px-4 hover:bg-black rounded-md font-semibold text-yellow-500 hover:text-white">Reply</button>
            @endcan
            @can('edit-comment', $comment)
                <button data-toggle="modal" id="comment-button-{{ $comment->getKey() }}" data-target="#comment-modal-{{ $comment->getKey() }}" class="focus:outline-none bg-gray-900 my-2 py-2 px-4 hover:bg-black rounded-md font-semibold text-yellow-500 hover:text-white">Edit</button>
            @endcan
            @can('delete-comment', $comment)
                <a href="{{ route('comments.destroy', $comment->getKey()) }}" onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();" class="btn btn-sm btn-link text-danger text-uppercase">Delete</a>
                <form id="comment-delete-form-{{ $comment->getKey() }}" action="{{ route('comments.destroy', $comment->getKey()) }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>
            @endcan
        </div>

        @can('edit-comment', $comment)
            <div class="edit-modal bg-gray-600 w-auto my-4 mx-4 py-2 px-3 rounded-md border-2 border-black text-left" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog" style="display:none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
                            @method('PUT')
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title font-bold">Edit Comment</h5>
                            </div>
                            <div class="modal-body">
                              <textarea required class="focus:outline-none shadow appearance-none border-2 rounded-md my-2 py-2 px-3 w-full leading-tight focus:border-gray-500" name="message" rows="5">{{ $comment->comment }}</textarea>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="focus:outline-none bg-gray-900 my-2 py-2 px-4 hover:bg-black rounded-md font-semibold text-yellow-500 hover:text-white">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        @can('reply-to-comment', $comment)
            <div class="reply-modal bg-gray-600 w-auto my-4 mx-4 py-2 px-3 rounded-md border-2 border-black text-left" id="reply-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog" style="display:none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('comments.reply', $comment->getKey()) }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title font-bold">Reply to Comment</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <textarea required class="focus:outline-none shadow appearance-none border-2 rounded-md my-2 py-2 px-3 w-full leading-tight focus:border-gray-50" name="message" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="focus:outline-none bg-gray-900 my-2 py-2 px-4 hover:bg-black rounded-md font-semibold text-yellow-500 hover:text-white">Reply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        <br />{{-- Margin bottom --}}

        {{-- Recursion for children --}}
        @if($grouped_comments->has($comment->getKey()))
            @foreach($grouped_comments[$comment->getKey()] as $child)
                @include('comments::_comment', [
                    'comment' => $child,
                    'reply' => true,
                    'grouped_comments' => $grouped_comments
                ])
            @endforeach
        @endif

    </div>
@if(isset($reply) && $reply === true)
  </div>
@else
  </li>
@endif
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

  $('#reply-button-{{ $comment->getKey() }}').click(function(){
    $('#reply-modal-{{ $comment->getKey() }}').toggle('slow');
  });

  $('#comment-button-{{ $comment->getKey() }}').click(function(){
    $('#comment-modal-{{ $comment->getKey() }}').toggle('slow');
  });

});
</script>
