@extends('admin.index')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Add new item
    
      </h1>
     <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>-->
    </section>
  
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-8">
          <div class="box">
  
    <!-- /.box-header -->
    <div class="box-body">
      <form  action="{{admin_url('/')}}/add-new" method="post">
        @csrf()
        <input type="hidden" class="form-control"  name="userId" value="2">
        @if ($errors->any())
        <div class="alert alert-danger">
           <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @if (isset($error_msg))
      <div class="api-error alert alert-danger">{{$error_msg}}</div>
      @endif
      @if (isset($success_msg))
      <div class="api-error alert alert-success">{{$success_msg}}</div>
      @endif
        <!-- text input -->
        <div class="form-group">
          <label>Title</label>
          <input type="text" class="form-control" placeholder="Enter ..." name="titel">
        </div>

        <!-- textarea -->
        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" rows="3" placeholder="Enter ..." name="description"></textarea>
        </div>
         <!-- text input -->
         <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control"  name="imageNews">
          </div>
         <!-- Date -->
         <div class="row">
             <div class="col-lg-6">
                <div class="form-group">
                    <label>activeDateFrom:</label>
                
                    <div class="input-group date">
                      <div class="input-group">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" name="activeDateFrom">
                    </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                 
             </div><!--col-lg-6-->
             <div class="col-lg-6">
                <div class="form-group">
                    <label>activeDateTo:</label>
                
                    <div class="input-group date">
                      <div class="input-group">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepickerTo" name="activeDateTo">
                    </div>
                    </div>
                    <!-- /.input group -->
                    <div class="form-group">
                        <label>Language</label>
                        <select class="form-control" name="language">
                            <option value="ar">Arabic</option>
                            <option value="en">English</option>
                        </select>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <button type="submit" class="btn btn-block btn-info">Save</button>
                         </div>      
                    </div>
                    </div><!--col-lg-6-->
                    
                  </div>
                  
             </div><!--row-->
         </div>
      </form>
      <div class="col-lg-4">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Important Data</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table class="table table-bordered">
                  <tbody>
                  <tr>
                    <td>1.</td>
                    <td>Count of Active users</td>
                    
                    <td><span class="badge bg-red">55</span></td>
                  </tr>
                  <tr>
                    <td>2.</td>
                    <td>Most five news seen by users</td>
                  
                            <td><a href="#"> <span class="badge bg-yellow">Post1</span></a></td>
                       
                            <td><a href="#"> <span class="badge bg-yellow">Post2</span></a></td>
                       
                       
                    </td>
                  </tr>
                
                </tbody></table>
              </div>
            
            </div>
            <!-- /.box -->
          </div>
      </div>
    
    <!-- /.box-body -->
  </div>
  
</div>
<!-- /.col -->

</div>

<!-- /.row -->
</section>
<!-- /.content -->
</div>
@endsection
@push('js')
<script>
//Date picker
$('#datepicker').datepicker({
  autoclose: true
});
$('#datepickerTo').datepicker({
    autoclose: true
  });
</script>
@endpush
