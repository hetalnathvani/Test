@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.technologies.management') . ' | ' . trans('labels.backend.technologies.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.technologies.management') }}
        <small>{{ trans('labels.backend.technologies.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.technologies.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-technology']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.technologies.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.technologies.partials.technologies-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!--box-header with-border-->

            <div class="box-body">

            {{-- Technology Name --}}
                <div class="form-group">
                    {{ Form::label('name', 'Technology Name', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('technology_name', null, ['class' => 'form-control box-size', 'placeholder' => 'Enter Technology Name', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                
                    <div class="edit-form-btn">
                        {{ link_to_route('admin.technologies.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!-- form-group -->
            </div><!--box-body-->
        </div><!--box box-success-->
    {{ Form::close() }}
@endsection
