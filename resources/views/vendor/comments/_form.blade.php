<div class="card flex flex-col bg-gray-600 mb-4 my-2 mx-4 py-2 px-3 rounded-md border-2 border-black text-left">
    <div class="card-body">
        @include('includes.error')
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            @honeypot
            <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
            <input type="hidden" name="commentable_id" value="{{ $model->getKey() }}" />

            <div class="items-center px-4 text-left">
                <label for="message">Enter your comment here:</label>
                <textarea name="message" rows="3" class="focus:outline-none shadow appearance-none border-2 rounded-md my-2 py-2 px-3 w-full text-gray-700 leading-tight focus:border-gray-500" autocomplete="off" required></textarea>

            <button type="submit" class="focus:outline-none shadow rounded-md font-bold my-2 py-2 px-3 text-yellow-500 bg-gray-900 hover:bg-black hover:text-white">Submit</button>
            </div>
        </form>
    </div>
</div>
<br />
