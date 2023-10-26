@extends('quest.layouts.app')

@viteReactRefresh
@vite(['resources/js/connect-wallet.jsx'])
@vite(['resources/js/ModalWallet.jsx'])


@section('title') {{ __("Posts List") }} @endsection

@push('after-styles')
    <style>


        .fitting-image {
            object-fit: contain;
        }
        .imgExampleColumnList {
            max-height: 160px;
            min-height: auto;
        }
    </style>
@endpush
@section('content')


<section class="bg-white text-gray-600 p-6 sm:p-20">
    <div class="flex flex-wrap -mx-4 mb-12 md:mb-20">
        @foreach ($$module_name as $$module_name_singular)
            @php
                $details_url = route("quest.$module_name.show",[encode_id($$module_name_singular->id), $$module_name_singular->slug]);
            @endphp
        <div class="w-full sm:w-full md:w-1/2 lg:w-1/4 px-4 mb-8">
            <a class="block mb-6 overflow-hidden rounded-md" href="{{$details_url}}">
                @php
                    $img_link = $$module_name_singular->featured_image;
                    if (!Str::startsWith($img_link, 'http')) {
                        $img_link = url($img_link);
                    }
                @endphp
                <img class="w-full fitting-image imgExampleColumnList " src="{{$img_link}}" alt="" data-config-id="auto-img-2-2">
            </a>

            <a class="inline-block mb-4 text-2xl md:text-3xl leading-tight text-coolGray-800 hover:text-coolGray-900 font-bold hover:underline" href="{{$details_url}}" data-config-id="auto-txt-11-2">{{$$module_name_singular->name}}</a>
            <div class="flex flex-row content-center my-4">
                <address class="flex items-center mb-6 not-italic">
                    <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                        <img class="w-5 h-5 sm:w-8 sm:h-8 rounded-full" src="https://res.cloudinary.com/dhploi5y1/image/upload/v1696240313/a49dc6a0-8564-48dd-b99d-16b008957acc_oexjni.png" alt="Jese Leos">
                        <div>
                            <a href="{{$details_url}}" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">Altlayer
                                <span class="inline-flex items-center justify-center w-6 h-6 mr-2 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full dark:bg-gray-700 dark:text-blue-400">
                                              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill="currentColor" d="m18.774 8.245-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z"/>
                                                <path fill="#fff" d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z"/>
                                              </svg>
                                             <span class="sr-only">Icon description</span>
                                            </span>
                            </a>
                        </div>
                    </div>
                </address>
            </div>

            <p class="mb-2 text-coolGray-500 font-medium" data-config-id="auto-txt-10-2">{{$$module_name_singular->intro}}</p>
            <p>
                <a href="{{route('quest.categories.show', [encode_id($$module_name_singular->category_id), $$module_name_singular->category->slug])}}" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 dark:hover:bg-blue-300">{{$$module_name_singular->category_name}}</a>
            </p>
        </div>

        @endforeach
    </div>

    <div class="d-flex justify-content-center w-100 mt-3">
        {{$$module_name->links()}}
    </div>
</section>
<!--

@if(count($$module_name))
<section class="section section-lg line-bottom-light">
    <div class="container mt-n7 mt-lg-n12 z-2">
        <div class="row">
            @php
            $$module_name_singular = $$module_name->shift();

            $details_url = route("quest.$module_name.show",[encode_id($$module_name_singular->id), $$module_name_singular->slug]);
            @endphp

            <div class="col-lg-12 mb-5">
                <div class="card bg-white border-light shadow-soft flex-md-row no-gutters p-4">
                    <a href="{{$details_url}}" class="col-md-6 col-lg-6">
                        <img src="{{$$module_name_singular->featured_image}}" alt="" class="card-img-top">
                    </a>
                    <div class="card-body d-flex flex-column justify-content-between col-auto py-4 p-lg-5">
                        <a href="{{$details_url}}">
                            <h2>{{$$module_name_singular->name}}</h2>
                        </a>
                        <p>
                            {{$$module_name_singular->intro}}
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="avatar avatar-sm rounded-circle" src="{{asset('img/avatars/'.rand(1, 8).'.jpg')}}" alt="">

                            {!!isset($$module_name_singular->created_by_alias)? $$module_name_singular->created_by_alias : '<a href="'.route('quest.users.profile', $$module_name_singular->created_by).'">
                                <h6 class="text-muted small ml-2 mb-0">'.$$module_name_singular->created_by_name.'</h6>
                            </a>'!!}

                            <h6 class="text-muted small font-weight-normal mb-0 ml-auto"><time datetime="{{$$module_name_singular->published_at}}">{{$$module_name_singular->published_at_formatted}}</time></h6>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($$module_name as $$module_name_singular)
            @php
            $details_url = route("quest.$module_name.show",[encode_id($$module_name_singular->id), $$module_name_singular->slug]);
            @endphp
            <div class="col-12 col-md-4 mb-4">
                <div class="card bg-white border-light shadow-soft p-4 rounded">
                    <a href="{{$details_url}}"><img src="{{$$module_name_singular->featured_image}}" class="card-img-top" alt=""></a>
                    <div class="card-body p-0 pt-4">
                        <a href="{{$details_url}}" class="h3">{{$$module_name_singular->name}}</a>
                        <div class="d-flex align-items-center my-4">
                            <img class="avatar avatar-sm rounded-circle" src="{{asset('img/avatars/'.rand(1, 8).'.jpg')}}" alt="">
                            {!!isset($$module_name_singular->created_by_alias)? $$module_name_singular->created_by_alias : '<a href="'.route('quest.users.profile', $$module_name_singular->created_by).'">
                                <h6 class="text-muted small ml-2 mb-0">'.$$module_name_singular->created_by_name.'</h6>
                            </a>'!!}
                        </div>
                        <p class="mb-3">{{$$module_name_singular->intro}}</p>
                        <a href="{{route('quest.categories.show', [encode_id($$module_name_singular->category_id), $$module_name_singular->category->slug])}}" class="badge bg-primary">{{$$module_name_singular->category_name}}</a>
                        <p>
                            @foreach ($$module_name_singular->tags as $tag)
                            <a href="{{route('quest.tags.show', [encode_id($tag->id), $tag->slug])}}" class="badge bg-warning text-dark">{{$tag->name}}</a>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center w-100 mt-3">
            {{$$module_name->links()}}
        </div>
    </div>
</section>
@endif -->

@endsection
