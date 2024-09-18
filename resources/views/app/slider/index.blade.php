<x-master-layout>

    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    </head>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">الاسلايدر</h5>
                            <a href="{{ route('app.slider.create') }}" class="float-right mr-1 btn btn-sm btn-primary"><i
                                    class="fa fa-plus-circle"></i>
                                {{ __("اضافة صورة") }}</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped border">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>العنوان</th>
                            <th>الحالة</th>
                            <th>الصورة</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( $sliders->count() == 0 )
                        <tr>
                            <td colspan="5" class="text-center">لا يوجد بيانات</td>
                        </tr>
                        @else
                            @foreach($sliders as $slider)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $slider->title }}</td>
                                <td>
                                    <span class="badge badge-{{ $slider->status == 1 ? 'success' : 'light' }}">{{ $slider->status == 1 ? 'نشط' : 'غير نشط' }}</span>
                                </td>
                                <td><img src="{{ asset('storage/images/public/slider_images/' . $slider->image) }}" alt="{{ $slider->title }}" width="100"></td>
                                <td>
                                    <a href="{{ route('app.slider.edit', $slider->id) }}" class="btn"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('app.slider.delete', $slider->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</x-master-layout>