@extends('layouts.dashboard')

@section('scripts')
<script type="text/javascript">
    $(function() {
        $("[data-toggle='modal']").on('click', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let url = window.location.origin + window.location.pathname + `/${id}`;

            $('#deleteModal').find('.modal-body .name').text(name);

            let form = $('#deleteModal').find('form');
            form.attr('action', url);
        });
    });
</script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <a href="{{ route('users.create') }}" class="btn btn-primary" title="Tambah data">
                        <i class="fas fa-plus"></i>
                        <span class="d-none d-sm-inline ml-2">Tambah data</span>
                    </a>
                        
                    <div class="card-tools">
                        <form autocomplete="off">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="cari" class="form-control float-right" value="{{ request('cari') ?? '' }}" placeholder="Cari..." />
            
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Nama Pengguna</th>
                                <th>Peran</th>
                                <th colspan="2">Bergabung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td style="width: 35%">{{ $user->name }}</td>
                                    <td style="width: 30%">{{ $user->username }}</td>
                                    <td style="width: 15%">
                                        @switch($user->role)
                                            @case('admin')
                                                Administrator
                                                @break
                                            @case('staff')
                                                Staff
                                                @break
                                            @default
                                                -
                                        @endswitch
                                    </td>
                                    <td style="width: 15%">{{ $user->created_at->isoFormat('D MMMM YYYY') }}</td>
                                    <td style="width: 5%">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right p-1" role="menu">
                                                <a href="{{ route('users.edit', $user->id) }}" class="dropdown-item rounded">
                                                    <i class="fas fa-edit mr-2"></i>
                                                    Edit
                                                </a>
                                                <button type="button" class="dropdown-item rounded text-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                                    <i class="fas fa-trash mr-2"></i>
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data ☹</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col flex-grow-0">
            {{ $users->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus pengguna ?</h5>
            </div>
            <div class="modal-body">
                <p>Ini akan di hapus <strong class="name"></strong></p>
                <div class="d-flex justify-content-end">
                    <form method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger ml-2">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection