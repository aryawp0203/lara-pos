@extends('layouts.master')

@section('title')
    Daftar Pembelian
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Pembelian</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <button onclick="addForm()"
                        class="btn btn-success btn-xs btn-flat">
                        <i class="fa fa-plus-circle"></i> Transaksi Baru
                    </button>

                    @empty(!session('id_pembelian'))
                        <a href="{{ route('pembelian_detail.index') }}"
                            class="btn btn-warning btn-xs btn-flat">
                            <i class="fa fa-edit"></i> Transaksi Aktif
                        </a>
                    @endempty
                </div>

                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered table-pembelian">
                        <thead>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>Total Item</th>
                            <th>Total Harga</th>
                            <th>Diskon</th>
                            <th>Total Bayar</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @includeIf('pembelian.supplier')
    @includeIf('pembelian.detail')
@endsection

@push('scripts')
    <script>
        let tablePembelian, tableDetail;

        $(function() {
            tablePembelian = $('.table-pembelian').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('pembelian.data') }}',
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'tanggal'},
                    {data: 'supplier'},
                    {data: 'total_item'},
                    {data: 'total_harga'},
                    {data: 'diskon'},
                    {data: 'bayar'},
                    {data: 'aksi', searchable: false, sortable: false}
                ]
            });

            $('.table-supplier').DataTable();

            tableDetail = $('.table-detail').DataTable({
                processing: true,
                bsort: false,
                dom: 'Brt',
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'kode_produk'},
                    {data: 'nama_produk'},
                    {data: 'harga_beli'},
                    {data: 'jumlah'},
                    {data: 'subtotal'},
                ]
            });
        });

        // Fungsi untuk membuka modal pilih supplier
        function addForm() {
            $('#modal-supplier').modal('show');
        }

        // Fungsi untuk menampilkan modal detail pembelian
        function showDetail(url) {
            $('#modal-detail').modal('show');

            tableDetail.ajax.url(url);
            tableDetail.ajax.reload();
        }

        // Fungsi untuk hapus data pembelian
        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        tablePembelian.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }
    </script>
@endpush
