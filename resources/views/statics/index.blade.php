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
              <h5 class="font-weight-bold">التحليلات</h5>
             
            </div>
            {{-- {{ $dataTable->table(['class' => 'table w-100'],false) }} --}}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-end align-items-start">

  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</x-master-layout>