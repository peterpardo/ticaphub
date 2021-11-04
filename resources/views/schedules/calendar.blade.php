<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
        <div x-data="app()" x-init="[initDate(), getNoOfDays(), getEvents()]" x-cloak>
            <div class="container mx-auto px-4 py-2">
    
                <div class="bg-white rounded-lg shadow overflow-hidden">
    
                    <div class="flex items-center justify-between py-2 px-6">
                        <!-- Months -->
                        <div>
                            <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                            <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                        </div>
                        <div class="border rounded-lg px-1" style="padding-top: 2px;">
                            <button 
                                type="button"
                                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center" 
                                :class="{'cursor-not-allowed opacity-25': month == 0 }"
                                :disabled="month == 0 ? true : false"
                                @click="month--; getNoOfDays()">
                                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>  
                            </button>
                            <div class="border-r inline-flex h-6"></div>		
                            <button 
                                type="button"
                                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1" 
                                :class="{'cursor-not-allowed opacity-25': month == 11 }"
                                :disabled="month == 11 ? true : false"
                                @click="month++; getNoOfDays()">
                                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>									  
                            </button>
                        </div>
                    </div>	
    
                    <div class="-mx-1 -mb-1">
                        <div class="flex flex-wrap" style="margin-bottom: -40px;">
                            <template x-for="(day, index) in DAYS" :key="index">	
                                <div style="width: 14.26%" class="px-2 py-2">
                                    <div
                                        x-text="day" 
                                        class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center"></div>
                                </div>
                            </template>
                        </div>
    
                        <div class="flex flex-wrap border-t border-l">
                            <template x-for="blankday in blankdays">
                                <div 
                                    style="width: 14.28%; height: 120px"
                                    class="text-center border-r border-b px-4 pt-2"	
                                ></div>
                            </template>	
                            <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">	
                                <div style="width: 14.28%; height: 120px" class="px-4 pt-2 border-r border-b relative">
                                    <div
                                        @click="showEventModal(date, 'add')"
                                        x-text="date"
                                        class="inline-flex w-6 h-6 items-center justify-center cursor-pointer text-center leading-none rounded-full transition ease-in-out duration-100"
                                        :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }"	
                                    ></div>
                                    <div style="height: 80px;" class="overflow-y-auto mt-1">
                                        <div 
                                            class="absolute top-0 right-0 mt-2 mr-2 inline-flex items-center justify-center rounded-full text-sm w-6 h-6 bg-gray-700 text-white leading-none"
                                            x-show="events.filter(e => new Date(e.date).toDateString() === new Date(year, month, date).toDateString()).length"
                                            x-text="events.filter(e => new Date(e.date).toDateString() === new Date(year, month, date).toDateString()).length"></div>
    
                                        <template x-for="event in events.filter(e => new Date(e.date).toDateString() ===  new Date(year, month, date).toDateString())">	
                                            <div
                                                class="px-2 py-1 rounded-lg mt-1 overflow-hidden border cursor-pointer"
                                                :class="{
                                                    'border-blue-200 text-blue-800 bg-blue-100 hover:bg-blue-200': event.theme === 'blue',
                                                    'border-red-200 text-red-800 bg-red-100 hover:bg-blue-200': event.theme === 'red',
                                                    'border-yellow-200 text-yellow-800 bg-yellow-100 hover:bg-blue-200': event.theme === 'yellow',
                                                    'border-green-200 text-green-800 bg-green-100 hover:bg-blue-200': event.theme === 'green',
                                                    'border-purple-200 text-purple-800 bg-purple-100 hover:bg-blue-200': event.theme === 'purple'
                                                }"
                                                @click="updateEvent(event.name, event.theme, date, event.attendees, event.id)"
                                            >
                                                <div class="flex flex-col">
                                                    <p x-text="event.name" class="text-sm truncate leading-tight"></p>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Modal -->
            <div style=" background-color: rgba(0, 0, 0, 0.8)" class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full" x-show.transition.opacity="openEventModal">
                <div class="p-4 max-w-xl mx-auto relative left-0 right-0 overflow-hidden mt-24">
                    <div class="shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer"
                        x-on:click="openEventModal = !openEventModal">
                        <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z" />
                        </svg>
                    </div>
    
                    <div class="shadow w-full rounded-lg bg-white overflow-hidden block p-8">
                        
                        <h2 class="font-bold text-2xl mb-6 text-gray-800 border-b pb-2">Add Event Details</h2>
                        <div x-show="showError" class="mb-4">
                            <span x-html="error" class="inline-block w-full text-white text-center rounded py-3 bg-red-500"></span>
                        </div>
                        <div class="mb-4">
                            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Event title</label>
                            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="event_title" @keyup="showError = false">
                        </div>
    
                        <div class="mb-4">
                            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Event date</label>
                            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="event_date" readonly>
                        </div>
    
                        <div class="inline-block w-64 mb-4">
                            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Select a theme</label>
                            <div class="relative">
                                <select @change="event_theme = $event.target.value;" x-model="event_theme" class="block appearance-none w-full bg-gray-200 border-2 border-gray-200 hover:border-gray-500 px-4 py-2 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-gray-700">
                                        <template x-for="(theme, index) in themes">
                                            <option :value="theme.value" x-text="theme.label"></option>
                                        </template>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                {{-- <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg> --}}
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Attendees</label>
                            <div class="mr-2 inline-block text-gray-800">
                                <input type="checkbox" class="mr-1 text-gray-800 " id="panelists" name="attendees[]" value="panelists" x-model="attendees"><label for="panelists">panelists</label>
                            </div>
                            <div class="mr-2 inline-block text-gray-800">
                                <input type="checkbox" class="mr-1 text-gray-800 " id="students" name="attendees[]" value="students" x-model="attendees"><label for="students">students</label>
                            </div>
                            <div class="mr-2 inline-block text-gray-800">
                                <input type="checkbox" class="mr-1 text-gray-800 " id="officers" name="attendees[]" value="officers" x-model="attendees"><label for="officers">officers</label>
                            </div>
                        </div>
    
                        <div 
                            class="mt-8"
                            :class="{'flex justify-between' : showDelete}"
                        >
                            <button type="button" x-show="showDelete" @click.prevent="deleteEvent(event.id)" class="bg-red-800 hover:bg-red-700 text-white font-semibold py-2 px-4 border border-red-700 rounded-lg shadow-sm">
                                Delete
                            </button>
                            <div 
                                class="text-right"
                                :class="{'flex' : showDelete}"
                            >
                                <button class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm mr-2" @click.prevent="openEventModal = !openEventModal">
                                    Cancel
                                </button>	
                                <button class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-700 rounded-lg shadow-sm" @click.prevent="addEvent()">
                                    Save Event
                                </button>	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Modal -->
        </div>

</x-app-layout>