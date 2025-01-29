<div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
    @foreach($staffs as $staff)
        @includeIf('staff::styles.atoms._list')
    @endforeach
</div>
