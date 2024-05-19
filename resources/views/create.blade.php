<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <textarea name="content" placeholder="What's on your mind?"></textarea>
    <input type="file" name="image">
    <input type="file" name="video">
    <button type="submit">Post</button>
</form>
