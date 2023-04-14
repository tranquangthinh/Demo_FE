@extends('main')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Register Blog</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card">
              <div class="card-header">
                <div class="form-group">
                  <form action="{{empty($blog) ? '/register' : '/edit/'. $blog['id']}}" method="POST">
                    @csrf
                    <div>
                        Title : <input type="text" name="title" @if(!empty($blog)) value="{{$blog['attributes']['Title']}}"  @endif/>
                    </div>
                    <br/>
                    <div>
                        Author : <input type="text" name="author" @if(!empty($blog)) value="{{$blog['attributes']['Author']}}"  @endif/>
                    </div>
                    <br/>
                    <div>
                        Content : <input type="text" name="content" @if(!empty($blog)) value="{{$blog['attributes']['Content']}}"  @endif/>
                    </div>
                    <br/>
                    <button type="submit">{{empty($blog) ? 'Register' : 'Edit' }}</button>
                  </form>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script-session')
<script>
</script>
@endsection