

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @auth
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-6 px-4">
                        <p>Willkommen, {{ Auth::user()->name }}!</p>
                        <x-appointmentForm></x-appointmentForm>

                        <section class="bg-gray-200 p-4 mt-8 rounded-xl md:p-8">
                            <h3 class="text-2xl font-bold">Kalender</h3>
                            @if(isset($appointments))
                                <div class="relative overflow-x-auto mt-6">
                                    <table class="w-full text-sm text-left mb-6">
                                        <thead class="text-xs text-gray-700 uppercase">
                                        <tr class="font-bold">
                                            <th scope="col" class="text-xl font-bold">
                                                Datum
                                            </th>
                                            <th scope="col" class="text-xl font-bold">
                                                Bezeichnung
                                            </th>
                                            <th scope="col" class="text-xl font-bold">
                                                Erinnerung
                                            </th>
                                            <th scope="col" class="text-xl font-bold">
                                                Aktion
                                            </th>
                                        </tr>
                                @foreach($appointments as $appointment)
                                    <x-appointment
                                        appointment_date="{{$appointment->appointment_date}}"
                                        title="{{$appointment->title}}"
                                        reminder_time="{{$appointment->reminder_time}}"
                                        current_appointment="{{$appointment->id}}"/>
                                @endforeach
                                        </thead>
                                    </table>
                                </div>
                            @else
                                <h4>Sie haben keine Daten. Bitte fügen Sie ein Erinnerungsdatum hinzu</h4>
                            @endif
                        </section>
                    </div>
                </div>
            @endauth
            @guest
{{--                TODO impement the design on the screen --}}
                <p>You are a guest. Please log in or register.</p>
            @endguest
        </div>
    </div>
</x-app-layout>
