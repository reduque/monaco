@extends('layouts.front')

@section('title','Divisions')


@section('content')
<section class="divisions">
    <article class="d1">
        <div class="floati"></div>
        <div class="floatd">
            <div class="textos">
                <h2>Food Service</h2>
                <p>At Monaco Foods, we cater to the Food Service Industry offering a vast variety of quality foods to meet our clients needs. Our product portfolio comes in different size packaging that adapt to your customers’ requirements and end users’ needs.</p>
                @php
                    $line=$lines[2];
                @endphp
                <div class="enlaces">
                @if($line->products->count()>0)
                    <a href="{{ route('change_line',$line->id) }}">SEE MORE</a>  |  
                @endif
                    <a href="{{ route('reach_us') }}">ASK US</a>
                </div>
            </div>
        </div>
    </article>
    <article class="d2">
        <div class="floati">
            <div class="textos">
                <h2>Retail</h2>
                <p>Monaco Foods products can be found in market shelves around the American continent, with a large portfolio of Premium Quality foods from different cultural backgrounds to satisfy our customers’ preferences.</p>
                @php
                    $line=$lines[0];
                @endphp
                <div class="enlaces">
                @if($line->products->count()>0)
                    <a href="{{ route('change_line',$line->id) }}">SEE MORE</a>  |  
                @endif
                    <a href="{{ route('reach_us') }}">ASK US</a>
                </div>
            </div>
        </div>
        <div class="floatd"></div>
    </article>
    <article class="d3">
        <div class="floati"></div>
        <div class="floatd">
            <div class="textos">
                <h2>Private Label</h2>
                <p>If you are interested in developing your private label, Monaco Foods can assess your company in finding and producing the right food products that best suit your company’s needs.</p>
                @php
                    $line=$lines[1];
                @endphp
                <div class="enlaces">
                    <a href="{{ route('brands') }}#private_label">SEE MORE</a>  |  
                    <a href="{{ route('reach_us') }}">ASK US</a>
                </div>
            </div>
        </div>
    </article>
    <article class="d4">
        <div class="floati">
            <div class="textos">
                <h2>Industrial</h2>
                <p>Monaco Foods serves the industrial market with food ingredients for their production needs. Contact us to help us understand how we can serve your company’s needs.</p>
                @php
                    $line=$lines[3];
                @endphp
                <div class="enlaces">
                @if($line->products->count()>0)
                    <a href="{{ route('change_line',$line->id) }}">SEE MORE</a>  |  
                @endif
                    <a href="{{ route('reach_us') }}">ASK US</a>
                </div>
            </div>
        </div>
        <div class="floatd"></div>
    </article>
        
</section>

@endsection
