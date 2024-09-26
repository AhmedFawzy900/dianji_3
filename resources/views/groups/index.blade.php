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
                            <h5 class="font-weight-bold">الجروبات</h5>
                            <a href="{{ route('groups.create') }}" class="float-right mr-1 btn btn-sm btn-primary"><i
                                    class="fa fa-plus-circle"></i>
                                {{ __("اضافة جروب") }}</a>
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
                            <th>الاسم</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( $groups->count() == 0 )
                        <tr>
                            <td colspan="5" class="text-center">لا يوجد بيانات</td>
                        </tr>
                        @else
                            @foreach($groups as $group)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $group->name }}</td>
                                <td>
                                    <a href="{{ route('groups.edit', $group->id) }}" class="btn p-2 m-0"><i class="fas fa-edit m-0"></i></a>
                                    <form action="{{ route('groups.destroy', $group->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm p-2 "><i class="far fa-trash-alt m-0"></i></button>
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