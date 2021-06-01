<?php $page = TCG\Voyager\Models\Page::first(); ?>

@can('browse' , $page)

    You Can browse pages
@endcan

