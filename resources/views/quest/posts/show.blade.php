<?php
/**
 * @var App\Models\Post $$module_name_singular
 * @var App\Models\Task $task
 * @var array $categories
 */
use App\Models\Task;

?>

@extends('quest.layouts.app')

@viteReactRefresh
@vite(['resources/js/connect-wallet.jsx'])

@section('title') {{$$module_name_singular->name}} @endsection

@section('content')
    <div class="" id="content">

        <section data-section-id="1" data-share="" data-category="blog-content-white-pattern" data-component-id="5d44a180_02_awz" class="py-16 md:py-24 bg-white" style="background-image: url('https://shuffle.dev/flex-ui-assets/elements/pattern-white.svg'); background-repeat: no-repeat; background-position: center top;" data-config-id="auto-img-4">
            <div class="container px-4 mx-auto">
                <div class="md:max-w-3xl mx-auto mb-5 text-left">

                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <address class="flex items-center mb-6 not-italic">
                                <div class="inline-flex items-center mr-3 text-sm text-gray-900">
                                    <img class="mr-4 w-16 h-16 rounded-full" src="https://res.cloudinary.com/dhploi5y1/image/upload/v1696240313/a49dc6a0-8564-48dd-b99d-16b008957acc_oexjni.png" alt="Jese Leos">
                                    <div>
                                        <a href="#" rel="author" class="text-xl font-bold text-gray-900">{{$$module_name_singular->getCreatedByName()}}
                                            <span class="inline-flex items-center justify-center w-6 h-6 mr-2 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full">
                                              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill="currentColor" d="m18.774 8.245-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z"/>
                                                <path fill="#fff" d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z"/>
                                              </svg>
                                             <span class="sr-only">Icon description</span>
                                            </span>

                                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300">
                                                    <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                                    </svg>
                                                    Folow 150k+
                                                </button>
                                        </a>


                                    </div>
                                </div>
                            </address>
                        </div>
                        <div class="flex justify-end space-x-4 font-mono text-white text-sm font-bold leading-6 bg-stripes-cyan rounded-lg">
                            @foreach ($$module_name_singular->tags as $tag)
                                <span class="inline-block py-px px-2 mb-4 text-xs leading-5 text-white bg-green-500 uppercase rounded-9xl" data-config-id="auto-txt-13-1">
                                {{$tag->name}}
                                </span>
                            @endforeach
                        </div>
                    </div>


                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <h3 class="mb-4 text-3xl md:text-4xl leading-tight text-darkCoolGray-900 font-bold tracking-tighter" data-config-id="auto-txt-5-2">{{$$module_name_singular->name}}</h3>
                        </div>
                        <div class="flex justify-end space-x-4 font-mono text-white text-sm font-bold leading-6 bg-stripes-cyan rounded-lg">
                            <button type="button" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center">

                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13v-3a9 9 0 1 0-18 0v3m2-3h3v7H3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2Zm11 0h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3v-7Z"/>
                                </svg>
                                <span class="sr-only">Icon description</span>
                            </button>
                            <a href="{{$$module_name_singular->getTwitterShareUrlAttribute()}}" type="button" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path fill="currentColor" d="M12.186 8.672 18.743.947h-2.927l-5.005 5.9-4.44-5.9H0l7.434 9.876-6.986 8.23h2.927l5.434-6.4 4.82 6.4H20L12.186 8.672Zm-2.267 2.671L8.544 9.515 3.2 2.42h2.2l4.312 5.719 1.375 1.828 5.731 7.613h-2.2l-4.699-6.237Z"/>
                                </svg>

                                <span class="sr-only">Icon description</span>
                            </a>
                            <button id="btnStarQuest" data-id="{{$$module_name_singular->id}}" type="button" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m11.479 1.712 2.367 4.8a.532.532 0 0 0 .4.292l5.294.769a.534.534 0 0 1 .3.91l-3.83 3.735a.534.534 0 0 0-.154.473l.9 5.272a.535.535 0 0 1-.775.563l-4.734-2.49a.536.536 0 0 0-.5 0l-4.73 2.487a.534.534 0 0 1-.775-.563l.9-5.272a.534.534 0 0 0-.154-.473L2.158 8.48a.534.534 0 0 1 .3-.911l5.294-.77a.532.532 0 0 0 .4-.292l2.367-4.8a.534.534 0 0 1 .96.004Z"/>
                                </svg>
                                <span class="sr-only">Icon description</span>
                            </button>

                            <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50" type="button">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdownDots" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">

                                <div class="py-2">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <span><svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1v18M1 3.652v9c5.6-5.223 8.4 2.49 14-.08v-9c-5.6 2.57-8.4-5.143-14 .08Z"/>
                                        </svg></span>Report</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <p class="mb-10 text-lg md:text-xl font-medium text-coolGray-500" data-config-id="auto-txt-6-2">{{$$module_name_singular->content}}</p>

                    <div class="mb-5 flex ">
                        <div class="flex -space-x-4">
                            <img class="w-10 h-10 border-2 border-white rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="">
                            <img class="w-10 h-10 border-2 border-white rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="">
                            <img class="w-10 h-10 border-2 border-white rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="">
                            <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600" href="#">+99</a>
                        </div>
                        <div class="flex -space-x-4 justify-between">
                           <p class="inline-block text-green-500 font-medium justify-between ml-5 mt-3"> {{$$module_name_singular->getStartAtEndAtTextAttribute()}}</p>
                        </div>
                    </div>
                    <p class="inline-block text-green-500 font-medium" data-config-id="auto-txt-4-2">
                        {{$$module_name_singular->getRewardTextAttribute()}}
                    </p>

                </div>
            </div>
            <div class="container px-4 mx-auto">
                <div class="md:max-w-3xl mx-auto">

                    <div class="mb-10 pb-0 text-base md:text-lg text-coolGray-500 border-b border-coolGray-100">
                    <div id="accordion-color" data-accordion="collapse" data-active-classes="bg-blue-100 text-blue-600">
                        @foreach($tasks as $task)
                            <h2 id="accordion-color-heading-{{$task->id}}" class="mb-0 headingAction2" data-isopen="true" data-action="FOLLOW{{$task->entry_type}}" data-url="{{$task->value}}">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 {{$loop->iteration==1? 'rounded-t-xl': ''}} focus:ring-4 focus:ring-blue-200 hover:bg-blue-100" data-accordion-target="#accordion-color-body-{{$task->id}}" aria-expanded="{{$loop->iteration ==1?'false':'false'}}" aria-controls="accordion-color-body-{{$task->id}}">
                                <span class="flex items-center">
                                    @if($task->entry_type == Task::TRANSFER_TYPE_HOLDERS)
                                        <svg class="w-5 h-5 mr-2 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
    <path d="M8 5.625c4.418 0 8-1.063 8-2.375S12.418.875 8 .875 0 1.938 0 3.25s3.582 2.375 8 2.375Zm0 13.5c4.963 0 8-1.538 8-2.375v-4.019c-.052.029-.112.054-.165.082a8.08 8.08 0 0 1-.745.353c-.193.081-.394.158-.6.231l-.189.067c-2.04.628-4.165.936-6.3.911a20.601 20.601 0 0 1-6.3-.911l-.189-.067a10.719 10.719 0 0 1-.852-.34 8.08 8.08 0 0 1-.493-.244c-.053-.028-.113-.053-.165-.082v4.019C0 17.587 3.037 19.125 8 19.125Zm7.09-12.709c-.193.081-.394.158-.6.231l-.189.067a20.6 20.6 0 0 1-6.3.911 20.6 20.6 0 0 1-6.3-.911l-.189-.067a10.719 10.719 0 0 1-.852-.34 8.08 8.08 0 0 1-.493-.244C.112 6.035.052 6.01 0 5.981V10c0 .837 3.037 2.375 8 2.375s8-1.538 8-2.375V5.981c-.052.029-.112.054-.165.082a8.08 8.08 0 0 1-.745.353Z"/>
  </svg>
                                    @elseif($task->entry_type == Task::TRANSFER_TYPE_ACTIVITY )
                                        <svg class="w-5 h-5 mr-2 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 20">
    <path d="M18.972.863a.913.913 0 0 0-.041-.207.956.956 0 0 0-.107-.19 1.01 1.01 0 0 0-.065-.116c-.008-.01-.02-.013-.028-.022a1.008 1.008 0 0 0-.174-.137 1.085 1.085 0 0 0-.141-.095 1.051 1.051 0 0 0-.171-.047.985.985 0 0 0-.207-.041C18.025.007 18.014 0 18 0h-3.207a1 1 0 1 0 0 2h.5l-4.552 3.9-3.5-.874a1 1 0 0 0-.867.189l-5 4a1 1 0 0 0 1.25 1.562L7.238 7.09l3.52.88a1 1 0 0 0 .892-.211L17 3.173v1.034a1 1 0 0 0 2 0V1a.9.9 0 0 0-.028-.137ZM13.5 9a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11Zm.24 4.591a3.112 3.112 0 0 1 1.935 1.374 2.036 2.036 0 0 1 .234 1.584 2.255 2.255 0 0 1-1.374 1.469.982.982 0 0 1-1.953.09 2.943 2.943 0 0 1-1.475-.92 1 1 0 0 1 1.536-1.283.953.953 0 0 0 .507.29.778.778 0 0 0 .831-.18 1.108 1.108 0 0 0-.714-.481 3.105 3.105 0 0 1-1.934-1.374 2.042 2.042 0 0 1-.233-1.584 2.264 2.264 0 0 1 1.45-1.493v-.03a1 1 0 0 1 2 0c.517.159.98.457 1.337.862a1.002 1.002 0 1 1-1.524 1.3.962.962 0 0 0-.507-.286.775.775 0 0 0-.829.18 1.113 1.113 0 0 0 .713.482ZM6 20a1 1 0 0 1-1-1v-6a1 1 0 1 1 2 0v6a1 1 0 0 1-1 1Zm-4 0a1 1 0 0 1-1-1v-4a1 1 0 1 1 2 0v4a1 1 0 0 1-1 1Z"/>
  </svg>
                                    @elseif($task->entry_type == Task::TYPE_TELEGRAM_JOIN )
                                        <img class="w-5 h-5 mr-2 shrink-0" src="https://www.svgrepo.com/show/354443/telegram.svg" alt="">
                                    @elseif($task->entry_type == Task::TYPE_DISCORD_JOIN )
                                        <img class="w-5 h-5 mr-2 shrink-0" src="https://www.svgrepo.com/show/353655/discord-icon.svg" alt="">
                                    @elseif($task->entry_type == Task::NFT_TYPE )
                                        <img class="w-5 h-5 mr-2 shrink-0" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkP290uEH2BjU5Hrlqu2hOmj1mzege9IVzuw&usqp=CAU" alt="">
                                    @elseif($task->entry_type == Task::TASK_SOCIAL )
                                        <svg class="w-5 h-5 mr-2 shrink-0 text-red-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
    <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4c0 1.1.9 2 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.8-3.1a5.5 5.5 0 0 0-2.8-6.3c.6-.4 1.3-.6 2-.6a3.5 3.5 0 0 1 .8 6.9Zm2.2 7.1h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1l-.5.8c1.9 1 3.1 3 3.1 5.2ZM4 7.5a3.5 3.5 0 0 1 5.5-2.9A5.5 5.5 0 0 0 6.7 11 3.5 3.5 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4c0 1.1.9 2 2 2h.5a6 6 0 0 1 3-5.2l-.4-.8Z" clip-rule="evenodd"/>
  </svg>

                                    @else
                                        <img class="w-5 h-5 mr-2 shrink-0" src="https://www.svgrepo.com/show/452123/twitter.svg" alt="">
                                    @endif
                                    {{$task->getNameTextAttribute()}}</span>

                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                            </h2>
                            <div id="accordion-color-body-{{$task->id}}" class="{{$loop->iteration ==1?'hidden' : 'hidden mb-0'}} " aria-labelledby="accordion-color-heading-{{$task->id}}">
                            <div class="p-5 border border-b-0 border-gray-200">
                                <p class="mb-2 text-gray-500">
                                    {{$task->getNameTextAttribute()}}

                                    <button type="button" data-canopen="true" data-id="{{$task->id}}" class=" @if(in_array($task->id, $arrTaskUserHasPlay)) hidden @else show  @endif btnCheckStatus ml-5 text-blue-700 border border-blue-700  hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center">

                                        {{--Check task is done will show svg done--}}
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                            <path d="M17 9a1 1 0 0 0-1 1 6.994 6.994 0 0 1-11.89 5H7a1 1 0 0 0 0-2H2.236a1 1 0 0 0-.585.07c-.019.007-.037.011-.055.018-.018.007-.028.006-.04.014-.028.015-.044.042-.069.06A.984.984 0 0 0 1 14v5a1 1 0 1 0 2 0v-2.32A8.977 8.977 0 0 0 18 10a1 1 0 0 0-1-1ZM2 10a6.994 6.994 0 0 1 11.89-5H11a1 1 0 0 0 0 2h4.768a.992.992 0 0 0 .581-.07c.019-.007.037-.011.055-.018.018-.007.027-.006.04-.014.028-.015.044-.042.07-.06A.985.985 0 0 0 17 6V1a1 1 0 1 0-2 0v2.32A8.977 8.977 0 0 0 0 10a1 1 0 1 0 2 0Z"/>
                                        </svg>

                                        <span class="sr-only">Icon description</span>
                                    </button>

                                    <button type="button" data-stak2="1" data-id="{{$task->id}}"  class="@if(in_array($task->id, $arrTaskUserHasPlay)) show @else hidden @endif btnCheckStatus text-green-700 border border-blue-700  hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center">

                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10 2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>

                                        <span class="sr-only">Icon description</span>
                                    </button>

                                </p>

                                <button data-tooltip-target="tooltip-dark{{$task->id}}" data-isdone="@if(in_array($task->id, $arrTaskUserHasPlay))1 @endif" data-isopen="true" data-action="{{$task->type_value}}" data-tag_url="{{$task->getHashtagValueAttribute()}}" data-url-referal="{{$task->task_referal_url}}" data-url="{{$task->value}}" data-id="{{$task->id}}" type="button"
                                        data-text_holder="{{$task->getHolderTokenTextAttribute()}}" data-text_transaction="{{$task->getTransactionTextAttribute()}}"
                                        class="headingAction text-white bg-[#1da1f2] hover:bg-[#1da1f2]/90 focus:ring-4 focus:outline-none focus:ring-[#1da1f2]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2">
                                    @if($task->entry_type == Task::TRANSFER_TYPE_HOLDERS)
                                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                            <path d="M8 5.625c4.418 0 8-1.063 8-2.375S12.418.875 8 .875 0 1.938 0 3.25s3.582 2.375 8 2.375Zm0 13.5c4.963 0 8-1.538 8-2.375v-4.019c-.052.029-.112.054-.165.082a8.08 8.08 0 0 1-.745.353c-.193.081-.394.158-.6.231l-.189.067c-2.04.628-4.165.936-6.3.911a20.601 20.601 0 0 1-6.3-.911l-.189-.067a10.719 10.719 0 0 1-.852-.34 8.08 8.08 0 0 1-.493-.244c-.053-.028-.113-.053-.165-.082v4.019C0 17.587 3.037 19.125 8 19.125Zm7.09-12.709c-.193.081-.394.158-.6.231l-.189.067a20.6 20.6 0 0 1-6.3.911 20.6 20.6 0 0 1-6.3-.911l-.189-.067a10.719 10.719 0 0 1-.852-.34 8.08 8.08 0 0 1-.493-.244C.112 6.035.052 6.01 0 5.981V10c0 .837 3.037 2.375 8 2.375s8-1.538 8-2.375V5.981c-.052.029-.112.054-.165.082a8.08 8.08 0 0 1-.745.353Z"/>
                                        </svg>
                                    @elseif($task->entry_type == Task::TRANSFER_TYPE_ACTIVITY )
                                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 20">
                                            <path d="M18.972.863a.913.913 0 0 0-.041-.207.956.956 0 0 0-.107-.19 1.01 1.01 0 0 0-.065-.116c-.008-.01-.02-.013-.028-.022a1.008 1.008 0 0 0-.174-.137 1.085 1.085 0 0 0-.141-.095 1.051 1.051 0 0 0-.171-.047.985.985 0 0 0-.207-.041C18.025.007 18.014 0 18 0h-3.207a1 1 0 1 0 0 2h.5l-4.552 3.9-3.5-.874a1 1 0 0 0-.867.189l-5 4a1 1 0 0 0 1.25 1.562L7.238 7.09l3.52.88a1 1 0 0 0 .892-.211L17 3.173v1.034a1 1 0 0 0 2 0V1a.9.9 0 0 0-.028-.137ZM13.5 9a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11Zm.24 4.591a3.112 3.112 0 0 1 1.935 1.374 2.036 2.036 0 0 1 .234 1.584 2.255 2.255 0 0 1-1.374 1.469.982.982 0 0 1-1.953.09 2.943 2.943 0 0 1-1.475-.92 1 1 0 0 1 1.536-1.283.953.953 0 0 0 .507.29.778.778 0 0 0 .831-.18 1.108 1.108 0 0 0-.714-.481 3.105 3.105 0 0 1-1.934-1.374 2.042 2.042 0 0 1-.233-1.584 2.264 2.264 0 0 1 1.45-1.493v-.03a1 1 0 0 1 2 0c.517.159.98.457 1.337.862a1.002 1.002 0 1 1-1.524 1.3.962.962 0 0 0-.507-.286.775.775 0 0 0-.829.18 1.113 1.113 0 0 0 .713.482ZM6 20a1 1 0 0 1-1-1v-6a1 1 0 1 1 2 0v6a1 1 0 0 1-1 1Zm-4 0a1 1 0 0 1-1-1v-4a1 1 0 1 1 2 0v4a1 1 0 0 1-1 1Z"/>
                                        </svg>
                                    @elseif($task->entry_type == Task::TYPE_TELEGRAM_JOIN )
                                        <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.2434 12.4957C11.023 13.6068 11.1185 15.5552 12.4419 16.5415L17.1159 20.0253C17.9406 20.4843 18.5356 20.2466 18.7411 19.2529L21.6827 5.26855C21.9838 4.05046 21.2224 3.49779 20.4334 3.85915L3.1604 10.5784C1.98137 11.0555 1.98839 11.7192 2.94551 12.0148L6.21184 13.0433C6.95125 13.2762 7.75576 13.1703 8.40973 12.7541L17.6402 6.8792C18.1247 6.58282 18.5694 6.74202 18.2045 7.06885" fill="white"></path></svg>

                                    @elseif($task->entry_type == Task::TYPE_DISCORD_JOIN )
                                        <svg class="w-4 h-4 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 5.6c-1.4-.7-2.8-1.1-4.2-1.3l-.5 1c-1.5-.2-3-.2-4.6 0l-.5-1c-1.4.2-2.8.6-4.1 1.3a17.4 17.4 0 0 0-3 11.6 18 18 0 0 0 5 2.5c.5-.5.8-1.1 1.1-1.7l-1.7-1c.2 0 .3-.2.4-.3a11.7 11.7 0 0 0 10.2 0l.4.3-1.7.9 1 1.7c1.9-.5 3.6-1.4 5.1-2.6.4-4-.6-8.2-3-11.5ZM8.6 14.8a2 2 0 0 1-1.8-2 2 2 0 0 1 1.8-2 2 2 0 0 1 1.8 2 2 2 0 0 1-1.8 2Zm6.6 0a2 2 0 0 1-1.8-2 2 2 0 0 1 1.8-2 2 2 0 0 1 1.8 2 2 2 0 0 1-1.8 2Z"/>
                                        </svg>
                                    @elseif($task->entry_type == Task::NFT_TYPE )

                                    @elseif($task->entry_type == Task::TASK_SOCIAL )
                                        <svg class="w-4 h-4 mr-2 text-red-200 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M14.5 6.7a1 1 0 0 1 0-1.4 1 1 0 0 1 1.3 0l5.5 4.9a2 2 0 0 1 0 3l-5.5 5.1a1 1 0 0 1-1.5 0 1 1 0 0 1 .1-1.5l5.6-5v-.1l-5.5-5ZM8 16v-.4A4.1 4.1 0 0 0 5.3 18a1.7 1.7 0 0 1-2 1A1.7 1.7 0 0 1 2 17.2v-1.3c0-3.8 2.5-7 6-7.6v-.7a2 2 0 0 1 2-2.1 2 2 0 0 1 1.1.4l5.1 4.3a2.1 2.1 0 0 1 0 3.1l-5 4.3H11A2 2 0 0 1 8 16Z" clip-rule="evenodd"/>
                                        </svg>

                                    @else
                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                                        <path fill-rule="evenodd" d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z" clip-rule="evenodd"/>
                                    </svg>

                                    @endif

                                    @if($task->entry_type == Task::TRANSFER_TYPE_HOLDERS || $task->entry_type == Task::TRANSFER_TYPE_ACTIVITY)
                                        {{Str::studly(Str::lower($task->type_value))}}
                                    @elseif($task->entry_type == Task::TYPE_TELEGRAM_JOIN)
                                            Join Telegram
                                    @elseif($task->entry_type == Task::TYPE_DISCORD_JOIN)
                                            Join Discord
                                    @elseif($task->entry_type == Task::NFT_TYPE)
                                            Check NFT
                                    @elseif($task->entry_type == Task::TASK_SOCIAL)
                                            Copy link
                                    @else

                                         Twitter  {{Str::studly(Str::lower($task->type_value))}}
                                    @endif
                                </button>

                                <div id="tooltip-dark{{$task->id}}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                    Tooltip content
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    </div>


                    <div class="flex items-center justify-center">
                        <a id="btnCopyLink" class="inline-flex mr-4 items-center justify-center py-2 px-4 text-coolGray-300 hover:text-coolGray-400 bg-white hover:bg-coolGray-100 border border-coolGray-200 hover:border-coolGray-300 rounded-md shadow-md transition duration-200" href="javascript:void(0)">
                            <svg width="20" height="16" viewbox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg" data-config-id="auto-svg-1-2">
                                <path d="M15 13.8333H5C4.33696 13.8333 3.70108 13.5699 3.23224 13.1011C2.76339 12.6323 2.5 11.9964 2.5 11.3333V4.66667C2.5 4.44565 2.41221 4.23369 2.25592 4.07741C2.09964 3.92113 1.88768 3.83333 1.66667 3.83333C1.44566 3.83333 1.23369 3.92113 1.07741 4.07741C0.921133 4.23369 0.833336 4.44565 0.833336 4.66667V11.3333C0.833336 12.4384 1.27232 13.4982 2.05372 14.2796C2.44063 14.6665 2.89996 14.9734 3.40549 15.1828C3.91101 15.3922 4.45283 15.5 5 15.5H15C15.221 15.5 15.433 15.4122 15.5893 15.2559C15.7455 15.0996 15.8333 14.8877 15.8333 14.6667C15.8333 14.4457 15.7455 14.2337 15.5893 14.0774C15.433 13.9211 15.221 13.8333 15 13.8333ZM19.1667 6.28333C19.158 6.20678 19.1412 6.13136 19.1167 6.05833V5.98333C19.0766 5.89765 19.0232 5.81889 18.9583 5.75V5.75L13.9583 0.75C13.8894 0.68518 13.8107 0.631734 13.725 0.591667H13.65L13.3833 0.5H6.66667C6.00363 0.5 5.36774 0.763392 4.8989 1.23223C4.43006 1.70107 4.16667 2.33696 4.16667 3V9.66667C4.16667 10.3297 4.43006 10.9656 4.8989 11.4344C5.36774 11.9033 6.00363 12.1667 6.66667 12.1667H16.6667C17.3297 12.1667 17.9656 11.9033 18.4344 11.4344C18.9033 10.9656 19.1667 10.3297 19.1667 9.66667V6.33333C19.1667 6.33333 19.1667 6.33333 19.1667 6.28333ZM14.1667 3.34167L16.325 5.5H15C14.779 5.5 14.567 5.4122 14.4107 5.25592C14.2545 5.09964 14.1667 4.88768 14.1667 4.66667V3.34167ZM17.5 9.66667C17.5 9.88768 17.4122 10.0996 17.2559 10.2559C17.0996 10.4122 16.8877 10.5 16.6667 10.5H6.66667C6.44565 10.5 6.23369 10.4122 6.07741 10.2559C5.92113 10.0996 5.83334 9.88768 5.83334 9.66667V3C5.83334 2.77899 5.92113 2.56702 6.07741 2.41074C6.23369 2.25446 6.44565 2.16667 6.66667 2.16667H12.5V4.66667C12.5 5.32971 12.7634 5.96559 13.2322 6.43443C13.7011 6.90327 14.337 7.16667 15 7.16667H17.5V9.66667Z" fill="currentColor"></path>
                            </svg>
                            <span class="ml-2 text-sm text-coolGray-500 hover:text-coolGray-600 font-medium" data-config-id="auto-txt-27-2">Copy Link</span>
                        </a>
                        <a class="inline-flex mr-2 h-9 w-9 items-center justify-center text-coolGray-500 hover:text-coolGray-600 bg-white hover:bg-coolGray-100 border border-coolGray-200 rounded-md shadow-md transition duration-200" href="{{$$module_name_singular->getFacebookShareUrlAttribute()}}">
                            <svg width="10" height="18" viewbox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg" data-config-id="auto-svg-2-2">
                                <path d="M7.6 3.43332H9.16667V0.783318C8.40813 0.70444 7.64596 0.665497 6.88333 0.666651C4.61667 0.666651 3.06667 2.04998 3.06667 4.58332V6.76665H0.508333V9.73332H3.06667V17.3333H6.13333V9.73332H8.68333L9.06667 6.76665H6.13333V4.87498C6.13333 3.99998 6.36667 3.43332 7.6 3.43332Z" fill="currentColor"></path>
                            </svg>
                        </a>
                        <a class="inline-flex mr-2 h-9 w-9 items-center justify-center text-coolGray-500 hover:text-coolGray-600 bg-white hover:bg-coolGray-100 border border-coolGray-200 rounded-md shadow-md transition duration-200" href="{{$$module_name_singular->getTwitterShareUrlAttribute()}}">
                            <svg width="18" height="14" viewbox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg" data-config-id="auto-svg-3-2">
                                <path d="M17.3333 1.83339C16.7069 2.10513 16.0445 2.28477 15.3667 2.36672C16.0818 1.93949 16.6177 1.26737 16.875 0.475053C16.203 0.875105 15.4673 1.15697 14.7 1.30839C14.1871 0.752196 13.5041 0.381966 12.7582 0.255762C12.0122 0.129558 11.2455 0.254518 10.5782 0.611044C9.91087 0.96757 9.38078 1.5355 9.07104 2.22575C8.76129 2.916 8.68941 3.68954 8.86667 4.42505C7.50786 4.35632 6.1787 4.00251 4.96555 3.3866C3.75239 2.77069 2.68237 1.90646 1.825 0.850052C1.52428 1.37519 1.36627 1.9699 1.36667 2.57505C1.3656 3.13704 1.50352 3.69057 1.76813 4.18636C2.03275 4.68215 2.41585 5.10481 2.88333 5.41672C2.33998 5.40194 1.80824 5.25613 1.33333 4.99172V5.03339C1.33741 5.82079 1.61333 6.58263 2.11443 7.19002C2.61553 7.79742 3.31105 8.21309 4.08333 8.36672C3.78605 8.45719 3.4774 8.50489 3.16667 8.50839C2.95158 8.50587 2.73702 8.48637 2.525 8.45005C2.74493 9.1274 3.17052 9.71934 3.74256 10.1435C4.31461 10.5677 5.00465 10.803 5.71667 10.8167C4.51434 11.7628 3.0299 12.2791 1.5 12.2834C1.22145 12.2843 0.943114 12.2676 0.666668 12.2334C2.22869 13.2419 4.04901 13.7773 5.90833 13.7751C7.19141 13.7884 8.46428 13.5459 9.6526 13.0618C10.8409 12.5777 11.9209 11.8616 12.8293 10.9555C13.7378 10.0493 14.4566 8.97121 14.9438 7.78414C15.431 6.59707 15.6767 5.32483 15.6667 4.04172C15.6667 3.90005 15.6667 3.75005 15.6667 3.60005C16.3206 3.11239 16.8846 2.51457 17.3333 1.83339V1.83339Z" fill="currentColor"></path>
                            </svg>
                        </a>
                        <a class="inline-flex h-9 w-9 items-center justify-center text-coolGray-500 hover:text-coolGray-600 bg-white hover:bg-coolGray-100 border border-coolGray-200 rounded-md shadow-md transition duration-200" href="{{$$module_name_singular->getInstagramShareUrlAttribute()}}">
                            <svg width="18" height="18" viewbox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" data-config-id="auto-svg-4-2">
                                <path d="M13.45 3.54996C13.2522 3.54996 13.0589 3.60861 12.8944 3.71849C12.73 3.82837 12.6018 3.98455 12.5261 4.16728C12.4504 4.35 12.4306 4.55107 12.4692 4.74505C12.5078 4.93903 12.603 5.11721 12.7429 5.25707C12.8827 5.39692 13.0609 5.49216 13.2549 5.53074C13.4489 5.56933 13.65 5.54953 13.8327 5.47384C14.0154 5.39815 14.1716 5.26998 14.2815 5.10553C14.3913 4.94108 14.45 4.74774 14.45 4.54996C14.45 4.28474 14.3446 4.03039 14.1571 3.84285C13.9696 3.65532 13.7152 3.54996 13.45 3.54996V3.54996ZM17.2833 5.56663C17.2671 4.87521 17.1376 4.19113 16.9 3.54163C16.6881 2.9859 16.3583 2.48269 15.9333 2.06663C15.5207 1.63948 15.0163 1.31177 14.4583 1.10829C13.8105 0.863427 13.1257 0.730968 12.4333 0.716626C11.55 0.666626 11.2667 0.666626 9 0.666626C6.73333 0.666626 6.45 0.666626 5.56666 0.716626C4.87429 0.730968 4.18945 0.863427 3.54166 1.10829C2.98473 1.31383 2.48078 1.64126 2.06666 2.06663C1.63952 2.47927 1.31181 2.98366 1.10833 3.54163C0.863465 4.18941 0.731006 4.87425 0.716664 5.56663C0.666664 6.44996 0.666664 6.73329 0.666664 8.99996C0.666664 11.2666 0.666664 11.55 0.716664 12.4333C0.731006 13.1257 0.863465 13.8105 1.10833 14.4583C1.31181 15.0163 1.63952 15.5206 2.06666 15.9333C2.48078 16.3587 2.98473 16.6861 3.54166 16.8916C4.18945 17.1365 4.87429 17.269 5.56666 17.2833C6.45 17.3333 6.73333 17.3333 9 17.3333C11.2667 17.3333 11.55 17.3333 12.4333 17.2833C13.1257 17.269 13.8105 17.1365 14.4583 16.8916C15.0163 16.6881 15.5207 16.3604 15.9333 15.9333C16.3602 15.5188 16.6903 15.0151 16.9 14.4583C17.1376 13.8088 17.2671 13.1247 17.2833 12.4333C17.2833 11.55 17.3333 11.2666 17.3333 8.99996C17.3333 6.73329 17.3333 6.44996 17.2833 5.56663V5.56663ZM15.7833 12.3333C15.7773 12.8623 15.6815 13.3864 15.5 13.8833C15.3669 14.246 15.1532 14.5736 14.875 14.8416C14.6047 15.117 14.2777 15.3303 13.9167 15.4666C13.4197 15.6481 12.8956 15.7439 12.3667 15.75C11.5333 15.7916 11.225 15.8 9.03333 15.8C6.84166 15.8 6.53333 15.8 5.7 15.75C5.15074 15.7602 4.60383 15.6757 4.08333 15.5C3.73815 15.3567 3.42613 15.1439 3.16666 14.875C2.89007 14.6072 2.67903 14.2793 2.55 13.9166C2.34654 13.4126 2.2337 12.8766 2.21666 12.3333C2.21666 11.5 2.16666 11.1916 2.16666 8.99996C2.16666 6.80829 2.16666 6.49996 2.21666 5.66663C2.2204 5.12584 2.31912 4.58991 2.50833 4.08329C2.65504 3.73155 2.88022 3.41801 3.16666 3.16663C3.41984 2.8801 3.73274 2.65254 4.08333 2.49996C4.59129 2.31666 5.12666 2.22086 5.66666 2.21663C6.5 2.21663 6.80833 2.16663 9 2.16663C11.1917 2.16663 11.5 2.16663 12.3333 2.21663C12.8623 2.22269 13.3864 2.3185 13.8833 2.49996C14.262 2.6405 14.6019 2.869 14.875 3.16663C15.1481 3.42261 15.3615 3.73557 15.5 4.08329C15.6852 4.59074 15.7811 5.12644 15.7833 5.66663C15.825 6.49996 15.8333 6.80829 15.8333 8.99996C15.8333 11.1916 15.825 11.5 15.7833 12.3333ZM9 4.72496C8.15484 4.72661 7.32913 4.97873 6.62721 5.44947C5.92529 5.92022 5.37865 6.58846 5.05636 7.36975C4.73407 8.15105 4.6506 9.01035 4.81649 9.83907C4.98238 10.6678 5.39019 11.4287 5.98839 12.0258C6.58659 12.6228 7.34834 13.0291 8.17738 13.1934C9.00642 13.3577 9.86555 13.2725 10.6462 12.9487C11.4269 12.6249 12.0941 12.077 12.5634 11.3742C13.0328 10.6713 13.2833 9.84512 13.2833 8.99996C13.2844 8.43755 13.1743 7.88047 12.9594 7.36076C12.7444 6.84105 12.4288 6.36897 12.0307 5.97167C11.6326 5.57437 11.16 5.25969 10.6398 5.04573C10.1197 4.83178 9.56241 4.72276 9 4.72496V4.72496ZM9 11.775C8.45115 11.775 7.91464 11.6122 7.45829 11.3073C7.00194 11.0024 6.64627 10.569 6.43623 10.0619C6.2262 9.55484 6.17124 8.99688 6.27832 8.45858C6.38539 7.92029 6.64969 7.42583 7.03778 7.03774C7.42587 6.64965 7.92033 6.38535 8.45862 6.27828C8.99692 6.17121 9.55488 6.22616 10.0619 6.43619C10.569 6.64623 11.0024 7.00191 11.3073 7.45825C11.6122 7.9146 11.775 8.45112 11.775 8.99996C11.775 9.36438 11.7032 9.72523 11.5638 10.0619C11.4243 10.3986 11.2199 10.7045 10.9622 10.9622C10.7045 11.2199 10.3986 11.4243 10.0619 11.5637C9.72527 11.7032 9.36442 11.775 9 11.775V11.775Z" fill="currentColor"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>




    <!-- Main modal -->
    <div id="taskModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="taskModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5">
                    <svg class="w-10 h-10 text-gray-400 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                        <path d="M8 5.625c4.418 0 8-1.063 8-2.375S12.418.875 8 .875 0 1.938 0 3.25s3.582 2.375 8 2.375Zm0 13.5c4.963 0 8-1.538 8-2.375v-4.019c-.052.029-.112.054-.165.082a8.08 8.08 0 0 1-.745.353c-.193.081-.394.158-.6.231l-.189.067c-2.04.628-4.165.936-6.3.911a20.601 20.601 0 0 1-6.3-.911l-.189-.067a10.719 10.719 0 0 1-.852-.34 8.08 8.08 0 0 1-.493-.244c-.053-.028-.113-.053-.165-.082v4.019C0 17.587 3.037 19.125 8 19.125Zm7.09-12.709c-.193.081-.394.158-.6.231l-.189.067a20.6 20.6 0 0 1-6.3.911 20.6 20.6 0 0 1-6.3-.911l-.189-.067a10.719 10.719 0 0 1-.852-.34 8.08 8.08 0 0 1-.493-.244C.112 6.035.052 6.01 0 5.981V10c0 .837 3.037 2.375 8 2.375s8-1.538 8-2.375V5.981c-.052.029-.112.054-.165.082a8.08 8.08 0 0 1-.745.353Z"/>
                    </svg>
                    <h3 class="mb-1 text-xl font-bold text-gray-900" id="text-model-task">Approaching Full Capacity</h3>
                    <input type="hidden" id="task_confirm_id" value="">
                    <div role="status" id="spinnerModal" class="hidden absolute -translate-x-1/2 -translate-y-1/2 top-1/4 left-1/2">
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="mt-10"></p>
                    <!-- Modal footer -->
                    <div class="flex items-center mt-6 space-x-2 rtl:space-x-reverse">
                        <button  id="btnConfirmModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Confirm

                        </button>
                        <button data-modal-hide="taskModal" id="btnCancelModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Main modal -->
    <div id="crypto-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Connect social media
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crypto-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        Connect with one of our available wallet providers or create a new one.
                    </p>
                    <ul class="my-4 space-y-3" style="list-style: none">
                        <li>
                            <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">

                                <img class="w-4 h-4 mr-2" src="https://www.svgrepo.com/show/452123/twitter.svg" alt="">
                                <span class="flex-1 ms-3 whitespace-nowrap">Twitter</span>
                                <span class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">Popular</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('quest.users.profileEdit', ['id' => encode_id($questUser?$questUser->id: 1)])}}" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600">
                                <img class="w-4 h-4" src="https://www.svgrepo.com/show/354443/telegram.svg" alt="">
                                <span class="flex-1 ms-3 whitespace-nowrap">Telegram</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('quest.users.profileEdit', ['id' => encode_id($questUser?$questUser->id: 1)])}}" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">

                                <img class="w-4 h-4" src="https://www.svgrepo.com/show/353655/discord-icon.svg" alt="">
                                <span class="flex-1 ms-3 whitespace-nowrap">Discord</span>
                            </a>
                        </li>
                    </ul>
                    <div>
                        <a href="#" class="inline-flex items-center text-xs font-normal text-gray-500 hover:underline dark:text-gray-400">
                            <svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.529 7.988a2.502 2.502 0 0 1 5 .191A2.441 2.441 0 0 1 10 10.582V12m-.01 3.008H10M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            By connecting, you agree to our <span class="underline">Terms of Service</span> and <span class="underline">Privacy Policy</span>.
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection

@push ("after-style")

@endpush

@push ("after-scripts")
    <script type="module" src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            let IsUserConnectTelegram = '{{ $isUserConnectTelegram? 1:0 }}';
            let IsUserConnectDiscord = '{{ $isUserConnectDiscord? 1:0 }}';

            // set the modal menu element
            const $targetEl = document.getElementById('taskModal');
            //Modal crypto-modal
            const $targetEl2 = document.getElementById('crypto-modal');

            // options with default values
            const optionsModel = {
                placement: 'bottom-right',
                backdrop: 'dynamic',
                backdropClasses:
                    'bg-gray-900/50 fixed inset-0 z-40',
                closable: true,
                onHide: () => {
                    console.log('modal is hidden');
                },
                onShow: () => {
                    console.log('modal is shown');
                },
                onToggle: () => {
                    console.log('modal has been toggled');
                },
            };

            // instance options object
            const instanceOptionsModal = {
                id: 'taskModal',
                override: true
            };

            /*
             * $targetEl: required
             * options: optional
             */
            const modalTask = new Modal($targetEl, optionsModel, instanceOptionsModal);
            //crypto-modal
            const modalCrypto = new Modal($targetEl2, optionsModel, instanceOptionsModal);

            // create an array of objects with the id,
            // trigger element (eg. button), and the content element
            const accordionItems = [
                    @foreach($tasks as $task)
                {
                    id: 'accordion-color-heading-{{$task->id}}',
                    triggerEl: document.querySelector('#accordion-color-heading-{{$task->id}}'),
                    targetEl: document.querySelector('#accordion-color-body-{{$task->id}}'),
                    active: false
                },
                @endforeach
            ];

            // options with default values
            const options = {
                alwaysOpen: false,
                activeClasses: 'bg-gray-100 text-gray-900',
                inactiveClasses: 'text-gray-500',
                onOpen: (item) => {
                    console.log('accordion item has been shown');
                    console.log(item);
                    //Call-to-Action
                    //https://twitter.com/intent/follow?screen_name=OmniFDN
                    //WIndow Open popup
                    //window.open("https://twitter.com/intent/follow?screen_name=OmniFDN", "myWindow", "width=500,height=500");

                },
                onClose: (item) => {
                    console.log('accordion item has been hidden');
                    console.log(item);
                },
                onToggle: (item) => {
                    console.log('accordion item has been toggled');
                    console.log(item);
                },
            };

            /*
            * accordionItems: array of accordion item objects
            * options: optional
            */
            const accordion = new Accordion(accordionItems, options);

            //Class headingAction on click
            $('.btnCheckStatusSuccess').on('click', function () {
                //Alert Success
                alert('Task Completed');
            } );

            $('#btnConfirmModal').on('click', function () {
                //Alert Success
                //get input value. task_confirm_id
                var id = $('#task_confirm_id').val();
                //alert(id);
                //spinnerModal remover hidden class
                $('#spinnerModal').removeClass('hidden');
                //modalTask.hide();
                //$(this).addClass('animate-spin fill-blue-600');
                //Call ajax
                var url = '{{ route('quest.tasks.checkStatus') }}?task_id=' + id;
                //Ajax Post
                $.ajax({
                    url: url,
                    type: 'POST',
                    contentType:'application/json',

                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (data) {
                        console.log(data['status'])
                        //Check data status is false
                        if(data['status'] == 0){
                            //console.log(data);
                            //Remove class animate-spin fill-blue-600 to button
                            $('#spinnerModal').addClass('hidden');
                            alert(data['success']);
                            modalTask.hide();
                        }else{
                            $('#spinnerModal').addClass('hidden');
                            //Find button class btnCheckStatus has data id = id
                            var selectButton = $('.btnCheckStatus[data-id="'+id+'"]');
                            //Add class text-green-500
                            selectButton.addClass('text-green-500');
                            //Change SVG Value
                            selectButton.html('<svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"> ' +
                                '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10 2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/> ' +
                                '</svg>');

                            //console.log(data);
                            alert(data['success']);
                            modalTask.hide();
                        }
                    },
                    fail: function (data) {


                        //Remove class animate-spin fill-blue-600 to button
                        alert('Error');
                    },
                    error: function (data) {

                        //Remove class animate-spin fill-blue-600 to button

                        alert('Error check status');
                    }
                });
            } );

            $('#btnCancelModal').on('click', function () {

                //Alert Success
                modalTask.hide();

            } );

            $('.btnCheckStatus').on('click', function () {
                //Open Spinner
                var selectButton = $(this);
                //Add class animate-spin fill-blue-600 to button
                $(this).addClass('animate-spin fill-blue-600');
                //Call ajax
                var id = $(this).data('id');
                var url2 = $(this).data('url');
                var url = '{{ route('quest.tasks.checkStatus') }}?task_id=' + id;
                var type = $(this).data('type');
                //Ajax Post
                $.ajax({
                    url: url,
                    type: 'POST',
                    contentType:'application/json',

                    data: {
                        id: id,
                        type: type,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (data) {
                        console.log(data['status'])
                        //Check data status is false
                        if(data['status'] == 0){
                            //console.log(data);
                            //Remove class animate-spin fill-blue-600 to button
                            selectButton.removeClass('animate-spin fill-blue-600 text-blue-700');
                            alert(data['success']);
                        }else{
                            //console.log(data);
                            //Remove class animate-spin fill-blue-600 to button
                            selectButton.removeClass('animate-spin fill-blue-600 text-blue-700');
                            //Add class text-green-500
                            selectButton.addClass('text-green-500');
                            //Change SVG Value
                            selectButton.html('<svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"> ' +
                                '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10 2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/> ' +
                                '</svg>');
                            alert(data['success']);
                        }
                    },
                    fail: function (data) {
                        console.log(data);
                        //Remove class animate-spin fill-blue-600 to button
                        alert('Error');
                    },
                    error: function (data) {
                        console.log(data);

                        //Remove class animate-spin fill-blue-600 to button
                        selectButton.removeClass('animate-spin fill-blue-600 text-blue-700');
                        alert('Error check status');
                    }
                });


            });

            $('.headingAction').on('click', function () {
                //isopen
                var isOpen = $(this).data('isopen');
                //Get tag text-model-task text
                var textModelTask = document.getElementById('text-model-task');
                if(isOpen){
                    var dataUrl = $(this).data('url');
                    var dataTagUrl = $(this).data('tag_url');
                    var dataAction = $(this).data('action');
                    //console.log($(this).data('action'));
                    if ( dataAction == 'FOLLOW') {
                        window.open(dataUrl, "myWindow", "width=1000,height=1000");
                    }
                    //HASHTAG
                    if ( dataAction == 'HASHTAG') {
                        window.open(dataTagUrl, "myWindow", "width=1000,height=1000");
                    }

                    //LIKE
                    if (dataAction == 'LIKE') {
                        window.open(dataUrl, "myWindow", "width=1000,height=1000");
                    }
                    //RETWEET
                    if (dataAction == 'RETWEET') {
                        window.open(dataUrl, "myWindow", "width=1000,height=1000");
                    }

                    //TOKEN_HOLDER
                    if (dataAction == 'TOKEN_HOLDER') {
                        // show the modal
                        ///Get text
                        var text = $(this).data('text_holder');
                        //get data id
                        var id = $(this).data('id');
                        //set task_confirm_id id
                        $('#task_confirm_id').val(id);
                        //Set text
                        textModelTask.innerHTML = text;
                        modalTask.show();
                    }

                    //TRANSACTION_ACTIVITY
                    if (dataAction == 'TRANSACTION_ACTIVITY') {
                        //Get text
                        //text_transaction
                        var text = $(this).data('text_transaction');

                        //Set text
                        textModelTask.innerHTML = text;
                        //get data id
                        var id = $(this).data('id');
                        //set task_confirm_id id
                        $('#task_confirm_id').val(id);
                        modalTask.show();
                    }

                    //Telegram
                    if (dataAction == 'TELEGRAM_JOIN') {
                        //Check user has added to telegram
                        if(IsUserConnectTelegram == 1) {
                            //Redirect to telegram
                            window.open(dataUrl, "myWindow", "width=1000,height=1000");
                        }else {
                            //Show modal
                            modalCrypto.show();
                        }
                    }

                    //Discord
                    if (dataAction == 'DISCORD_JOIN') {
                        if(IsUserConnectDiscord == 1) {
                            //Redirect to discord
                            window.open(dataUrl, "myWindow", "width=1000,height=1000");
                        }
                        else {
                            //Show modal
                            modalCrypto.show();
                        }
                    }
                    //Referal
                    if (dataAction == 'REFERRAL') {
                        //Copy Link to clipboard then alert
                        var copyText = $(this).data('url-referal');
                        navigator.clipboard.writeText(copyText+"?share=refernal&userid={{ Auth::guard('quest')->user()->id ?? null }}").then(function() {
                            alert('Link copied');
                        }, function(err) {
                            alert('Error');
                        });
                    }
                }


            });

            //https://github.com/twitterdev/Twitter-API-v2-sample-code/blob/main/Follows-Lookup/following_lookup.js


            //btnCopyLink
            $('#btnCopyLink').on('click', function () {
                //Copy Link
                var copyText = "{{$$module_name_singular->getTwitterShareUrlAttribute()}}";
                navigator.clipboard.writeText(copyText).then(function() {
                    alert('Copied');
                }, function(err) {
                    alert('Error');
                });
            });

            //btnStarQuest Call Ajax Save Quest
            $('#btnStarQuest').on('click', function () {
                //Copy Link
                var idQuest = $(this).data('id');
                var url = '{{ route('quest.posts.starQuest') }}?quest_id=' + idQuest;
                //Ajax Post
                $.ajax({
                    url: url,
                    type: 'POST',
                    contentType:'application/json',
                    data: {
                        id: idQuest,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (data) {
                        console.log(data);
                        //Check data status is false
                        if(data['status'] == 0){
                            //console.log(data);
                            alert(data['success']);
                        }else{
                            //console.log(data);
                            alert(data['success']);
                        }
                    },
                    fail: function (data) {
                        console.log(data);
                        alert('Error');
                    },
                    error: function (data) {
                        console.log(data);
                        alert('Error');
                    }
                });
            });
        });
    </script>

    <!-- Javascript code -->
    {{--https://www.kindacode.com/article/tailwind-css-creating-a-read-more-read-less-button/--}}
    <script>
        function toggleText() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var button = document.getElementById("button");

            if (dots.classList.contains("hidden")) {
                // Show the dots
                dots.classList.remove("hidden");

                // Hide the more text
                moreText.classList.add("hidden");

                // change text of the button
                button.innerHTML = "Read more";
            } else {
                // Hide the dots
                dots.classList.add("hidden");

                // hide the more text
                moreText.classList.remove("hidden");

                // change text of the button
                button.innerHTML = "Read less";
            }
        }
    </script>
@endpush
