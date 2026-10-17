<x-vendor.layout>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <x-vendor.sidebar />



            <!-- Main Content -->
            <div class="col-lg-10 col-md-9 p-4">


                <!-- Stats Section -->
                <x-vendor.stat :store="$store" />
                


                <!-- Orders Table -->

            </div>
        </div>
    </div>

</x-vendor.layout>
