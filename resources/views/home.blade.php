<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @auth
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-6 px-4">
                        <p>Willkommen, {{ Auth::user()->name }}!</p>
                        <form id="appointment-form">
                            <input type="text" name="title" placeholder="Titel des Termins">
                            <input type="datetime-local" name="appointment_date">
                            <input type="hidden" name="email" value="{{Auth::user()->email}}">
                            <select name="reminder_time">
                                <option value="1">1 Tag</option>
                                <option value="2">2 Tage</option>
                                <option value="4">4 Tage</option>
                                <option value="7">1 Woche</option>
                                <option value="14">2 Wochen</option>
                            </select>
                            <button type="submit">Termin hinzufügen</button>
                        </form>
                        <div id="appointments">
                            {{--                                    @foreach($appointments as $appointment)--}}
                            {{--                                        <div>--}}
                            {{--                                            <p>{{ $appointment->title }} - {{ $appointment->appointment_date }}</p>--}}
                            {{--                                            <button onclick="deleteAppointment({{ $appointment->id }})">Löschen</button>--}}
                            {{--                                        </div>--}}
                            {{--                                    @endforeach--}}
                        </div>
                        <section class="bg-gray-200 p-4 mt-8 rounded-xl md:p-8">
                            <h3 class="text-2xl font-bold">Kalender</h3>
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
                                    </thead>
                                    <x-appointment appointment_date="01.01." title="Hohzeitstag" reminder_time="1 Tage"></x-appointment>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            @endauth
            @guest
                <p>You are a guest. Please log in or register.</p>
            @endguest
        </div>
    </div>
</x-app-layout>
