<x-admin.layout>
    <div class="container-fluid">

    <main class="col-12 px-2 px-md-4">
        <h1 class="h2 mt-4">Stores Requests</h1>
        <p class="text-muted">
            Here you can manage all the store requests from users.
        </p>
    </main>

    <div class="card p-2 p-md-3 shadow-sm">
        <h5 class="mb-3">Recent Users</h5>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Store</th>
                        <th class="d-none d-lg-table-cell">Slug</th>
                        <th class="d-none d-lg-table-cell">Email</th>
                        <th class="d-none d-xl-table-cell">Phone</th>
                        <th class="d-none d-xl-table-cell">Address</th>
                        <th>Logo</th>
                        <th class="d-none d-lg-table-cell">Description</th>
                        <th class="d-none d-lg-table-cell">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @php $counter = 1; @endphp

                    @forelse ($stores as $store)
                        <tr>
                            <td>{{ $counter++ }}</td>

                            <!-- Store Name + Email stacked on mobile -->
                            <td>
                                <div class="fw-semibold">{{ $store->store_name }}</div>
                                <div class="small text-muted d-lg-none">
                                    {{ $store->business_email }}
                                </div>
                            </td>

                            <td class="d-none d-lg-table-cell">
                                {{ $store->store_slug }}
                            </td>

                            <td class="d-none d-lg-table-cell">
                                {{ $store->business_email }}
                            </td>

                            <td class="d-none d-xl-table-cell">
                                {{ $store->phone_number }}
                            </td>

                            <td class="d-none d-xl-table-cell">
                                {{ $store->address }}
                            </td>

                            <td>
                                <img src="/assets/images/stores/{{ $store->store_logo }}"
                                     class="img-fluid rounded"
                                     style="max-width: 40px; height: auto;">
                            </td>

                            <td class="d-none d-lg-table-cell">
                                <small>{{ Str::limit($store->store_description, 50) }}</small>
                            </td>

                            <td class="d-none d-lg-table-cell text-secondary">
                                <small>{{ $store->in_progress }}</small>
                            </td>
                            

                            <td class="d-flex flex-column gap-1">
                                <form action="{{ route('admin.stores.approve', $store->id) }}" method="POST"
                                      onsubmit="return confirm('Approve this store?');">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-success btn-sm w-100 w-md-auto {{ $store->in_progress === 'Approved' ? 'disabled' : '' }}">
                                        {{ $store->in_progress === 'Approved' ? 'Approved' : 'Approve' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.stores.decline', $store->id) }}" method="POST"
                                      onsubmit="return confirm('Decline this store?');">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-danger btn-sm w-100 w-md-auto {{ $store->in_progress === 'Declined' ? 'disabled' : '' }}">
                                        {{ $store->in_progress === 'Declined' ? 'Declined' : 'Decline' }}
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                No stores found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $stores->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>
</x-admin.layout>
