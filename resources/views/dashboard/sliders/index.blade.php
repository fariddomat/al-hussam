<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Slider</h1>
        <a href="{{ route('dashboard.sliders.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded shadow" wire:navigate>➕ @lang('site.add') Slider</a>

        <div class="overflow-x-auto mt-4">
            <x-table2
                :columns="['id', 'title', 'order_num']"
                :data="$sliders"
                routePrefix="dashboard.sliders"
                :show="true"
                :edit="true"
                :delete="true"
                :restore="true"
                class="sortable-table"
            />
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <!-- SortableJS and AJAX Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tableBody = document.querySelector('.sortable-table tbody');
            if (tableBody) {
                new Sortable(tableBody, {
                    animation: 150,
                    handle: '.drag-handle', // Optional: Add a drag handle column
                    onEnd: function (evt) {
                        // Get the new order of sliders
                        const rows = tableBody.querySelectorAll('tr');
                        const order = Array.from(rows).map(row => ({
                            id: row.dataset.id,
                            order_num: parseInt(row.querySelector('.order-num')?.textContent || row.dataset.orderNum)
                        }));

                        // Send the new order to the server
                        fetch('{{ route('dashboard.sliders.reorder') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({ order: order })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Order updated successfully!');
                            } else {
                                alert('Failed to update order.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while updating the order.');
                        });
                    }
                });
            }
        });
    </script>
</x-app-layout>
