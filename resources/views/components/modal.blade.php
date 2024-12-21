@php
    use Carbon\Carbon;$date_now = Carbon::now();
@endphp
@props(['current_appointment', 'title', 'reminder_time', 'appointment_date'])
<section class="model">

    <button class="editButton font-medium text-blue-600 hover:underline" id="crud-modal-{{$current_appointment}}"
            type="button">
        {{$slot}}
    </button>

    <section id="crud-modal-{{$current_appointment}}" tabindex="-1" aria-hidden="true"
             class="crud-modal-{{$current_appointment}} hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full h-screen flex justify-center items-center max-h-full bg-black bg-opacity-25">
            <!-- Modal content -->
            <div class="fixed bg-white rounded-xl shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Bearbeiten - {{$title}} - Appointment
                    </h3>
                    <button type="button"
                            class="close-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    >
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form id="appointment-form" class="flex justify-between flex-col mt-6 gap-4 p-6" method="POST"
                      action="/edit-appointment/{{$current_appointment}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_email" value="{{Auth::user()->email}}">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="flex-1">
                        <label for="appointment_date" class="mb-4 font-bold inline-flex">Datum
                            <input type="date"
                                   class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5"
                                   id="appointment_date" name="appointment_date"
                                   value="{{ $appointment_date }}" min="{{  $date_now->toDateString()}}"
                                   max="2030-12-31" required/>
                        </label>
                    </div>
                    <div class="flex-1">
                        <label for="title" class="mb-4 font-bold inline-flex">
                            Bezeichnung
                            <input type="text" name="title" required minlength="4" maxlength="50" size="55"
                                   placeholder="Bezeichnung"
                                   value="{{$title}}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5">

                        </label>
                    </div>
                    <div class="flex-1">
                        <label for="reminder_time" class="mb-4 font-bold inline-flex">Erinnerung {{$reminder_time}}
                            <select name="reminder_time"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                <option disabled selected>-- bitte auswählen --</option>
                                @php
                                    $options = [
                                        1 => '1 Tag',
                                        2 => '2 Tage',
                                        4 => '4 Tage',
                                        7 => '1 Woche',
                                        14 => '2 Wochen'
                                    ];
                                @endphp
                                @foreach($options as $value => $label)
                                    <option
                                        value="{{ $value }}" {{ $reminder_time == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <x-primary-button class="mt-9 inline-flex justify-center items-center bg-red-600">
                        Speichern
                    </x-primary-button>
                </form>
            </div>
        </div>
    </section>
</section>

