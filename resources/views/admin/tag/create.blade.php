@extends('admin.layout.layout')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tag Create</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">New Tag</h3>
                    </div>
                    <form action="{{route('tags.store')}}" method="POST">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="titleCategory">Title</label>
                                <input type="text" class="form-control
                                @if($errors->any())
                                border-danger
                                @endif
                                " id="titleCategory"
                                   name="title"
                                   @if($errors->any())
                                       value="{{old('title')}}"
                                   @else
                                        placeholder="Enter title tag"
                                    @endif
                                >
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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

    </section>
    <!-- /.content -->
@endsection
