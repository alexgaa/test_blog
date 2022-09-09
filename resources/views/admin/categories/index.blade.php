@extends('admin.layout.layout')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categories</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <p>
                    <a href="{{route('categories.create')}}" class="btn btn-primary">Add Category</a>
                </p>
                @if(count($categories))
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th >id</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th >Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                            <tr class="mr-1">

                                <td>{{$category->id}}</td>
                                <td>{{$category->title}}</td>
                                <td>{{$category->slug}}</td>
                                <td>
                                    <a href="{{route('categories.edit', ["category"=>$category->id])}}"
                                       class="btn btn-info btn-sm float-left mr-1"
                                    >
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                    <form action="{{route('categories.destroy', ["category"=>$category->id] )}}"
                                          method="post" class="float-left mb-0"
                                    >
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you want delete Category?')">
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
                    <p><b>Category not found!</b> </p>
                @endif
            </div>
            <!-- /.card-body -->



            <div class="card-footer clearfix">
{{--                <div class="pagination">--}}
                    {{ $categories->links() }}
{{--                </div>--}}
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->

<!-- /.content-wrapper -->
@endsection
