<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">اضافة جروب</h5>
                            <a href="{{ route('groups.index') }}" class="float-right btn btn-sm btn-primary"><i
                                    class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model(null,['method' => 'POST','route'=>'groups.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator"] ) }}
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('name',__('الاسم').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('name',old('name'),['placeholder' => __('الاسم'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('user_ids',__('المستخدمين').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                <br />
                                {{ Form::select('user_ids[]', [], old('user_ids'), [
                                    'class' => 'select2js form-group category',
                                    'required',
                                    'data-placeholder' => __("اختر المستخدمين"),
                                    'data-ajax--url' => route('ajax-list', ['type' => 'all_user' ]),
                                    'multiple' => 'multiple',
                                ]) }}
                            </div>
                        </div>
                        {{ Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary float-right']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>