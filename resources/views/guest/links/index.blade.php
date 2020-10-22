@extends('layouts.guest')

@section('content')

    <header class="d-flex align-items-center">
        <h3 class="mb-0">
            @lang('link.links')
        </h3>
        <div class="dropdown ml-auto">
            @include('models.links.partials.index-order-dropdown', ['baseRoute' => 'guest.links.index'])
        </div>
    </header>

    <section class="my-4">
        @if($links->isNotEmpty())

            <div class="link-wrapper">
                @if((int)systemsettings('guest_link_display_mode') === Link::DISPLAY_CARDS)
                    @include('guest.links.partials.list-cards')
                @elseif((int)systemsettings('guest_link_display_mode') === Link::DISPLAY_LIST_SIMPLE)
                    @include('guest.links.partials.list-simple')
                @else
                    @include('guest.links.partials.list-detailed')
                @endif
            </div>

        @else

            <div class="alert alert-info">
                @lang('linkace.no_results_found', ['model' => trans('link.links')])
            </div>

        @endif
    </section>

    @if($links->isNotEmpty())
        {!! $links->onEachSide(1)->appends(['orderBy' => $orderBy, 'orderDir' => $orderDir])->links() !!}
    @endif

@endsection
