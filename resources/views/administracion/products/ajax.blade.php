@foreach($products as $product)
@if (!$product->relacionado)
<tr>
    <td>
        <a href="{{ route('related_marcar',['id'=>codifica($product->id),'accion'=>1]) }}"><i class="fa fa-square"></i></a>
    </td>
    <td>{{ $product->name_en . ' ' . $product->size }}</td>
    <td>{{ $product->category->category_en }}</td>
    <td>@if($product->subcategory) {{ $product->subcategory->subcategory_en }} @endif</td>
    <td>@if($product->line) {{ $product->line->line_en }} @endif</td>
</tr>
@endif
@endforeach
