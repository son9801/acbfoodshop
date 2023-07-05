<div>
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá sản phẩm</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyUser">
                    <div class="modal-body">
                        <h6>Xác nhận xoá người dùng này? </h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="Submit" data-bs-dismiss="modal" class="btn btn-primary">Đồng ý xoá</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif


            <div class="card">
                <div class="card-header">
                    <h4>Người dùng
                        <a href="{{ url('admin/users/create') }}" class="btn btn-primary btn-sm float-end text-white">Thêm người dùng</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form wire:submit.prevent="filter" class="mb-3 form-group float-start">
                                <label>Vai trò</label>
                                <select name="status" class="form-select" wire:model="role">
                                    <option value="">Tất cả</option>
                                    <option value="user">User</option> 
                                    <option value="admin">Admin</option> 
                                </select>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="float-end w-50">
                                <div class="form-group">
                                    <label for="">Tìm kiếm theo email</label>
                                    <input type="search" type="text" class="form-control w-100" wire:model="searchTerm"
                                        placeholder="Nhập tên email muốn tìm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($users as $user)
                                  <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role_as == '0')
                                            <label class="badge btn-primary">User</label>
                                        @elseif ($user->role_as == '1')
                                            <label class="badge btn-warning">Admin</label>
                                        @else
                                            <label class="badge btn-primary">None</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/users/' . $user->id . '/edit') }}"
                                            class="btn btn-success">Sửa</a>
                                        <a href="#" wire:click="deleteUser({{ $user->id }})"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            class="btn btn-danger">Xoá</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Không có người dùng </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $users->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
