<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">تعديل صورة</h5>
                            <a href="{{ route('app.slider.index') }}" class="float-right btn btn-sm btn-primary"><i
                                    class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model(null,['method' => 'POST','route'=>['app.slider.update', $slider->id], 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator"] ) }}
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('title',__('العنوان').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('title',old('title',$slider->title),['placeholder' => __('العنوان'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('status',__('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status',$slider->status),[ 'class' =>'form-control select2js','required']) }}
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-control-label" for="slider_image">{{ __('الصورة') }}
                                </label>
                                <div class="custom-file">
                                    <input type="file" name="slider_image" class="custom-file-input" accept="image/*">
                                    <label
                                        class="custom-file-label upload-label">{{  __('messages.choose_file',['file' =>  __('الصورة') ]) }}</label>
                                </div>

                                <!-- <span class="selected_file"></span> -->
                                <div class="form-group mt-2">
                                    <img src="{{ asset('storage/images/public/slider_images/'.$slider->image) }}" class="img-thumbnail" alt="slider_image" width="200">
                                </div>
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