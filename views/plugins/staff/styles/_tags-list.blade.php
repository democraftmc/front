@php
    $arrayTags = [];
    if($staffs->count() >= 1){
        foreach ($staffs as $staff){
            if($staff->tags->count() >= 1){
                foreach ($staff->tags as $tag){
                    $arrayTags[] = $tag->pluck('id', 'name');
                }
            }
        }
    }
@endphp
    @foreach($arrayTags[0] as $key => $value)
        <h2 class="badge badge-lg border-0">{{$key}}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
        @foreach($staffs as $staff)
            @foreach($staff->tags as $tag)
                @if($tag->id == $value)
                    @includeIf('staff::styles.atoms._list')
                @endif
            @endforeach
        @endforeach
        </div>
    @endforeach


