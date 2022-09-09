@extends('admin.layout.layout')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Post</h3>
                    </div>
                    <form action="{{route('posts.update',['post' => $post->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <div class="form-group">
                                <label for="titlePost">Title</label>
                                <input type="text"
                                    class="form-control
                                        @if($errors->any())
                                            border-danger
                                        @endif
                                    "
                                   id="titlePost"
                                   name="title"
                                   value="{{$post->title}}"
                               >
                            </div>

                            <div class="form-group">
                                <label for="descriptionPost">Description</label>
                                <textarea name="description" id="descriptionPost"
                                          class="form-control @error('description')
                                           border-danger
                                           @enderror" rows="2" >{{$post->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="contentPost">Content</label>
                                <textarea name="content" id="contentPost"
                                          class="form-control @error('content')
                                           border-danger
                                           @enderror" rows="2" >{{$post->content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="categoryPost">Category</label>
                                <select name="category_id" id="categoryPost" class="form-control
                                    @error('category_id')
                                        border-danger
                                    @enderror">
                                    @foreach($categories as $categoryId => $categoryTitle )
                                        <option value="{{$categoryId}}"
                                        @if($categoryId == $post->category_id)
                                            selected
                                        @endif
                                        >{{$categoryTitle}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group ">
                                <label for="tags">Tags</label>
                                <select name="tags[]" class="select2 @error('tags')
                                           border-danger
                                           @enderror" multiple="multiple" id="tags" data-placeholder="Select tags" style="width: 100%;">
                                    @foreach($tags as $tagId => $tagTitle)
                                        <option value="{{$tagId}}"
                                        @foreach($post->tag->pluck('title') as $tag)
                                            @if($tag == $tagTitle)
                                                selected
                                            @endif

                                        @endforeach
                                        >{{$tagTitle}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label id="inputGroupFile01">Image</label>
                                <div class="input-group">
                                    <label class="input-group-text " for="inputGroupFile01">Upload</label>
                                    <input name="thumbnail"
                                           type="file" class="form-control @error('thumbnail')
                                           border-danger
                                           @enderror" id="inputGroupFile01">
                                </div>
                                <img src="{{asset($post->thumbnail)}}" alt="" width="150px">
                            </div>



                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-body -->
        <div class="card-footer clearfix">
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
