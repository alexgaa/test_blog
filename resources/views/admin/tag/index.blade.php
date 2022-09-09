@extends('admin.layout.layout')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tags</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <p>
                    <a href="{{route('tags.create')}}" class="btn btn-primary">Add Tag</a>
                </p>
                @if(count($tags))
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th >id</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                            <tr class="mr-1">

                                <td>{{$tag->id}}</td>
                                <td>{{$tag->title}}</td>
                                <td>{{$tag->slug}}</td>
                                <td>
                                    <a href="{{route('tags.edit', ["tag"=>$tag->id])}}"
                                       class="btn btn-info btn-sm float-left mr-1"
                                    >
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                    <form action="{{route('tags.destroy', ["tag"=>$tag->id] )}}"
                                          method="post" class="float-left mb-0"
                                    >
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you want delete Tag?')">
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
                    <p><b>Tag not found!</b> </p>
                @endif
            </div>
            <!-- /.card-body -->



            <div class="card-footer clearfix">
{{--                <div class="pagination">--}}
                    {{ $tags->links() }}
{{--                </div>--}}
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->

<!-- /.content-wrapper -->
@endsection
