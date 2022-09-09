@extends('admin.layout.layout')

@section('content')
    <!-- Main content -->
    <div class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Post Create</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">New Post</h3>
                    </div>
                    <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="titlePost">Title</label>
                                <input type="text" class="form-control
                                @error('title')
                                border-danger
                                @enderror
                                " id="titlePost"
                                   name="title"
                                       @error('title')
                                       value="{{old('title')}}"
                                       @enderror
                                        placeholder="Enter title post"
                                >
                            </div>
                            <div class="form-group">
                                <label for="descriptionPost">Description</label>
                                <textarea name="description" id="descriptionPost"
                                          class="form-control @error('description')
                                           border-danger
                                           @enderror" rows="2" placeholder="Enter ..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="contentPost">Content</label>
                                <textarea name="content" id="contentPost"
                                          class="form-control @error('content')
                                           border-danger
                                           @enderror" rows="2" placeholder="Enter ..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="categoryPost">Category</label>
                                <select name="category_id" id="categoryPost" class="form-control @error('category_id')
                                           border-danger
                                           @enderror">
                                 @foreach($categories as $categoryId => $categoryTitle )
                                    <option value="{{$categoryId}}">{{$categoryTitle}}</option>
                                 @endforeach
                                </select>
                            </div>

                            <div class="form-group ">
                                <label for="tags">Tags</label>
                                <select name="tags[]" class="select2 @error('tags')
                                           border-danger
                                           @enderror" multiple="multiple" id="tags" data-placeholder="Select tags" style="width: 100%;">
                                    @foreach($tags as $tagId => $tagTitle)
                                        <option value="{{$tagId}}">{{$tagTitle}}</option>
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
{{--                <div class="pagination">--}}
{{--                    {{ $categories->links() }}--}}
{{--                </div>--}}
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </div>
    <!-- /.content -->
@endsection
