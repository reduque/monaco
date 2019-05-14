<?php
$tot=$products->count() + $recipes->count();
?>
@if($tot)
    <div class="t1">{{ $tot }}</div>
    <div class="t2">Top relevant results for "{{ $q }}"</div>
    <div class="t3">
    @if ($products->count()>0)
        PRODUCTS ({{ $products->count() }})&nbsp;&nbsp;&nbsp;
    @endif
    @if ($recipes->count()>0)
        RECIPES ({{ $recipes->count() }})
    @endif
    </div>

    @if ($products->count()>0)
        <div class="bloque">
            <h4>PRODUCTS</h4>
        @foreach ($products as $product)
            <a href="{{ route('product',$product->slug_en) }}">{{ $product->name_en . ' ' . $product->size }}</a>
        @endforeach
        </div>
    @endif

    @if ($recipes->count()>0)
        <div class="bloque">
            <h4>RECIPES</h4>
        @foreach ($recipes as $recipe)
            <a href="{{ route('recipes_category',$recipe->category->slug_en) }}#rep_{{ $recipe->id }}">{{ $recipe->title_en }}</a>
        @endforeach
        </div>
    @endif

@else
    <div class="t2">No results found for "{{ $q }}"</div>
@endif