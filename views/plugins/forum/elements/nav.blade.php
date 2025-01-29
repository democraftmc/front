      <div
        class="breadcrumbs inline-flex justify-center md:justify-start md:w-3/4 md:pl-1">
        <ul>
          <li>
            <a href="{{ route('home') }}"><i class="fa-solid fa-house mr-2"></i> {{ trans('messages.home') }}</a>
          </li>
          <li>
            <a href="{{ route('forum.home') }}"><i class="fa-solid fa-message mr-2"></i> {{ trans('forum::messages.title') }}</a>
          </li>
          @foreach(($current ?? null)?->getNavigationStack() ?? [] as $breadcrumbLink => $breadcrumbName)
          <li><a href="{{ $breadcrumbLink }}">{{ $breadcrumbName }}</a></li>
          @endforeach
        </ul>
      </div>