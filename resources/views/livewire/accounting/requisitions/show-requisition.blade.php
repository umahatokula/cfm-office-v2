<div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Cost(&#8358;)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requisition->requisitionItems as $requisitionItem)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $requisitionItem->description }}</td>
                    <td class="text-end">{{ $requisitionItem->qty }}</td>
                    <td class="text-end">{{ number_format($requisitionItem->total_cost, 2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td class="text-center" colspan="2">
                        <strong>Total:</strong>
                    </td>
                    <td class="text-end" colspan="2">
                        <strong>&#8358; {{ number_format($requisition->requisitionItems->sum('total_cost'), 2) }}</strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
