@if ( !empty($records) )
    @foreach ( $categories as $category )
        <div>
            <table>
                <tr>
                    <td>
                        <p><b>Categoría:</b></p>
                    </td>
                    <td align="center">
                        {{ $category->name }}
                    </td>
                </tr>
            </table>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Barcode</th>
                    <th>SKU</th>
                    <th>Nombre</th>
                    <th>Stock</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    @if ($record->category_id == $category->id)
                        <tr>
                            <td>{{ "'" . $record->barcode . "'" }}</td>
                            <td>{{ $record->sku }}</td>
                            <td>{{ $record->title }}</td>
                            <td>{{ $record->stock }}</td>
                            <td>{{ $record->sale_price }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endforeach
@else
    <div>
        <p>No se encontraron registros.</p>
    </div>
@endif
