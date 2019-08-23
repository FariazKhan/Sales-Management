@extends('admin/master')

@section('customStyles')
<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('contents')

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Write the post
		</h3>
		<!-- tools box -->
		<div class="pull-right box-tools">
			<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
			title="Collapse">
			<i class="fa fa-minus"></i></button>

		</div>
		<!-- /. tools -->
	</div>
	<!-- /.box-header -->
	<div class="box-body pad">
		{!! Form::open(['route' => 'post.store']) !!}
			<div class="box-body">
				<div class="col-md-6">
					
					<div class="form-group">
					    {!! Form::label('title', 'Post Title') !!}
					    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => "Enter post title here..."]) !!}
						<p class="text-danger">{{$errors->first('title')}}</p>
					</div>
					<div class="form-group">
						{!! Form::label('subtitle', 'Post Subtitle') !!}
						{!! Form::text('subtitle', null, ['class' => 'form-control', 'placeholder' => "Enter post subtitle here..."]) !!}
						<p class="text-danger">{{$errors->first('subtitle')}}</p>
					</div>
					<div class="form-group">
						{!! Form::label('slug', 'Post Slug') !!}
						{!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => "Enter post slug here..."]) !!}
						<p class="text-danger">{{$errors->first('slug')}}</p>
					</div>

				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="pull-left">
							<div class="form-group">
							    {!! Form::label('image', 'Post Image') !!}
							    {!! Form::file('image', null) !!}
							</div>
						</div>
						<div class="checkbox pull-right">
							<label>
								<input type="checkbox" name="status" value="1"> Publish
								<p class="text-danger">{{$errors->first('status')}}</p>
							</label>
						</div>
					</div>
					<br>
					<br>
					<br>
					<div class="form-group">
						{!!Form::label('categories', 'Post Category') !!}
						{!!Form::select('categories[]', $categories, null, ['class' => 'form-control select2', 'multiple'])!!}
						<p class="text-danger">{{$errors->first('categories[]')}}</p>
					</div>
					<div class="form-group">
						<label>Select Tag</label>
						{!!Form::label('tags', 'Post Tags') !!}
						{!!Form::select('tags[]', $tags, null, ['class' => 'form-control select2', 'multiple'])!!}
						<p class="text-danger">{{$errors->first('tags[]')}}</p>
					</div>
			</div>
		</div>

		<hr>

		<div class="box box-info">
			<div class="box-body pad">
				<textarea id="editor1" name="body" height="400px"></textarea>
			</div>
		</div>
		<a href="{{ route('post.index') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back</a>
		{!! Form::submit('Post >>', ['class' => 'btn btn-info pull-right']) !!}
	{!! Form::close() !!}
</div>
</div>

@endsection

@section('customScript')
<script src="{{asset('admin/bower_components/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<script>
//Initialize Select2 Elements
$(document).ready(function(){
	$('.select2').select2();
});
</script>
@endsection
