<x-admin.layout title="Deleted Users">
    <x-admin.cards-admin />

    <div class="card p-3">
        <h5 class="mb-3">Deleted Users</h5>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th class="d-none d-md-table-cell">Email</th>
                        <th>Role</th>
                        <th class="d-none d-md-table-cell">Phone</th>
                        <th>Deleted At</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @php $counter = 1; @endphp

                    @forelse ($users as $user)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $user->name }}</td>

                                <!-- Hide on small screens -->
                                <td class="d-none d-md-table-cell">
                                    {{ $user->email }}
                                </td>

                                <td>
                                   {{ $user->role }}
                                </td>

                                <!-- Hide on small screens -->
                                <td class="d-none d-md-table-cell">
                                    {{ $user->phone }}
                                </td>
                                <td>{{ $user->formatted_date }}</td>
                                <td>
                                    <div class="d-flex flex-column flex-md-row gap-2">
                                       

                                        <form action="{{ route('admin.restoreUser', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to restore this user?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-secondary">
                                                Restore
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                      
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                No Deleted users found.
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

   </x-admin.layout>