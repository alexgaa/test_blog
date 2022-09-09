@extends('admin.layout.layout')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Posts</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <p>
                    <a href="{{route('posts.create')}}" class="btn btn-primary">Add Post</a>
                </p>
                @if(count($posts))
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Content</th>
                                <th>Category</th>
                                <th>Tag</th>
                                <th>Thumbnail</th>
                                <th>Created date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                            <tr class="mr-1">

                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->slug}}</td>
                                <th>{{$post->description}}</th>
                                <th>{{$post->content}}</th>
                                <th>{{$post->category->title}}</th>
                                <th>{{$post->tag->pluck('title')->join(', ')}}
                                 </th>
                                <th><img src="{{asset($post->thumbnail)}}" alt="" width="200px"></th>
                                <th>{{$post->created_at}}</th>
                                <td>
                                    <a href="{{route('posts.edit', ["post"=>$post->id])}}"
                                       class="btn btn-info btn-sm float-left mr-1">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                    <form action="{{route('posts.destroy', ["post"=>$post->id] )}}"
                                          method="post" class="float-left mb-0">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you want delete Post?')">
                                            <i class="fas fa-trash-alt"></i>
                                            Delete</button>
                                    </form>

                                </td>

                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                @else
                    <p><b>Post not found!</b> </p>
                @endif
            </div>
            <!-- /.card-body -->



            <div class="card-footer clearfix">
{{--                <div class="pagination">--}}
                    {{ $posts->links() }}
{{--                </div>--}}
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->

<!-- /.content-wrapper -->
@endsection
