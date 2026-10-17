<x-admin.layout title="Admin Users">
    <x-admin.cards-admin />

    <div class="card p-3">
        <h5 class="mb-3">Recent Users</h5>

        <div class="row text-center">
            @forelse (['Admin', 'Vendor', 'Customer'] as $role)
                <div class="col-md-2 col-6 mb-3">
                    <a href="{{ route('admin.filterUsersByRole', $role) }}" class="btn  {{ request()->routeIs('admin.filterUsersByRole') && request()->route('role') == $role ? 'btn-dark active' : 'btn-outline-dark' }} w-100">
                        {{ $role }}
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">No roles found.</p>
                </div>
            @endforelse
        </div>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th class="d-none d-md-table-cell">Email</th>
                        <th>Role</th>
                        <th class="d-none d-md-table-cell">Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    

                    @forelse ($users as $user)
                        @if (Auth::id() != $user->id)
                            <tr>
                                <td> {{ $users->firstItem() + $loop->index }}</td>
                                <td>{{ $user->name }}</td>

                                <!-- Hide on small screens -->
                                <td class="d-none d-md-table-cell">
                                    {{ $user->email }}
                                </td>

                                <td>
                                    <form action="{{ route('admin.updateUserRole', $user->id) }}" method="POST">
                                        @csrf
                                        <select class="form-select form-select-sm w-auto" name="role"
                                            onchange="this.form.submit()">
                                            <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>
                                                Customer
                                            </option>
                                            <option value="vendor" {{ $user->role === 'vendor' ? 'selected' : '' }}>
                                                Vendor
                                            </option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                                Admin
                                            </option>
                                        </select>
                                    </form>
                                </td>

                                <!-- Hide on small screens -->
                                <td class="d-none d-md-table-cell">
                                    {{ $user->phone }}
                                </td>

                                <td>
                                    <div class="d-flex flex-column flex-md-row gap-2">
                                        <a href="#" class="btn btn-sm btn-primary">
                                            View
                                        </a>

                                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>

    </div>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('admin.deletedUsers') }}" class="btn btn-outline-warning">View Deleted Users</a>


</x-admin.layout>
