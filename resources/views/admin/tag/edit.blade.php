@extends('admin.layout.layout')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Tag</h3>
                    </div>
                    <form action="{{route('tags.update',['tag' => $tag->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <div class="form-group">
                                <label for="titleTag">Title</label>
                                <input type="text"
                                    class="form-control
                                        @if($errors->any())
                                            border-danger
                                        @endif
                                    "
                                   id="titleTag"
                                   name="title"
                                   value="{{$tag->title}}"
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
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
