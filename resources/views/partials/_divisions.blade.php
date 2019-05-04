<ul class="lines">
    @foreach ($lines as $line)
    @if($line->id==2)
        <li><a href="{{ route('brands') }}#private_label" @if($line->id == session('v_line_id')) class="activo" @endif>{{ $line->line_en }}</a></li>
    @else
        <li><a href="{{ route('change_line',$line->id) }}" @if($line->id == session('v_line_id')) class="activo" @endif>{{ $line->line_en }}</a></li>
    @endif
    @endforeach
</ul>
