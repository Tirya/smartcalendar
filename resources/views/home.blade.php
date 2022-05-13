@extends('layouts.app')

@section("content")

<div class="load">
    <x-Loading></x-Loading>
</div>
<div>
    <div class="flex w-full">

        <div class="w-3/4 m-8 overflow-y-auto">
            <div id="calendar"></div>
        </div>
        <div class="flex flex-col w-1/4 border-r">
            <h2 class="text-3xl font-semibold text-center mb-5">{{__('contact')}}</h2>
            <div>
                <div>
                    <div>
                        <div class="input-group relative flex flex-wrap items-stretch w-full">
                            <input type="search" class="mx-1 form-control relative flex-auto block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="{{__('search')}}" aria-label="Search" aria-describedby="button-addon2">
                            <button class="btn mx-1 px-6 py-2.5 bg-gray-700 text-white flex-none font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-800 hover:shadow-lg focus:bg-gray-800  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center" type="button" id="button-addon2">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                                </svg>
                            </button>
                            <button onclick="showAddContactModal()" class="btn mx-1 px-6 py-2.5 bg-gray-700 text-white flex-none font-medium text-xs  leading-tight uppercase rounded shadow-md hover:bg-gray-800 hover:shadow-lg focus:bg-gray-900  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center" type="button" id="button-addon2">
                                <svg width="16" height="16" viewBox="0 0 32 32" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.38403 15.5V12.558L6.31132 12.5343V9.28388L3.29245 9.28181V12.5032L0 12.529V15.5H3.29245V18.6625H6.31132V15.5H9.38403Z" />
                                    <path d="M25.2672 18.1129H14.2084C10.496 18.1129 7.47559 21.1333 7.47559 24.8458V28.7353H32.0001V24.8458C32.0001 21.1334 28.9797 18.1129 25.2672 18.1129ZM29 26H20H10.5V25C10.5 22 12 21 14 21H25.0588C27.5 21 29 22.5 29 24.8459V26Z" />
                                    <path d="M19.7377 17.4212C23.6406 17.4212 26.8159 14.2459 26.8159 10.3429C26.8159 6.44 23.6406 3.26465 19.7377 3.26465C15.8348 3.26465 12.6594 6.4399 12.6594 10.3429C12.6594 14.246 15.8348 17.4212 19.7377 17.4212ZM19.7377 6C22 6 23.7868 7.74449 23.7868 10.3429C23.7868 12.5 22.1075 14.5 19.7377 14.5C17.3679 14.5 15.3569 12.6311 15.3569 10.3429C15.3569 8.05473 17 6 19.7377 6Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="flex flex-col justify-between mt-6">
                    <aside>
                        <ul>
                            @forelse (Auth::user()->contacts() as $user)
                            <li>
                                <div class="flex items-center px-4 py-2 mt-2 text-gray-600 rounded-md hover:bg-gray-200" id="user-{{ $user->id }}" onclick="unshowUser({{ $user->id }})">
                                    <input type="hidden" id="user-checked-{{ $user->id }}" value="true">
                                    <svg width="22" height="22" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="1.25" y="1.25" width="17.5" height="17.5" rx="2.75" stroke="#2D2438" stroke-width="1.5" />
                                        <path id="user-checkbox-show-{{ $user->id }}" d="M3.55939 3.55247C3.81128 3.35094 4.17367 3.36793 4.40561 3.59213L10 9L15.4406 3.55941C15.7389 3.26113 16.2303 3.28868 16.4934 3.61844C16.7178 3.89981 16.6951 4.3049 16.4406 4.55941L11 10L16.4036 15.3807C16.6844 15.6604 16.6849 16.115 16.4046 16.3953C16.1248 16.6752 15.671 16.6752 15.3911 16.3953L9.99581 11L4.55065 16.4452C4.30059 16.6952 3.89517 16.6952 3.64511 16.4452C3.39805 16.1981 3.39466 15.7986 3.63751 15.5474L9 10L3.50656 4.50656C3.23633 4.23633 3.26098 3.79121 3.55939 3.55247Z" fill="#2D2438" />
                                    </svg>

                                    <span id="user-text-{{ $user->id }}" class="mx-4 font-medium">
                                        {{ $user->name }} {{ $user->lastname }}
                                    </span>
                                </div>
                            </li>
                            @empty
                            <p>__('</p>
                            @endforelse
                        </ul>
                    </aside>

                </div>
            </div>
        </div>
    </div>
    @endsection
    @section("popup")
    <div id="new-event-modal" tabindex="-1" class="{{old('modalName') == 'new-event-modal' ? '' : 'hidden'}} overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex">
        <div id="new-event-modal-opacity" class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow">
                <div class="p-4 rounded-t border-b">
                    <h3 class="text-xl text-center text-gray-900 font-bold">{{__('new_event')}}</h3>
                </div>
                <div class="p-6 space-y-6">
                    <form action="{{route('events.store')}}" method="POST">
                        @csrf
                        <input type="hidden" id="modalName" name="modalName" value="new-event-modal">
                        <input type="hidden" id="timezone" name="timezone">
                        <div class="grid gap-6 mb-6 lg:grid-cols-2">
                            <div>
                                <label for="startDate" class="@error('startDate') text-red-700 @enderror block mb-1 text-sm font-medium text-gray-900">{{__('start_date')}}</label>
                                <input type="datetime-local" name="startDate" id="startDate" value="{{old('startDate')}}" class="@error('title') bg-red-50 border border-red-500 text-red-900 @enderror form-control bg-gray-50 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" required>
                                @error('startDate')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{__('start_date-error')}}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="endDate" class="@error('endDate') text-red-700 @enderror block mb-1 text-sm font-medium text-gray-900">{{__('end_date')}}</label>
                                <input type="datetime-local" name="endDate" id="endDate" value="{{old('endDate')}}" class="@error('title') bg-red-50 border border-red-500 text-red-900 @enderror form-control bg-gray-50 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" required>
                                @error('endDate')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{__('end_date-error')}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-6">
                            <input type="checkbox" name="fullDay" id="fullDay" class="form-check-input" {{ old('fullDay') ? 'checked' : '' }}>
                            <label for="fullDay" class="form-check-label">{{__('full_day')}}</label>
                        </div>
                        <div class="mb-6">
                            <input type="text" name="title" id="title" placeholder="{{__('title')}}" value="{{old('title')}}" class="@error('title') bg-red-50 border border-red-500 text-red-900 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            @error('title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{__('title-error')}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <textarea name="description" id="description" placeholder="{{__('description')}}" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{old('description')}}</textarea>
                        </div>
                        <div class="flex justify-between mt-10">
                            <div class="items-center text-sm font-medium text-center text-black rounded-lg focus:ring-4" onclick="closeNewModal()">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg%22%3E">
                                    <path d=" M10.2626 16L24.4516 1.81105C24.807 1.45562 24.5435 0.621994 24.1881 0.266569C23.8327 -0.0888563 23.2627 -0.0888563 22.9072 0.266569L7.81173 15.3621C7.45631 15.7175 7.45631 16.2875 7.81173 16.643L22.9072 31.7318C23.0816 31.9061 23.3163 32 23.5443 32C23.7723 32 24.0071 31.9128 24.1814 31.7318C24.5368 31.3763 24.7996 30.5435 24.4442 30.1881L10.2626 16Z"></path>
                                </svg>
                            </div>
                            <button type="submit" class="items-center text-sm font-medium text-center text-black rounded-lg focus:ring-4">
                                <x-ok-button></x-ok-button>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="show-event-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex">
        <div id="show-event-modal-opacity" class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <input type="hidden" id="eventId" name="eventId">
            <div class="relative bg-white rounded-lg shadow">
                <div class="p-4 rounded-t border-b">
                    <h3 class="text-xl text-center text-gray-900 font-bold" id="event-show-title"></h3>
                </div>
                <div class="p-6">
                    <p id="event-show-date" class="font-light mb-5"></p>
                    <p id="event-show-description" class="font-normal mb-8"></p>
                    <div class="flex justify-between">
                        <div class="items-center text-sm font-medium text-center text-black rounded-lg focus:ring-4" onclick="closeShowModal()">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg%22%3E">
                                <path d=" M10.2626 16L24.4516 1.81105C24.807 1.45562 24.5435 0.621994 24.1881 0.266569C23.8327 -0.0888563 23.2627 -0.0888563 22.9072 0.266569L7.81173 15.3621C7.45631 15.7175 7.45631 16.2875 7.81173 16.643L22.9072 31.7318C23.0816 31.9061 23.3163 32 23.5443 32C23.7723 32 24.0071 31.9128 24.1814 31.7318C24.5368 31.3763 24.7996 30.5435 24.4442 30.1881L10.2626 16Z"></path>
                            </svg>
                        </div>
                        <div class="flex justify-between space-x-5">
                            <div class="items-center text-sm font-medium text-center text-black rounded-lg focus:ring-4" onclick="editEvent()">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 59.985 59.985" style="enable-background:new 0 0 59.985 59.985;" xml:space="preserve">
                                    <path d="M59.985,7c0-1.87-0.728-3.627-2.05-4.949S54.855,0,52.985,0s-3.627,0.729-4.95,2.051l-1.414,1.414l-4.243,4.242l0,0L4.536,45.551c-0.11,0.109-0.192,0.243-0.242,0.391L0.051,58.669c-0.12,0.359-0.026,0.756,0.242,1.023c0.19,0.19,0.446,0.293,0.707,0.293c0.106,0,0.212-0.017,0.316-0.052l12.728-4.243c0.147-0.049,0.281-0.132,0.391-0.241l37.843-37.843l0,0l4.242-4.242l0,0l1.415-1.415C59.257,10.627,59.985,8.87,59.985,7z M52.278,14.778l-7.071-7.071l1.414-1.414 l7.071,7.071L52.278,14.778z M5.68,48.109l6.197,6.196l-9.296,3.099L5.68,48.109z M13.728,53.328l-7.071-7.07L43.793,9.121l7.071,7.071L13.728,53.328z M55.106,11.95l-7.071-7.071l1.414-1.414C50.394,2.521,51.65,2,52.985,2s2.591,0.521,3.536,1.465s1.464,2.2,1.464,3.535s-0.52,2.591-1.464,3.535L55.106,11.95z" />
                                </svg>
                            </div>
                            <div class="items-center text-sm font-medium text-center text-black rounded-lg focus:ring-4" onclick="destroyEvent()">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M26.6664 3.98301H20.4004C20.1792 1.75005 18.2903 0 16 0C13.7098 0 11.8209 1.75005 11.5997 3.98301H5.33373C3.45365 3.98301 1.92407 5.51258 1.92407 7.39266C1.92407 9.216 3.36271 10.7095 5.16448 10.7981V27.8822C5.16448 30.1528 7.01169 32 9.28226 32H22.7179C24.9885 32 26.8357 30.1528 26.8357 27.8822V10.7981C28.6375 10.7096 30.0761 9.21607 30.0761 7.39273C30.0761 5.51258 28.5465 3.98301 26.6664 3.98301ZM16 2.09378C17.1337 2.09378 18.0803 2.90848 18.2864 3.98301H13.7136C13.9197 2.90848 14.8663 2.09378 16 2.09378ZM24.7419 27.8823C24.7419 28.9984 23.8339 29.9063 22.7179 29.9063H9.28219C8.16613 29.9063 7.2582 28.9984 7.2582 27.8823V10.8024C8.11274 10.8024 24.0735 10.8024 24.7419 10.8024V27.8823ZM26.6664 8.70861C26.4482 8.70861 5.51931 8.70861 5.33373 8.70861C4.60816 8.70861 4.01786 8.1183 4.01786 7.39273C4.01786 6.66717 4.60816 6.07686 5.33373 6.07686H26.6664C27.392 6.07686 27.9823 6.66717 27.9823 7.39273C27.9823 8.1183 27.392 8.70861 26.6664 8.70861Z" fill="#2D2438" />
                                    <path d="M16 27.3813C16.5782 27.3813 17.0469 26.9126 17.0469 26.3344V14.2111C17.0469 13.6329 16.5783 13.1642 16 13.1642C15.4219 13.1642 14.9531 13.6329 14.9531 14.2111V26.3344C14.9531 26.9126 15.4219 27.3813 16 27.3813Z" fill="#2D2438" />
                                    <path d="M21.4036 27.3813C21.9817 27.3813 22.4504 26.9126 22.4504 26.3344V14.2111C22.4504 13.6329 21.9817 13.1642 21.4036 13.1642C20.8254 13.1642 20.3567 13.6329 20.3567 14.2111V26.3344C20.3567 26.9126 20.8254 27.3813 21.4036 27.3813Z" fill="#2D2438" />
                                    <path d="M10.5967 27.3813C11.1749 27.3813 11.6436 26.9126 11.6436 26.3344V14.2111C11.6436 13.6329 11.1749 13.1642 10.5967 13.1642C10.0185 13.1642 9.5498 13.6329 9.5498 14.2111V26.3344C9.5498 26.9126 10.0185 27.3813 10.5967 27.3813Z" fill="#2D2438" />
                                </svg>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="update-event-modal" tabindex="-1" class="{{old('modalName') == 'update-event-modal' ? '' : 'hidden'}} overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex">
        <div id="update-event-modal-opacity" class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50" onclick="closeUpdateModal()"></div>
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow">
                <div class="p-4 rounded-t border-b">
                    <h3 id="update-event-show-title" class="text-xl text-center text-gray-900 font-bold"></h3>
                </div>
                <div class="p-4 flex flex-col space-y-6">
                    <form id="update-event-form" action="{{route('events.update', old('modalName') == 'update-event-modal' ? old('id') : 0 )}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="update-event-id" value="{{old('id')}}">
                        <input type="hidden" id="modalName" name="modalName" value="update-event-modal">
                        <input type="hidden" id="update-timezone" name="timezone">
                        <div class="grid gap-6 mb-6 lg:grid-cols-2">
                            <div>
                                <label for="startDate" class="@error('startDate') text-red-700 @enderror block mb-1 text-sm font-medium text-gray-900">{{__('start_date')}}</label>
                                <input type="datetime-local" name="startDate" id="update-event-startDate" value="{{old('startDate')}}" class="@error('startDate') bg-red-50 border border-red-500 text-red-900 @enderror form-control bg-gray-50 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" required>
                                @error('startDate')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{__('start_date-error')}}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="endDate" class="@error('endDate') text-red-700 @enderror block mb-1 text-sm font-medium text-gray-900">{{__('end_date')}}</label>
                                <input type="datetime-local" name="endDate" id="update-event-endDate" value="{{old('endDate')}}" class="@error('endDate') bg-red-50 border border-red-500 text-red-900 @enderror form-control bg-gray-50 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" required>
                                @error('endDate')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{__('end_date-error')}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-6">
                            <input type="checkbox" name="fullDay" id="update-event-fullDay" class="form-check-input" {{ old('fullDay') ? 'checked' : '' }}>
                            <label for="fullDay" class="form-check-label">{{__('full_day')}}</label>
                        </div>
                        <div class="mb-6">
                            <input type="text" name="title" id="update-event-title" placeholder="{{__('title')}}" value="{{old('title')}}" class="@error('title') bg-red-50 border border-red-500 text-red-900 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" require>
                            @error('title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{__('title-error')}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <textarea name="description" id="update-event-description" placeholder="{{__('description')}}" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{old('description')}}</textarea>
                        </div>
                        <div class="flex justify-between mt-10">
                            <div class="items-center text-sm font-medium text-center text-black rounded-lg focus:ring-4" onclick="closeUpdateModal()">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg%22%3E">
                                    <path d=" M10.2626 16L24.4516 1.81105C24.807 1.45562 24.5435 0.621994 24.1881 0.266569C23.8327 -0.0888563 23.2627 -0.0888563 22.9072 0.266569L7.81173 15.3621C7.45631 15.7175 7.45631 16.2875 7.81173 16.643L22.9072 31.7318C23.0816 31.9061 23.3163 32 23.5443 32C23.7723 32 24.0071 31.9128 24.1814 31.7318C24.5368 31.3763 24.7996 30.5435 24.4442 30.1881L10.2626 16Z"></path>
                                </svg>
                            </div>
                            <button type="submit" class="items-center text-sm font-medium text-center text-black rounded-lg focus:ring-4">
                                <x-ok-button></x-ok-button>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="add-contact-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex">
        <div id="add-contact-modal-opacity" class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50" onclick="closeAddContactModal()"></div>
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow">
                <div class="p-4 rounded-t border-b">
                    <h3 id="update-event-show-title" class="text-xl text-center text-gray-900 font-bold">{{__('add_contact')}}</h3>
                </div>
                <div class="mx-3 mt-3 pb-3">
                    <input type="search" class="w-full relative block py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="{{__('search')}}" aria-label="Search" aria-describedby="button-addon2">
                    <div class="flex flex-col">
                        <div class="flex flex-col justify-between mt-1">
                            <aside>
                                <ul>
                                    @forelse (Auth::user()->contactProposals() as $user)
                                    <div>
                                        <li>
                                            <div class="flex items-center mt-2 text-gray-600 rounded-md hover:bg-gray-200 justify-between w-full" id="user-add-{{ $user->id }}">
                                                <span id="user-text-{{ $user->id }}" class="font-medium flex-auto py-2 pl-4" onclick="showUserProfil({{ $user->id }})">
                                                    {{ $user->name }} {{ $user->lastname }}
                                                </span>
                                                <span class="mr-4 rounded justify-self-end flex-none py-1 px-1 hover:bg-gray-300 hover:shadow-lg" onclick="addContact({{ $user->id }})">
                                                    <svg width="22" height="22" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                                        <g id="user-add-icon-{{ $user->id }}" fill="#000" fill-rule="evenodd">
                                                            <path id="user-add-icon-add-{{ $user->id }}" d="M9.38403 15V13.0321L5.6251 13.0031V9.27856H3.7068V13.0031L0 13.0321V15H3.7068V18.6625H5.6251V15H9.38403Z" />
                                                            <path id="user-add-icon-added-{{ $user->id }}" class="hidden" d="M1 12.7188L3.26562 14.9844L8.25 10" stroke="#1f5c1b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M25.2672 18.1129H14.2084C10.496 18.1129 7.47559 21.1333 7.47559 24.8458V28.7353H32.0001V24.8458C32.0001 21.1334 28.9797 18.1129 25.2672 18.1129ZM30 27H20H9.36551V24.8459C9.36551 21.9391 11.3016 20 14.2084 20H25.2672C28.174 20 30 21.9391 30 24.8459V27Z" />
                                                            <path d="M19.7377 17.4212C23.6406 17.4212 26.8159 14.2459 26.8159 10.3429C26.8159 6.44 23.6406 3.26465 19.7377 3.26465C15.8348 3.26465 12.6594 6.4399 12.6594 10.3429C12.6594 14.246 15.8348 17.4212 19.7377 17.4212ZM19.7377 5C22.8349 5 25 7.2457 25 10.343C25 13.4404 22.8349 15.6817 19.7377 15.6817C16.6404 15.6817 14.5 13.4403 14.5 10.343C14.5 7.2458 16.6404 5 19.7377 5Z" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </div>
                                        </li>
                                    </div>
                                    @empty
                                    NO PROPOSALS
                                    @endforelse
                                </ul>
                            </aside>
                        </div>
                        <div class="flex justify-between mt-5">
                            <div class="items-center text-sm font-medium text-center text-black rounded-lg focus:ring-4" onclick="closeAddContactModal()">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg%22%3E">
                                    <path d=" M10.2626 16L24.4516 1.81105C24.807 1.45562 24.5435 0.621994 24.1881 0.266569C23.8327 -0.0888563 23.2627 -0.0888563 22.9072 0.266569L7.81173 15.3621C7.45631 15.7175 7.45631 16.2875 7.81173 16.643L22.9072 31.7318C23.0816 31.9061 23.3163 32 23.5443 32C23.7723 32 24.0071 31.9128 24.1814 31.7318C24.5368 31.3763 24.7996 30.5435 24.4442 30.1881L10.2626 16Z"></path>
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        @endsection

        @section("script")
        <script>
            function closeNewModal() {
                document.getElementById('new-event-modal').classList.add('hidden');
                return false;
            }

            function closeShowModal() {
                document.getElementById('show-event-modal').classList.add('hidden');
                return false;
            }

            function closeUpdateModal() {
                document.getElementById('update-event-modal').classList.add('hidden');
                return false;
            }

            function destroyEvent() {
                let id = document.getElementById('eventId').value;
                let url = "{{ route('events.destroy', ':id') }}";
                let response = axios.delete(url.replace(':id', id));
                response.then(function(response) {
                    if (response.data.success) {
                        document.getElementById('show-event-modal').classList.add('hidden');
                        window.calendar.getEventById(id).remove();
                    }
                });
            }

            function showAddContactModal() {
                document.getElementById('add-contact-modal').classList.remove('hidden');
                document.getElementById('add-contact-modal-opacity').classList.remove('hidden');
            }

            function closeAddContactModal() {
                document.getElementById('add-contact-modal').classList.add('hidden');
                document.getElementById('add-contact-modal-opacity').classList.add('hidden');
            }


            function addContact(id) {
                let url = "{{ route('contacts.add') }}";
                let response = axios.post(url, {
                    user_id: id
                });
                response.then(function(response) {
                    if (response.data.success) {
                        document.getElementById('user-add-icon-add-' + id).classList.add('hidden');
                        document.getElementById('user-add-icon-added-' + id).classList.remove('hidden');
                        document.getElementById('user-add-icon-' + id).setAttribute('fill', '#1f5c1b');
                        document.getElementById('user-text-' + id).classList.add('text-[#1f5c1b]');
                    }
                });
            }

            function editEvent() {
                let id = document.getElementById('eventId').value;
                let url = "{{ route('events.update', ':id') }}";
                let event = window.calendar.getEventById(id);
                let dt = event.start;;
                document.getElementById('update-event-form').action = url.replace(':id', id);

                document.getElementById('update-event-show-title').innerText = event._def.title;
                document.getElementById('update-event-id').value = event.id;
                document.getElementById('update-timezone').value = new Date().toString().slice(25, 33);
                document.getElementById('update-event-title').value = event._def.title;
                document.getElementById('update-event-description').value = event._def.extendedProps.description;
                document.getElementById('update-event-startDate').value = window.formatDateForInput(event.start);
                document.getElementById('update-event-endDate').value = window.formatDateForInput(event.end);
                document.getElementById('update-event-fullDay').checked = event._def.extendedProps.fullDay;

                document.getElementById('show-event-modal').classList.add('hidden');
                document.getElementById('update-event-modal').classList.remove('hidden');
            }

            window.onload = function() {
                initCalendar();
                const elements = document.getElementsByClassName("load");
                const newEventModalOpacity = document.getElementById("new-event-modal-opacity");
                const newEventModal = document.getElementById('new-event-modal');
                const showEventModalOpacity = document.getElementById("show-event-modal-opacity");
                const showEventModal = document.getElementById('show-event-modal');

                document.getElementById("timezone").value = new Date().toString().slice(25, 33);

                document.getElementById("fullDay").addEventListener("change", function() {
                    if (this.checked) {
                        document.getElementById("endDate").value = document.getElementById("startDate").value.slice(0, 10) + "T23:59";
                    }
                });
                document.getElementById("startDate").addEventListener("change", function() {
                    console.log(this.value);
                    if (document.getElementById("fullDay").checked) {
                        document.getElementById("endDate").value = document.getElementById("startDate").value.slice(0, 10) + "T23:59";
                    }
                });
                newEventModalOpacity.addEventListener('click', () => {
                    newEventModal.classList.add('hidden');
                });
                showEventModalOpacity.addEventListener('click', () => {
                    showEventModal.classList.add('hidden');
                });

                while (elements.length > 0) {
                    elements[0].parentNode.removeChild(elements[0]);
                }
            }
        </script>
        <script>
            function unshowUser(id) {
                const checked = document.getElementById("user-checked-" + id);
                const checkbox = document.getElementById("user-checkbox-show-" + id);
                const text = document.getElementById("user-text-" + id);

                if (checked.value == "true") {
                    checked.value = "false";
                    checkbox.classList.add('hidden');
                    text.classList.add('line-through');
                } else {
                    checked.value = "true";
                    checkbox.classList.remove('hidden');
                    text.classList.remove('line-through');
                }
            }
        </script>
        @endsection